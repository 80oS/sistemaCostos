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
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex flex-row items-center justify-center gap-5">
                <div class="mb-4">
                    <a href="{{ route('materiasPrimasDirectas.create') }}" class="btn btn-info">crear materia primas directas</a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('materiasPrimasIndirectas.create') }}" class="btn btn-info">crear materia primas indirectas</a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('materias_primas.create') }}" class="btn btn-info">servicios externos</a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('lista.sdp.cargar') }}" class="btn btn-info">Carga de Materias Primas</a>
                </div>
            </div>
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
                                    <th class="px-1">CODIGO</th>
                                    <th class="px-1">DESCRIPCION</th>
                                    <th class="px-1">PROVEEDOR</th>
                                    <th class="px-1">NUMERO DE FACTURA</th>
                                    <th class="px-1">NUMERO DE ORDEN DE COMPRA</th>
                                    <th class="px-1">PRECIO UNITARIO</th>
                                    <th class="px-1">EDTAR</th>
                                    <th class="px-1">ELIMINAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiasPrimasDirectas as $materiaPrimaDirecta)
                                    <tr>
                                        <td class="px-1">{{ $materiaPrimaDirecta->codigo }}</td>
                                        <td class="px-1">{{ $materiaPrimaDirecta->descripcion }}</td>
                                        <td class="px-1">{{ $materiaPrimaDirecta->proveedor }}</td>
                                        <td class="px-1">{{ $materiaPrimaDirecta->numero_factura }}</td>
                                        <td class="px-1">{{ $materiaPrimaDirecta->numero_orden_compra }}</td>
                                        <td class="px-1">{{ $materiaPrimaDirecta->precio_unit }}</td>
                                        <td class="px-1">
                                            <a href="{{ route('materiasPrimasDirectas.edit', $materiaPrimaDirecta->id) }}" class="text-yellow-600 hover:text-yellow-300">EDITAR</a>
                                        </td>
                                        <td class="px-1">
                                            <form action="{{ route('materiasPrimasDirectas.destroy', $materiaPrimaDirecta->id ) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="text-red-600 hover:text-red-400" onclick="return confirm('¿Estás seguro de que deseas eliminar esta materia prima directa?');">ELIMINAR</button>
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
                                    <th class="px-1">CODIGO</th>
                                    <th class="px-1">DESCRIPCION</th>
                                    <th class="px-1">PROVEEDOR</th>
                                    <th class="px-1">NUMERO DE FACTURA</th>
                                    <th class="px-1">NUMERO DE ORDEN DE COMPRA</th>
                                    <th class="px-1">PRECIO UNITARIO</th>
                                    <th class="px-1">EDITAR</th>
                                    <th class="px-1">ELIMINAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiasPrimasIndirectas as $materiaPrimaIndirecta)
                                    <tr>
                                        <td class="px-1">{{ $materiaPrimaIndirecta->codigo }}</td>
                                        <td class="px-1">{{ $materiaPrimaIndirecta->descripcion }}</td>
                                        <td class="px-1">{{ $materiaPrimaIndirecta->proveedor }}</td>
                                        <td class="px-1">{{ $materiaPrimaIndirecta->numero_factura }}</td>
                                        <td class="px-1">{{ $materiaPrimaIndirecta->numero_orden_compra }}</td>
                                        <td class="px-1">{{ $materiaPrimaIndirecta->precio_unit }}</td>
                                        <td class="px-1">
                                            <a href="{{ route('materiasPrimasIndirectas.edit', $materiaPrimaIndirecta->id) }}" class="text-yellow-600 hover:text-yellow-400">EDITAR</a>
                                        </td>
                                        <td class="px-1">
                                            <form action="{{ route('materiasPrimasIndirectas.destroy', $materiaPrimaIndirecta->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-red-600 hover:text-red-400" type="submit"  onclick="return confirm('¿Estás seguro de que deseas eliminar esta materia prima indirecta?');">ELIMINAR</button>
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
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 10000);
    </script>
@stop


