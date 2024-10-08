@extends('adminlte::page')

@section('title', 'Edit Permission')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-900 leading-tight uppercase">
    {{ __('editar permiso') }}
</h2>
@stop

@section('content')
    <div class="p-12">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Permiso</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" required>
                        </div>
                
                        <button type="submit" class="btn btn-primary">actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop