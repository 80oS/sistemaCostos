@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-300 leading-tight">
    {{ __('ASIGNAR PERMISOS A ROL') }}
</h2>
@stop

@section('content')
    <div class="p-12">
        <div class="container">
            <div class="card max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="card-header">
                    <p>Asignar permisos a rol: {{ $role->name }}</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="max-w-sm mx-auto space-y-4">
                        @csrf
                        @method('PUT')
                        <select name="permissions[]" class="form-select" id="multiple-select-field" data-placeholder="seleccione los permisos..." multiple>
                            @foreach ($permisos as $permiso)
                                <option value="{{ $permiso->id }}" {{ in_array($permiso->id, $rolePermisos) ? 'selected':''}}>
                                    {{ $permiso->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Guardar</button>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        .card {
            width: 50rem;
            height: 300px;
        }
        
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $( '#multiple-select-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
    </script>
@stop
