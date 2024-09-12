@extends('adminlte::page')

@section('title', 'Inventario Actual')

@section('content_header')
    <h1>Inventario Actual</h1>
@stop

@section('content')
<div class="p-4 flex justify-end">
    <a href="{{ route('almacen') }}" class="btn btn-warning">
        volver
    </a>
</div>
<div class="container">
    <h1>Inventario</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Ubicación</th>
                <th>Cantidad</th>
                <th>Última Actualización</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventarios as $inventario)
                <tr>
                    <td>{{ $inventario->producto->nombre }}</td>
                    <td>{{ $inventario->ubicacion->nombre }}</td>
                    <td>{{ $inventario->cantidad }}</td>
                    <td>{{ $inventario->fecha_actualizacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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