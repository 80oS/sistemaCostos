<?php

namespace App\Http\Controllers;

use App\Models\CostosProduccion;
use App\Models\SDP;
use App\Models\Servicio;
use App\Models\ServicioCostos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServicioCostosController extends Controller
{
    public function indexServicios($numero_sdp)
    {
            // Buscar la SDP por su número
            $sdp = SDP::findOrFail($numero_sdp);

            $costosProduccion = CostosProduccion::with(['servicios']) // Asegúrate de cargar la relación del servicio
            ->where('sdp_id', $sdp->numero_sdp)
            ->firstOrFail();

            $serviciosCostos = $sdp->serviciosCostos()->with('servicio')->get();

            // dd($serviciosCostos);

        return view('servicios.verServicios', compact('sdp', 'serviciosCostos', 'costosProduccion'));
    }

    public function show($id)
    {
        
        $servicioCosto = ServicioCostos::with('servicio')->findOrFail($id);

        return view('servicios.editServicio', compact('servicioCosto'));
    }

    public function actualizarPrecioServicio(Request $request, $id)
    {
        // Validar el formulario
        $request->validate([
            'servicio_id' => 'required|exists:servicios,codigo',
            'valor_servicio' => 'required|numeric|min:0',
        ]);

        $servicioCosto = ServicioCostos::findOrFail($id);

        $servicioCosto->valor_servicio = $request->input('valor_servicio');
        $servicioCosto->save();

        return redirect()->route('servicio.index')->with('success', 'Precio del servicio actualizado correctamente');
    }
}
