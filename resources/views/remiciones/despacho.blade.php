@extends('adminlte::page')

@section('title', 'remisionesDespacho')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
    {{ __('remisiones de despacho') }}
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
                <div class="mb-4">
                    <a href="{{ route('remision.despacho.create') }}" class="btn btn-info">Crear</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr class="table-primary">
                            <th>codigo</th>
                            <th>cliente</th>
                            <th>sdp</th>
                            <th>fecha de despacho</th>
                            <th>observaciones</th>
                            <th>depacho</th>
                            <th>departamento</th>
                            <th>recibido</th>
                            <th>editar</th>
                            <th>ver remision</th>
                            <th>eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($remicionesDespacho as $remicionDespacho)
                            <tr class="table-secondary">
                                <td>{{ $remicionDespacho->codigo }}</td>
                                <td>{{ $remicionDespacho->cliente->nombre }}</td>
                                <td>{{ $remicionDespacho->sdp->numero_sdp }}</td>
                                <td>{{ $remicionDespacho->fecha_despacho }}</td>
                                <td>{{ $remicionDespacho->observaciones }}</td>
                                <td>{{ $remicionDespacho->despacho }}</td>
                                <td>{{ $remicionDespacho->departamento }}</td>
                                <td>{{ $remicionDespacho->recibido }}</td>
                                <td>
                                    <a href="{{ route('remision.despacho.edit', $remicionDespacho->id)}}" class="btn btn-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('remision.despacho.show', $remicionDespacho->id)}}" class="btn btn-info">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('remision.despacho.destroy', $remicionDespacho->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return comfirm('Seguro que quire eliminar esta remision de despacho')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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