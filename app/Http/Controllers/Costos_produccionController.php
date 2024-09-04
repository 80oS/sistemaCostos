<?php

namespace App\Http\Controllers;

use App\Models\Cif;
use App\Models\Cliente;
use App\Models\CostosProduccion;
use App\Models\idimcol;
use App\Models\Operativo;
use App\Models\SDP;
use App\Models\Tiempos_produccion;
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
        $sdp = SDP::where('numero_sdp', $id)->firstOrFail();
        Log::info('SDP obtenido:', ['sdp' => $sdp]);

        // Inicializar el total
        $total = 0;

        // Calcular el subtotal de cada artículo y acumular al total
        $articulosConSubtotales = $sdp->articulos->map(function ($articulo) use (&$total) {
            // Calcular el subtotal del artículo
            $subtotal = $articulo->pivot->cantidad * $articulo->precio;
            // Acumular el subtotal al total general
            $total += $subtotal;
            // Agregar el subtotal al artículo
            Log::info('Subtotal calculado para el artículo:', [
                'articulo_id' => $articulo->id,
                'cantidad' => $articulo->pivot->cantidad,
                'precio' => $articulo->precio,
                'subtotal' => $subtotal,
                'total_acumulado' => $total
            ]);
            return $articulo->setAttribute('subtotal', $subtotal);
        });

        // Filtrar costos de producción específicos para el SDP
        $costosProduccion = CostosProduccion::where('sdp_id', $sdp->numero_sdp)->get();
        Log::info('Costos de producción obtenidos:', ['costosProduccion' => $costosProduccion]);
        // Obtener información adicional (si es necesario)
        $idimcols = idimcol::all();
        $cifs = Cif::all();

        $totalHorasOperarios = Tiempos_produccion::where('sdp_id', $sdp->numero_sdp)
        ->sum('horas');
        Log::info('Total horas operarios:', ['totalHorasOperarios' => $totalHorasOperarios]);

        $totalManoObra = CostosProduccion::where('sdp_id', $sdp->numero_sdp)->sum('mano_obra_directa');
        Log::info('Total mano de obra:', ['totalManoObra' => $totalManoObra]);

        $totalMOI = $cifs->sum('MOI');
        $totalGOI = $cifs->sum('GOI');
        $totalOCI = $cifs->sum('OCI');
        Log::info('Totales CIFs:', ['MOI' => $totalMOI, 'GOI' => $totalGOI, 'OCI' => $totalOCI]);

        $costosProduccionPorOperario = $this->listarManoObraDirectaPorOperario($sdp->numero_sdp);

        $subtotalesOperarios = collect($costosProduccionPorOperario)->map(function ($item) use ($totalMOI, $totalGOI, $totalOCI) {
            $subtotal = $item['mano_obra_directa_total'] + $totalMOI + $totalGOI + $totalOCI;
            return $subtotal;
        });

        $totalGeneral = $subtotalesOperarios->sum();
        Log::info('Total general calculado:', ['totalGeneral' => $totalGeneral]);

        $cif = ($totalMOI*$totalHorasOperarios)+($totalGOI*$totalHorasOperarios)+($totalOCI*$totalHorasOperarios);
        Log::info('CIF calculado:', ['cif' => $cif]);

        $utilidad_bruta = $total-$totalManoObra-0-$cif;
        Log::info('Utilidad bruta calculada:', ['utilidad_bruta' => $utilidad_bruta]);

        $margen_bruto = ($utilidad_bruta/$total)*100;

        return view('costos_produccion.show', compact('sdp', 
                                                    'total', 'idimcols', 'costosProduccion', 
                                                    'cifs', 'costosProduccionPorOperario', 'totalMOI', 
                                                    'totalGOI', 'totalOCI', 'totalHorasOperarios',
                                                    'totalManoObra', 'totalGeneral', 'cif', 'utilidad_bruta', 'margen_bruto'));
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
}
