@extends('adminlte::page')

@section('title', 'crear_empleado')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-400 leading-tight">
    {{ __('Formulario del nuevo empleado') }}
</h2>
@stop

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card">
            <div class="card-body overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('trabajadores.store') }}" method="POST" class="max-w-sm mx-auto space-y-4">
                    @csrf
                    <h1>INFORMACION PERSONAL DEL EMPLEADO</h1>
    
                        <h2>Documento</h2>
    
                    <div class="">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="nombre">cedula</label>
                        <input type="text" id="numero_identificacion" name="numero_identificacion"  class="bg- border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    <div class="mt-8">
                        <label for="ciudad_expedicion" class="block mb-2 text-sm font-medium text-gray-100">Ciudad de Expedicion</label>
                        <input type="text" id="ciudad_expedicion" name="ciudad_expedicion" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    <div class="mt-8">
                        <label for="fecha_expedicion" class="block mb-2 text-sm font-medium text-gray-100">fecha_expedicion</label>
                        <input type="date" id="fecha_expedicion" name="fecha_expedicion" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                        <h2>Personal</h2>
    
                    <div class="">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    <div class="">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    <div class="">
                        <label for="fecha_nacimieno" >Fecha de nacimiento</label>
                        <input type="date" id="trabajador-fecha_nacimiento" data-relacion="trabajador" name="fecha_nacimiento"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
                    </div>
    
                    <div class="">
                        <label  for="edad">Edad</label>
                        <input type="number" id="trabajador-edad" name="edad"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" readonly>
                    </div>
    
                    <div class="">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="estado_civil">Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                            @foreach (App\Enums\estado_civil::cases() as $estado_civil)
                                <option value="{{ $estado_civil->value }}">{{ $estado_civil->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="sexo">Sexo</label>
                        <select id="sexo" name="sexo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                            @foreach (App\Enums\sexo::cases() as $sexo)
                                <option value="{{ $sexo->value }}">{{ $sexo->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    
                    <div class="form-group">
                        <label for="lugar_nacimiento" class="block mb-2 text-sm font-medium text-gray-100">Lugar de Nacimiento</label>
                        <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                        <h2>contacto</h2>
    
    
                    <div class="">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="telefono_fijo">Teléfono Fijo</label>
                        <input type="text" id="telefono_fijo" name="telefono_fijo"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    
                    <div class="form-group">
                        <label for="celular" class="block mb-2 text-sm font-medium text-gray-100">celular</label>
                        <input type="text" id="celular" name="celular" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div>
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="correo">Correo</label>
                        <input type="email" id="correo" name="correo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    <h2>informacion del cargo</h2>
    
                    
                    <div class="">
                        <label class="block text-gray-100 text-sm font-bold mb-2" for="cargo">Cargo</label>
                        <input type="text" id="cargo" name="cargo"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    <div class="form-group">
                        <label for="fecha_ingreso" class="block mb-2 text-sm font-medium text-gray-100">Fecha de ingreaso</label>
                        <input type="date" id="fecha_ingreso" name="fecha_ingreso"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    <div class="form-group">
                        <label for="tipo_pago" class="block mb-2 text-sm font-medium text-gray-100">Tipo de Pago</label>
                        <select name="tipo_pago" id="tipo_pago" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                            @foreach (App\Enums\TipoPago::cases() as $tipoPago)
                                <option value="{{ $tipoPago->value }}">
                                    {{ $tipoPago->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="departamentos" class="block mb-2 text-sm font-medium text-gray-100">Departamento / Area / Centro De Trabajo </label>
                        <select name="departamentos" id="departamentos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                            @foreach (App\Enums\Departamento::cases() as $departamento)
                                <option value="{{ $departamento->value }}">
                                    {{ $departamento->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="contrato" class="block mb-2 text-sm font-medium text-gray-100">Contrato</label>
                        <input type="text" id="contrato" name="contrato" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <h2>Direccion Del Empleado</h2>
    
                    <div class="form-group">
                            <label for="direccion" class="block mb-2 text-sm font-medium text-gray-100">Direccion</label>
                            <input type="text" id="direccion" name="direccion"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                    </div>
    
                    <div class="form-group">
                        <label for="ciudad" class="block mb-2 text-sm font-medium text-gray-100">Cuidad</label>
                        <input type="text" id="ciudad" name="ciudad"  required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <h1>INFORMACION MEDICA</h1>
                    
                    <div class="form-group">
                        <label for="ARL" class="block mb-2 text-sm font-medium text-gray-100">ARL</label>
                        <input type="text" id="ARL" name="ARL"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div class="form-group">
                        <label for="Eps" class="block mb-2 text-sm font-medium text-gray-100">EPS</label>
                        <input type="text" id="Eps" name="Eps" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div class="form-group">
                        <label for="tipo_sangre" class="block mb-2 text-sm font-medium text-gray-100">Tipo Sangre</label>
                        <input type="text" id="tipo_sangre" required name="tipo_sangre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div class="form-group">
                        <label for="alergias" class="block mb-2 text-sm font-medium text-gray-100">Alergias</label>
                        <input type="text" id="alergias" name="alergias" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <h1>INFORMACION DE PERSONA DE CONTACTO</h1>
    
                    <div class="form-group">
                        <label for="nombre_persona_contacto" class="block mb-2 text-sm font-medium text-gray-100 capitalize">nombre de la persona de contacto</label>
                        <input type="text" id="nombre_persona_contacto"  required name="nombre_persona_contacto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div class="form-group">
                        <label for="parentesco_con_persona_contacto" class="block mb-2 text-sm font-medium text-gray-100 capitalize">parentesco de la persona de contacto</label>
                        <input type="text" id="parentesco_con_persona_contacto" name="parentesco_con_persona_contacto" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div class="form-group">
                        <label for="telefono_celular_persona_contacto" class="block mb-2 text-sm font-medium text-gray-100 capitalize">telefono o celular</label>
                        <input type="text" id="telefono_celular_persona_contacto" required name="telefono_celular_persona_contacto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <h1>INFORMACION BANCARIA DEL EMPLEADO</h1>
    
                    <div class="form-group">
                        <label for="cuenta_bancaria" class="block mb-2 text-sm font-medium text-gray-100 capitalize">cuenta bancaria</label>
                        <input type="text" id="cuenta_bancaria" name="cuenta_bancaria" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div class="form-group">
                        <label for="caja" class="block mb-2 text-sm font-medium text-gray-100 capitalize">caja</label>
                        <input type="text" id="caja" name="caja" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div class="form-group">
                        <label for="fondo_cesantias" class="block mb-2 text-sm font-medium text-gray-100 capitalize">fondo de cesantias</label>
                        <input type="text" id="fondo_cesantias" name="fondo_cesantias" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    <div class="form-group">
                        <label for="fondo_pencion" class="block mb-2 text-sm font-medium text-gray-100 capitalize">fondo_pencion</label>
                        <input type="text" id="fondo_pencion" name="fondo_pencion"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
    
                    <h1 class="mb-4">INFORMACION FAMILIAR DEL EMPLEADO</h1>
    
                    <h2>Informacion de Conyugue</h2>
    
                        <div class="form-group">
                            <label for="nombre_conyuge" class="block mb-2 text-sm font-medium text-gray-100 capitalize">nombre de conyugue</label>
                            <input type="text" id="nombre_conyuge" name="nombre_conyuge"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        </div>
    
                        <div class="form-group">
                            <label for="fecha_nacimiento_conyuge" class="block mb-2 text-sm font-medium text-gray-100 capitalize">fecha de nacimiento del conyugue</label>
                            <input type="date" id="fecha_nacimiento_conyuge" name="fecha_nacimiento_conyuge"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        </div>
    
                        <div class="form-group">
                            <label for="numero_documento_conyuge" class="block mb-2 text-sm font-medium text-gray-100 capitalize">numero de documento del conyugue</label>
                            <input type="text" id="numero_documento_conyuge" name="numero_documento_conyuge"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        </div>
    
                        <div class="form-group">
                            <label for="fecha_expedicion_conyuge" class="block mb-2 text-sm font-medium text-gray-100 capitalize">fecha de expedicion</label>
                            <input type="date" id="fecha_expedicion_conyuge" name="fecha_expedicion_conyuge" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        </div>
    
                        <div class="form-group">
                            <label for="lugar_expedicion_conyuge" class="block mb-2 text-sm font-medium text-gray-100 capitalize">lugar expedicion conyuge</label>
                            <input type="text" id="lugar_expedicion_conyuge" name="lugar_expedicion_conyuge" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        </div>
    
                    <div class="form-group">
                        <label for="hijos_count" class="block mb-2 text-sm font-medium text-gray-100 capitalize">numero de hijos del empleado</label>
                        <input type="number" id="numero_hijos" name="hijos_count" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    </div>
    
                    
    
                    <div id="hijos-container">
                        <h2 class="mb-5">Informacion De los Hijos</h2>
                        
                    </div>
                        <h1>ESTADO DEL EMPLEADO</h1>
    
                        <div class="form-group">
                            <label for="estado" class="block mb-2 text-sm font-medium text-gray-100 capitalize">Estado</label>
                            <select name="estado" id="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                                <option value="activo">activo</option>
                                <option value="inactivo">inactivo</option>
                            </select>
                        </div>
                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                        <a href="{{ route('trabajadores.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2.5 px-4 rounded">Cancelar</a>
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
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        h1 {
            text-transform: uppercase;
            color: #ffffff;
            margin-bottom: 20px;
        }

        h2 {
            text-transform: capitalize;
            color: #ffffff;
            margin-top: 20px;
        }

        form {
            width: 900px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px;
            gap: 20px;
        }

        label {
            font-size: 15px;
            text-align: start;
            display: block;
        }

        input {
            width: 500px;
            height: 50px;
            background-color: #363d44 !important; /* Para modo claro */
            border-width: 1px;
            color: #fff !important;
            font-size: 0.875rem; /* 14px */
            border-radius: 0.5rem; /* 8px */
            display: block;
            padding: 0.625rem;
        }

        input:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
            box-shadow: 0 0 0 2px #3B82F6;
            border-color: #3B82F6;
        }

        input::placeholder {
            color: #ffffff;
        }

        select {
            width: 500px;
            height: 50px;
            background: #4f6185;
            padding: 0.625rem;
            margin: 8px 0;
            border: #ffffff 0.5px solid;
            border-radius: 5px;
            font-size: 0.875rem ;
            line-height: 1.25rem ;
            text-transform: uppercase;
        }

    </style>
@stop

@section('js')
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
<script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hijosContainer = document.getElementById('hijos-container');
            const numeroHijosInput = document.getElementById('numero_hijos');
    
            numeroHijosInput.addEventListener('input', function () {
                const numeroHijos = parseInt(numeroHijosInput.value);
    
                // Limpiar contenedor actual
                hijosContainer.innerHTML = '';
    
                // Agregar campos de hijo según el número ingresado
                for (let i = 1; i <= numeroHijos; i++) {
                    hijosContainer.innerHTML += `
                        <div class="mb-5 border-b border-gray-300 py-5">
                            <h2 class="mb-5">Información del Hijo ${i}</h2>
    
                            <div class="form-group mb-5">
                                <label for="hijos[${i}][nombre]" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Nombre del Hijo</label>
                                <input type="text" id="hijos[${i}][nombre]" name="hijos[${i}][nombre]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                            </div>
    
                            <div class="form-group mb-5">
                                <label for="hijos[${i}][fecha_nacimiento]" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Fecha de Nacimiento del Hijo</label>
                                <input type="date" id="hijos[${i}][fecha_nacimiento]" name="hijos[${i}][fecha_nacimiento]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                            </div>
    
                            <div class="form-group mb-5">
                                <label for="hijos[${i}][edad]" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Edad del Hijo</label>
                                <input type="number" id="hijos[${i}][edad]" name="hijos[${i}][edad]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required readonly>
                            </div>
    
                            <div class="form-group mb-5">
                                <label for="hijos[${i}][tipo_documento]" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Tipo de Documento del Hijo</label>
                                <select name="hijos[${i}][tipo_documento]" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    @foreach (App\Enums\TipoDocumentoHijo::cases() as $TipoDocumento)
                                        <option value="{{ $TipoDocumento->value }}">{{ $TipoDocumento->name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group mb-5">
                                <label for="hijos[${i}][numero_documento]" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Número de Documento del Hijo</label>
                                <input type="text" id="hijos[${i}][numero_documento]" name="hijos[${i}][numero_documento]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
                            </div>
                        </div>
                    `;
                }
    
                // Agregar el evento para calcular la edad en cada campo de fecha
                document.querySelectorAll('input[type="date"]').forEach(input => {
                    input.addEventListener('input', function () {
                        calculateAge(this);
                    });
                });
            });
    
            // Función para calcular la edad
            function calculateAge(input) {
                const fechaNacimiento = new Date(input.value);
                const hoy = new Date();
                let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                const mes = hoy.getMonth() - fechaNacimiento.getMonth();
    
                if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                    edad--;
                }
    
                const index = input.id.match(/\d+/)[0];
                const edadInput = document.querySelector(`input[name="hijos[${index}][edad]"]`);
    
                if (edadInput) {
                    edadInput.value = edad >= 0 ? edad : 0;
                }
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Aplica la función de cálculo de edad a los campos de fecha existentes
            document.querySelectorAll('input[type="date"]').forEach(input => {
                input.addEventListener('input', function() {
                    calculateAge(this);
                });
            });

            function calculateAge(input) {
                const fechaNacimiento = new Date(input.value);
                const hoy = new Date();
                let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                const mes = hoy.getMonth() - fechaNacimiento.getMonth();

                // Ajuste si el mes o día de nacimiento aún no ha ocurrido este año
                if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                    edad--;
                }

                // Identifica el campo de edad correspondiente
                const idRelacion = input.getAttribute('data-relacion');
                const edadInput = document.getElementById(`${idRelacion}-edad`);

                if (edadInput) {
                    edadInput.value = edad >= 0 ? edad : 0; // Evita edades negativas
                }
            }
        });
    </script>
@stop