@extends('adminlte::page')

@section('title', 'tiempos de produccion')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('lista tiempos de producción del operario') }} {{ $tiempos_produccion->first()->nombre_operario }}
    </h2>
@stop

@section('content')
<div class="py-12">
    <div class="flex items-end justify-end col-12 px-20 mb-4">
        <a href="{{ route('tiempos.group') }}" class="btn btn-success">volver</a>
    </div>
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="max-w-full mx-auto sm:px-6 lg:px-10 space-y-6">
        <div class=" overflow-hidden  sm:rounded-lg p-6 tg">
            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle container">
                                <table>
                                    <thead>
                                        <tr class="bg-gray-400 text-gray-800 uppercase">
                                            <th class="px-2 py-1 border">#</th>
                                            <th class="px-2 py-1 border">codigo del operario</th>
                                            <th class="px-2 py-1 border">nombre del operario</th>
                                            <th class="px-2 py-1 border">dia</th>
                                            <th class="px-2 py-1 border">mes</th>
                                            <th class="px-2 py-1 border">año</th>
                                            <th class="px-2 py-1 border">hora de inicio</th>
                                            <th class="px-2 py-1 border">hora de fin</th>
                                            <th class="px-2 py-1 border">codigo del servicio</th>
                                            <th class="px-2 py-1 border">proceso/servicio</th>
                                            <th class="px-2 py-1 border">valor hora del sevicio</th>
                                            <th class="px-2 py-1 border">horas</th>
                                            <th class="px-2 py-1 border">valor total por las horas trabajadas</th>
                                            <th class="px-2 py-1 border">sdp</th>
                                            <th class="px-2 py-1 border">editar</th>
                                            <th class="px-2 py-1 border">eliminar</th>
                                            <th class="px-2 py-1 border">recalcular</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tiempos_produccion as $index => $tiempo)
                                            <tr class="bg-gray-200 text-gray-800 capitalize">
                                                <td class="px-2 py-2 border">{{ $index + 1 }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->operativo_id }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->nombre_operario }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->dia }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->mes }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->año }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->hora_inicio }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->hora_fin }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->proseso_id  }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->nombre_servicio }}</td>
                                                <td class="px-2 py-2 border">{{ number_format($tiempo->servicio->valor_hora, 2, ',', '.') }}</td>
                                                <td class="px-2 py-2 border">{{ number_format($tiempo->horas, 2, ',', '.') }}</td>
                                                <td class="px-2 py-2 border">{{ number_format($tiempo->valor_total_horas, 2, ',', '.') }}</td>
                                                <td class="px-2 py-2 border">{{ $tiempo->sdp_id }}</td>
                                                <td class="px-2 py-2 border">
                                                    <a href="{{ route('tiempos-produccion.edit', $tiempo->id) }}" class="text-yellow-800 hover:text-yellow-500">
                                                        Editar
                                                    </a>
                                                </td>
                                                <td class="px-4 py-2 border">
                                                    <form action="{{ route('tiempos-produccion.destroy', $tiempo->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="text-red-700 hover:text-red-400" onclick="return confirm('¿Estás seguro de que deseas eliminar este tiempo de produccion?');">Eliminar</button>
                                                    </form>
                                                </td>
                                                <td class="px-4 py-2 border">
                                                    <form action="{{ route('tiempos_produccion.recalcular', $tiempo->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning">Recalcular</button>
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
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}


    <style>

        h2{
            font-size: 18px;
            text-transform: uppercase;
        }

        .buton {
            padding: 30px;
        }

        .content, .content-header {
            background: #fff !important;
        }
        .content{
            height: 87vh;
        }

        th, td {
            text-align: center;
        }

        th, td {
            border: #000 1px solid !important;
        }

        thead tr th {
            border: #000 1px solid !important;
        }

        tbody tr td {
            border: #000 1px solid !important;
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
        }, 2000);
    </script>
@stop








