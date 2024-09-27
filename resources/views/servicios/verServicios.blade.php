@extends('adminlte::page')

@section('title', 'servicios')

@section('content_header')
    
@stop

@section('content')
<form action="{{ route('servicio.actualizar-precio-servicio', $sdp->numero_sdp) }}" method="POST">
    @csrf
    @foreach($servicios as $servicio)
        <div class="service-row">
            <label>{{ $servicio->nombre }}</label>

            <!-- Mostrar el precio predeterminado de la tabla servicios si no tiene precio asignado aún -->
            @php
                $precioActual = $costosProduccion ? $costosProduccion->servicios->where('codigo', $servicio->codigo)->first()->pivot->valor_servicio ?? $servicio->valor_hora : $servicio->valor_hora;
            @endphp

            <input type="hidden" name="servicio_id" value="{{ $servicio->codigo }}">
            <input type="number" name="valor_servicio" value="{{ old('valor_servicio', $precioActual) }}" step="0.01" required>

            <button type="submit">Actualizar Precio</button>
        </div>
    @endforeach
</form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop