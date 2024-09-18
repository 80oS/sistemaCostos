@extends('adminlte::page')

@section('title', 'Paquetes de SDP')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
    {{ __('Paquetes de SDP') }}
</h2>
@stop

@section('content')
<div class="">
    <a href="{{ route('ADD_C_S') }}" class="btn btn-warning">volver</a>
</div>
@if (session('success'))
<div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <a href="{{ route('sdp.create') }}" class="btn btn-info">crear sdp</a>
            </div>
            <table class="table table-striped" id="sdp">
                <thead>
                    <tr>
                        <th>clientes</th>
                        <th>nit</th>
                        <th>numeros de sdp</th>
                        <th>cantidad de SDPs</th>
                        <th>lista sdps</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->nit }}</td>
                        <td>
                            <p>
                                @foreach($cliente->sdp as $sdp)
                                    {{ $sdp->numero_sdp }},
                                @endforeach
                            </p>
                        </td>
                        <td>{{ $cliente->sdp->count() }}</td>
                        <td>
                            <a href="{{ route('sdp.lista', $cliente->nit) }}" class="btn btn-info">
                                lista de sdps
                            </a>
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
        .card-body, .card {
            background: #bdbbbb !important;
            color: #000 !important;
        }

        input {
            background: #dfdede !important;
        }

        .content, .content-header {
            background: #fff !important;
        }

        .content {
            width: 100%;
            height: 90vh;
        }
    </style>
@stop

@section('js')
{{-- Add here extra scripts --}}
<script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    </script>
    <script>
        new DataTable('#sdp', {
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: '50vh',
        });
    </script>
@stop








