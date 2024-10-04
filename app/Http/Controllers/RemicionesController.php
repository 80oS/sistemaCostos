<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Remiciones;
use App\Models\Cliente;
use App\Models\Remicion;
use App\Models\RemisionIngreso;

class RemicionesController extends Controller
{

    public function index()
    {
        return view('remiciones.index');
    }

    public function Despacho()
    {
        $remicionesDespacho = Remicion::all();
        return view('remiciones.despacho', compact('remicionesDespacho'));
    }

    public function Ingreso()
    {
        $remisionesIngreso = RemisionIngreso::all();
        return view('remiciones.ingreso', compact('remisionesIngreso'));
    }

    public function create(Request $request)
    {
        $clientes = Cliente::orderBy('nombre')->get(['nit', 'nombre']);

        return view('remiciones.create', compact('clientes'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'cantidad' => 'required|integer',
            'descripcion' => 'required|string',
            'fecha_despacho' => 'required|date',
            'solicitud_produccion' => 'required|string',
            'observaciones' => 'nullable|string',
            'recibido' => 'required|string',
            'despacho' => 'required|string',
            'cliente_nit' => 'required|exists:clientes,nit'
        ]);

        $remiciones = new Remicion();
        $remiciones->cantidad = $request->input('cantidad');
        $remiciones->descripcion = $request->input('descripcion');
        $remiciones->fecha_despacho = $request->input('fecha_despacho');
        $remiciones->solicitud_produccion = $request->input('solicitud_produccion');
        $remiciones->observaciones = $request->input('observaciones');
        $remiciones->recibido = $request->input('recibido');
        $remiciones->despacho = $request->input('despacho');
        $remiciones->cliente_nit = $request->input('cliente_nit');
        $remiciones->save();

        return redirect()->route('remiciones.index')->with('success', 'Remicion creada con éxito');
    }

    public function show($codigo_remicion)
    {
        $remicion = Remicion::with('cliente')->find($codigo_remicion);
        return view('remiciones.show', compact('remicion'));
    }

    public function edit($codigo_remicion)
    {
        $remiciones = Remicion::where('codigo_remicion', $codigo_remicion)->firstOrFail();
        return view('remiciones.edit', compact('remiciones'));
    }

    public function update(Request $request, $codigo_remicion)
    {
        $request->validate([
            'cantidad' => 'required|integer',
            'descripcion' => 'required|string',
            'fecha_despacho' => 'required|date',
            'solicitud_produccion' => 'required|string',
            'observaciones' => 'nullable|string',
            'recibido' => 'required|string',
            'despacho' => 'required|string'
        ]);

        $remiciones = Remicion::where('codigo_remicion', $codigo_remicion)->firstOrFail();
        $remiciones->update($request->all());


        return redirect()->route('remiciones.index')->with('success', 'Remicion se ha actualizado con éxito');
    }

    public function destroy($codigo_remicion)
    {
        $remicion = Remicion::where('codigo_remicion', $codigo_remicion)->firstOrFail();
        $remicion->delete();

        return redirect()->route('remiciones.index')->with('success', 'Remicion se ha eliminado con éxito');
    }
}
