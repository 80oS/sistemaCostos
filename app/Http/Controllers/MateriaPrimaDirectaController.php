<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrimaDirecta;
use Illuminate\Http\Request;

class MateriaPrimaDirectaController extends Controller
{

    public function create()
    {
        return view('materiasPrimasDirectas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'proveedor' => 'required|string',
            'numero_factura' => 'required|string',
            'numero_orden_compra' => 'required|string',
            'precio_unit' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'valor' => 'required|numeric'
        ]);

        $materia_Prima_directa = new MateriaPrimaDirecta([
            'descripcion' => $request->input('descripcion'),
            'proveedor' => $request->input('proveedor'),
            'numero_factura' => $request->input('numero_factura'),
            'numero_orden_compra' => $request->input('numero_orden_compra'),
            'precio_unit' => $request->input('precio_unit'),
            'cantidad' => $request->input('cantidad'),
            'valor' => $request->input('valor')
        ]);
        $materia_Prima_directa->save();

        return redirect()->route('materias_primas.index')->with('success', 'la materia prima se ha creado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MateriaPrimaDirecta $materiaPrimaDirecta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MateriaPrimaDirecta $materiaPrimaDirecta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MateriaPrimaDirecta $materiaPrimaDirecta)
    {
        //
    }
}
