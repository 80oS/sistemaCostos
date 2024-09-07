@extends('adminlte::page')

@section('title', 'ALMACEN')

@section('content_header')
    
@stop

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Almacén</h1>
    
    <div class="flex justify-between items-center mb-6">
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" placeholder="Buscar productos" class="pl-8 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <a href="" class="text-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600">
            <i class="fa-solid fa-box"></i> Agregar Producto
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold">Inventario</h2>
                <p class="text-sm text-gray-500">Resumen de productos en stock</p>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold">1,234</p>
            </div>
            <div class="p-4 border-t border-gray-200">
                <a href="" class="text-center px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:text-gray-800">
                    <i class="fa-solid fa-box"></i> Ver Inventario
                </a>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold">Pedidos</h2>
                <p class="text-sm text-gray-500">Pedidos pendientes de envío</p>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold">42</p>
            </div>
            <div class="p-4 border-t border-gray-200">
                <a href="" class="tex-center px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:text-gray-800">
                    <i class="fa-regular fa-clipboard"></i> Ver Pedidos
                </a>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold">Movimientos</h2>
                <p class="text-sm text-gray-500">Movimientos programados para hoy</p>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold">7</p>
            </div>
            <div class="p-4 border-t border-gray-200">
                <a href="" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:text-gray-800">
                    Ver Movimientos
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/w3-css/4.1.0/w3.css" integrity="sha512-Ef5r/bdKQ7JAmVBbTgivSgg3RM+SLRjwU0cAgySwTSv4+jYcVeDukMp+9lZGWT78T4vCUxgT3g+E8t7uabwRuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/lucide-static@0.244.0/font/lucide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .search {
            background: #fff;
            color: #000;
            padding: 5px;
            border-radius: 5px;
            height: 40px;
        }

        .search input {
            border: none !important;
            height: 30px;
        }
    </style>
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/SVG-Morpheus/0.3.2/svg-morpheus.js" integrity="sha512-iyriEH7X9+KePLXu2Yv+HDo9UPIr+OTiPvxG/HwUyLVHGE2yPAyg+eyq7xlodMPbEEfGyhpBzBEMznbQ0o1NjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop