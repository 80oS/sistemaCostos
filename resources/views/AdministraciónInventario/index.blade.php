@extends('adminlte::page')

@section('title', 'ADMINISTRACION_INVENTARIO')

@section('content_header')
    
@stop

@section('content')
<nav class="navl navbar navbar-expand-lg bg-primary mb-4">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('materias_primas.index') }}">CARGUE DE MATERIAS PRIMAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('materias_primas.index') }}">ORDENES DE COMPRA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('almacen') }}">ALMACEN</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        body {
            height: 100vh;
        }
        .link {
            font-size: 20px;
            color: #000;
            font-size: 20px;
            text-transform: uppercase;
        }

        .link:hover {
            color: #5be03a;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop