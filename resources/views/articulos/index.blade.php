@extends('adminlte::page')

@section('title', 'Articulos')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Todos los Articulos') }}
</h2>
@stop

@section('content')
    <div class="p-12">
        <div class=" flex items-end justify-end mb-4 px-20">
            <a href="{{ route('ADD_C_S') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">volver</a>
        </div>
        @if (session('success'))
            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="card">
            <div class="">
                <div class="card-body">
                    <table id="articulos" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>codigo</th>
                                <th>descripcion</th>
                                <th>material</th>
                                <th>plano</th>
                                <th>editar</th>
                                <th>eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articulos as $index => $articulo)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>{{ $articulo->codigo }}</td>
                                <td>{{ $articulo->descripcion }}</td>
                                <td>{{ $articulo->material }}</td>
                                <td>{{ $articulo->plano }}</td>
                                <td>
                                    <a href="{{ route('articulos.edit', $articulo->id) }}" class="text-yellow-700 hover:text-yellow-300">
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('articulos.destroy', $articulo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-700 hover:text-red-300" onclick="return confirm('¿Estás seguro de que deseas eliminar este articulo?');">eliminar</button>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.tailwindcss.css">
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
        new DataTable('#articulos', {
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: '50vh',
        });
    </script>
@stop