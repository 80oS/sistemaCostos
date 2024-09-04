
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
            {{ __('Paquetes de remiciones') }}
        </h2>
    </x-slot>
    <style>
        th, td {
            font-size: 15px;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex flex-col items-end justify-end mb-5">
                    <a href="{{ route('remiciones.create') }}" class="bg-blue-500 hover:bg-blue-900 px-3 py-2 text-white rounded">crear</a>
                </div>
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead>
                            <tr class="text-xs text-gray-700 uppercase bg-gray-50">
                                <th scope="col" class="py-3 px-6">cliente</th>
                                <th scope="col" class="py-3 px-6">nit</th>
                                <th scope="col" class="py-3 px-6">cantidad</th>
                                <th scope="col" class="py-3 px-6">remiciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $cliente->nombre }}</td>
                                    <td class="px-4 py-2 border">{{ $cliente->nit }}</td>
                                    <td class="px-4 py-2 border">{{ $cliente->remiciones->count() }}</td>
                                    <td class="px-4 py-6 border">
                                        <ul> 
                                            @foreach($remiciones as $rem)
                                            <li class="mb-3">
                                                <a href="{{ route('remiciones.show', $rem->codigo_remicion) }}" class="font-medium text-blue-600 hover:underline mr-5">
                                                    {{ $rem->codigo_remicion }}
                                                </a>

                                                <form action="{{ route('remiciones.destroy', $rem->codigo_remicion) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold" onclick="return confirm('¿Estás seguro de que deseas eliminar este paqute?');">Eliminar</button>
                                                </form>

                                                <a href="{{ route('remiciones.edit', $rem->codigo_remicion) }}" class="text-yellow-500 hover:text-blue-700 font-bold py-2 px-3 ">Editar</a>
                                                <hr>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 px-20">
        <a href="{{ route('ADD_C_S') }}" class="bg-violet-500 hover:bg-violet-700 text-white font-bold py-2 px-3 rounded">Admin_S_C</a>
    </div>
</x-app-layout>