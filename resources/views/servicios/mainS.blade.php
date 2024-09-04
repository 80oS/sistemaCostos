@extends('adminlte::page')

@section('title', 'main_servicios')

@section('content_header')
    
@stop

@section('content')
<nav class="navbar navbar-expand-lg bg-primary mb-4">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link link" aria-current="page" href="{{ route('servicios.index') }}">servicios</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="./output.css" rel="stylesheet">
    <style>
        .link {
            color: #030303;
            font-size: 22px;
            text-transform: uppercase;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop