@extends('adminlte::page')

@section('title', 'CREAR CLIENTE')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Formulario del nuevo cliente') }}
    </h2>
@stop

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('clientes.store') }}" method="POST" class="max-w-sm mx-auto space-y-4">
                @csrf

                <div>
                    <label for="comerciales_id" class="block mb-2 text-sm font-medium text-gray-100">R.comercial</label>
                    <select name="comerciales_id" id="comerciales_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">Seleccione un comercial</option>
                        @foreach($comerciales as $comercial)
                            <option value="{{ $comercial->id }}">{{ $comercial->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="nombre">Nombre / Razon Social</label>
                    <input type="text" name="nombre" id="nombre" class="bg-gray-900 border border-gray-300 text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray100" for="nit">Nit / Cedula</label>
                    <input type="text" name="nit" id="nit" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="direccion">direccion</label>
                    <input type="text" name="direccion" id="" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="departamento">Departamento / pais</label>
                    <select name="departamento" id="departamento" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">Seleccione un departamento</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="ciudad">Ciudad / Municipio</label>
                    <div class="relatives">
                        <select name="ciudad" id="ciudad" class="select bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="">Seleccione una ciudad/municipio</option>
                        </select>
                        <button type="button" id="addMunicipioBtn" class="bg-green-600 text-white rounded-lg hover:bg-green-700">Agregar Municipio</button>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="contacto">contacto</label>
                    <input type="text" name="contacto" id="contacto" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">Guardar</button>
                    <a href="{{ route('clientes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="addMunicipioModal" class="fixed inset-0 flext items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Agregar Nuevo Municipio</h3>
        <form id="addMunicipioForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="newMunicipio" class="block text-sm font-medium text-gray-900">Nombre del Municipio</label>
                <input type="text" id="newMunicipio" name="newMunicipio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Guardar</button>
                <button type="button" id="closeModalBtn" class="ml-4 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Cancelar</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .flext {
            display: flex;
        }
        .relatives {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .relatives select.select {
            width: 500rem;
            height: 40px;

        }

        .relatives button {
            width: 300px;
            height: 60px;
            text-align: center;
            padding: 10px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departamentoSelect = document.getElementById('departamento');
            const ciudadSelect = document.getElementById('ciudad');
            const addMunicipioBtn = document.getElementById('addMunicipioBtn');
            const addMunicipioModal = document.getElementById('addMunicipioModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const addMunicipioForm = document.getElementById('addMunicipioForm');

            departamentoSelect.addEventListener('change', function() {
                const departamentoId = this.value;
                ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad/municipio</option>'; // Limpiar opciones previas

                if (departamentoId) {
                    fetch(`/municipios/${departamentoId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(municipio => {
                                const option = document.createElement('option');
                                option.value = municipio.id;
                                option.textContent = municipio.nombre;
                                ciudadSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching municipios:', error));
                }
            });

            addMunicipioBtn.addEventListener('click', function() {
                addMunicipioModal.classList.remove('hidden');
            });

            closeModalBtn.addEventListener('click', function() {
                addMunicipioModal.classList.add('hidden');
            });

            addMunicipioForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const nuevoMunicipio = document.getElementById('newMunicipio').value;
                const departamentoId = departamentoSelect.value;

                if (nuevoMunicipio && departamentoId) {
                    fetch(`/municipios/${departamentoId}/add`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ nombre: nuevoMunicipio })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const option = document.createElement('option');
                        option.value = data.id;
                        option.textContent = data.nombre;
                        ciudadSelect.appendChild(option);
                        addMunicipioModal.classList.add('hidden');
                        addMunicipioForm.reset();
                    })
                    .catch(error => console.error('Error adding municipio:', error));
                }
            });
        });
    </script>
@stop








