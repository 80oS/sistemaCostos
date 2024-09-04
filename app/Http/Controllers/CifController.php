<?php

namespace App\Http\Controllers;

use App\Models\Cif;
use Illuminate\Http\Request;

class CifController extends Controller
{

    public function index()
    {
        $cif = Cif::first();
        return view('cif.index', compact('cif'));
    }

    public function edit($id)
    {
        $cif = Cif::findOrFail($id);
        return view('cif.edit', compact('cif'));
    }

    public function update(Request $request, $id)
    {
        $cif = Cif::findOrFail($id);

        if ($request->has('NMH') && !$request->has('GOI') && !$request->has('MOI') && !$request->has('OCI')) {
            // Solo actualizar NMH
            $request->validate(['NMH' => 'required|numeric']);
            $cif->update(['NMH' => $request->NMH]);
            return response()->json(['success' => true]);
        };

        // Actualizar todos los campos
        $validate = $request->validate([
            'GOI' => 'required|numeric',
            'MOI' => 'required|numeric',
            'OCI' => 'required|numeric',
            'NMH' => 'required|numeric'
        ]);

        $cif->update($validate);

        return response()->json(['success' => true, 'cif' => $cif], 201);
    }
}