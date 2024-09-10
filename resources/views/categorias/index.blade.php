@extends('adminlte::page')

@section('title', 'categorias')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-300 leading-tight">
    {{ __('Todas las Categorias y sus Productos') }}
</h2>
@stop

@section('content')
<div class="p-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="flex justify-start">
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Agregar Categoria
            </a>
        </div>
        @foreach ($categorias as $categoria)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-200 px-4 py-2">
                    <h2 class="text-lg font-semibold text-gray-700">{{ $categoria->nombre }}</h2>
                </div>
                <div class="p-4">
                    <p class="text-gray-600 mb-4">{{ $categoria->descripcion }}</p>
                    <h3 class="font-semibold text-gray-700 mb-2">Productos:</h3>
                    <ul class="space-y-2">
                        @forelse ($categoria->productos as $producto)
                            <li class="flex justify-between items-center">
                                <span class="text-gray-700">{{ $producto->nombre }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Stock: {{ $producto->inventario_sum_cantidad ?? 0 }}
                                </span>
                            </li>
                        @empty
                            <li class="text-gray-500 italic">No hay productos en esta categoría.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop