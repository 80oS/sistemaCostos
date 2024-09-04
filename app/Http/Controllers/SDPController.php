<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Cliente;
use App\Models\idimcol;
use App\Models\SDP;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SDPController extends Controller
{

    public function indexPaquetes()
    {
        $clientes = Cliente::with(['sdp' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();
        return view('SDP.paquetes', compact('clientes'));
    }

    public function lista($nit)
    {
        $cliente = Cliente::with(['SDP.articulos'])->where('nit', $nit)->firstOrFail();
        return view('SDP.lista', compact('cliente'));
    }

    public function ver($id)
    {
        $sdp = SDP::with('clientes', 'articulos', 'vendedores')->findOrFail($id);
        
        $total = 0;
        
        $articulosConSubtotales = $sdp->articulos->map(function ($articulo) use (&$total) {
            // Calcular el subtotal del artículo
            $subtotal = $articulo->pivot->cantidad * $articulo->precio;
            // Acumulando el subtotal al total general
            $total += $subtotal;
            // Agregar el subtotal al artículo
            return $articulo->setAttribute('subtotal', $subtotal);
        });

        $idimcols = idimcol::all();

        return view('SDP.ver', compact('sdp','total', 'idimcols'));
    }

    

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get(['nit', 'nombre']);
        $vendedores = Vendedor::orderBy('nombre')->get(['id', 'nombre']);
        
        // Obtener el último número de SDP
        $ultimoSDP = SDP::latest('id')->first();
        $nuevoNumeroSDP = $ultimoSDP ? $ultimoSDP->numero_sdp + 1 : 1;

        $clientesPorVendedor = [];
        foreach ($vendedores as $vendedor) {
            $clientesPorVendedor[$vendedor->id] = $vendedor->clientes()->get(['nit', 'nombre'])->toArray();
        }

        return view('SDP.create', compact('clientes', 'vendedores', 'nuevoNumeroSDP', 'clientesPorVendedor'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Llegó la solicitud', $request->all());

            $request->validate([
                'numero_sdp' => 'required|unique:sdps',
                'cliente_nit' => 'required|exists:clientes,nit', // Verificar que el cliente exista
                'vendedor_id' => 'required|exists:vendedores,id', // Verificar que el vendedor exista
                'fecha_despacho_comercial' => 'required|date',
                'fecha_despacho_produccion' => 'required|date',
                'observaciones' => 'nullable|string',
                'orden_compra' => 'nullable|string',
                'memoria_calculo' => 'nullable|string',
                'requisitos_cliente' => 'nullable|string',
                'articulos' => 'required|array',
                'articulos.*.descripcion' => 'required|string',
                'articulos.*.cantidad' => 'required|integer|min:1',
                'articulos.*.material' => 'nullable|string',
                'articulos.*.plano' => 'nullable|string',
                'articulos.*.precio' => 'required|numeric|min:0',
            ]);

            // Iniciar una transacción
            DB::beginTransaction();

            // Crear SDP
            $sdp = Sdp::create($request->only([
                'numero_sdp', 'cliente_nit', 'vendedor_id', 
                'fecha_despacho_comercial', 'fecha_despacho_produccion', 
                'observaciones', 'orden_compra', 'memoria_calculo', 'requisitos_cliente'
            ]));

            // Asociar artículos con el SDP y actualizar si hay cambios
            foreach ($request->input('articulos') as $articuloData) {
                // Encontrar el artículo existente por su descripción
                $articulo = Articulo::where('descripcion', $articuloData['descripcion'])->first();

                if ($articulo) {
                    // Actualizar el artículo si alguno de los campos ha cambiado
                    $articulo->update([
                        'descripcion' =>$articuloData['descripcion'],
                        'material' => $articuloData['material'],
                        'plano' => $articuloData['plano'],
                        'precio' => $articuloData['precio']
                    ]);
                } else {
                    // Si no se encuentra el artículo, lanzar una excepción o manejarlo según el caso
                    throw new \Exception('El artículo con la descripción "' . $articuloData['descripcion'] . '" no se encontró.');
                }

                // Asociar el artículo actualizado con la SDP
                $sdp->articulos()->attach($articulo->id, [
                    'cantidad' => $articuloData['cantidad'],
                    's_d_p_id' => $sdp->id, // Asegúrate de que este nombre sea correcto
                    'articulo_id' => $articulo->id
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('sdp.paquetes')->with('success', 'SDP creado exitosamente');
            
        } catch (\Throwable $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            Log::error('Error al guardar SDP: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);

            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al guardar la solicitud. Por favor, inténtelo de nuevo.']);
        }
    }




    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        $sdp = SDP::with('clientes', 'articulos', 'vendedores')->findOrFail($id);
        $clientes = Cliente::orderBy('nombre')->get(['nit', 'nombre']);
        $vendedores = Vendedor::orderBy('nombre')->get(['id', 'nombre']);
        return view('SDP.edit', compact('sdp', 'clientes', 'vendedores'));
    }

    public function update(Request $request, $id)
    {
        try {
            Log::info('Llegó la solicitud de actualización', $request->all());

            // Validaciones
            $request->validate([
                'numero_sdp' => 'required|unique:sdps,numero_sdp,' . $id, // Permitir el mismo número para el SDP que se está editando
                'cliente_nit' => 'required|exists:clientes,nit', // Verificar que el cliente exista
                'vendedor_id' => 'required|exists:vendedores,id', // Verificar que el vendedor exista
                'fecha_despacho_comercial' => 'required|date',
                'fecha_despacho_produccion' => 'required|date',
                'observaciones' => 'nullable|string',
                'orden_compra' => 'nullable|string',
                'memoria_calculo' => 'nullable|string',
                'requisitos_cliente' => 'nullable|string',
                'articulos' => 'required|array',
                'articulos.*.descripcion' => 'required|string',
                'articulos.*.cantidad' => 'required|integer|min:1',
                'articulos.*.material' => 'nullable|string',
                'articulos.*.plano' => 'nullable|string',
                'articulos.*.precio' => 'required|numeric|min:0',
            ]);

            // Iniciar una transacción
            DB::beginTransaction();

            // Encontrar el SDP existente
            $sdp = Sdp::findOrFail($id);

            // Actualizar los campos del SDP
            $sdp->update($request->only([
                'numero_sdp', 'cliente_nit', 'vendedor_id',
                'fecha_despacho_comercial', 'fecha_despacho_produccion',
                'observaciones', 'orden_compra', 'memoria_calculo', 'requisitos_cliente'
            ]));

            // Obtener los IDs de los artículos enviados en la solicitud
            $articulos_enviados = collect($request->input('articulos'))->pluck('descripcion')->toArray();

            // Obtener los artículos asociados actuales del SDP
            $articulos_actuales = $sdp->articulos->pluck('descripcion')->toArray();

            // Eliminar los artículos que ya no están en la solicitud
            $articulos_para_eliminar = array_diff($articulos_actuales, $articulos_enviados);
            foreach ($articulos_para_eliminar as $articulo_descripcion) {
                $articulo = Articulo::where('descripcion', $articulo_descripcion)->first();
                if ($articulo) {
                    $sdp->articulos()->detach($articulo->id);
                }
            }

            // Asociar y actualizar los artículos enviados en la solicitud
            foreach ($request->input('articulos') as $articuloData) {
                // Encontrar o crear el artículo por su descripción
                $articulo = Articulo::firstOrCreate(
                    ['descripcion' => $articuloData['descripcion']],
                    [
                        'material' => $articuloData['material'],
                        'plano' => $articuloData['plano'],
                        'precio' => $articuloData['precio']
                    ]
                );

                // Actualizar los datos del artículo si es necesario
                $articulo->update([
                    'material' => $articuloData['material'],
                    'plano' => $articuloData['plano'],
                    'precio' => $articuloData['precio']
                ]);

                // Asociar el artículo con el SDP, o actualizar la cantidad si ya está asociado
                $sdp->articulos()->syncWithoutDetaching([
                    $articulo->id => [
                        'cantidad' => $articuloData['cantidad'],
                        's_d_p_id' => $sdp->id,
                        'articulo_id' => $articulo->id
                    ]
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('sdp.ver', $sdp->id)->with('success', 'SDP actualizado exitosamente');
            
        } catch (\Throwable $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            Log::error('Error al actualizar SDP: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);

            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al actualizar la solicitud. Por favor, inténtelo de nuevo.']);
        }
    }

    public function destroy($id)
    {
        $sdp = SDP::findOrFail($id);
        $sdp->delete();

        return redirect()->back()->with('success', 'SDP eliminado exitosamente');
    }
}