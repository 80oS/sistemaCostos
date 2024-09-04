<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Proveedores') }}
        </h2>
    </x-slot>
    
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
            background-color: #024f7c;
            position: sticky;
            top: 0; /* Fija la fila del encabezado en la parte superior */
            z-index: 1; /* Asegura que el encabezado esté por encima de las filas del cuerpo */ 
            border: 1px solid #ccc;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{route('proveedores.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear</a>
                </div>

                <div class="table-wraper">
                    <table id="tablaProveedores" class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700">
                                <th class="px-4 py-2 border">N DE IDENTIFICACION</th>
                                <th class="px-4 py-2 border">NOMBRE COMPLETO</th>
                                <th class="px-4 py-2 border">DIRECCION</th>
                                <th class="px-4 py-2 border">TELEFONO</th>
                                <th class="px-4 py-2 border">CORREO</th>
                                <th class="px-4 py-2 border">TIPO DE SERVICIO</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proveedores as $proveedor)
                            <tr class="text-gray-700">
                                <td class="border px-4 py-2">{{$proveedor->numero_identificacion}}</td>
                                <td class="border px-4 py-2">{{$proveedor->nombre}}</td>
                                <td class="border px-4 py-2">{{$proveedor->direccion}}</td>
                                <td class="border px-4 py-2">{{$proveedor->telefono}}</td>
                                <td class="border px-4 py-2">{{$proveedor->correo}}</td>
                                <td class="border px-4 py-2">{{$proveedor->tipo_servicio}}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{route('proveedores.edit', $proveedor->numero_identificacion)}}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Editar</a>
                                    <form action="{{ route('proveedores.destroy', $proveedor->numero_identificacion) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 p">
            <a href="{{route('home')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded">volver</a>
        </div>
    </div>
</x-app-layout>