@extends('adminlte::page')

@section('title', 'Paquetes de SDP')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
    {{ __('Paquetes de SDP') }}
</h2>
@stop

@section('content')
<div class="p">
    <a href="{{ route('ADD_C_S') }}" class="btn btn-primary">volver</a>
</div>
@if (session('success'))
    <div id="success-message" class="alert alert-success success-message" role="alert">
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
                        <th>numero_sdp</th>
                        <th>clientes</th>
                        <th>nit</th>
                        <th>fecha de creacion</th>
                        <th>lista sdps</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sdps as $sdp)
                    <tr>
                        <td>{{ $sdp->numero_sdp }}</td>
                        <td>{{ $sdp->clientes->nombre }}</td>
                        <td>{{ $sdp->clientes->nit }}</td>
                        <td>{{ $sdp->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('sdp.ver', $sdp->numero_sdp) }}" class="btn btn-info">
                                ver sdp
                            </a>
                        </td>
                        <td>
                            <div class="col-4">
                                <a href="{{ route('sdp.edit', $sdp->numero_sdp) }}" class="btn btn-info">Editar</a>
                            </div>
                        </td>
                        <td>
                            <div class="COL-4">
                                <form action="{{ route('sdp.destroy', $sdp->numero_sdp) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este SDP?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
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

        .success-message {
            --tw-bg-opacity: 1;
            background-color: rgb(220 252 231 / var(--tw-bg-opacity)) /* #dcfce7 */;
            border-width: 1px;
            --tw-border-opacity: 1;
            border-color: rgb(74 222 128 / var(--tw-border-opacity)) /* #4ade80 */;
            --tw-text-opacity: 1;
            color: rgb(21 128 61 / var(--tw-text-opacity)) /* #15803d */;
            padding-left: 1rem /* 16px */;
            padding-right: 1rem /* 16px */;
            padding-top: 0.75rem /* 12px */;
            padding-bottom: 0.75rem /* 12px */;
            border-radius: 0.25rem /* 4px */;
            position: relative;
            margin-bottom: 1rem /* 16px */;
        }

        .p {
            margin-bottom: 1rem /* 16px */;
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








