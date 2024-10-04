@extends('adminlte::page')

@section('title', 'ORDEN DE COMPRA')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('lista de ordenes de compra') }}
</h2>
@stop

@section('content')
    <div class="py-12">
        <div class="container">
            <div class="col-12 mb-4">
                <a href="{{ route('AdministraciónInventario') }}" class="btn btn-primary">volver</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-12 mb-4">
                        <a href="{{ route('Ordencompras.create') }}" class="btn btn-primary">Crear</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="table">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
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
            background-color: #d2d0d0;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop