@extends('adminlte::page')

@section('title', 'servicios')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('actualizar servicios para la sdp') }} {{ $sdp->numero_sdp }}
</h2>
@stop

@section('content')
<div class="container">
    <div class="">
        <a href="{{ route('servicio.index') }}" class="btn btn-info mb-4">volver</a>
    </div>
    @if (session('success'))
        <div id="success-message" class="success-message" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table id="servicios" class="table table-striped">
                <thead class="">
                    <tr>
                        <th>codigo</th>
                        <th>servicio</th>
                        <th>valor actual</th>
                        <th>editar</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach($sdp->servicios as $serviciosCosto)
                        <tr>
                            <td>{{  $serviciosCosto->pivot->servicio_id }}</td>
                            <td>{{  $serviciosCosto->nombre }}</td>
                            <td>{{ number_format($serviciosCosto->pivot->valor_servicio, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('serviciosCostos.show', $serviciosCosto->pivot->id) }}" class="btn btn-primary">Actualizar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>            
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .container{
            padding: 20px;
        }
        .card, .card-body {
            background: #c7bfbf;
        }

        .card-body {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    </script>
@stop