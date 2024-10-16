<?php

namespace App\Http\Controllers;


use App\Models\SDP;
use App\Models\servicioSDP;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServicioSdpController extends Controller
{
    public function indexServicios($numero_sdp)
    {
            // Buscar la SDP por su número
            $sdp = SDP::with('servicios')->where('numero_sdp', $numero_sdp)->firstOrFail();

        return view('servicios.verServicios', compact('sdp'));
    }

    public function show($id)
    {
        $servicioCosto = servicioSDP::with('servicio')->findOrFail($id);

        dd($servicioCosto);

        return view('servicios.editServicio', compact('servicioCosto'));
    }

    public function actualizarPrecioServicio(Request $request, $id)
    {
        // Validar el formulario
        $request->validate([
            'valor_servicio' => 'required|numeric|min:0',
        ]);

        $servicioCosto = servicioSDP::findOrFail($id);

        $servicioCosto->valor_servicio = $request->input('valor_servicio');
        $servicioCosto->save();

        return redirect()->route('servicio.index')->with('success', 'Precio del servicio actualizado correctamente');
    }
}
