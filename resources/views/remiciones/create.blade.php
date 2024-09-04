<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear remisión') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form action="{{ route('remiciones.store') }}" method="POST" class="max-w-sm mx-auto space-y-4">
                        @csrf

                        <select name="cliente_nit" id="cliente_nit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->nit }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-200" for="cantidad">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="bg-gray-50 border border-gray-300 text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-200" for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="bg-gray-50 border border-gray-300 text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="observaciones">observaciones</label>
                            <input type="text" name="observaciones" id="observaciones" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="despacho">despachado por</label>
                            <input type="text" name="despacho" id="despacho" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="recibido">recibido por</label>
                            <input type="text" name="recibido" id="recibido"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="solicitud_produccion">solicitud de produccion</label>
                            <input type="number" name="solicitud_produccion" id="solicitud_produccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="fecha_despacho">fecha de despacho</label>
                            <input type="date" name="fecha_despacho" id="fecha_despacho" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Guardar</button>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>