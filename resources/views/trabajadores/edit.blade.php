@extends('adminlte::page')

@section('title', 'Editar Empleado')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Editar empleado') }} - {{ $trabajador->nombre }} - {{ $trabajador->apellido }}
    </h2>
@stop

@section('content')
<div class="py-20">
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('trabajadores.update', $trabajador->id) }}" method="POST" >
                    @csrf
                    @method('PUT')
    
                    <h1>INFORMACION PERSONAL DEL EMPLEADO</h1>
                    <h2>Documento</h2>
                        <div class="form-1">
                            <label  for="nombre">cedula</label>
                            <input type="text" id="numero_identificacion" name="numero_identificacion" value="{{ $trabajador->numero_identificacion }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
                            
                            <label for="ciudad_expedicion" >Ciudad de Expedicion</label>
                            <input type="text" id="ciudad_expedicion" name="ciudad_expedicion" value="{{ $trabajador->ciudad_expedicion }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
                        
                            <label for="fecha_expedicion" >fecha_expedicion</label>
                            <input type="date" id="fecha_expedicion" name="fecha_expedicion" value="{{ $trabajador->fecha_expedicion }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
                        </div>
                        <hr>
                        <h2>Personal</h2>
                        <div class="form-2">
                            
    
                            <label  for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ $trabajador->nombre }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
                        
                            <label  for="apellido">Apellido</label>
                            <input type="text" id="apellido" name="apellido" value="{{ $trabajador->apellido }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
                            
                            <label for="fecha_nacimieno" >Fecha de nacimiento</label>
                            <input type="date" id="trabajador-fecha_nacimiento" data-relacion="trabajador" name="fecha_nacimiento" value="{{ $trabajador->fecha_nacimiento }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
                        
                            <label  for="edad">Edad</label>
                            <input type="number" id="trabajador-edad" name="edad" value="{{ $trabajador->edad }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" readonly>
                        
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="estado_civil">Estado Civil</label>
                            <select id="estado_civil" name="estado_civil" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                                @foreach (App\Enums\estado_civil::cases() as $estado_civil)
                                    <option 
                                        value="{{ $estado_civil->value }}" 
                                        {{ $trabajador->estado_civil === $estado_civil ? 'selected' : '' }}
                                    >
                                        {{ $estado_civil->name }}
                                    </option>
                                @endforeach
                            </select>
                        
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="sexo">Sexo</label>
                            <select id="sexo" name="sexo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                                @foreach (App\Enums\sexo::cases() as $sexo)
                                    <option 
                                        value="{{ $sexo->value }}" 
                                        {{ $trabajador->sexo === $sexo ? 'selected' : '' }}
                                    >
                                        {{ $sexo->name }}
                                    </option>
                                @endforeach
                            </select>
                        
                            <label for="lugar_nacimiento" >Lugar de Nacimiento</label>
                            <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" value="{{ $trabajador->lugar_nacimiento }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  >
                        </div>
                        <hr>
                        <h2>contacto</h2>
                        <div class="form-3">
                            
    
                            <label  for="telefono_fijo">Teléfono Fijo</label>
                            <input type="text" id="telefono_fijo" name="telefono_fijo" value="{{ $trabajador->telefono_fijo }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
                        
                            <label for="celular" >celular</label>
                            <input type="text" id="celular" name="celular" value="{{ $trabajador->celular }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
                        
                            <label  for="correo">Correo</label>
                            <input type="email" id="correo" name="correo" value="{{ $trabajador->correo }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
                        </div>
                        <hr>
    
                        <h2>informacion del cargo</h2>
                    <div class="form-4">
                        
    
                        <label  for="cargo">Cargo</label>
                        <input type="text" id="cargo" name="cargo" value="{{ $trabajador->cargo }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
    
                        <label for="fecha_ingreso" >Fecha de ingreaso</label>
                        <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="{{ $trabajador->fecha_ingreso }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5"  required>
                    
                        <label for="tipo_pago" >Tipo de Pago</label>
                        <select name="tipo_pago" id="tipo_pago"  required>
                            @foreach (App\Enums\TipoPago::cases() as $tipoPago)
                                <option 
                                    value="{{ $tipoPago->value }}" 
                                    {{ $trabajador->tipo_pago === $tipoPago ? 'selected' : '' }}
                                >
                                    {{ $tipoPago->name }}
                                </option>
                            @endforeach
                        </select>
                    
                        <label for="departamentos">Departamento / Area / Centro De Trabajo</label>
                        <select name="departamentos" id="departamentos" required>
                            @foreach (App\Enums\Departamento::cases() as $departamento)
                                <option 
                                    value="{{ $departamento->value }}" 
                                    {{ $trabajador->departamentos === $departamento ? 'selected' : '' }}
                                >
                                    {{ $departamento->name }}
                                </option>
                            @endforeach
                        </select>
                    
                        <label for="contrato" >Contrato</label>
                        <input type="text" id="contrato" name="contrato" value="{{ $trabajador->contrato }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
                    </div>
                    <hr>
                    <h2>Direccion Del Empleado</h2>
                    <div class="form-5">
                        
    
                        <label for="direccion" >Direccion</label>
                        <input type="text" id="direccion" name="direccion" value="{{ $trabajador->direccion }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required>
    
                        <label for="ciudad" >Cuidad</label>
                        <input type="text" id="ciudad" name="ciudad" value="{{ $trabajador->ciudad }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
                    </div>
                    <hr>
                    <h1>INFORMACION MEDICA</h1>
                    <div class="form-6">
                        
                        <label for="ARL" >ARL</label>
                        <input type="text" id="ARL" name="ARL" value="{{ $trabajador->ARL }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" >
                    
    
    
                        <label for="Eps" >EPS</label>
                        <input type="text" id="Eps" name="Eps" value="{{ $trabajador->Eps }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
                    
    
    
                        <label for="tipo_sangre" >Tipo Sangre</label>
                        <input type="text" id="tipo_sangre" value="{{ $trabajador->tipo_sangre }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required name="tipo_sangre" >
                    
    
    
                        <label for="alergias" >Alergias</label>
                        <input type="text" id="alergias" name="alergias" value="{{ $trabajador->alergias }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
                    
                    </div>
                    <hr>
                    <h1>INFORMACION DE PERSONA DE CONTACTO</h1>
                    <div class="form-7">
                        
    
    
                        <label for="nombre_persona_contacto" class=" capitalize">nombre de la persona de contacto</label>
                        <input type="text" id="nombre_persona_contacto" value="{{ $trabajador->nombre_persona_contacto }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required name="nombre_persona_contacto" >
                    
    
    
                        <label for="parentesco_con_persona_contacto" class=" capitalize">parentesco de la persona de contacto</label>
                        <input type="text" id="parentesco_con_persona_contacto" value="{{ $trabajador->parentesco_con_persona_contacto }}" name="parentesco_con_persona_contacto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
                    
    
    
                        <label for="telefono_celular_persona_contacto" class=" capitalize">telefono o celular</label>
                        <input type="text" id="telefono_celular_persona_contacto" value="{{ $trabajador->telefono_celular_persona_contacto }}" required name="telefono_celular_persona_contacto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" >
                    
                    </div>
                    <hr>
                    <h1>INFORMACION BANCARIA DEL EMPLEADO</h1>
                    <div class="form-8">
                        
    
                        <label for="caja" class=" capitalize">caja</label>
                        <input type="text" id="caja" name="caja" value="{{ $trabajador->caja }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
    
    
                        <label for="cuenta_bancaria" class=" capitalize">cuenta bancaria</label>
                        <input type="text" id="cuenta_bancaria" name="cuenta_bancaria" value="{{ $trabajador->cuenta_bancaria }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" required >
    
                        <label for="fondo_cesantias" class=" capitalize">fondo de cesantias</label>
                        <input type="text" id="fondo_cesantias" value="{{ $trabajador->fondo_cesantias }}" name="fondo_cesantias" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    
    
                        <label for="fondo_pencion" class=" capitalize">fondo_pencion</label>
                        <input type="text" id="fondo_pencion" name="fondo_pencion" value="{{ $trabajador->fondo_pencion }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                    
                    </div>
                    <hr>
                    <h2>Informacion del Conyugue</h2>
                    <div class="form-9">
                        
    
                            <label for="nombre_conyuge" class=" capitalize">nombre de conyugue</label>
                            <input type="text" id="nombre_conyuge" name="nombre_conyuge" value="{{ $trabajador->nombre_conyuge }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        
                            <label for="fecha_nacimiento_conyuge" class=" capitalize">fecha de nacimiento del conyugue</label>
                            <input type="date" id="fecha_nacimiento_conyuge" name="fecha_nacimiento_conyuge" value="{{ $trabajador->fecha_nacimiento_conyuge }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        
                            <label for="numero_documento_conyuge" class=" capitalize">numero de documento del conyugue</label>
                            <input type="text" id="numero_documento_conyuge" name="numero_documento_conyuge" value="{{ $trabajador->numero_documento_conyuge }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        
                            <label for="fecha_expedicion_conyuge" class=" capitalize">fecha de expedicion</label>
                            <input type="date" id="fecha_expedicion_conyuge" name="fecha_expedicion_conyuge" value="{{ $trabajador->fecha_expedicion_conyuge }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        
                            <label for="lugar_expedicion_conyuge" class=" capitalize">lugar expedicion conyuge</label>
                            <input type="text" id="lugar_expedicion_conyuge" name="lugar_expedicion_conyuge" value="{{ $trabajador->lugar_expedicion_conyuge }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        
                            <label for="hijos_count" class=" capitalize">numero de hijos del empleado</label>
                            <input type="number" id="numero_hijos" name="hijos_count" value="{{ $trabajador->hijos_count }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5">
                        
                    </div>
    
                    @foreach ($trabajador->hijos as $index => $hijo)
                        <div class="hijo mb-4" data-index="{{ $index }}">
                            <input type="hidden" name="hijos[{{ $index }}][id]" value="{{ $hijo->id }}">
                        
                            <label for="hijos[{{ $index }}][nombre]" class="block mb-4 text-sm font-medium text-gray-900 capitalize">
                                Nombre del Hijo {{ $index + 1 }}
                            </label>
                            <input type="text" name="hijos[{{ $index }}][nombre]" value="{{ $hijo->nombre }}" placeholder="Nombre del Hijo" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        
                            <label for="hijos[{{ $index }}][fecha_nacimiento]" class="capitalize">Fecha de Nacimiento del Hijo</label>
                            <input type="date" name="hijos[{{ $index }}][fecha_nacimiento]" value="{{ $hijo->fecha_nacimiento }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" oninput="calculateAge(this)">
                        
                            <label for="hijos[{{ $index }}][edad]" class="capitalize">Edad del Hijo</label>
                            <input type="number" name="hijos[{{ $index }}][edad]" value="{{ $hijo->edad }}" placeholder="Edad" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" readonly>
                        
                            <label for="hijos[{{ $index }}][tipo_documento]" class="capitalize">
                                Tipo de Documento del Hijo {{ $index + 1 }}
                            </label>
                            <select name="hijos[{{ $index }}][tipo_documento]" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                @foreach (App\Enums\TipoDocumentoHijo::cases() as $tipoDocumento)
                                    <option 
                                        value="{{ $tipoDocumento->value }}" 
                                        {{ $hijo->tipo_documento === $tipoDocumento->value ? 'selected' : '' }}
                                    >
                                        {{ $tipoDocumento->name }}
                                    </option>
                                @endforeach
                            </select>
                        
                            <label for="hijos[{{ $index }}][numero_documento]" class="capitalize">
                                Número de Documento del Hijo {{ $index + 1 }}
                            </label>
                            <input type="text" name="hijos[{{ $index }}][numero_documento]" value="{{ $hijo->numero_documento }}" placeholder="Número de Documento" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        </div>
                        <hr>
                    @endforeach

                        <button id="add-hijo-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Hijo</button>
    
                    <div id="hijos-container">
                        
                    </div>
                    <hr>
                    <h1>ESTADO DEL EMPLEADO</h1>
                        <div class="form-10">
                            <label for="estado" class=" capitalize">Estado</label>
                            <select name="estado" id="estado" value="{{ $trabajador->estado }}" required >
                            @foreach(['activo','inactivo'] as $estado)    
                                <option value="{{ $estado }}" 
                                    {{ $trabajador->estado === $estado ? 'selected' : '' }}
                                >
                                    {{ ucfirst($estado) }}
                                </option>
                            @endforeach
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/4.0.0-alpha.1/chunk-GNCUPSHB.mjs">
    <style>

        h1 {
            text-transform: uppercase;
            color: #ffffff;
            margin-bottom: 20px;
            font-size: 20px;
        }

        h2 {
            text-transform: capitalize;
            color: #ffffff;
            margin-top: 20px;
            font-size: 20px;
        }

        .container {
            background: #202941;
            max-width: 500rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            padding: 20px;
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
            color: #fff !important;
        }

        input {
            width: 500px;
            height: 50px;
            background-color: #303a44 !important; /* Para modo claro */
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

        hr {
            width: 700px;
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

        /* .form-1 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-2 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-3 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-4 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-5 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-6 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-7{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-8 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-9 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        }
        .form-10 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: start;
        } */

    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hijosContainer = document.getElementById('hijos-container');
            const addHijoButton = document.getElementById('add-hijo-button');
            
            let hijoIndex = document.querySelectorAll('.hijo').length;

            addHijoButton.addEventListener('click', function() {
                addHijoFields(hijoIndex);
                hijoIndex++;
                updateHijoIndices();
            });

            function addHijoFields(index) {
                const hijoDiv = document.createElement('div');
                hijoDiv.className = 'hijo mb-4';
                hijoDiv.dataset.index = index;
                hijoDiv.innerHTML = `
                    <h3>Hijo ${index + 1}</h3>
                    <label for="hijos[${index}][nombre]" class="capitalize">Nombre del Hijo</label>
                    <input type="text" name="hijos[${index}][nombre]" placeholder="Nombre del Hijo" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
            
                    <label for="hijos[${index}][fecha_nacimiento]" class="capitalize">Fecha de Nacimiento del Hijo</label>
                    <input type="date" name="hijos[${index}][fecha_nacimiento]" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" oninput="calculateAge(this)">
            
                    <label for="hijos[${index}][edad]" class="capitalize">Edad del Hijo</label>
                    <input type="number" name="hijos[${index}][edad]" placeholder="Edad" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" readonly>
            
                    <label for="hijos[${index}][tipo_documento]" class="capitalize">Tipo de Documento del Hijo</label>
                    <select name="hijos[${index}][tipo_documento]" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        @foreach (App\Enums\TipoDocumentoHijo::cases() as $TipoDocumento)
                            <option value="{{ $TipoDocumento->value }}">{{ $TipoDocumento->name }}</option>
                        @endforeach
                    </select>
            
                    <label for="hijos[${index}][numero_documento]" class="capitalize">Número de Documento del Hijo</label>
                    <input type="text" name="hijos[${index}][numero_documento]" placeholder="Número de Documento" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
            
                    <button type="button" class="remove-hijo bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded">Eliminar Hijo</button>
                `;
                hijosContainer.appendChild(hijoDiv);
                
                hijoDiv.querySelector('.remove-hijo').addEventListener('click', function() {
                    if (confirm('¿Está seguro de que desea eliminar este hijo?')) {
                        hijosContainer.removeChild(hijoDiv);
                        hijoIndex--;
                        updateHijoIndices();
                    }
                });

                hijoDiv.querySelector('input[type="date"]').addEventListener('input', function() {
                    calculateAge(this);
                });
            }

            function updateHijoIndices() {
                document.querySelectorAll('.hijo').forEach((hijo, index) => {
                    hijo.querySelector('h3').textContent = `Hijo ${index + 1}`;
                    hijo.querySelectorAll('input, select').forEach(input => {
                        input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
                        input.id = input.id ? input.id.replace(/\[\d+\]/, `[${index}]`) : '';
                    });
                    hijo.dataset.index = index;
                });
            }

            function calculateAge(input) {
                const fechaNacimiento = new Date(input.value);
                const hoy = new Date();
                let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                const mes = hoy.getMonth() - fechaNacimiento.getMonth();

                if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                    edad--;
                }

                const index = input.closest('.hijo').getAttribute('data-index');
                const edadInput = document.querySelector(`input[name="hijos[${index}][edad]"]`);
                
                if (edadInput) {
                    edadInput.value = edad >= 0 ? edad : 0;
                }
            }

            // Aplicar la función calculateAge a los campos de fecha existentes en la carga inicial
            document.querySelectorAll('.hijo input[type="date"]').forEach(input => {
                input.addEventListener('input', function() {
                    calculateAge(this);
                });
            });
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