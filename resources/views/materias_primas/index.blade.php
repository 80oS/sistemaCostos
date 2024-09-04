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
        <a href="{{ route('almacen') }}" class="bg-yellow-600 hover:bg-yellow-400 px-3 py-2 rounded">volver</a>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex flex-row items-center justify-center gap-5">
                <div class="mb-4">
                    <a href="{{ route('materias_primas.create') }}" class="btn btn-info">crear materia primas directas</a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('materias_primas.create') }}" class="btn btn-info">crear materia primas indirectas</a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('materias_primas.create') }}" class="btn btn-info">otros costos</a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('materias_primas.create') }}" class="btn btn-info">carge de materias primas</a>
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
            overflow-y: auto;
            max-height: 600px;
        }
        table {
            width: 100%;
            border: #343434 1px solid;
        }
        thead tr th {
            background: #555555;
            border: #343434 1px solid;
            padding: 2px;
            color: #fff;
            text-align: center;
        }

        tbody tr td {
            background: #a1a1a1;
            border: #343434 1px solid;
            padding: 2px;
        }
        tfoot tr td {
            background: #4a4949;
            border: #343434 1px solid;
            padding: 2px;
            color: #fff;
            text-align: end;
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
