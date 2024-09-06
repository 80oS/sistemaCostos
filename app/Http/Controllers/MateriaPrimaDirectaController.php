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

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'proveedor' => 'required|string',
            'numero_factura' => 'required|string',
            'numero_orden_compra' => 'required|string',
            'precio_unit' => 'required|numeric',
        ]);

        $materia_Prima_directa = new MateriaPrimaDirecta([
            'descripcion' => $request->input('descripcion'),
            'proveedor' => $request->input('proveedor'),
            'numero_factura' => $request->input('numero_factura'),
            'numero_orden_compra' => $request->input('numero_orden_compra'),
            'precio_unit' => $request->input('precio_unit'),
            'valor' => 0
        ]);
        $materia_Prima_directa->save();

        return redirect()->route('materias_primas.index')->with('success', 'la materia prima directa se ha creada exitosamente');
    }

    public function edit( $id)
    {
        $materia_Prima_directa = MateriaPrimaDirecta::findOrFail($id);

        return view('materiasPrimasDirectas.edit', compact('materia_Prima_directa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'proveedor' => 'required|string',
            'numero_factura' => 'required|string',
            'numero_orden_compra' => 'required|string',
            'precio_unit' => 'required|numeric',
        ]);

        $materia_Prima_directa = MateriaPrimaDirecta::findOrFail($id);

        $materia_Prima_directa->update([
            'descripcion' => $request->input('descripcion'),
            'proveedor' => $request->input('proveedor'),
            'numero_factura' => $request->input('numero_factura'),
            'numero_orden_compra' => $request->input('numero_orden_compra'),
            'precio_unit' => $request->input('precio_unit'),
            'valor' => 0
        ]);

        return redirect()->route('materias_primas.index')->with('success', 'la materia prima directa actualizada exitosamente');
    }

    public function destroy($id)
    {
        $materia_Prima_directa = MateriaPrimaDirecta::findOrFail($id);
        $materia_Prima_directa->delete();

        return redirect()->route('materias_primas.index')->with('success', 'la materia prima directa eliminada exitosamente');
    }
}
