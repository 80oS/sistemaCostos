<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('editar remicion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('remiciones.update', $remiciones->codigo_remicion) }}" method="POST" class="max-w-sm mx-auto space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="cantidad">cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" value="{{$remiciones->cantidad}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="descripcion">descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" value="{{$remiciones->descripcion}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="observaciones">observaciones</label>
                        <input type="text" name="observaciones" id="observaciones" value="{{$remiciones->observaciones}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="despacho">despachado por</label>
                        <input type="text" name="despacho" id="despacho" value="{{$remiciones->despacho}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="recibido">recibido por</label>
                        <input type="text" name="recibido" id="recibido" value="{{$remiciones->recibido}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="solicitud_produccion">solicitud de produccion</label>
                        <input type="text" name="solicitud_produccion" id="solicitud_produccion" value="{{$remiciones->solicitud_produccion}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="fecha_despacho">fecha despacho</label>
                        <input type="date" name="fecha_despacho" id="fecha_despaco" value="{{$remiciones->fecha_despacho}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">Guardar</button>
                        <a href="{{ route('remiciones.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>