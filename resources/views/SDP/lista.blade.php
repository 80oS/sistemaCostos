@extends('adminlte::page')

@section('title', 'lista de sdps')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-300 leading-tight uppercase">
        {{ __('SDPs de ') . $cliente->nombre }}
    </h2>
@stop

@section('content')
<div class=" flex items-end justify-end mb-4 px-20">
    <a href="{{ route('sdp.paquetes') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">volver</a>
</div>
@if (session('success'))
    <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dark:bg-gray-700 shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 rounded">
                <div class="container">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-600 text-gray-200">
                                <th class="px-6 py-3 border-b">#</th>
                                <th class="px-6 py-3 border-b">Descripción</th>
                                <th class="px-6 py-3 border-b">Fecha</th>
                                <th class="px-6 py-3 border-b acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cliente->sdp as  $sdp)
                                <tr class="dark:bg-gray-300 text-gray-700">
                                    <td class="px-6 py-4 border-b">{{ $sdp->numero_sdp  }}</td>
                                    <td class="px-6 py-4 border-b desc">{{ $sdp->articulos->first()->descripcion }}</td>
                                    <td class="px-6 py-4 border-b">{{ $sdp->created_at->timezone('America/Bogota')->format('d/m/Y - h:i A') }}</td>
                                    <td class="px-6 py-4 border-b">
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="{{ route('sdp.ver', $sdp->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                            </div>
                                            <div class="col-4">
                                                <a href="{{ route('sdp.edit', $sdp->id) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                            </div>
                                            <div class="COL-4">
                                                <form action="{{ route('sdp.destroy', $sdp->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este SDP?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-700 hover:text-red-400">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
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
            overflow-y: auto;
            max-height: 500px;
        }
        table thead th.acciones {
            text-align: center
        }

        table thead th {
            text-transform: uppercase;
        }

        table tbody td.desc {
            text-transform: uppercase;
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
        }, 5000);
    </script>
@stop








