@extends('adminlte::page')

@section('title', 'gestion de clientes')

@section('content_header')
@stop

@section('content')
<nav class="navbar navbar-expand-lg bg-primary mb-4">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('clientes-comerciales') }}">clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('sdp.paquetes') }}">solicitud de produccion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('remiciones.index') }}">remisiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('vendedor.index') }}">vendedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('articulos.index') }}">articulos</a>
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
        a.link {
            color: #030303;
            font-size: 22px;
            text-transform: uppercase;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop








