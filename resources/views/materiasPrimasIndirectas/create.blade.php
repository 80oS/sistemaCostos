@extends('adminlte::page')

@section('title','crear materia prima indirecta')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-300 leading-tight">
    {{ __('Formulario de la nueva materia prima indirecta') }}
</h2>
@stop

@section('content')
<div class="p-12">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('materiasPrimasIndirectas.store') }}"  method="POST" class="max-w-sm mx-auto space-y-4">

                    @csrf

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-100" for="nombre">Descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
    
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-100" for="nombre">proveedor</label>
                        <input type="text" name="proveedor" id="proveedor" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
    
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-100" for="nombre">Numero de Factura</label>
                        <input type="text" name="numero_factura" id="numero_factura" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
    
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-100" for="nombre">Numero de orden de compra</label>
                        <input type="text" name="numero_orden_compra" id="numero_orden_compra" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-100" for="precio_unitario">Precio Unitario</label>
                        <input type="number" name="precio_unit" id="precio_unit" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">Guardar</button>
                        <a href="{{ route('materias_primas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop