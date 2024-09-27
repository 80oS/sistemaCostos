@extends('adminlte::page')

@section('title', 'sdps')

@section('content_header')
    
@stop

@section('content')
<div class="">
    <a href="{{ route('servicios.index') }}" class="btn btn-primary">volver</a>
</div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <table id="costos" class="table table-striped">
                <thead>
                    <tr>
                        <th>SDP ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sdps as $sdp)
                        <tr>
                            <td>{{ $sdp->numero_sdp }}</td>
                            <td>{{ $sdp->clientes->nombre }}</td>
                            <td>{{ $sdp->fecha }}</td>
                            <td>
                                <a href="{{ route('servicio.ver-servicios', $sdp->numero_sdp) }}" class="btn btn-info">Ver Servicios</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">
    <style>
        .container {
            padding: 10px;
        }
        .content {
            padding: 10px;
        }
        .card, .card-body {
            background: #f1f1f1 !important;
            color: #000000 !important;
        }

        input {
            background: #fff !important;
            color: #000 !important;
        }

        label {
            color: #000 !important;
        }

        
    </style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
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