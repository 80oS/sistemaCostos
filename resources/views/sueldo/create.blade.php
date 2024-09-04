@extends('adminlte::page')

@section('title', 'home')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('creacion de sueldo') }}
    </h2>
@stop

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('sueldo.store') }}" method="POST" class="max-w-sm mx-auto space-y-4">
                @csrf

                <input type="hidden"  name="trabajador_id" value="{{ $trabajador->id }}">

                <div>
                    <label for="trabajador_id" class="block mb-2 text-sm font-medium text-gray-100">Trabajador</label>
                    <input type="text" value="{{ $trabajador->id }} - {{ $trabajador->nombre }} - {{ $trabajador->apellido }}" disabled class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div class="">
                    <label for="sueldo" class="block mb-2 text-sm font-medium text-gray-100">sueldo</label>
                    <input type="number" id="sueldo" name="sueldo" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <div class="">
                    <label for="auxilio_transporte" class="block mb-2 text-sm font-medium text-gray-100">auxilio_transporte</label>
                    <input type="number" id="auxilio_transporte" name="auxilio_transporte" value="162000" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                
                <div class="">
                    <label for="" class="block mb-2 text-sm font-medium text-gray-100">bonificacion_auxilio</label>
                    <input type="number" id="bonificacion_auxilio" name="bonificacion_auxilio" value="0" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>

                <div class="form-group">
                    <label for="tipo_pago" class="block mb-2 text-sm font-medium text-gray-100">Tipo de Pago</label>
                    <select name="tipo_pago" id="tipo_pago" class="bg-gray-900 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @foreach (App\Enums\TipoPago::cases() as $tipoPago)
                            <option value="{{ $tipoPago->value }}">{{ $tipoPago->name }}</option>
                        @endforeach
                    </select>
                </div>
                

                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-900 text-white font-bold px-3 py-2 rounded">guardar</button>
                    <a href="{{ route('trabajadores.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold px-3 py-2 rounded">cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
@stop

@section('js')
{{-- Add here extra scripts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop