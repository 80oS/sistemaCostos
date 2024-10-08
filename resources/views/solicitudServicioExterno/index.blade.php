@extends('adminlte::page')

@section('title', 'LISTA SSE')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
    {{ __('lista de solicitudes de servicio externo') }}
</h2>
@stop

@section('content')
    <div class="py-12">
        <div class="container">
            <div class="mb-4">
                <a href="{{ route('remiciones.index') }}" class="btn btn-primary">volver</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <table  class="table table-striped">
                        <thead>
                            <tr class="table-primary">
                                <th>numero_sse</th>
                                <th>sdp</th>
                                <th>observaciones</th>
                                <th>despacho</th>
                                <th>recibido</th>
                                <th>ver solicitud</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-secondary">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
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
        .card-body {
            max-height: 400px;
            overflow-y: auto;
        }
        th {
            text-align: center;
            text-transform: uppercase;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop