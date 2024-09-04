<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\TipoIdentificacion;

class ProveedorController extends Controller
{
    // Método para mostrar la lista de proveedores
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    // Método para mostrar el formulario de creación de un nuevo proveedor
    public function create()
    {   
        $proveedor = new Proveedor();
        return view('proveedores.create', compact('proveedor'));
    }

    // Método para almacenar un nuevo proveedor en la base de datos
    public function store(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->numero_identificacion = $request->input('numero_identificacion');
        $proveedor->nombre = $request->input('nombre');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('correo');
        $proveedor->tipo_servicio = $request->input('tipo_servicio');
        $proveedor->save();
    
        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado con éxito');
    }
    // Método para mostrar el formulario de edición de un proveedor
    public function edit($numero_identificacion)
    {
        // Buscar el proveedor por su número de identificación
        $proveedor = Proveedor::where('numero_identificacion', $numero_identificacion)->firstOrFail();
        return view('proveedores.edit', compact('proveedor'));
    }

    // Método para actualizar un proveedor existente en la base de datos
    public function update(Request $request, $numero_identificacion)
    {
        $proveedor = Proveedor::where('numero_identificacion', $numero_identificacion)->firstOrFail();
        $proveedor->nombre = $request->input('nombre');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('correo');
        $proveedor->tipo_servicio = $request->input('tipo_servicio');
        $proveedor->save();
    
        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado con éxito');
    }
    // Método para eliminar un proveedor de la base de datos
    public function destroy($id)
    {
        // Buscar el proveedor por su ID y eliminarlo
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado con éxito');
    }
}
