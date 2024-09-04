@extends('adminlte::page')

@section('title', 'ALMACEN')

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
                    <a class="nav-link link" href="{{ route('materias_primas.index') }}">CARGE DE MATERIAS PRIMAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('materias_primas.index') }}">ORDENES DE COMPRA</a>
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

            font-size: 20px;

            text-transform: uppercase;
        }

        .navl {
            background: linear-gradient(90deg, #f06161, #2b0101) no-repeat;
        }

        .link {
            font-size: 20px;
            color: #000;
        }

        .link:hover {
            color: #5be03a;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop