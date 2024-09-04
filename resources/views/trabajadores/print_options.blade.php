@extends('adminlte::page')

@section('title', 'Opciones de Impresión')

@section('content')
<div class="container">
    <h2>Seleccione las opciones de impresión</h2>
    <form action="{{ route('generate.print.list') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Seleccione los campos a imprimir:</label>
            <div>
                <input type="checkbox" name="campos[]" value="nombre"> Nombre
                <input type="checkbox" name="campos[]" value="cargo"> Cargo
                <input type="checkbox" name="campos[]" value="telefono"> Teléfono
                <!-- Añade más campos según sea necesario -->
            </div>
        </div>
        <div class="form-group">
            <label>Seleccione los trabajadores:</label>
            <div>
                <input type="radio" name="seleccion_trabajadores" value="todos" checked> Todos los trabajadores
                <input type="radio" name="seleccion_trabajadores" value="seleccionar"> Seleccionar trabajadores
            </div>
        </div>
        <div id="lista_trabajadores" style="display: none;">
            @foreach($trabajadores as $trabajador)
                <div>
                    <input type="checkbox" name="trabajadores_seleccionados[]" value="{{ $trabajador->id }}">
                    {{ $trabajador->nombre }} {{ $trabajador->apellido }}
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Generar Lista para Imprimir</button>
    </form>
</div>

@stop

@section('js')
<script>
    document.querySelectorAll('input[name="seleccion_trabajadores"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.getElementById('lista_trabajadores').style.display = 
                this.value === 'seleccionar' ? 'block' : 'none';
        });
    });
</script>
@stop
