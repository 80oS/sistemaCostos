@extends('adminlte::page')

@section('title', 'costos_produccion')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Lista de SDP') }}
</h2>
@stop

@section('content')
    <div class="p-12">
        <div class="container">
            <div class="flex items-end justify-end mb-4">
                <a href="{{ route('cif.index') }}" class="btn btn-warning">volver</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="costos" class="table">
                        <thead>
                            <tr>
                                <th>Numero sdp</th>
                                <th>Comercial</th>
                                <th>cliente</th>
                                <th>Fecha despacho comercial</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sdps as $sdp)
                                <tr>
                                    <td>{{ $sdp->numero_sdp }}</td>
                                    <td>{{ $sdp->vendedores->nombre }}</td>
                                    <td>{{ $sdp->clientes->nombre }}</td>
                                    <td>{{ $sdp->fecha_despacho_comercial }}</td>
                                    <td>
                                        <a href="{{ route('costos_produccion.show', $sdp->numero_sdp) }}" class="btn btn-info">Ver Detalles</a>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.tailwindcss.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.tailwindcss.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        new DataTable('#costos', {
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: '50vh',
        });
    </script>
@stop