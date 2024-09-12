@extends('adminlte::page')

@section('title', 'MATERIAS PRIMAS')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-400 leading-tight">
    {{ __('Materias primas') }}
</h2>
@stop

@section('content')
<div class="py-12">
    @if (session('success'))
        <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="flex items-end justify-end p-10">
        <a href="{{ route('AdministraciónInventario') }}" class="bg-yellow-600 hover:bg-yellow-400 px-3 py-2 rounded">volver</a>
    </div>
    <div class="container">
        <div class="card px-8">
            <div class="card-body">
                <div class="flex flex-row items-center justify-center gap-5">
                    <div class="mb-4">
                        <a href="{{ route('materiasPrimasDirectas.create') }}" class="btn btn-info">crear materia primas directas</a>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('materiasPrimasIndirectas.create') }}" class="btn btn-info">crear materia primas indirectas</a>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('serviciosExternos.index') }}" class="btn btn-info">servicios externos</a>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('lista.sdp.cargar') }}" class="btn btn-info">Carga de Materias Primas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .container {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        .card {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        table {
            width: 100%;
            border: #34343431 1px solid;
            background: #a9b0ef19;
            backdrop-filter: blur(0.4rem);
            -webkit-backdrop-filter: blur(0.4rem);
        }
        thead tr th {
            background: #a9b0ef19;
            backdrop-filter: blur(0.4rem);
            -webkit-backdrop-filter: blur(0.4rem);
            border: #34343431 1px solid;
            color: #cfcdcd;
            text-align: center;
        }

        tbody tr td {
            background: #a9b0ef19;
            backdrop-filter: blur(0.4rem);
            -webkit-backdrop-filter: blur(0.4rem);
            border: #34343431 1px solid;
        }

        th, td {
            border: #34343431 1px solid;
        }

    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 10000);
    </script>
@stop


