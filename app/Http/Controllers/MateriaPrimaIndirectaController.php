<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrimaIndirecta;
use Illuminate\Http\Request;

class MateriaPrimaIndirectaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materiasPrimasIndirectas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'proveedor' => 'required|string',
            'numero_factura' => 'required|string',
            'numero_orden_compra' => 'required|string',
            'precio_unit' => 'required|numeric',
        ]);

        $materia_Prima_indirecta = new MateriaPrimaIndirecta([
            'descripcion' => $request->input('descripcion'),
            'proveedor' => $request->input('proveedor'),
            'numero_factura' => $request->input('numero_factura'),
            'numero_orden_compra' => $request->input('numero_orden_compra'),
            'precio_unit' => $request->input('precio_unit'),
            'valor' => 0
        ]);
        $materia_Prima_indirecta->save();

        return redirect()->route('materias_primas.index')->with('success', 'la materia prima indirecta se ha creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(MateriaPrimaIndirecta $materiaPrimaIndirecta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MateriaPrimaIndirecta $materiaPrimaIndirecta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MateriaPrimaIndirecta $materiaPrimaIndirecta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MateriaPrimaIndirecta $materiaPrimaIndirecta)
    {
        //
    }
}
