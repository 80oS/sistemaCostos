@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content_header')
    <h1>Editar Role</h1>
@stop

@section('content')
    <div class="p-12">
        <div class="container">
            <div class="card max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="card-body">
                    <form action="{{ route('roles.update', $role) }}" method="POST" class="max-w-sm mx-auto space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Role</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
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
        .card {
            width: 50rem;
            height: 200px;
        }
        input {
            width: 200px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

