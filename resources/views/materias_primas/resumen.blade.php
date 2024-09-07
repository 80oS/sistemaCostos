@extends('adminlte::page')

@section('title', 'Materias primas cargadas')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-400 leading-tight">
    {{ __('Materias primas cargadas') }}
</h2>
@stop

@section('content')
<div class="p-12">
    <div class="mb-4">
        <a href="{{ route('lista.sdp.cargar') }}" class="btn btn-warning">volver</a>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-body-1">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="8">MATERIAS PRIMAS DIRECTAS</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="px-1">#</th>
                                <th class="px-1">CODIGO</th>
                                <th class="px-1">DESCRIPCION</th>
                                <th class="px-1">PROVEEDOR</th>
                                <th class="px-1">NUMERO DE FACTURA</th>
                                <th class="px-1">NUMERO DE ORDEN DE COMPRA</th>
                                <th class="px-1">PRECIO UNITARIO</th>
                                <th class="px-1">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materiasPrimasDirectas as $index => $materiaPrimaDirecta)
                                <tr>
                                    <td class="px-1">{{ $index + 1 }}</td>
                                    <td class="px-1">{{ $materiaPrimaDirecta->codigo }}</td>
                                    <td class="px-1">{{ $materiaPrimaDirecta->descripcion }}</td>
                                    <td class="px-1">{{ $materiaPrimaDirecta->proveedor }}</td>
                                    <td class="px-1">{{ $materiaPrimaDirecta->numero_factura }}</td>
                                    <td class="px-1">{{ $materiaPrimaDirecta->numero_orden_compra }}</td>
                                    <td class="px-1">{{ $materiaPrimaDirecta->precio_unit }}</td>
                                    <td>
                                        <form action="{{ route('destroyDirectas', ['numero_sdp' => $sdp->numero_sdp, 'id' => $materiaPrimaDirecta->pivot->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta materia prima directa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body-2">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="8">MATERIAS PRIMAS INDIRECTAS</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="px-1">#</th>
                                <th class="px-1">CODIGO</th>
                                <th class="px-1">DESCRIPCION</th>
                                <th class="px-1">PROVEEDOR</th>
                                <th class="px-1">NUMERO DE FACTURA</th>
                                <th class="px-1">NUMERO DE ORDEN DE COMPRA</th>
                                <th class="px-1">PRECIO UNITARIO</th>
                                <th class="px-1">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materiasPrimasIndirectas as $index => $materiaPrimaIndirecta)
                                <tr>
                                    <td class="px-1">{{ $index + 1 }}</td>
                                    <td class="px-1">{{ $materiaPrimaIndirecta->codigo }}</td>
                                    <td class="px-1">{{ $materiaPrimaIndirecta->descripcion }}</td>
                                    <td class="px-1">{{ $materiaPrimaIndirecta->proveedor }}</td>
                                    <td class="px-1">{{ $materiaPrimaIndirecta->numero_factura }}</td>
                                    <td class="px-1">{{ $materiaPrimaIndirecta->numero_orden_compra }}</td>
                                    <td class="px-1">{{ $materiaPrimaIndirecta->precio_unit }}</td>
                                    <td class="px-1">
                                        <form action="{{ route('destroyIndirectas', ['numero_sdp' => $sdp->numero_sdp, 'id' => $materiaPrimaIndirecta->pivot->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta materia prima directa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
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

        .card {
            background: #55555510;
            border-radius: 10px;
        }

        .card-body {
            background: #55555510;
            border-radius: 8px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 8px;
        }

        .card-body-1, .card-body-2 {
            background: #a9b0ef19;
            backdrop-filter: blur(0.4rem);
            -webkit-backdrop-filter: blur(0.4rem);
            border-radius: 8px;
            border: 2px #a9b0ef19 solid;
            width: 600px;
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop