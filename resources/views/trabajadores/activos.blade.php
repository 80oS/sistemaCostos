@extends('adminlte::page')

@section('title', 'empleados activos')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Empleados activos') }}
    </h2>
@stop

@section('content')
<div class="box">
    <div class="col-12 px-20 mb-4">
        <a href="{{ route('trabajador.butons') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded">volver</a>
    </div>
    <div class="container">
        <div class="flex">
            <input type="text" id="searchInput" placeholder="Buscar trabajadores..." class="border rounded p-2 mb-4">
        </div>
        <div class="table_wrapper">
            <table class="">
                <thead>
                    <tr class="">
                        <!-- Sección de Información Personal -->
                        <th colspan="17" class=" d ">Información Personal</th>
                        <!-- Sección de Información Médica -->
                        <th colspan="4" class=" d ">Información Médica</th>
                        <!-- Sección de Información Familiar -->
                        <th colspan="{{ 13 + (5 * $maxHijos) }}" class=" d ">Información Familiar</th>
                        <!-- Sección de Acciones -->
                        <th colspan="3" class=" d ">Acciones</th>
                    </tr>
                    <tr class="">
                        <th class=" cd">#</th>
                        <!-- Información Personal -->
                        <th class=" c-1">Cédula</th>
                        <th class=" c-2">Nombre</th>
                        <th class=" c-3">Apellido</th>
                        <th class=" c-4">Sueldo Base</th>
                        <th class=" v">Teléfono Fijo</th>
                        <th class=" v">Celular</th>
                        <th class=" v">Correo</th>
                        <th class=" v">Area</th>
                        <th class=" v">Edad</th>
                        <th class=" v">Estado Civil</th>
                        <th class=" v">Sexo</th>
                        <th class=" v">Cargo</th>
                        <th class=" v">Fecha de Nacimiento</th>
                        <th class=" v">Fecha de Ingreso</th>
                        <th class=" v">Lugar de Nacimiento</th>
                        <th class=" v">Dirección</th>
        
                        <!-- Información Médica -->
                        <th class=" v">ARL</th>
                        <th class=" v">EPS</th>
                        <th class=" v">Alergias</th>
                        <th class=" v">Tipo de Sangre</th>
        
                        <!-- Información Familiar -->
                        <th class=" v">Nombre del Contacto</th>
                        <th class=" v">Parentesco</th>
                        <th class=" v">Teléfono del Contacto</th>
                        <th class=" v">Cuenta Bancaria</th>
                        <th class=" v">Fondo de Pensión</th>
                        <th class=" v">Fondo de Cesantías</th>
                        <th class=" v">Caja</th>
                        <th class=" v">Número de Hijos</th>
                            @for($i = 1; $i <= $maxHijos; $i++ )
                            <th class=" v">Nombre del Hijo{{ $i }}</th>
                            <th class=" v">Fecha de Nacimiento del Hijo{{ $i }}</th>
                            <th class=" v">Edad del Hijo{{ $i }}</th>
                            <th class=" v">Tipo de Documento del Hijo{{ $i }}</th>
                            <th class=" v">Número de Documento del Hijo{{ $i }}</th>
                            @endfor
                            <th class=" v">Nombre del Cónyuge</th>
                            <th class=" v">Fecha de Nacimiento del Cónyuge</th>
                            <th class=" v">Número de Documento del Cónyuge</th>
                            <th class=" v">Fecha de Expedición del Cónyuge</th>
                            <th class=" v">lugar de Expedición del Cónyuge</th>
                            <!-- Acciones -->
                            {{-- <th class=" v">Eliminar</th> --}}
                            <th class=" v">Habilitar/Deshabilitar</th>
                    </tr>
                </thead>
                <tbody id="trabajadoresTable">
                    @foreach ($trabajadores as $index => $trabajador)
                            <tr class="text-gray-700">
                                <td class="cd">{{ $index + 1 }}</td>
                                <!-- Información Personal -->
                                <td class=" c-1">{{ $trabajador->numero_identificacion }}</td>
                                <td class=" c-2">{{ $trabajador->nombre }}</td>
                                <td class=" c-3">{{ $trabajador->apellido }}</td>
                                <td class=" c-4">{{ $trabajador->sueldos->first()->sueldo ?? 'No tiene sueldo registrado' }}</td>
                                <td class=" v">{{ $trabajador->telefono_fijo }}</td>
                                <td class=" v">{{ $trabajador->celular }}</td>
                                <td class=" v">{{ $trabajador->correo }}</td>
                                <td class=" v">{{ $trabajador->departamentos }}</td>
                                <td class=" v">{{ $trabajador->edad }}</td>
                                <td class=" v">{{ $trabajador->estado_civil }}</td>
                                <td class=" v">{{ $trabajador->sexo }}</td>
                                <td class=" v">{{ $trabajador->cargo }}</td>
                                <td class=" v">{{ $trabajador->fecha_nacimiento }}</td>
                                <td class=" v">{{ $trabajador->fecha_ingreso }}</td>
                                <td class=" v">{{ $trabajador->lugar_nacimiento }}</td>
                                <td class=" v">{{ $trabajador->direccion }}</td>
        
                                <!-- Información Médica -->
                                <td class=" v">{{ $trabajador->ARL }}</td>
                                <td class=" v">{{ $trabajador->Eps }}</td>
                                <td class=" v">{{ $trabajador->alergias }}</td>
                                <td class=" v">{{ $trabajador->tipo_sangre }}</td>
        
                                <!-- Información Familiar -->
                                <td class=" v">{{ $trabajador->nombre_persona_contacto }}</td>
                                <td class=" v">{{ $trabajador->parentesco_con_persona_contacto }}</td>
                                <td class=" v">{{ $trabajador->telefono_celular_persona_contacto }}</td>
                                <td class=" v">{{ $trabajador->cuenta_bancaria }}</td>
                                <td class=" v">{{ $trabajador->fondo_pencion }}</td>
                                <td class=" v">{{ $trabajador->fondo_cesantias }}</td>
                                <td class=" v">{{ $trabajador->caja }}</td>
                                <td class=" v">{{ $trabajador->hijos_count }}</td>
                            @if ($trabajador->hijos_count > 0)
                                @foreach ($trabajador->hijos as $hijo)
                                    <td class=" v">{{ $hijo->nombre }}</td>
                                    <td class=" v">{{ $hijo->fecha_nacimiento }}</td>
                                    <td class=" v">{{ $hijo->edad }}</td>
                                    <td class=" v">{{ $hijo->tipo_documento }}</td>
                                    <td class=" v">{{ $hijo->numero_documento }}</td>  
                                @endforeach
                                @for ($i = $trabajador->hijos_count; $i < $maxHijos; $i++)
                                    <td class=" v">NO APLICA</td>
                                    <td class=" v">NO APLICA</td>
                                    <td class=" v">NO APLICA</td>
                                    <td class=" v">NO APLICA</td>
                                    <td class=" v">NO APLICA</td>
                                @endfor
                            @else
                                @for ($i = 0; $i < $maxHijos; $i++ )
                                    <td class=" v">NO APLICA</td>
                                    <td class=" v">NO APLICA</td>
                                    <td class=" v">NO APLICA</td>
                                    <td class=" v">NO APLICA</td>
                                    <td class=" v">NO APLICA</td>
                                @endfor
                            @endif
                                <td class=" v">{{ $trabajador->nombre_conyuge }}</td>
                                <td class=" v">{{ $trabajador->fecha_nacimiento_conyuge }}</td>
                                <td class=" v">{{ $trabajador->numero_documento_conyuge }}</td>
                                <td class=" v">{{ $trabajador->fecha_expedicion_conyuge }}</td>
                                <td class=" v">{{ $trabajador->lugar_expedicion_conyuge }}</td>
                                <td class=" v">
                                    @if ($trabajador->estado === 'activo')
                                        <form action="{{ route('trabajadores.disable', $trabajador->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Deshabilitar</button>
                                        </form>
                                    @else
                                        <form action="{{ route('trabajadores.enable', $trabajador->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Habilitar</button>
                                        </form>
                                    @endif
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
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
    <style>

    * {
    text-transform: capitalize;
    }
    .p-6 {
        padding: auto;
    }

    .box {
        padding: 10px;
        max-width: 1000rem;
    }

    .container {
        width: 900rem;
        max-height: 900px;
        background: #2a293b;
        border-radius: 10px;
        padding: 20px;
    }

    .table_wrapper {
        background: #d6d6d6;
        padding: 10px;
        border-radius: 10px;
        max-height: 700px;
        overflow-x: auto;
    }

    table {
            table-layout: auto;
            border: #000000 1px solid;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: #000000 1px solid;
            text-align: center;
        }

        table thead tr th.d {
            background: #37759e;
            border: #000000 1px solid;
            position: sticky;
            top: -12px;
            z-index: 2;
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
            left: 26px;
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
            left: 120px;
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
            left: 215px;
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
            left: 317px;
            border:1px solid #000000;
            color: #000000;
        }
        table tbody tr td.c-4 {
            background: #91dcff;
            border:1px solid #000000;
            color: #000000;
        }

        table thead tr th.cd, table thead tr th.c-1, table thead tr th.c-2, 
        table thead tr th.c-3, table thead tr th.c-4 {
            background: #91dcff;
            border: #000000 1px solid;
            position: sticky;
            top: 32px;
            z-index: 2;
        }

        table thead tr th.v {
            background: #2b5fa3;
            color: #000000;
            border: #000000 1px solid;
            position: sticky;
            top: 32px;

            text-transform: uppercase;
        }

        table .v {
            color: #000000;
            border: #000000 1px solid;
        }

        input {
            color: #000000;
        }

    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>

<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 5000);
</script>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        // Obtener el valor del campo de búsqueda
        var searchValue = this.value.toLowerCase();
        
        // Obtener todas las filas de la tabla
        var rows = document.querySelectorAll('#trabajadoresTable tr');
        
        // Iterar sobre las filas y ocultar las que no coincidan con el término de búsqueda
        rows.forEach(function(row) {
            // Obtener el texto de las celdas que deseas filtrar (por ejemplo: nombre, apellido, identificación)
            var nombre = row.cells[0].innerText.toLowerCase();
            var apellido = row.cells[1].innerText.toLowerCase();
            var numeroIdentificacion = row.cells[2].innerText.toLowerCase();
            
            // Si el término de búsqueda coincide con el nombre, apellido o identificación, mostrar la fila
            if (nombre.includes(searchValue) || apellido.includes(searchValue) || numeroIdentificacion.includes(searchValue)) {
                row.style.display = '';
            } else {
                // Si no coincide, ocultar la fila
                row.style.display = 'none';
            }
        });
    });
</script>
@stop
