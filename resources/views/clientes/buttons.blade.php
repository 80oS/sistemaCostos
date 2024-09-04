@extends('adminlte::page')

@section('title', 'COMERCIALES/CLIENTES')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('SECCION DE CLIENTES DE CADA COMERCIAL') }}
</h2>
@stop

@section('content')
    <div class="cont">
        <a href="{{ route('ADD_C_S') }}" class="button bg-yellow-800 hover:bg-yellow-500 text-black py-2 px-3 rounded">volver</a>
        <div class="container">
            <div class="center">
                <a href="{{ route('clientes-william') }}" class="bg-green-600 hover:bg-green-800 text-white px-3 py-2 rounded">clientes_William</a>
                <a href="{{ route('clientes-fabian') }}" class="bg-green-800 hover:bg-green-600 text-white px-3 py-2 rounded">clientes_Fabian</a>
                <a href="{{ route('clientes-ochoa') }}" class="bg-lime-600 hover:bg-lime-800 text-white px-3 py-2 rounded">clientes-Hernando</a>
                <a href="{{ route('clientes.index') }}" class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-2 rounded">todos_los_clientes</a>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

    <style>

        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #343a40; /* Color de fondo gris oscuro */
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px; /* Espacio entre botones */
            background-color: #4a5568; /* Color de fondo de la barra azul */
            padding: 10px;
            border-radius: 5px;
            width: 800px;
            height: 200px;
        }


        .cont {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://cdn.tailwindcss.com"></script>
@stop