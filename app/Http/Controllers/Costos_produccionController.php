<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Cif;
use App\Models\Cliente;
use App\Models\CostosProduccion;
use App\Models\idimcol;
use App\Models\MateriaPrimaDirecta;
use App\Models\MateriaPrimaIndirecta;
use App\Models\Operativo;
use App\Models\SDP;
use App\Models\Tiempos_produccion;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Costos_produccionController extends Controller
{
    public function index()
    {
        // Obtener todas las SDPs con relaciones necesarias
        $sdps = SDP::with('vendedores', 'clientes')->get();
        $tiempos_produccion = Tiempos_produccion::with('operativo')->get();

        return view('costos_produccion.index', compact('sdps', 'tiempos_produccion'));
    }

    public function show($id)
    {
        // Obtener el SDP junto con las relaciones necesarias
        $sdp = SDP::with('articulos', 'costosProduccion')->where('numero_sdp', $id)->firstOrFail();
        Log::info('SDP obtenido:', ['sdp' => $sdp]);
        $costoProduccion = $sdp->costosProduccion()->first();

        $materiasPrimasDirectas = $costoProduccion->materiasPrimasDirectas()
            ->withPivot('cantidad', 'articulo_id', 'articulo_descripcion', 'materia_prima_directa_id', 'costos_produccion_id',)
            ->get();

        // Obtener las materias primas indirectas asociadas a la SDP
        $materiasPrimasIndirectas = $costoProduccion->materiasPrimasIndirectas()
            ->withPivot('cantidad', 'articulo_id', 'articulo_descripcion', 'materia_indirecta_id', 'costos_produccion_id')
            ->get();

        $total= 0;

        $articulosConSubtotales = $sdp->articulos->map(function ($articulo) use (&$total) {
            // Calcular el subtotal del artículo
            $subtotal = $articulo->pivot->cantidad * $articulo->pivot->precio;
            // Acumulando el subtotal al total general
            $total += $subtotal;
            // Agregar el subtotal al artículo
            return $articulo->setAttribute('subtotal', $subtotal);
        });

         // Obtener los artículos que están asociados a tiempos de producción para esta SDP // Filtrar por sdp_id en la tabla pivot
        $articulosConTiempos = $articulosConSubtotales->filter(function ($articulo) use ($sdp) {
            return Articulo::whereHas('tiemposProduccion', function ($query) use ($sdp, $articulo) {
                // Especificar correctamente la tabla para evitar ambigüedad
                $query->where('tiempos_produccions.sdp_id', $sdp->numero_sdp) // Asegúrate de que 'tiempos_produccions' es correcto
                    ->where('articulo_tiempos_produccion.articulo_id', $articulo->id);
            })->exists();
        });

        $totalManoObra = 0;

        $articulosConManoDeObra = $articulosConTiempos->map(function ($articulo) use ($sdp, &$totalManoObra) {
            // Obtener el tiempo de producción asociado a este artículo
            $tiemposProduccion = $articulo->tiemposProduccion()->where('articulo_tiempos_produccion.sdp_id', $sdp->numero_sdp)->get();

            $operarios = [];

            foreach ($tiemposProduccion as $tiempo) {
                
                $operario = $tiempo->operativo; // Asegúrate de que aquí tienes el operario correcto
                $servicio = $tiempo->servicio;
                if ($operario) {
                    // Obtener el trabajador asociado al operario
                    $trabajador = $operario->trabajador;
        
                    if ($trabajador) {
                        // Obtener el último sueldo del trabajador
                        $sueldo = $trabajador->sueldos()->orderBy('created_at', 'desc')->first()->sueldo ?? 0; // Asegúrate de que esto se ajusta a tu lógica para obtener el sueldo

                        $valor_servicio = $servicio->orderBy('created_at', 'desc')->first()->valor_hora ?? 0;
                        $servicio_nombre = $servicio->orderBy('created_at', 'desc')->first()->nombre;
        
                        // Guardar el sueldo y operario
                        $operarios[] = [
                            'codigo' => $operario->codigo,
                            'nombre' => $operario->operario,
                            'sueldo' => $sueldo, 
                            'valor_servicio' => $valor_servicio,
                            'servicio_nombre' => $servicio_nombre
                        ];
                    }
                }

                $costoProduccion = CostosProduccion::where('tiempo_produccion_id', $tiempo->id)
                    ->where('sdp_id', $sdp->numero_sdp)
                    ->first();

                if ($costoProduccion) {
                    $manoDeObraDirecta = $costoProduccion->mano_obra_directa;
                    $totalManoObra += $manoDeObraDirecta;
                    $articulo->setAttribute('mano_de_obra_directa', $manoDeObraDirecta);
                }
            }
            $articulo->setAttribute('operarios', $operarios);
            return $articulo;
        });

        // Obtener otros datos adicionales (IDIMCOL en tu caso, si es necesario)
        $idimcols = Idimcol::all();

        // Retornar la vista con los datos calculados
        return view('costos_produccion.show', compact('sdp', 'totalManoObra', 'articulosConManoDeObra', 'articulosConTiempos', 'total', 'articulosConSubtotales', 'idimcols'));
    }
public function resumen($id)
    {
        // Obtener el SDP junto con las relaciones necesarias
        $sdp = SDP::where('numero_sdp', $id)->firstOrFail();
        Log::info('SDP obtenido:', ['sdp' => $sdp]);

        // Inicializar el total y otros valores globales
        $total = 0;
        $totalMOI = Cif::sum('MOI');
        $totalGOI = Cif::sum('GOI');
        $totalOCI = Cif::sum('OCI');
        $totalCIF = $totalMOI + $totalGOI + $totalOCI;

        // Obtener costos de producción y calcular la mano de obra total
        $costosProduccion = CostosProduccion::where('sdp_id', $sdp->numero_sdp)->first();
        $totalManoObra = $costosProduccion->mano_obra_directa ?? 0; // Usar coalescencia nula

        // Obtener el total de horas operativas asociadas al SDP
        $totalHorasOperarios = Tiempos_produccion::where('sdp_id', $sdp->numero_sdp)->sum('horas');
        Log::info('Total horas operarios:', ['totalHorasOperarios' => $totalHorasOperarios]);

        $articulosSeleccionados = $sdp->articulos()
            ->whereHas('articulo_tiempos_produccion')
            ->get();

        // Mapear los artículos y calcular los valores relacionados
        $articulosConSubtotales = $articulosSeleccionados->map(function ($articulo) use (&$total, $sdp, $costosProduccion) {
            // Calcular el subtotal del artículo
            $subtotal = $articulo->pivot->cantidad * $articulo->pivot->precio;
            $total += $subtotal;


            // Obtener costos de producción para el artículo
            $costosProduccion = CostosProduccion::where('sdp_id', $sdp->numero_sdp)->first();

            // Calcular los costos de producción relacionados
            $totalManoObraArticulo = $costosProduccion ? $costosProduccion->mano_obra_directa / $sdp->articulos->count() : 0;
            $totalDirectasArticulo = $costosProduccion ? $costosProduccion->materiasPrimasDirectas->sum(function ($materiaPrima) {
                return $materiaPrima->pivot->cantidad * $materiaPrima->precio_unit;
            }) / $sdp->articulos->count() : 0;

            // Costos Indirectos
            $totalMOI = Cif::sum('MOI');
            $totalGOI = Cif::sum('GOI');
            $totalOCI = Cif::sum('OCI');
            $cifPorArticulo = ($totalMOI + $totalGOI + $totalOCI) / $sdp->articulos->count();

            // Cálculos adicionales si es necesario
            $materiasPrimasIndirectas = $costosProduccion ? $costosProduccion->materiasPrimasIndirectas->sum(function ($materiaPrima) {
                return $materiaPrima->pivot->cantidad * $materiaPrima->precio_unit;
            }) / $sdp->articulos->count() : 0; // Define según tu lógica si hay materias primas indirectas

            // Calcular la utilidad bruta por artículo
            $utilidadBrutaArticulo = $subtotal - $totalManoObraArticulo - $totalDirectasArticulo - $cifPorArticulo;
            
            // Calcular el margen bruto por artículo
            $margenBrutoArticulo = ($utilidadBrutaArticulo / $subtotal) * 100;

            // Retornar el artículo con nuevos atributos
            return $articulo->setAttribute('subtotal', $subtotal)
                            ->setAttribute('mano_obra_directa', $totalManoObraArticulo)
                            ->setAttribute('materias_primas_directas', $totalDirectasArticulo)
                            ->setAttribute('materias_primas_indirectas', $materiasPrimasIndirectas) // Defínelo si es aplicable
                            ->setAttribute('cif', $cifPorArticulo)
                            ->setAttribute('utilidad_bruta', $utilidadBrutaArticulo)
                            ->setAttribute('margen_bruto', $margenBrutoArticulo);
        });

    // Obtener costos de producción específicos para el SDP
        $costosProduccion = CostosProduccion::where('sdp_id', $sdp->numero_sdp)->get();
        Log::info('Costos de producción obtenidos:', ['costosProduccion' => $costosProduccion]);

        // Obtener información adicional
        $idimcols = idimcol::all();
        $cifs = Cif::all();

        // Log de los CIFs totales
        Log::info('Totales CIFs:', ['MOI' => $totalMOI, 'GOI' => $totalGOI, 'OCI' => $totalOCI]);

        return view('costos_produccion.resumen', compact('sdp', 'totalMOI', 'totalGOI', 'total', 'totalOCI', 'idimcols', 'costosProduccion', 'cifs', 'totalHorasOperarios', 'totalManoObra', 'articulosConSubtotales', 'totalCIF'));
    }
}
