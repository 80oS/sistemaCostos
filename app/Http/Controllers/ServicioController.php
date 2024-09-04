<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
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

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'valor_hora' => 'required|numeric|min:0',
        ]);

        $validatedData['codigo'] = Servicio::generateUniqueCode();

        $servicio = Servicio::create($validatedData);

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
