@extends('adminlte::page')

@section('title', 'empleados')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Empleados inactivos') }}
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
            <table class=" border-gray-900 ">
                <thead>
                    <tr class=" border-gray-900 ">
                        <!-- Sección de Información Personal -->
                        <th colspan="17" class=" d border-gray-900 ">Información Personal</th>
                        <!-- Sección de Información Médica -->
                        <th colspan="4" class=" d border-gray-900 ">Información Médica</th>
                        <!-- Sección de Información Familiar -->
                        <th colspan="{{ 13 + (5 * $maxHijos) }}" class=" d border-gray-900 ">Información Familiar</th>
                        <!-- Sección de Acciones -->
                        <th colspan="3" class=" d border-gray-900 ">Acciones</th>
                    </tr>
                    <tr class=" border-gray-900 ">
                        <th class="  border-gray-900  cd">#</th>
                        <!-- Información Personal -->
                        <th class="  border-gray-900  c-1">Cédula</th>
                        <th class=" border-gray-900   c-2">Nombre</th>
                        <th class=" border-gray-900   c-3">Apellido</th>
                        <th class="  border-gray-900 c-4">Sueldo Base</th>
                        <th class="  border-gray-900 v">Teléfono Fijo</th>
                        <th class="  border-gray-900 v">Celular</th>
                        <th class=" border-gray-900  v">Correo</th>
                        <th class="  border-gray-900 v">Area</th>
                        <th class="  border-gray-900  v">Edad</th>
                        <th class="  border-gray-900  v">Estado Civil</th>
                        <th class="  border-gray-900  v">Sexo</th>
                        <th class="  border-gray-900  v">Cargo</th>
                        <th class=" border-gray-900  v">Fecha de Nacimiento</th>
                        <th class="  border-gray-900 v">Fecha de Ingreso</th>
                        <th class=" border-gray-900  v">Lugar de Nacimiento</th>
                        <th class=" border-gray-900  v">Dirección</th>
        
                        <!-- Información Médica -->
                        <th class="  border-gray-900 v">ARL</th>
                        <th class="  border-gray-900 v">EPS</th>
                        <th class="  border-gray-900 v">Alergias</th>
                        <th class="  border-gray-900 v">Tipo de Sangre</th>
        
                        <!-- Información Familiar -->
                        <th class=" border-gray-900  v">Nombre del Contacto</th>
                        <th class=" border-gray-900  v">Parentesco</th>
                        <th class=" border-gray-900  v">Teléfono del Contacto</th>
                        <th class=" border-gray-900  v">Cuenta Bancaria</th>
                        <th class=" border-gray-900  v">Fondo de Pensión</th>
                        <th class=" border-gray-900  v">Fondo de Cesantías</th>
                        <th class=" border-gray-900  v">Caja</th>
                        <th class=" border-gray-900  v">Número de Hijos</th>
                            @for($i = 1; $i <= $maxHijos; $i++ )
                            <th class="  border-gray-900 v">Nombre del Hijo{{ $i }}</th>
                            <th class=" border-gray-900  v">Fecha de Nacimiento del Hijo{{ $i }}</th>
                            <th class=" border-gray-900  v">Edad del Hijo{{ $i }}</th>
                            <th class=" border-gray-900  v">Tipo de Documento del Hijo{{ $i }}</th>
                            <th class=" border-gray-900  v">Número de Documento del Hijo{{ $i }}</th>
                            @endfor
                            <th class=" border-gray-900  v">Nombre del Cónyuge</th>
                            <th class=" border-gray-900  v">Fecha de Nacimiento del Cónyuge</th>
                            <th class="  border-gray-900 v">Número de Documento del Cónyuge</th>
                            <th class=" border-gray-900  v">Fecha de Expedición del Cónyuge</th>
                            <th class=" border-gray-900  v">Lugar de Expedición del Cónyuge</th>
                            <!-- Acciones -->
                            {{-- <th class=" v">Eliminar</th> --}}
                            <th class=" border-gray-900  v">Habilitar/Deshabilitar</th>
                    </tr>
                </thead>
                <tbody id="trabajadoresTable">
                    @foreach ($trabajadores as $index => $trabajador)
                            <tr class="text-gray-700">
                                <td class=" border-gray-900  cd">{{ $index + 1 }}</td>
                                <!-- Información Personal -->
                                <td class=" border-gray-900  c-1">{{ $trabajador->numero_identificacion }}</td>
                                <td class=" border-gray-900  c-2">{{ $trabajador->nombre }}</td>
                                <td class=" border-gray-900  c-3">{{ $trabajador->apellido }}</td>
                                <td class=" border-gray-900  c-4">{{ $trabajador->sueldos->first()->sueldo ?? 'No tiene sueldo registrado' }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->telefono_fijo }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->celular }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->correo }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->departamentos }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->edad }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->estado_civil }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->sexo }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->cargo }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->fecha_nacimiento }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->fecha_ingreso }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->lugar_nacimiento }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->direccion }}</td>
        
                                <!-- Información Médica -->
                                <td class=" border-gray-900  v">{{ $trabajador->ARL }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->Eps }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->alergias }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->tipo_sangre }}</td>
        
                                <!-- Información Familiar -->
                                <td class=" v">{{ $trabajador->nombre_persona_contacto }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->parentesco_con_persona_contacto }}</td>
                                <td class=" border-gray-900  v">{{ $trabajador->telefono_celular_persona_contacto }}</td>
                                <td class="  border-gray-900 v">{{ $trabajador->cuenta_bancaria }}</td>
                                <td class="  border-gray-900 v">{{ $trabajador->fondo_pencion }}</td>
                                <td class=" border-gray-900 v">{{ $trabajador->fondo_cesantias }}</td>
                                <td class="  border-gray-900 v">{{ $trabajador->caja }}</td>
                                <td class="  border-gray-900 v">{{ $trabajador->hijos_count }}</td>
                            @if ($trabajador->hijos_count > 0)
                                @foreach ($trabajador->hijos as $hijo)
                                    <td class=" border-gray-900  v">{{ $hijo->nombre }}</td>
                                    <td class=" border-gray-900  v">{{ $hijo->fecha_nacimiento }}</td>
                                    <td class="  border-gray-900 v">{{ $hijo->edad }}</td>
                                    <td class=" border-gray-900  v">{{ $hijo->tipo_documento }}</td>
                                    <td class="  border-gray-900 v">{{ $hijo->numero_documento }}</td>  
                                @endforeach
                                @for ($i = $trabajador->hijos_count; $i < $maxHijos; $i++)
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                @endfor
                            @else
                                @for ($i = 0; $i < $maxHijos; $i++ )
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                    <td class="  border-gray-900 v">NO APLICA</td>
                                @endfor
                            @endif
                            <td class=" border-gray-900  v">{{ $trabajador->nombre_conyuge }}</td>
                            <td class=" border-gray-900  v">{{ $trabajador->fecha_nacimiento_conyuge }}</td>
                            <td class=" border-gray-900  v">{{ $trabajador->numero_documento_conyuge }}</td>
                            <td class=" border-gray-900  v">{{ $trabajador->fecha_expedicion_conyuge }}</td>
                            <td class=" border-gray-900  v">{{ $trabajador->lugar_expedicion_conyuge }}</td>
                                <td class="  border-gray-900  v">
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
    
    }
    .p-6 {
        padding: auto;
    }

    .box {
        padding: 5px;
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
        border-radius: 10px;
        max-height: 700px;
        overflow-x: auto;
    }

    table {
            border:1px solid #000000;
            border-collapse: collapse;
            padding: 1px;
            /* height: 200px; */
        }

        th, td {
            padding: 10px;
            border:1px solid #000000;
            text-align: center;
        }

        table thead tr th.d {
            background: #37759e;
            border:1px solid #000000;
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
            left: -5px;
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
            left: 14px;
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
            left: 80px;
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
            left: 150px;
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
            left: 220px;
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
            border:1px solid #000000;
            position: sticky;
            top: 32px;
            z-index: 2;
        }

        table thead tr th.v {
            background: #2b5fa3;
            color: #000000;
            border:1px solid #000000;
            position: sticky;
            top: 32px;

            text-transform: uppercase;
        }

        table .v {
            color: #000000;
            border:1px solid #000000;
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
