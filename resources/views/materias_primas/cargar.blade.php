@extends('adminlte::page')

@section('title', 'cargar materia prima')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-400 leading-tight">
    {{ __('Cargar materias primas') }}
</h2>
@stop

@section('content')
    <div class="p-12">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('materias.store', ['numero_sdp' => $sdp->numero_sdp]) }}" method="POST" class="form space-y-4">

                        @csrf
                        <div class="materias-container mb-4">
                            <div class="mb-4">
                                <input type="text" id="buscar_materia" class="buscar_materia px-3 py-2" placeholder="buscar materia...">
                                <div class="suggestionsContainer" id="suggestionsContainer">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="codigo">codigo/materia</label>
                                <input type="text" id="codigo" name="codigo" class="px-3 py-2" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="descripcion">descripcion</label>
                                <input type="text" id="descripcion" name="descripcion" class="px-3 py-2" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="precio_unit">precio unitario</label>
                                <input type="text" id="precio_unit" name="precio_unit" class="px-3 py-2" readonly>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="cantidad">cantidad</label>
                            <input type="text" id="cantidad" name="cantidad" class="px-3 py-2">
                        </div>
                        <div class="mb4">
                            <label for="valor">valor</label>
                            <input type="text" id="valor" name="valor" class="px-3 py-2" readonly>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="button">cargar</button>
                            <a href="{{ route('lista.sdp.cargar') }}" class="buton">cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .form {
            max-width: 24rem;
            margin-left: auto;
            margin-right: auto;
        }

        .space-y-4 > :not([hidden]) ~ :not([hidden]) {
            --tw-space-y-reverse: 0;
            margin-top: calc(1rem /* 16px */ * calc(1 - var(--tw-space-y-reverse)));
            margin-bottom: calc(1rem /* 16px */ * var(--tw-space-y-reverse));
        }

        label {
            display: block;
            color: #fff;
            text-transform: capitalize;
        }

        input, select {
            width: 300px;
            height: 30px;
            padding: 16px;
            background: #666666;
            color: #fff;
            border: 2px #8d8c8c solid;
            border-radius: 5px;
        }

        button.button {
            background-color: #007cb5;
            padding-left: 16px;
            padding-right: 16px;
            padding-top: 8px;
            padding-bottom: 8px;
            border: #fafafa10 2px solid;
            border-radius: 5px;
            text-transform: capitalize;
        }

        a.buton {
            background-color: #5e5e5e;
            padding-left: 16px;
            padding-right: 16px;
            padding-top: 9px;
            padding-bottom: 9px;
            border: #fafafa10 2px solid;
            border-radius: 5px;
            text-transform: capitalize;
        }

        .suggestions-list {
            list-style-type: none; /* Elimina las viñetas de la lista */
            padding: 0;
            margin: 0;
            border: 1px solid #ddd;
            max-height: 150px; /* Altura máxima de la lista */
            overflow-y: auto; /* Muestra una barra de desplazamiento si es necesario */
            background-color: #fff;
            position: absolute; /* Posicionamiento absoluto para la lista */
            width: 500px; /* Asegura que la lista ocupe todo el ancho del input */
            z-index: 1000; /* Asegura que la lista aparezca sobre otros elementos */
            color: #000;
        }

        .suggestions-list li {
            padding: 8px; /* Espaciado interno de cada ítem */
            cursor: pointer;
        }

        .suggestions-list li:hover {
            background-color: #f0f0f0; /* Color de fondo al pasar el ratón */
            color: #000;
        }

    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        document.getElementById('buscar_materia').addEventListener('input', function(event) {
            let query = event.target.value;
            if (query.length > 2) {
                fetch(`/api/buscar-materias?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        let suggestionsContainer = document.getElementById('suggestionsContainer');
                        
                        // Limpiar cualquier lista de sugerencias anterior
                        suggestionsContainer.innerHTML = '';

                        if (data.length > 0) {
                            // Crear una lista de sugerencias
                            let ul = document.createElement('ul');
                            ul.classList.add('suggestions-list');

                            data.forEach(materia => {
                                let li = document.createElement('li');
                                li.textContent = materia.descripcion; 
                                li.addEventListener('click', function() {
                                    // Actualizar los campos con la información de la materia seleccionada
                                    document.getElementById('codigo').value = materia.codigo;
                                    document.getElementById('descripcion').value = materia.descripcion;
                                    document.getElementById('precio_unit').value = materia.precio_unit;

                                    // Limpiar las sugerencias una vez seleccionada
                                    suggestionsContainer.innerHTML = '';
                                });

                                ul.appendChild(li);
                            });

                            suggestionsContainer.appendChild(ul);
                        }
                    });
            } else {
                // Limpiar la lista de sugerencias si el query es menor de 3 caracteres
                let suggestionsContainer = document.getElementById('suggestionsContainer');
                suggestionsContainer.innerHTML = '';
            }
        });
    </script>
    <script>
        // Obtener los elementos del DOM
        const precioUnitInput = document.getElementById('precio_unit');
        const cantidadInput = document.getElementById('cantidad');
        const valorInput = document.getElementById('valor');
    
        // Escuchar el cambio en el campo de cantidad
        cantidadInput.addEventListener('input', function() {
            // Obtener los valores actuales
            const precioUnitario = parseFloat(precioUnitInput.value) || 0; // Asegurarse de que sea un número
            const cantidad = parseFloat(cantidadInput.value) || 0; // Asegurarse de que sea un número
    
            // Calcular el valor
            const valor = precioUnitario * cantidad;
    
            // Asignar el valor al campo de resultado
            valorInput.value = valor.toFixed(2); // Mostrar solo 2 decimales
        });
    </script>
@stop