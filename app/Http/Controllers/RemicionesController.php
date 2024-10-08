<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Remiciones;
use App\Models\Cliente;
use App\Models\Item;
use App\Models\Remicion;
use App\Models\RemisionIngreso;
use App\Models\SDP;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function Pest\Laravel\json;

class RemicionesController extends Controller
{

    public function index()
    {
        return view('remiciones.index');
    }

    public function Despacho()
    {
        $remicionesDespacho = Remicion::with('items', 'cliente', 'sdp')->get();
        return view('remiciones.despacho', compact('remicionesDespacho'));
    }

    public function Ingreso()
    {
        $remisionesIngreso = RemisionIngreso::all();
        return view('remiciones.ingreso', compact('remisionesIngreso'));
    }

    public function getSdpsByCliente($clienteId)
    {
        // Obtener SDPs del cliente seleccionado
        $sdps = SDP::where('cliente_nit', $clienteId)->with('clientes')->get();

        // Retornar los datos en formato JSON
        return response()->json($sdps);
    }

    public function createDespacho(Request $request)
    {
        $clientes = Cliente::has('SDP')->get();
        $sdps = SDP::with('clientes', 'articulos')->get();

        return view('remiciones.createDespacho', compact('clientes', 'sdps'));
    }
    
    public function storeDespacho(Request $request)
    {
        Log::info('Creación de la nueva remicion de despacho', $request->all());

        $request->validate([
            'cliente_id' => 'required|string|exists:clientes,nit',
            'fecha_despacho' => 'required|date',
            'sdp_id' => 'required|integer|exists:sdps,numero_sdp',
            'observaciones' => 'nullable|string',
            'despacho' => 'nullable|string',
            'departamento' => 'required|string',
            'recibido' => 'nullable|string',
            'items' => 'required|array',
            'items.*.cantidad' => 'required|numeric',
            'items.*.descripcion' => 'required|string',
        ]);

        DB::beginTransaction();

        $remiciones = Remicion::create([
            'cliente_id' => $request->cliente_id,
            'fecha_despacho' => $request->fecha_despacho,
            'sdp_id' => $request->sdp_id,
            'observaciones' => $request->observaciones,
            'despacho' => $request->despacho,
            'departamento' => $request->departamento,
            'recibido' => $request->recibido,
        ]);

        foreach ($request->input('items') as $itemsData){
            $item = Item::firstOrCreate(
                ['descripcion' => $itemsData['descripcion']]
            );

            $remiciones->items()->attach($item->id, [
                'cantidad' => $itemsData['cantidad']
            ]);
        }

        DB::commit();

        return redirect()->route('remiciones.index')->with('success', 'Remicion de despacho creada con éxito');
    }

    public function show($codigo_remicion)
    {
        $remicion = Remicion::with('cliente')->find($codigo_remicion);
        return view('remiciones.show', compact('remicion'));
    }

    public function editDespacho($id)
    {
        $remisionDespacho = Remicion::findOrFail($id);
        

        

        return view('remiciones.editDespacho', compact('remisionDespacho'));
    }

    public function updateDespacho(Request $request, $id)
    {

        $remiciones = Remicion::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|string|exists:clientes,nit',
            'fecha_despacho' => 'required|date',
            'sdp_id' => 'required|integer|exists:sdps,numero_sdp',
            'observaciones' => 'nullable|string',
            'despacho' => 'nullable|string',
            'departamento' => 'required|string',
            'recibido' => 'nullable|string',
            'items' => 'required|array',
            'items.*.cantidad' => 'required|numeric',
            'items.*.descripcion' => 'required|string',
        ]);

        DB::beginTransaction();

        $remiciones->update([
            'cliente_id' => $request->cliente_id,
            'fecha_despacho' => $request->fecha_despacho,
            'sdp_id' => $request->sdp_id,
            'observaciones' => $request->observaciones,
            'despacho' => $request->despacho,
            'departamento' => $request->departamento,
            'recibido' => $request->recibido,
        ]);

        $items_esnviados = $request->input('items');

        $items_ids = [];

        foreach ($items_esnviados as $itemsData){
            $item = Item::where('descripcion', $itemsData['descripcion'])->first();

            if ($item){
                $items_ids[$item->id] = [
                    'cantidad' => $itemsData['cantidad'],
                ];
            }
        }

        $remiciones->items()->sycn($itemsData);

        DB::commit();

        return redirect()->route('remiciones.index')->with('success', 'Remision de despacho se ha actualizado con éxito');
    }

    public function destroyDespacho($id)
    {
        $remiciones = Remicion::findOrFail($id);
        $remiciones->delete();

        return redirect()->route('remiciones.index')->with('success', 'Remision de despacho se ha eliminado con éxito');
    }
}
