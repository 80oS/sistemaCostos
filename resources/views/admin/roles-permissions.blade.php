@extends('adminlte::page')

@section('title', 'Roles y Permisos')

@section('content_header')
    <h1>Gestión de Roles y Permisos</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills flex-column">
                    @foreach($roles as $role)
                        <li class="nav-item">
                            <a class="nav-link @if($loop->first) active @endif" href="#role-{{ $role->id }}" data-toggle="tab">
                                {{ $role->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permisos</h3>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    @foreach($roles as $role)
                        <div class="tab-pane @if($loop->first) active @endif" id="role-{{ $role->id }}">
                            <form action="{{ route('admin.roles.permissions.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                @include('admin.partials.permissions-checkbox', ['permissions' => $permissions, 'role' => $role])
                                <button type="submit" class="btn btn-primary mt-3">Guardar Permisos</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('.permission-checkbox').on('change', function() {
            var isChecked = $(this).prop('checked');
            $(this).closest('li').find('input[type="checkbox"]').prop('checked', isChecked);
        });
    });
</script>
@stop