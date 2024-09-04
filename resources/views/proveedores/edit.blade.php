<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .custom-select {
                position: relative;
                display: inline-block;
                width: 100%;
            }
            .custom-select select {
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                display: block;
                width: 100%;
                padding: 10px 40px 10px 15px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #3E5B86;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3Cpath d='M7 10l5 5 5-5H7z' fill='%23000'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 10px center;
                background-size: 24px 24px;
            }
            .custom-select select:focus {
                border-color: #66afe9;
                outline: none;
                box-shadow: 0 0 5px rgba(102, 175, 233, 0.5);
            }
        </style>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulario para actualizar proveedor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('proveedores.update', $proveedor->numero_identificacion) }}" method="POST" class="max-w-sm mx-auto space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="tipo_identificacion_id" class="block mb-2 text-sm font-medium text-gray-900" for="tipo_identificacion">Tipo de Identificación</label>
                        <div class="custom-select">
                            <select name="tipo_identificacion" id="tipo_identificacion" required>
                                <option value="cedula_ciudadania" {{ $proveedor->tipo_identificacion == 'cedula_ciudadania' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                                <option value="cedula_extrangera" {{ $proveedor->tipo_identificacion == 'cedula_extrangera' ? 'selected' : '' }}>Cédula de extranjería</option>
                                <option value="pasaporte" {{ $proveedor->tipo_identificacion == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block  mb-2 text-sm font-medium text-gray-900" for="numero_identificacion">Número de Identificación</label>
                        <input type="number" name="numero_identificacion" id="numero_identificacion" value="{{$proveedor->numero_identificacion}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="nombre">Nombre Completo</label>
                        <input type="text" name="nombre" id="nombre" value="{{$proveedor->nombre}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" value="{{$proveedor->direccion}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="telefono">Teléfono</label>
                        <input type="tel" name="telefono" id="telefono" value="{{$proveedor->telefono}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" value="{{$proveedor->correo}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="tipo_servicio">Tipo de Servicio</label>
                        <div class="custom-select">
                            <select name="tipo_servicio" id="tipo_servicio" class="custom-select" required>
                                <option value="general">General</option>
                                <!-- Añadir otras opciones según sea necesario -->
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">Guardar</button>
                        <a href="{{ route('proveedores.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>