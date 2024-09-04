@extends('adminlte::page')

@section('title', 'Empleados Operarios')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Empleados Operarios') }}
    </h2>
@stop

@section('content')
<div class="box">
    <div class="col-12 px-20 mb-4">
        <a href="{{ route('trabajadores.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded">volver</a>
    </div>
    <div class="flex items-end justify-end px-20 mb-4">
        <a href="{{ route('asignar.codigos') }}" class="btn btn-primary">Asignar Códigos Operarios</a>
    </div>
    {{-- <div class="flex items-end justify-end px-20 mb-4">
        <a href="{{ route('operarios.test') }}" class="btn btn-primary">test</a>
    </div> --}}
    <div class="container">
        @if (session('success'))
            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="table_wrapper">
            <table class="">
                <thead>
                    <tr class="">
                        <th class=" cd">#</th>
                        <!-- Información Personal -->
                        <th class=" c-1">codigo</th>
                        <th class=" c-2">Cédula</th>
                        <th class=" c-3">Nombre</th>
                        <th class=" c-4">Apellido</th>
                        <th class=" c-5">Sueldo Base</th>
                        <th class=" v">Teléfono Fijo</th>
                        <th class=" v">Celular</th>
                        <th class=" v">Correo</th>
                        <th class=" v">Area</th>
                        <th class=" v">Edad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operativos as $index => $operario)
                        <tr class="text-gray-700">
                            <td class="cd">{{ $index + 1 }}</td>
                            <td class="c-1">{{ $operario->codigo }}</td>
                            <!-- Información Personal -->
                            <td class="c-2">{{ $operario->trabajador->numero_identificacion }}</td>
                            <td class="c-3">{{ $operario->operario }}</td>
                            <td class="c-4">{{ $operario->trabajador->apellido }}</td>
                            <td class="c-5">{{ $operario->trabajador->sueldos->first()->sueldo ?? 'No tiene sueldo registrado' }}</td>
                            <td class="v">{{ $operario->trabajador->telefono_fijo }}</td>
                            <td class="v">{{ $operario->trabajador->celular }}</td>
                            <td class="v">{{ $operario->trabajador->correo }}</td>
                            <td class="v">{{ $operario->trabajador->departamentos }}</td>
                            <td class="v">{{ $operario->trabajador->edad }}</td>  
                        </tr>                  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="flex flex-col items-end justify-end px-20">
    <a href="{{ route('horas-extras.index') }}" id="exportToExcel" class="btnE btn btn-info">
        Bonos
    </a>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>

        * {
            text-transform: capitalize;
            }
        .p-6 {
                padding: auto;
            }
    
        .box {
                padding: 10px;
                max-width: 900rem;
            }
    
        .container {
                width: 100rem;
                max-height: 900px;
                background: #2a293b;
                border-radius: 10px;
                padding: 20px;
            }
    
        .table_wrapper {
                background: #d6d6d6;
                padding: 10px;
                border-radius: 10px;
                max-height: 800px;
                overflow-x: auto;
            }
    
        table {
                border: #000000 1px solid;
                border-collapse: collapse;
                padding: 10px;
            }
    
            th, td {
                padding: 10px;
                border: #000000 1px solid;
                text-align: center;
            }
    
    
            thead tr th.cd {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
            table .cd {
                position: sticky;
                left: -10px;
                border:1px solid #000000;
                color: #000000;
            }
            table tbody tr td.cd {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
    
            thead tr th.c-1 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
            table .c-1 {
                position: sticky;
                left: 10px;
                border:1px solid #000000;
                color: #000000;
            }
            table tbody tr td.c-1 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
    
            thead tr th.c-2 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
            table .c-2 {
                position: sticky;
                left: 78px;
                border:1px solid #000000;
                color: #000000;
            }
            table tbody tr td.c-2 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
    
            thead tr th.c-3 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
    
            }
            table .c-3 {
                position: sticky;
                left: 170px;
                border:1px solid #000000;
                color: #000000;
            }
            table tbody tr td.c-3 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
    
            thead tr th.c-4 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
            table .c-4 {
                position: sticky;
                left: 250px;
                border:1px solid #000000;
                color: #000000;
            }
            table tbody tr td.c-4 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }

            thead tr th.c-5 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
            table .c-5 {
                position: sticky;
                left: 350px;
                border:1px solid #000000;
                color: #000000;
            }
            table tbody tr td.c-5 {
                background: #91dcff;
                border:1px solid #000000;
                color: #000000;
            }
    
            table thead tr th.cd, table thead tr th.c-1, table thead tr th.c-2, 
            table thead tr th.c-3, table thead tr th.c-4, table thead tr th.c-5 {
                background: #91dcff;
                border: #000000 1px solid;
                position: sticky;
                top: 0px;
                z-index: 2;
            }
    
            table thead tr th.v {
                background: #2b5fa3;
                color: #000000;
                border: #000000 1px solid;
                position: sticky;
                top: 0px;
    
                text-transform: uppercase;
            }
    
            table .v {
                color: #000000;
                border: #000000 1px solid;
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