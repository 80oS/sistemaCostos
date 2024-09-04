<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrimaDirecta;
use App\Models\MateriaPrimaIndirecta;
use App\Models\SDP;
use Illuminate\Http\Request;

class CargarMateriaPrimaController extends Controller
{
    public function cargarMateriaPrimas()
    {
        $sdps = SDP::all();
        return view('materias_primas.cargar', compact('sdps'));
    }

    public function cargarMateriaPrima(Request $request, $numero_sdp)
    {
        // Validar el request
        $validated = $request->validate([
            'numero_sdp' => 'required|exists:sdps,numero_sdp',
            'codigo' => 'required|string',
            'descripcion' => 'required|string',
            'valor' => 'required|numeric'
        ]);

        // Obtener la SDP
        $sdp = Sdp::where('numero_sdp', $validated['numero_sdp'])->first();

        

        return redirect()->back()->with('success', 'Materia prima agregada exitosamente.');
    }


    public function verMateriasPrimas($numero_sdp)
    {
        // Buscar la SDP por su número
        $sdp = Sdp::where('numero_sdp', $numero_sdp)->firstOrFail();

        // Obtener las materias primas directas asociadas a la SDP
        $materiasPrimasDirectas = $sdp->materiasPrimasDirectas()->withPivot('cantidad', 'costo_produccion_id')->get();

        // Obtener las materias primas indirectas asociadas a la SDP
        $materiasPrimasIndirectas = $sdp->materiasPrimasIndirectas()->withPivot('cantidad', 'costo_produccion_id')->get();

        // Pasar los datos a la vista
        return view('materia_prima.resumen', compact('sdp', 'materiasPrimasDirectas', 'materiasPrimasIndirectas'));
    }
}
