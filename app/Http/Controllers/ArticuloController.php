<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::all();
        return view('articulos.index', compact('articulos'));
    }    
    
    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'descripcion' => 'required|string|unique:articulos,descripcion',
            'material' => 'required|string',
            'plano' => 'required|string',
            'precio'=> 'required|numeric|min:0' // Cambié integer a numeric porque precio generalmente admite decimales
        ]);

        try {
            // Creación del artículo
            $articulo = Articulo::create($validated);

            return response()->json(['success' => true, 'articulo' => $articulo], 201); // Devuelve también el artículo creado
        } catch (\Throwable $e) { // Usar Throwable para capturar cualquier tipo de error
            return response()->json(['success' => false, 'message' => 'Error al crear el artículo: ' . $e->getMessage()], 500);
        }
    }
    
    public function buscarArticulos(Request $request)
    {
        $query = $request->input('q');
    
        if (!$query) {
            return response()->json(['message' => 'No se proporcionó una consulta de búsqueda.'], 400); // Validación básica
        }
    
        $articulos = Articulo::where('descripcion', 'LIKE', "%{$query}%")->get();
    
        return response()->json($articulos);
    }

    public function edit($id)
    {
        $articulo = Articulo::findOrFail($id);

        return view('articulos.edit', compact('articulo'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar los datos recibidos
            $validated = $request->validate([
                'descripcion' => 'required|string',
                'material' => 'nullable|string',
                'plano' => 'nullable|string',
                'precio' => 'required|numeric',
            ]);
    
            // Buscar y actualizar el artículo
            $articulo = Articulo::findOrFail($id);
            $articulo->update($validated);
    
            // Retornar respuesta de éxito
            return redirect()->route('articulos.index')->with('success', 'el articulo se ha actualizado');
    
        } catch (\Exception $e) {
            // En caso de error, retornar una respuesta con el mensaje de error
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $articulo = Articulo::findOrFaild($id);
        $articulo->delete();

        return redirect()->route('articulos.index')->with('success', 'el articulo se ha eliminado');
    }
}