@extends('adminlte::page')

@section('title', 'servicios')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lista de Servicios') }}
    </h2>
@stop

@section('content')
<div class="py-12 tg">
    <div class="">
        <a href="{{ route('servicio.index') }}" class="btn btn-info mb-4">ver sdp</a>
    </div>
    <div class="col-12 p">
        <a href="{{ route('servicio') }}" class="btn btn-primary">volver</a>
    </div>
    <div class="tg max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-400 overflow-hidden shadow-xl sm:rounded-lg p-6 tg">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="mb-4">
                <a href="{{route('servicios.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear</a>
            </div>
            <div class="table-wraper">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="tg">
                        <tr class="bg-gray-50 text-gray-700">
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">codigo</th>
                            <th class="px-4 py-2 border">nombre</th>
                            <th class="px-4 py-2 border">valor por hora</th>
                            <th class="px-4 py-2 border">actualizar</th>
                            <th class="px-4 py-2 border">eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $index => $servicio)
                        <tr class="text-gray-700">
                            <td class="border px-4 py-2">{{ $index + 1}}</td>
                            <td class="border px-4 py-2">{{ $servicio->codigo }}</td>
                            <td class="border px-4 py-2">{{ $servicio->nombre }}</td>
                            <td class="border px-4 py-2">{{ number_format($servicio->valor_hora, 2, '.', ',') }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{route('servicios.edit', $servicio->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">Editar</a>
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{route('servicios.destroy', $servicio->id)}}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar este servicio?');">Eliminar</button>
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
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        .p {
            padding: 20px;
        }
        .table-wraper {
            max-height: 500px;
            overflow-y: auto;
        }
        table {
            height: 500px;
            border-collapse: collapse;
        }

        .content, .content-header {
            background-color: #fff !important;
        }

        .content {
            height: 86vh;
        }

        h2 {
            font-size: 18px;
            text-transform: uppercase;
        }

    </style>

@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop


