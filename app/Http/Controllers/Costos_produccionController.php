<?php

namespace App\Http\Controllers;

use App\Models\Cif;
use App\Models\Cliente;
use App\Models\CostosProduccion;
use App\Models\idimcol;
use App\Models\Operativo;
use App\Models\SDP;
use App\Models\Tiempos_produccion;
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
    $sdp = SDP::where('numero_sdp', $id)->with('articulos')->firstOrFail();
    Log::info('SDP obtenido:', ['sdp' => $sdp]);

    $articulosSdp = $sdp->articulos;

    // Obtener todos los artículos de la SDP
    $total = 0;

    // Calcular el subtotal para cada artículo y el total general
    foreach ($articulosSdp as $articulo) {
        $subtotal = $articulo->pivot->cantidad * $articulo->pivot->precio;
        $articulo->setAttribute('subtotal', $subtotal);
        $total += $subtotal;
    }

    // Inicializar el total y otros valores globales
    $totalMOI = Cif::sum('MOI');
    $totalGOI = Cif::sum('GOI');
    $totalOCI = Cif::sum('OCI');
    $totalCIF = $totalMOI + $totalGOI + $totalOCI;


    // Obtener costos de producción y calcular la mano de obra total
    $costosProduccion = CostosProduccion::where('sdp_id', $sdp->numero_sdp)->first();
    $totalManoObra = $costosProduccion->mano_obra_directa ?? 0; // Usar coalescencia nula

    $tiemposProduccion = Tiempos_produccion::where('sdp_id', $sdp->numero_sdp)->get();
    $manoObraTotal = 0;
    $manoObraPorOperario = [];

    foreach ($tiemposProduccion as $tiempo) {
        // Calcular la diferencia de horas entre la hora_inicio y hora_fin
        $horaInicio = Carbon::parse($tiempo->hora_inicio);
        $horaFin = Carbon::parse($tiempo->hora_fin);
        $horasTrabajadas = $horaInicio->diffInHours($horaFin);

        // Obtener el valor del servicio seleccionado
        $valorServicio = $tiempo->servicio->valor_hora; // Asumiendo que tienes una relación con el modelo Servicio

        // Calcular la mano de obra para este tiempo
        $manoObra = $sdp->mano_obra_directa + $valorServicio + 
                    ($totalMOI * $horasTrabajadas) + 
                    ($totalGOI * $horasTrabajadas) + 
                    ($totalOCI * $horasTrabajadas);

        // Sumar la mano de obra al total
        $manoObraTotal += $manoObra;

        $manoObraPorOperario[] = [
            'nombre_operario' => $tiempo->nombre_operario,
            'servicio' => $tiempo->nombre_servicio,
            'horas_trabajadas' => $horasTrabajadas,
            'valor_servicio' => $valorServicio,
            'mano_obra' => $manoObra
        ];
    }

    // Obtener el total de horas operativas asociadas al SDP
    $totalHorasOperarios = Tiempos_produccion::where('sdp_id', $sdp->numero_sdp)->sum('horas');
    Log::info('Total horas operarios:', ['totalHorasOperarios' => $totalHorasOperarios]);

    // Obtener artículos filtrados (ajusta los criterios según sea necesario)
    $articulosFiltrados = $sdp->articulos()->whereHas('articulo_tiempos_produccion')->get();

    // Mapear los artículos filtrados y calcular los valores relacionados
    $articulosConSubtotales = $articulosFiltrados->map(function ($articulo) use (&$sdp, $costosProduccion) {
        // Calcular el subtotal del artículo
        $subtotal = $articulo->pivot->cantidad * $articulo->pivot->precio;

        // Obtener costos de producción para el artículo
        $totalManoObraArticulo = $costosProduccion ? $costosProduccion->mano_obra_directa / $sdp->articulos->count() : 0;
        $totalDirectasArticulo = $costosProduccion ? $costosProduccion->materiasPrimasDirectas->sum(function ($materiaPrima) {
            return $materiaPrima->pivot->cantidad * $materiaPrima->precio_unit;
        }) / $sdp->articulos->count() : 0;

        // Costos Indirectos
        $totalMOI = Cif::sum('MOI');
        $totalGOI = Cif::sum('GOI');
        $totalOCI = Cif::sum('OCI');
        $cifPorArticulo = ($totalMOI + $totalGOI + $totalOCI) / $sdp->articulos->count();

        // Calcular la utilidad bruta por artículo
        $utilidadBrutaArticulo = $subtotal - $totalManoObraArticulo - $totalDirectasArticulo - $cifPorArticulo;

        // Calcular el margen bruto por artículo
        $margenBrutoArticulo = ($utilidadBrutaArticulo / $subtotal) * 100;

        // Retornar el artículo con nuevos atributos
        return $articulo->setAttribute('subtotal', $subtotal)
                            ->setAttribute('mano_obra_directa', $totalManoObraArticulo)
                            ->setAttribute('materias_primas_directas', $totalDirectasArticulo)
                            ->setAttribute('cif', $cifPorArticulo)
                            ->setAttribute('utilidad_bruta', $utilidadBrutaArticulo)
                            ->setAttribute('margen_bruto', $margenBrutoArticulo);
    });

    // Obtener información adicional
    $idimcols = idimcol::all();
    $cifs = Cif::all();

    // Log de los CIFs totales
    Log::info('Totales CIFs:', ['MOI' => $totalMOI, 'GOI' => $totalGOI, 'OCI' => $totalOCI]);
    
    // Retornar la vista con toda la información calculada
    return view('costos_produccion.show', compact('sdp', 'totalHorasOperarios', 'totalMOI','totalGOI', 'totalOCI', 'manoObraPorOperario','manoObraTotal', 'articulosSdp', 'total', 'idimcols', 'costosProduccion', 'cifs', 'totalHorasOperarios', 'totalManoObra', 'articulosConSubtotales'));
}

    private function listarManoObraDirectaPorOperario($sdpId)
    {
        // Obtener los tiempos de producción agrupados por operario
        $tiemposProduccionAgrupados = Tiempos_produccion::where('sdp_id', $sdpId)
            ->with('operativo.trabajador.sueldos')
            ->select('operativo_id', DB::raw('SUM(horas) as total_horas'))
            ->groupBy('operativo_id')
            ->get();
        Log::info('Tiempos de producción agrupados:', ['tiemposProduccionAgrupados' => $tiemposProduccionAgrupados]);

        $resultados = [];

        // Recorrer cada agrupación de tiempos de producción
        foreach ($tiemposProduccionAgrupados as $tiempoProduccion) {
            $operativo = $tiempoProduccion->operativo;
            $trabajador = $operativo->trabajador;

            if ($trabajador) {
                // Obtener el sueldo más reciente del trabajador
                $sueldo = $trabajador->sueldos()->orderBy('created_at', 'desc')->first()->sueldo ?? 0;

                // Obtener el número de horas laborales al mes desde el CIF más reciente
                $cif = Cif::orderBy('created_at', 'desc')->first();
                $horasMes = $cif->NMH ?? 0;

                // Verificar que las horas por mes no sean cero para evitar división por cero
                if ($horasMes > 0) {
                    // Calcular el costo por hora
                    $costoPorHora = $sueldo / $horasMes;
                    Log::info('Costo por hora calculado:', [
                        'sueldo' => $sueldo,
                        'horasMes' => $horasMes,
                        'costoPorHora' => $costoPorHora
                    ]);

                    // Calcular la mano de obra directa total para el operario
                    $manoObraDirectaTotal = $costoPorHora * $tiempoProduccion->total_horas;
                    Log::info('Mano de obra directa total para el operario:', [
                        'operativo_id' => $tiempoProduccion->operativo_id,
                        'total_horas' => $tiempoProduccion->total_horas,
                        'manoObraDirectaTotal' => $manoObraDirectaTotal
                    ]);

                    // Almacenar los resultados
                    $resultados[] = [
                        'operativo_id' => $tiempoProduccion->operativo_id,
                        'nombre_operario' => $trabajador->nombre, // Asumiendo que el modelo Trabajador tiene el atributo 'nombre'
                        'sueldo' => $sueldo,
                        'total_horas' => $tiempoProduccion->total_horas,
                        'mano_obra_directa_total' => $manoObraDirectaTotal
                    ];
                } else {
                    Log::warning('Horas mes es cero o no está definido para el CIF:', ['cif' => $cif]);
                }
            } else {
                Log::warning('Trabajador no encontrado para el operativo:', ['operativo_id' => $tiempoProduccion->operativo_id]);
            }
        }

        return $resultados;
    }

    public function actualizarManoObraDirecta($sdpId)
    {
        // Obtener todos los tiempos de producción asociados al SDP
        $tiemposProduccionAgrupados = Tiempos_produccion::where('sdp_id', $sdpId)
            ->with('operativo.trabajador.sueldos')
            ->select('operativo_id', DB::raw('SUM(horas) as total_horas'))
            ->groupBy('operativo_id')
            ->get();

        Log::info('Tiempos de producción agrupados para actualización:', ['tiemposProduccionAgrupados' => $tiemposProduccionAgrupados]);

        // Obtener el CIF más reciente
        $cif = Cif::orderBy('created_at', 'desc')->first();
        $horasMes = $cif->NMH ?? 0;

        // Recorre cada agrupación de tiempos de producción
        foreach ($tiemposProduccionAgrupados as $tiempoProduccion) {
            $operativo = $tiempoProduccion->operativo;
            $trabajador = $operativo->trabajador;

            if ($trabajador) {
                // Obtener el sueldo más reciente del trabajador
                $sueldo = $trabajador->sueldos()->orderBy('created_at', 'desc')->first()->sueldo ?? 0;

                if ($horasMes > 0) {
                    // Calcular el costo por hora
                    $costoPorHora = $sueldo / $horasMes;

                    // Calcular la mano de obra directa total para el operario
                    $manoObraDirectaTotal = $costoPorHora * $tiempoProduccion->total_horas;
                    Log::info('Mano de obra directa calculada para el operario:', [
                        'operativo_id' => $tiempoProduccion->operativo_id,
                        'total_horas' => $tiempoProduccion->total_horas,
                        'manoObraDirectaTotal' => $manoObraDirectaTotal
                    ]);

                    // Actualizar el campo mano_obra_directa en la tabla costos_produccion
                    CostosProduccion::where('sdp_id', $sdpId)
                        ->where('operativo_id', $tiempoProduccion->operativo_id)
                        ->update(['mano_obra_directa' => $manoObraDirectaTotal]);
                } else {
                    Log::warning('Horas mes es cero o no está definido para el CIF:', ['cif' => $cif]);
                }
            } else {
                Log::warning('Trabajador no encontrado para el operativo:', ['operativo_id' => $tiempoProduccion->operativo_id]);
            }
        }

        Log::info('Actualización de mano de obra directa completada para SDP:', ['sdp_id' => $sdpId]);
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
