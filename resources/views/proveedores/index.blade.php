@extends('adminlte::page')

@section('title', 'home')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
    {{ __('lista de proveedores') }}
</h2>
@stop

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="mb-4">
                <a href="{{route('proveedor.create')}}" class="btn btn-primary">Crear</a>
            </div>

            <div class="table-wraper">
                <table id="tablaProveedores" class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50 text-gray-700">
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">NOMBRE COMPLETO</th>
                            <th class="px-4 py-2 border">PERSONA DE CONTACTO</th>
                            <th class="px-4 py-2 border">TELEFONO</th>
                            <th class="px-4 py-2 border">CORREO</th>
                            <th class="px-4 py-2 border">DIRECCION</th>
                            <th class="px-4 py-2 border">CIUDAD</th>
                            <th class="px-4 py-2 border">EDITAR</th>
                            <th class="px-4 py-2 border">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $index  => $proveedor)

                        <tr class="text-gray-700">
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{$proveedor->nombre}}</td>
                            <td class="border px-4 py-2">{{$proveedor->persona_contacto}}</td>
                            <td class="border px-4 py-2">{{$proveedor->telefono}}</td>
                            <td class="border px-4 py-2">{{$proveedor->email}}</td>
                            <td class="border px-4 py-2">{{$proveedor->direccion}}</td>
                            <td class="border px-4 py-2">{{$proveedor->ciudad}}</td>
                            <td class="border px-4 py-2">
                                <a href="{{route('proveedor.edit', $proveedor->id)}}" class="btn btn-info">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('proveedor.destroy', $proveedor->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">Eliminar</button>
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
    <style>
        .p {
            padding: 20px;
        }

        .table-wraper {
            max-height: 600px;
            overflow-y: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        thead th {
            
            position: sticky;
            top: 0; /* Fija la fila del encabezado en la parte superior */
            z-index: 1; /* Asegura que el encabezado esté por encima de las filas del cuerpo */ 
            border: 1px solid #ccc;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop