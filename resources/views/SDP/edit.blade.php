@extends('adminlte::page')

@section('title', 'edit sdp')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-300 leading-tight uppercase">
    {{ __('Formulario del nuevo sdp') }}
</h2>
@stop

@section('content')
<div class="py-12">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card-body  overflow-hidden  sm:rounded-lg p-6">
            <form action="{{ route('sdp.update', $sdp->id) }}" method="POST"  class="max-w-sm mx-auto space-y-4">
                @csrf
                @method('PUT')
            
                <div class="form-group">
                    <label for="numero_sdp" class="block mb-2 text-sm font-medium text-gray-900">Número de SDP</label>
                    <input type="text" name="numero_sdp" id="numero_sdp" value="{{ $sdp->numero_sdp }}" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly>
                </div>
            
                <div class="form-group">
                    <label for="cliente_nit">Cliente / NIT</label>
                    <input type="text" name="cliente_nombre" id="cliente_nombre" value="{{ old('cliente_nombre', $sdp->clientes->nombre) }}" class="form-control mb-4">
                    <input type="text" name="cliente_nit" id="cliente_nit" class="form-control" value="{{ old('cliente_nit', $sdp->cliente_nit) }}" required> 
                </div>
            
                <div class="form-group">
                    <label for="vendedor_id">Vendedor</label>
                    <select name="vendedor_id" id="vendedor_id" class="form-control" required>
                        @foreach($vendedores as $vendedor)
                            <option value="{{ $vendedor->id }}" {{ $vendedor->id == old('vendedor_id', $sdp->vendedor_id) ? 'selected' : '' }}>
                                {{ $vendedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Artículos</label>
                    <div id="articulos-container">
                        @foreach($sdp->articulos as $articulo)
                            <div class="form-group articulo-item">
                                <div class="mb-4">
                                    <label for="articulo_{{ $loop->index }}_descripcion">Descripción</label>
                                    <input type="text" name="articulos[{{ $loop->index }}][descripcion]" id="articulo_{{ $loop->index }}_descripcion" class="form-control" value="{{ old('articulos.' . $loop->index . '.descripcion', $articulo->descripcion) }}" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="articulo_{{ $loop->index }}_material">Material</label>
                                    <input type="text" name="articulos[{{ $loop->index }}][material]" id="articulo_{{ $loop->index }}_material" class="form-control" value="{{ old('articulos.' . $loop->index . '.material', $articulo->material) }}">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="articulo_{{ $loop->index }}_plano">Plano</label>
                                    <input type="text" name="articulos[{{ $loop->index }}][plano]" id="articulo_{{ $loop->index }}_plano" class="form-control" value="{{ old('articulos.' . $loop->index . '.plano', $articulo->plano) }}">
                                </div>

                                <div class="mb-4">
                                    <label for="articulo_{{ $loop->index }}_cantidad">Cantidad</label>
                                    <input type="number" name="articulos[{{ $loop->index }}][cantidad]" id="articulo_{{ $loop->index }}_cantidad" class="form-control" value="{{ old('articulos.' . $loop->index . '.cantidad', $articulo->pivot->cantidad) }}" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="articulo_{{ $loop->index }}_precio">Precio</label>
                                    <input type="number" name="articulos[{{ $loop->index }}][precio]" id="articulo_{{ $loop->index }}_precio" class="form-control" value="{{ old('articulos.' . $loop->index . '.precio', $articulo->pivot->precio) }}" required>
                                </div>
                
                                <button type="button" class="btn btn-danger remove-articulo">Eliminar Artículo</button>
                            </div>
                        @endforeach
                    </div> 
                </div>

                <button type="button" id="add-articulo" class="btn btn-success">Agregar Artículo</button>
            
                <div class="form-group">
                    <label for="fecha_despacho_comercial" class="block mb-2 text-sm font-medium text-gray-100">Fecha Despacho Comercial</label>
                    <input type="date" name="fecha_despacho_comercial" id="fecha_despacho_comercial" value="{{ $sdp->fecha_despacho_comercial }}" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
            
                <div class="form-group">
                    <label for="fecha_despacho_produccion" class="block mb-2 text-sm font-medium text-gray-100">Fecha Despacho Producción</label>
                    <input type="date" name="fecha_despacho_produccion" id="fecha_despacho_produccion" value="{{ $sdp->fecha_despacho_produccion }}" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
            
                <div class="form-group">
                    <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-100">Observaciones</label>
                    <input type="text" name="observaciones" id="observaciones" value="{{ $sdp->observaciones }}" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            
                <div class="form-group">
                    <label for="orden_compra" class="block mb-2 text-sm font-medium text-gray-100">Orden de Compra</label>
                    <input type="text" name="orden_compra" id="orden_compra" value="{{ $sdp->orden_compra }}" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            
                <div class="form-group">
                    <label for="memoria_calculo" class="block mb-2 text-sm font-medium text-gray-100">Memoria de Cálculo</label>
                    <input type="text" name="memoria_calculo" id="memoria_calculo" value="{{ $sdp->memoria_calculo }}" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            
                <div class="form-group">
                    <label for="requisitos_cliente" class="block mb-2 text-sm font-medium text-gray-100">Requisitos Cliente</label>
                    <input type="text" name="requisitos_cliente" id="requisitos_cliente" value="{{ $sdp->requisitos_cliente }}" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            
                <div class="buttons">
                    <button type="submit"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Guardar
                    </button>
                    <a href="{{ route('sdp.paquetes') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="crearArticuloModal" tabindex="-1" aria-labelledby="crearArticuloModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearArticuloModalLabel">Crear Artículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crearArticuloForm">
                    @csrf
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="material">Material</label>
                        <input type="text" name="material" id="material" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="plano">Plano</label>
                        <input type="text" name="plano" id="plano" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Artículo</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .flext {
            display: flex;
        }

        .relatives {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .relatives input {
            width: 300px;
            height: 40px;

        }

        .relatives button {
            width: 400px;
            height: 60px;
            text-align: center;
            padding: 10px;
        }

        .buttons {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        form {
            max-width: 24rem;
            margin-left: auto;
            margin-right: auto;
        }

        .space-y-4 > :not([hidden]) ~ :not([hidden]) {
            --tw-space-y-reverse: 0;
            margin-top: calc(1rem /* 16px */ * calc(1 - var(--tw-space-y-reverse)));
            margin-bottom: calc(1rem /* 16px */ * var(--tw-space-y-reverse));
        }

        .card-body label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem /* 14px */;
            line-height: 1.25rem /* 20px */;
            font-weight: 500;
            --tw-text-opacity: 1;
            color: rgb(243 244 246 / var(--tw-text-opacity)) /* #f3f4f6 */;
        }

        .card-body input, .card-body select  {
            --tw-bg-opacity: 1;
            background-color: rgb(17 24 39 / var(--tw-bg-opacity)) /* #111827 */;
            border-width: 1px;
            --tw-border-opacity: 1;
            border-color: rgb(209 213 219 / var(--tw-border-opacity)) /* #d1d5db */;
            --tw-text-opacity: 1;
            color: rgb(243 244 246 / var(--tw-text-opacity)) /* #f3f4f6 */;
            font-size: 0.875rem /* 14px */;
            line-height: 1.25rem /* 20px */;
            border-radius: 0.5rem /* 8px */;
            width: 100%;
        }

        .card-body input.focus\:ring-blue-500:focus, .card-body select.focus\:ring-blue-500:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity)) /* #3b82f6 */;
        }
        .card-body input.p-2\.5, .card-body select.p-2\.5 {
            padding: 0.625rem /* 10px */;
        }

        .card-body button {
            --tw-bg-opacity: 1;
            background-color: rgb(59 130 246 / var(--tw-bg-opacity)) /* #3b82f6 */;
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity)) /* #ffffff */;
            font-weight: 700;
            padding-top: 0.5rem /* 8px */;
            padding-bottom: 0.5rem /* 8px */;
            padding-left: 1rem /* 16px */;
            padding-right: 1rem /* 16px */;
            border-radius: 0.25rem /* 4px */;
        }

        .card-body button.hover\:bg-blue-700:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(29 78 216 / var(--tw-bg-opacity)) /* #1d4ed8 */;
        }

        input.form-control::placeholder {
            color: #6b6a6a;
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
        document.addEventListener('DOMContentLoaded', function() {
            let articuloIndex = document.querySelectorAll('.articulo-item').length; // Contar artículos existentes

            document.getElementById('add-articulo').addEventListener('click', function () {
                const container = document.getElementById('articulos-container');
                
                const newArticuloHtml = `
            <div class="form-group articulo-item">
                <div class="mb-4">
                    <div>
                        <input type="text" class="form-control articulo-buscar mb-4" placeholder="Buscar artículo...">
                        <div class="suggestions-container"></div>
                    </div>
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#crearArticuloModal">
                        Crear Nuevo Artículo
                    </button>
                </div>

                <div class="mb-4">
                    <label for="articulo_${articuloIndex}_descripcion">Descripción</label>
                    <input type="text" name="articulos[${articuloIndex}][descripcion]" id="articulo_${articuloIndex}_descripcion" class="form-control" required>
                </div>    


                <div class="mb-4">
                    <label for="articulo_${articuloIndex}_material">Material</label>
                    <input type="text" name="articulos[${articuloIndex}][material]" id="articulo_${articuloIndex}_material" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="articulo_${articuloIndex}_plano">Plano</label>
                    <input type="text" name="articulos[${articuloIndex}][plano]" id="articulo_${articuloIndex}_plano" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="articulo_${articuloIndex}_cantidad">Cantidad</label>
                    <input type="number" name="articulos[${articuloIndex}][cantidad]" id="articulo_${articuloIndex}_cantidad" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="articulo_${articuloIndex}_precio">Precio</label>
                    <input type="number" name="articulos[${articuloIndex}][precio]" id="articulo_${articuloIndex}_precio" class="form-control" required>
                </div>
                
                <button type="button" class="btn btn-danger remove-articulo mb-4">Eliminar Artículo</button>
            </div>
        `;

                container.insertAdjacentHTML('beforeend', newArticuloHtml);
                articuloIndex++;
            });


            // Manejar la eliminación de una fila de artículo
            document.getElementById('articulos-container').addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-articulo')) {
                    event.target.closest('.articulo-item').remove();
                }
            });
        

            // Lógica para buscar y autocompletar artículos
            document.getElementById('articulos-container').addEventListener('input', function(event) {
                if (event.target.classList.contains('articulo-buscar')) {
                    let query = event.target.value;
                    if (query.length > 2) {
                        fetch(`/api/buscar-articulos?q=${query}`)
                            .then(response => response.json())
                            .then(data => {
                                let suggestionsContainer = event.target.nextElementSibling;
                                
                                // Limpiar cualquier lista de sugerencias anterior
                                suggestionsContainer.innerHTML = '';

                                if (data.length > 0) {
                                    // Crear una lista de sugerencias
                                    let ul = document.createElement('ul');
                                    ul.classList.add('suggestions-list');

                                    data.forEach(articulo => {
                                        let li = document.createElement('li');
                                        li.textContent = articulo.descripcion; // Mostrar la descripción del artículo
                                        li.addEventListener('click', function() {
                                            let row = event.target.closest('.articulo-item');

                                            // Completar los campos del artículo con los datos seleccionados
                                            row.querySelector('input[name$="[descripcion]"]').value = articulo.descripcion;
                                            row.querySelector('input[name$="[material]"]').value = articulo.material;
                                            row.querySelector('input[name$="[plano]"]').value = articulo.plano;
                                            row.querySelector('input[name$="[precio]"]').value = articulo.precio;

                                            // Limpiar la lista de sugerencias después de seleccionar un artículo
                                            suggestionsContainer.innerHTML = '';
                                        });

                                        ul.appendChild(li);
                                    });

                                    // Añadir la lista de sugerencias al contenedor correspondiente
                                    suggestionsContainer.appendChild(ul);
                                }
                            });
                    } else {
                        // Limpiar la lista de sugerencias si el query es menor de 3 caracteres
                        let suggestionsContainer = event.target.nextElementSibling;
                        suggestionsContainer.innerHTML = '';
                    }
                }
            });

            // Enviar el formulario para crear un artículo
            document.getElementById('crearArticuloForm').addEventListener('submit', function(event) {
                event.preventDefault();

                let formData = new FormData(event.target);

                fetch('{{ route("articulos.store") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('#crearArticuloModal').modal('hide');
                        event.target.reset();
                        alert('Artículo creado exitosamente.');
                    } else {
                        alert('Error al crear el artículo: ' + data.message);
                    }
                });
            });
        });
    </script>
@stop