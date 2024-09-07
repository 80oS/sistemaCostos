<?php

namespace App\Http\Controllers;

use App\Models\Servicio_esterno;
use Illuminate\Http\Request;

class servicioExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicionExternos = Servicio_esterno::all();

        return view('serviciosExternos.index', compact('servicionExternos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('serviciosExternos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'proveedor' => 'required|string',
            'valor_hora' => 'required|string',
        ]);

        $serviciosExternos = new Servicio_esterno([
            'descripcion' => $request->input('descripcion'),
            'proveedor' => $request->input('proveedor'),
            'valor_hora' => $request->input('valor_hora'),
        ]);
        $serviciosExternos->save();

        return redirect()->route('serviciosExternos.index')->with('success', 'servicio externo exitosamente creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
