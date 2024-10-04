@extends('adminlte::page')

@section('title', 'editar servicio')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('editar servicio') }}
</h2>
@stop

@section('content')
<div class="py-12">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('servicioCosto.actualizar', $servicioCosto->id) }}" method="POST" class="max-w-sm mx-auto space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="">{{ $servicioCosto->servicio->nombre }}</label>
                        <input type="hidden" name="servicio_id" value="{{ $servicioCosto->servicio_id }}">
                        <input type="text" name="valor_servicio" class="form-control" value="{{ $servicioCosto->valor_servicio }}" required>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('servicio.index') }}" class="btn btn-secondary">cancelar</a>
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
        .card, .card-body {
            background-color: #d4d2d2;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop