@extends('adminlte::page')

@section('title', 'CIF_HOME')

@section('content_header')
    
@stop

@section('content')
<nav class="navbar navbar-expand-lg bg-primary mb-4">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @if($cif)
                        <a class="nav-link link" href="{{ route('cif.edit', $cif->id) }}">CIF</a>
                    @else
                        <p>No hay datos de CIF disponibles.</p>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="{{ route('costos_produccion.index') }}">costos de producción</a>
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