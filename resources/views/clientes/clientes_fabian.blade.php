@extends('adminlte::page')

@section('title', 'CLIENTES_FABIAN')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lista de Clientes de Fabian Moreno') }}
    </h2>
@stop

@section('content')
<div class=" flex items-end justify-end mb-4 px-20">
    <a href="{{ route('clientes-comerciales') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">volver</a>
</div>
<div class="py-12">
    @if (session('success'))
        <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="tg max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6"> 
            <div class="mb-4">
                <a href="{{ route('clientes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear</a>
            </div>
            <table class="table" id="clientes">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIT</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Ciudad/Municpio</th>
                        <th>Departamento</th>
                        <th>Teléfono</th>
                        <th>contacto</th>
                        <th>Correo</th>
                        <th>Comerciales</th>
                        <th>Actualizar</th>
                        <th>eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $index => $cliente)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $cliente->nit }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>{{ $cliente->municipios->nombre }}</td>
                        <td>{{ $cliente->departamentos->nombre }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->contacto }}</td>
                        <td>{{ $cliente->correo }}</td>
                        <td>{{ $cliente->vendedores->nombre }}</td>
                        <td>
                            <a href="{{ route('clientes.edit', $cliente->nit) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Editar</a>
                        </td>
                        <td>
                            
                            <form action="{{ route('clientes.destroy', $cliente->nit) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">Eliminar</button>
                            </form>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.tailwindcss.css">
    <style>
        table.table {
            max-height: 700px;
            overflow: auto;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.tailwindcss.js"></script>
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
    <script>
        new DataTable('#clientes', {
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: '50vh',
        });
    </script>
@stop








