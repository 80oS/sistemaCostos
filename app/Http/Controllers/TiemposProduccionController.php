<?php

namespace App\Http\Controllers;

use App\Enums\Departamento;
use App\Models\Articulo;
use App\Models\ArticuloTiempoProduccion;
use App\Models\CostosProduccion;
use App\Models\Operativo;
use App\Models\Operativos;
use App\Models\SDP;
use App\Models\Servicio;
use App\Models\Tiempos_produccion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Log;

class TiemposProduccionController extends Controller
{

    public function index($codigoOperario)
    {
        $tiempos_produccion = Tiempos_produccion::where('operativo_id', $codigoOperario)
            ->with('operativo', 'servicio', 'sdp', 'cif')
            ->get();

        return view('tiemposproduccion.lista', compact('tiempos_produccion'));
    }

    public function groupByOperario()
    {
        $tiempos_produccion = Tiempos_produccion::with('operativo', 'servicio', 'sdp')
            ->get()->groupBy('operativo_id');
    
        return view('tiemposproduccion.index', compact('tiempos_produccion'));
    }

    public function getArticulos($sdpId)
    {
        // Asegúrate de que el $sdpId sea el id de la tabla sdps, no el numero_sdp
        $sdp = Sdp::with('articulos')->findOrFail($sdpId);

        // Obtener los artículos relacionados
        $articulos = $sdp->articulos;

        // Verificar si los artículos se están recuperando correctamente
        foreach ($articulos as $articulo) {
            Log::info('Artículo relacionado:', [
                'articulo_id' => $articulo->id,
                'cantidad' => $articulo->pivot->cantidad,
                'precio' => $articulo->pivot->precio
            ]);
        }

        $articulosSeleccionadosIds = ArticuloTiempoProduccion::pluck('articulo_id')->toArray();

        $articulos = $sdp->articulos->map(function ($articulo) use ($articulosSeleccionadosIds) {
            $articulo->ya_seleccionado = in_array($articulo->id, $articulosSeleccionadosIds);
            return $articulo;
        });

        // Devolver los artículos como respuesta JSON
        return response()->json($articulos);
    }


