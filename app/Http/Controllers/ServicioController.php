<?php

namespace App\Http\Controllers;

use App\Models\CostosProduccion;
use App\Models\SDP;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\ServicioCostos;
use Illuminate\Support\Facades\Log;
use App\Traits\codigoAlf;

class ServicioController extends Controller
{

    public function mainS()
    {
        $data = [
            'servicio' => 'servicios'
        ];

        return view('servicios.mainS', $data);
    }

    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    public function indexSdp()
    {
        $sdps = SDP::all(); // Obtener todas las SDPs
        return view('servicios.indexSdp', compact('sdps')); 
    }

    public function create()
    {
        $sdps = SDP::all();
        return view('servicios.create', compact('sdps'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'valor_hora' => 'required|numeric|min:0',
        ]);

        $validatedData['codigo'] = Servicio::generateUniqueCode();

        $servicio = Servicio::create($validatedData);

        $servicioSdp = $servicio->servicios->attach($servicio->id, [
            'servicio_id' => $servicio->codigo,
            'sdp_id' => $request->input('sdp_id'),
            'valor_servicio' => $servicio->valor_hora
        ]);


        Log::info('Nuevo servicio creado: ' . $servicio->codigo);

        return redirect()->route('servicios.index')
                        ->with('success', 'Servicio creado con éxito. Código: ' . $servicio->codigo);
    }

    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'valor_hora' => 'required|numeric|min:0',
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update($request->all());

        $servicioSdp = $servicio->sdp()->attach($servicio->id, [
            'servicio_id' => $servicio->codigo,
            'sdp_id' => $request->input('sdp_id'),
            'valor_servicio' => $servicio->valor_hora
        ]);

        return redirect()->route('servicios.index')
                    ->with('success', 'Servicio actualizado con éxito');
    }
    

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio -> delete();

        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado con éxito');
    }
}
