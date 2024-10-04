@extends('adminlte::page')

@section('title', 'Bonos')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Bonos') }}
    </h2>
@stop

@section('content')
{{-- <div class="container px-20">
    <a href="{{ route('nomina.show', ) }}" class="bg-yellow-700 hover:bg-yellow-400 px-3 py-2 text-white rounded">volver</a>
</div> --}}
<div class="py-12">
    <div class="container">
        @if (session('success'))
            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="flex flex-col items-end justify-end col-12 mb-4">
            <a href="{{ route('listar.operarios') }}" class="btn btn-primary">volver</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="col-12 mb-4">
                    <a href="{{ route('horas-extras.create') }}" class="btn btn-info">crear bono</a>
                </div>
                <div class="overflow-y-auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>codigo</th>
                                <th>operarios</th>
                                <th>valor del bono</th>
                                <th>hora extras diurna</th>
                                <th>hora extras nocturna</th>
                                <th>hora extra festivos / dominical</th>
                                <th>hora extra recargo nocturna</th>
                                <th>editar</th>
                                <th>eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($horas_extras as $index => $horas)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $horas->operarios->codigo }}</td>
                                    <td>{{ $horas->operarios->operario }}</td>
                                    <td>{{ number_format($horas->valor_bono, 2, ',', '.') }}</td>
                                    <td>{{ number_format($horas->horas_diurnas, 2, ',', '.') }}</td>
                                    <td>{{ number_format($horas->horas_nocturnas, 2, ',', '.') }}</td>
                                    <td>{{ number_format($horas->horas_festivos, 2, ',', '.') }}</td>
                                    <td>{{ number_format($horas->horas_recargo_nocturno, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('horas-extras.edit', $horas->id) }}" class="btn btn-warning">Editar</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('horas-extras.destroy', $horas->id ) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" >eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .content, .content-header{
            background: #fff !important;
        }

        .content {
            height: 87vh;
        }

        h2 {
            font-size: 18px;
            text-transform: uppercase;
        }

        table thead tr th, tbody tbody tr td {
            background: #9c9a9a !important;
            color: #000 !important;
            border: #bdbbbb 1px solid;
        }

        th {
            text-transform: uppercase;
        }
        
        .card, .card-body {
            background: #9f9f9f !important;
        }
    </style>
@stop

@section('js')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 5000);
</script>
@stop