    public function create()
    {
        // Obtener operativos asociados a trabajadores en el departamento de producción
        $operativos = Operativo::with('trabajador')->orderBy('codigo')->get();

        // Obtener todos los servicios y SDPs
        $servicios = Servicio::all();
        $sdps = SDP::with('clientes', 'articulos')->get();
        
        // Obtener el ID de la SDP desde la sesión
        $sdpId = session('sdp_id');

        // Verificar que el SDP está seleccionado
        if ($sdpId) {
            // Obtener la SDP seleccionada con sus artículos
            $sdpSeleccionada = SDP::with('articulos')->findOrFail($sdpId);

            // Filtrar los artículos relacionados a la SDP
            $articulosSeleccionados = $sdpSeleccionada->articulos;

            Log::info('SDP seleccionada con artículos:', ['sdp_id' => $sdpId, 'articulos' => $articulosSeleccionados]);

            // Depurar artículos con pivot
            foreach ($articulosSeleccionados as $articulo) {
                Log::info('Artículo relacionado:', [
                    'articulo_id' => $articulo->id,
                    'cantidad' => $articulo->pivot->cantidad,
                    'precio' => $articulo->pivot->precio
                ]);
            }
        } else {
            // Si no hay SDP seleccionada, inicializar un array vacío
            $articulosSeleccionados = collect();
        }

        $articulosSeleccionadosIds = ArticuloTiempoProduccion::pluck('articulo_id')->toArray();

        return view('tiemposproduccion.create', compact(
            'operativos',
            'servicios',
            'sdps',
            'articulosSeleccionados',
            'articulosSeleccionadosIds',
            'sdpId'
        ));
    }


    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'dia' => 'required|integer|min:1|max:31',
            'mes' => 'required|integer|min:1|max:12',
            'año' => 'required|integer|min:1900|max:' . date('Y'),
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio',
            'operativo_id' => 'required|exists:operativos,codigo',
            'proseso_id' => 'required|exists:servicios,codigo',
            'sdp_id' => 'required|exists:sdps,numero_sdp',
            'nombre_operario' => 'required|string|max:255',
            'nombre_servicio' => 'required|string|max:255',
            'articulos.articulo_id.*' => 'required|exists:articulos,id',
        ]);

        DB::beginTransaction();

        try {
            Log::info('Iniciando creación de tiempo de producción', $request->all());

            // Crear el registro de Tiempos_produccion
            $tiempoProduccion = Tiempos_produccion::create([
                'dia' => $request->dia,
                'mes' => $request->mes,
                'año' => $request->año,
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
                'operativo_id' => $request->operativo_id,
                'proseso_id' => $request->proseso_id,
                'sdp_id' => $request->sdp_id,
                'nombre_operario' => $request->nombre_operario,
                'nombre_servicio' => $request->nombre_servicio,
                'cif_id' => 1,
                'valor_total_horas' => 0,
                'horas' => 0
            ]);

            Log::info('Tiempo de producción creado exitosamente', ['tiempos_produccion_id' => $tiempoProduccion->id]);

            // Calcular el tiempo valor total para el registro creado
            $total_horas = $tiempoProduccion->Calcularvalor_total_horas();
            $horas = $tiempoProduccion->Calculartotalhoras();

            Log::info('Cálculos realizados', ['total_horas' => $total_horas, 'horas' => $horas]);

            if ($total_horas === null && $horas === null) {
                Log::warning('Error al calcular valor total de horas o total de horas');
                return redirect()->back()->withErrors('Error al calcular el tiempo valor total.');
            }

            $costoProduccion = new CostosProduccion();
            $costoProduccion->tiempo_produccion_id = $tiempoProduccion->id;
            $costoProduccion->mano_obra_directa = 0;
            $costoProduccion->sdp_id = $tiempoProduccion->sdp_id;
            $costoProduccion->cif_id = 1;
            $costoProduccion->save();

            Log::info('Costo de producción guardado', ['costo_produccion_id' => $costoProduccion->id]);

            $costoProduccion->servicios()->attach($costoProduccion->id, [
                'servicio_id' => $tiempoProduccion->proseso_id,
                'tiempos_produccion_id' => $tiempoProduccion->id,
                'costos_produccion_id' => $costoProduccion->id,
                'sdp_id' => $tiempoProduccion->sdp_id,
                'valor_servicio' => 0
            ]);

            // Procesar los artículos, si existen
            if ($request->has('articulos')) {
                Log::info('Procesando artículos asociados');
                
                $articulosData = [];
                foreach ($request->articulos['articulo_id'] as $articuloId) {
                    $articulosData[] = [
                        'tiempos_produccion_id' => $tiempoProduccion->id,
                        'articulo_id' => $articuloId,
                        'sdp_id'=> $tiempoProduccion->sdp_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                if (!empty($articulosData)) {
                    $tiempoProduccion->articulos()->attach($articulosData);
                    Log::info('Artículos asociados correctamente', ['articulos' => $articulosData]);
            
                     // Calcular la mano de obra directa solo para los artículos asociados
                $costoProduccion->calcularManoObraDirecta();
            }
        }

        DB::commit();

            // Redireccionar con éxito
            Log::info('Tiempo de producción creado exitosamente, redirigiendo');
            return redirect()->route('tiempos.group')->with([
                'success' => 'Tiempo de producción creado exitosamente.',
                'valor_total_horas' => 'Valor total de horas: ' . $total_horas,
                'total_horas' => 'Total de horas: ' . $horas,
            ]);

        } catch (\Exception $e) {
            // Manejo de excepciones y registro de errores
            Log::error('Error al crear tiempo de producción: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error al crear tiempo de producción. Por favor, intente de nuevo.');
        }
    }

    public function recalcular($id)
    {
        try {
            // Encontrar la instancia de Tiempos_produccion por su ID
            $tiempoProduccion = Tiempos_produccion::findOrFail($id);

            // Recalcular el tiempo_valor_total
            $total_horas = $tiempoProduccion->Calcularvalor_total_horas();
            $horas = $tiempoProduccion->Calculartotalhoras();

            // Verificar si el cálculo fue exitoso
            if (is_null($horas) && is_null($total_horas)) {
                return redirect()->back()->with('error', 'Error al recalcular ambos valores totales.');
            } elseif (is_null($horas)) {
                return redirect()->back()->with('error', 'Error al recalcular horas.');
            } elseif (is_null($total_horas)) {
                return redirect()->back()->with('error', 'Error al recalcular valor_total_horas.');
            }

            // Devolver una respuesta de éxito
            return redirect()->back()->with('success', 'Valores totales recalculados con éxito.');
    } catch (\Exception $e) {
        // Registrar el error
        Log::error('Error al recalcular los valores totales: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
        
        // Devolver una respuesta de error
        return redirect()->back()->with('error', 'Error al recalcular los valores totales.');
    }
    }


    public function edit(string $id)
    {
        $tiempo_produccion = Tiempos_produccion::findOrFail($id);
        $servicios = Servicio::all();

        $sdps = SDP::with('clientes', 'articulos')->get();
        
        // Obtener el ID de la SDP desde la sesión
        $sdpId = session('sdp_id');

        // Verificar que el SDP está seleccionado
        if ($sdpId) {
            // Obtener la SDP seleccionada con sus artículos
            $sdpSeleccionada = SDP::with('articulos')->findOrFail($sdpId);

            // Filtrar los artículos relacionados a la SDP
            $articulosSeleccionados = $sdpSeleccionada->articulos;

            Log::info('SDP seleccionada con artículos:', ['sdp_id' => $sdpId, 'articulos' => $articulosSeleccionados]);

            // Depurar artículos con pivot
            foreach ($articulosSeleccionados as $articulo) {
                Log::info('Artículo relacionado:', [
                    'articulo_id' => $articulo->id,
                    'cantidad' => $articulo->pivot->cantidad,
                    'precio' => $articulo->pivot->precio
                ]);
            }
        } else {
            // Si no hay SDP seleccionada, inicializar un array vacío
            $articulosSeleccionados = collect();
        }

        $articulosSeleccionadosIds = ArticuloTiempoProduccion::pluck('articulo_id')->toArray();

        return view('tiemposproduccion.edit', compact('tiempo_produccion', 'servicios', 'sdps', 'articulosSeleccionados', 'articulosSeleccionadosIds'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'dia' => 'required|integer|min:1|max:31',
            'mes' => 'required|integer|min:1|max:12',
            'año' => 'required|integer|min:1900|max:' . date('Y'),
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio',
            'operativo_id' => 'required|exists:operativos,codigo',
            'proseso_id' => 'required|exists:servicios,codigo',
            'sdp_id' => 'required|exists:sdps,numero_sdp',
            'nombre_operario' => 'required|string|max:255',
            'nombre_servicio' => 'required|string|max:255',
            'articulos.articulo_id.*' => 'required|exists:articulos,id',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Buscar el registro existente por ID
            $tiempoProduccion = Tiempos_produccion::findOrFail($id);
    
            Log::info('Iniciando actualización de tiempo de producción', $request->all());
    
            // Actualizar los campos de tiempo de producción
            $tiempoProduccion->update([
                'dia' => $request->dia,
                'mes' => $request->mes,
                'año' => $request->año,
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
                'operativo_id' => $request->operativo_id,
                'proseso_id' => $request->proseso_id,
                'sdp_id' => $request->sdp_id,
                'nombre_operario' => $request->nombre_operario,
                'nombre_servicio' => $request->nombre_servicio,
            ]);
    
            Log::info('Tiempo de producción actualizado exitosamente', ['tiempos_produccion_id' => $tiempoProduccion->id]);
    
            // Calcular el valor total de horas y las horas
            $total_horas = $tiempoProduccion->Calcularvalor_total_horas();
            $horas = $tiempoProduccion->Calculartotalhoras();
    
            if ($total_horas === null || $horas === null) {
                throw new \Exception('Error al calcular valor total de horas o total de horas');
            }
    
            // Buscar o crear el costo de producción relacionado
            $costoProduccion = CostosProduccion::where('tiempo_produccion_id', $tiempoProduccion->id)->first();
            if (!$costoProduccion) {
                $costoProduccion = new CostosProduccion();
                $costoProduccion->tiempo_produccion_id = $tiempoProduccion->id;
                $costoProduccion->sdp_id = $tiempoProduccion->sdp_id;
                $costoProduccion->cif_id = 1;
            }
            $costoProduccion->mano_obra_directa = 0;  // Aquí puedes calcular el valor si es necesario
            $costoProduccion->save();
    
            Log::info('Costo de producción actualizado', ['costo_produccion_id' => $costoProduccion->id]);
    
            // Actualizar los servicios asociados
            $costoProduccion->servicios()->sync([
                $tiempoProduccion->proseso_id => [
                    'servicio_cod' => $tiempoProduccion->proseso_id,
                    'costos_id' => $costoProduccion->id,
                    'sdp_num' => $tiempoProduccion->sdp_id,
                    'valor_servicio' => 0  // Aquí puedes asignar el valor real
                ]
            ]);
    
            // Procesar los artículos asociados, si existen
            if ($request->has('articulos')) {
                Log::info('Procesando artículos asociados');
    
                $articulosData = [];
                foreach ($request->articulos['articulo_id'] as $articuloId) {
                    $articulosData[] = [
                        'articulo_id' => $articuloId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
    
                // Sincronizar los artículos actualizados
                if (!empty($articulosData)) {
                    $tiempoProduccion->articulos()->sync($articulosData);
                    Log::info('Artículos actualizados correctamente', ['articulos' => $articulosData]);
    
                    // Calcular mano de obra directa de los artículos
                    $manoObraDirecta = $costoProduccion->calcularManoObraDirecta($articulosData);
                    if ($manoObraDirecta === null) {
                        throw new \Exception('Error al calcular mano de obra directa');
                    }
    
                    $costoProduccion->mano_obra_directa = $manoObraDirecta;
                    $costoProduccion->save();
                }
            }
    
            DB::commit();
    
            // Redireccionar con un mensaje de éxito
            return redirect()->route('tiempos.group')->with([
                'success' => 'Tiempo de producción actualizado exitosamente.',
                'valor_total_horas' => 'Valor total de horas: ' . $total_horas,
                'total_horas' => 'Total de horas: ' . $horas,
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar tiempo de producción: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error al actualizar tiempo de producción. Por favor, intente de nuevo.');
        }
    }

    public function destroy(string $id)
    {
        $tiempo_produccion = Tiempos_produccion::findOrFail($id);
        $tiempo_produccion->delete();

        return redirect()->route('tiempos.group')->with('success', 'Tiempo de producción actualizado exitosamente');
    }
}