@extends('adminlte::page')

@section('title', 'empleados')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-300 leading-tight uppercase">
        {{ __('Todos los Empleados') }}
    </h2>
@stop

@section('content')
<div class="box">
    @if (session('success'))
        <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="col-12 px-20 mb-4">
        <a href="{{ route('trabajador.butons') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded">volver</a>
    </div>
    <div class="flext">
        <a href="{{ route('listar.operarios') }}" class="btn btn-warning">Lista de operarios</a>
    </div>
    <div class="container">
            <div class="">
                <a href="{{ route('trabajadores.create') }}" class="btn btn-info">Crear</a>
            </div>
            <div class="flext">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#printOptionsModal">
                    Imprimir Lista
                </button>
                <div class="flex">
                    <input type="text" id="searchInput" placeholder="Buscar trabajadores..." class="input">
                </div>
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
                            <th class=" v">Actualizar</th>
                            <th class=" v">crear o actualizar sueldo</th>
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
                                    <a href="{{ route('trabajadores.edit', $trabajador->id) }}" class="btn-yellow">Actualizar</a>
                                </td>
                                <td class=" v">
                                    @if($trabajador->sueldos->isNotEmpty())
                                    <a href="{{ route('sueldos.edit', $trabajador->sueldos->first()->id) }}" class="btn-yellow">Actualizar_Sueldo</a>
                                    @else
                                        <a href="{{ route('sueldos.create', $trabajador->id) }}" class="btn-blue">Crear_Sueldo</a>
                                    @endif
                                </td>
                                <td class=" v">
                                    @if ($trabajador->estado === 'activo')
                                        <form action="{{ route('trabajadores.disable', $trabajador->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-default">Deshabilitar</button>
                                        </form>
                                    @else
                                        <form action="{{ route('trabajadores.enable', $trabajador->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Habilitar</button>
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
<div class="modal fade" id="printOptionsModal" tabindex="-1" role="dialog" aria-labelledby="printOptionsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printOptionsModalLabel">Opciones de Impresión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="printOptionsForm" action="{{ route('generate.print.list') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Seleccione los campos a imprimir:</label>
                            <div>
                                @foreach($campos as $campo)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="campos[]" value="{{ $campo }}" id="campo_{{ $campo }}">
                                        <label class="form-check-label" for="campo_{{ $campo }}">
                                            {{ ucfirst($campo) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Seleccione los trabajadores:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="seleccion_trabajadores" id="todos_trabajadores" value="todos" checked>
                                <label class="form-check-label" for="todos_trabajadores">
                                    Todos los trabajadores
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="seleccion_trabajadores" id="seleccionar_trabajadores" value="seleccionar">
                                <label class="form-check-label" for="seleccionar_trabajadores">
                                    Seleccionar trabajadores
                                </label>
                            </div>
                        </div>
                        <div id="lista_trabajadores" style="display: none;">
                            @foreach($trabajadores as $trabajador)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="trabajadores_seleccionados[]" value="{{ $trabajador->id }}" id="trabajador_{{ $trabajador->id }}">
                                    <label class="form-check-label" for="trabajador_{{ $trabajador->id }}">
                                        {{ $trabajador->nombre }} {{ $trabajador->apellido }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="submitPrintForm()">Generar Lista para Imprimir</button>
                </div>
            </div>
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
        padding: 15px;
    }

    .container {
        width: 900rem;
        max-height: 900px;
        background: #403e49;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 5px #000;
    }

    .table_wrapper {
        background: #d6d6d6;
        padding: 10px;
        border-radius: 10px;
        max-height: 600px;
        overflow-x: auto;
    }

    table {
            table-layout: auto;
            border: #000000 1px solid;
            border-collapse: collapse;
            height: 400px;
        }

        th, td {
            padding: 10px;
            border: #000000 1px solid;
            text-align: center;
            text-transform: uppercase; 
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

        .input {
            color: #000000;
            height: 40px;
            border: #000000 1px solid;
            border-radius: 5px;
        }

        .flext {
            display: flex;
            align-items: flex-end;
            justify-content: end;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }

        .btn-yellow{
            background: #edff2d;
            border-radius: 5px;
            color: #000;
            padding: 5px;
            border: #fff 1px solid;
        }

        .btn-blue{
            background: #0661d7;
            border-radius: 5px;
            color: #000;
            padding: 5px;
            border: #fff 1px solid;
        }

        .contentt {
            width: 450px;
            max-height: 500px;
            overflow: auto;
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
    }, 10000);
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
<script>
    $(document).ready(function() {
        $('input[name="seleccion_trabajadores"]').change(function() {
            if ($(this).val() === 'seleccionar') {
                $('#lista_trabajadores').show();
            } else {
                $('#lista_trabajadores').hide();
            }
        });
    });

    function submitPrintForm() {
        var form = document.getElementById('printOptionsForm');
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.text())
        .then(html => {
            var printWindow = window.open('', '_blank');
            printWindow.document.write(html);
            printWindow.document.close();
            printWindow.focus();
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@stop
