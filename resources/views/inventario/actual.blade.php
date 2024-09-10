@extends('adminlte::page')

@section('title', 'Inventario Actual')

@section('content_header')
    <h1>Inventario Actual</h1>
@stop

@section('content')
<div class="p-4 flex justify-end">
    <a href="{{ route('almacen') }}" class="btn btn-warning">
        volver
    </a>
</div>
<div class="bg-white shadow-md rounded my-6">
    <table class="min-w-max w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Producto</th>
                <th class="py-3 px-6 text-left">Categoría</th>
                <th class="py-3 px-6 text-center">Stock Total</th>
                <th class="py-3 px-6 text-center">Ubicaciones</th>
                <th class="py-3 px-6 text-center">Estado</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach ($inventario as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $item->producto_nombre }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <span>{{ $item->categoria }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span>{{ $item->stock_total }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span>{{ $item->num_ubicaciones }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if ($item->stock_total < $item->stock_minimo)
                            <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Bajo Mínimo</span>
                        @elseif ($item->stock_total > $item->stock_maximo)
                            <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Sobre Máximo</span>
                        @else
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Normal</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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