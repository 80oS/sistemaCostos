@extends('adminlte::page')

@section('title', 'categorias')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-300 leading-tight">
    {{ __('Todas las Categorias y sus Productos') }}
</h2>
@stop

@section('content')
<div class="p-12">
    <div class="flex justify-end">
        <a href="{{ route('almacen') }}" class="btn btn-warning">Volver</a>
    </div>
    <div class="flex justify-start">
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Agregar Categoria
        </a>
    </div>
    <div class="container">
        @foreach ($categorias as $categoria)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-4 py-2" id="titulo">
                    <h2 class="text-lg font-semibold text-gray-700">{{ $categoria->nombre }}</h2>
                </div>
                <div class="p-4">
                    <p class="text-gray-600 mb-4">{{ $categoria->descripcion }}</p>
                    <h3 class="font-semibold text-gray-700 mb-2">Productos:</h3>
                    <ul class="space-y-2">
                        @forelse ($categoria->productos as $producto)
                            <li class="flex justify-between items-center">
                                <span class="text-gray-700">{{ $producto->nombre }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Stock: {{ $producto->inventario_sum_stock ?? 0 }}
                                </span>
                            </li>
                        @empty
                            <li class="text-gray-500 italic">No hay productos en esta categoría.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endforeach
        <div class="flex justify-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Cambiar color de fondo
            </button>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar color de fondo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        Seleccionar el color de fondo
                    </div>
                    <div class="card-body">
                        <input type="color" name="color" id="colorPicker">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorPicker = document.getElementById('colorPicker');
        const modalGuardarBtn = document.querySelector('.modal-footer .btn-primary');
        let categoriaActual;

        // Función para abrir el modal y guardar la categoría actual
        function abrirModal(event) {
            const categoriaId = event.target.closest('.card').dataset.categoriaId;
            categoriaActual = document.querySelector(`.card[data-categoria-id="${categoriaId}"] .card-header`);
            const modal = new bootstrap.Modal(document.getElementById('colorModal'));
            modal.show();
        }

        // Asignar el evento a todos los botones de editar color
        document.querySelectorAll('.btn-edit-color').forEach(btn => {
            btn.addEventListener('click', abrirModal);
        });

        // Guardar el color seleccionado y persistirlo
        modalGuardarBtn.addEventListener('click', function() {
            const colorSeleccionado = colorPicker.value;
            if (categoriaActual) {
                const categoriaId = categoriaActual.closest('.card').dataset.categoriaId;
                categoriaActual.style.backgroundColor = colorSeleccionado;
                // Guardar el color en localStorage
                localStorage.setItem(`categoriaColor_${categoriaId}`, colorSeleccionado);
            }
            // Asignar el color de fondo al elemento con id 'titulo'
            const tituloElement = document.getElementById('titulo');
            if (tituloElement) {
                tituloElement.style.backgroundColor = colorSeleccionado;
                // Guardar el color del título en localStorage
                localStorage.setItem('tituloColor', colorSeleccionado);
            }
            bootstrap.Modal.getInstance(document.getElementById('colorModal')).hide();
        });

        // Función para cargar los colores guardados
        function cargarColoresGuardados() {
            document.querySelectorAll('.card').forEach(card => {
                const categoriaId = card.dataset.categoriaId;
                const colorGuardado = localStorage.getItem(`categoriaColor_${categoriaId}`);
                if (colorGuardado) {
                    card.querySelector('.card-header').style.backgroundColor = colorGuardado;
                }
            });

            const tituloElement = document.getElementById('titulo');
            const tituloColorGuardado = localStorage.getItem('tituloColor');
            if (tituloElement && tituloColorGuardado) {
                tituloElement.style.backgroundColor = tituloColorGuardado;
            }
        }

        // Llamar a la función para cargar los colores al cargar la página
        cargarColoresGuardados();
    });
    </script>
@stop
