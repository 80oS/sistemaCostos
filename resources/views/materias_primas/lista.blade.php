@extends('adminlte::page')

@section('title', 'lista sdp')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-400 leading-tight">
    {{ __('Materias primas') }}
</h2>
@stop

@section('content')
    <div class="p-12">
        <div class="mb-4">
            <a href="{{ route('materias_primas.index') }}" class="btn btn-warning">volver</a>
        </div>
        <div class="dark:bg-gray-700 shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 rounded">
                <div class="container">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-600 text-gray-200">
                                <th class="px-6 py-3 border-b" >Numero de SDP</th>
                                <th class="px-6 py-3 border-b" >Cargar materia prima</th>
                                <th class="px-6 py-3 border-b" >Lista de materias primas cargadas</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($sdps as $sdp)
                                <tr class="dark:bg-gray-300 text-gray-700">
                                    <td class="px-6 py-4 border-b">{{ $sdp->numero_sdp }}</td>
                                    <td class="px-6 py-4 border-b">
                                        <a href="{{ route('cargar.materias.form', ['numero_sdp' => $sdp->numero_sdp]) }}" class="btn btn-info">Cargar Materias Primas</a>
                                    </td>
                                    <td class="px-6 py-4 border-b">
                                        <a href="{{ route('verMateriasPrimas', ['numero_sdp' => $sdp->numero_sdp]) }}" class="btn btn-warning">ver lista</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            overflow-y: auto;
            max-height: 500px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop