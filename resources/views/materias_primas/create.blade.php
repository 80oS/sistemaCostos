@extends('adminlte::page')

@section('title', 'CREAR MATERI PRIMA')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-300 leading-tight">
    {{ __('Formulario del nueva materia prima') }}
</h2>
@stop

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('materias_primas.store') }}" method="POST" class="max-w-sm mx-auto space-y-4">
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

                <div class="form-group">
                    <label for="cantidad" class="block mb-2 text-sm font-medium text-gray-100">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="precio_unitario">Precio Unitario</label>
                    <input type="number" name="precio_unit" id="precio_unit" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <div class="form-group">
                    <label for="valor" class="block mb-2 text-sm font-medium text-gray-100">valor</label>
                    <input type="number" name="valor" id="valor" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">Guardar</button>
                    <a href="{{ route('materias_primas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                </div>
            </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Selecciona los elementos del DOM
            const cantidadInput = document.getElementById('cantidad');
            const precioUnitarioInput = document.getElementById('precio_unit');
            const valorInput = document.getElementById('valor');
    
            // Función para calcular el valor
            function calcularValor() {
                // Obtén los valores de cantidad y precio unitario
                const cantidad = parseFloat(cantidadInput.value) || 0;
                const precioUnitario = parseFloat(precioUnitarioInput.value) || 0;
    
                // Calcula el valor total
                const valorTotal = cantidad * precioUnitario;
    
                // Actualiza el campo "valor" con el resultado
                valorInput.value = valorTotal.toFixed(2); // Usar toFixed para mostrar dos decimales
            }
    
            // Agregar eventos de escucha a los campos de entrada para recalcular el valor al cambiar
            cantidadInput.addEventListener('input', calcularValor);
            precioUnitarioInput.addEventListener('input', calcularValor);
        });
    </script>
@stop