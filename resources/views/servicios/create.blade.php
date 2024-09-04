@extends('adminlte::page')

@section('title', 'crear servicio')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-300 leading-tight">
        {{ __('Formulario del nuevo servicio') }}
    </h2>
@stop

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-500 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('servicios.store') }}" method="POST" class="max-w-sm mx-auto space-y-4">
                @csrf

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="nombre">nombre</label>
                    <input type="text" name="nombre" id="nombre" class="bg-gray-800 border border-gray-700 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-100" for="cantidad">valor por hora</label>
                    <input type="number" name="valor_hora" id="valor_hora" class="bg-gray-800 border border-gray-700 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">Guardar</button>
                    <a href="{{ route('servicios.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop