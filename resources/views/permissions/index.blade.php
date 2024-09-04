@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
    <h1 class="mb-3">Permisos</h1>
    <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create Permission</a>
@stop

@section('content')
    <div class="p-12">
        <container>
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    <div class="tables">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('permissions.destroy', $permission) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este permiso?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </container>
    </div>
@stop

@section('css')
<style>
    .tables {
        max-height: 500px;
        overflow-y: auto;
    }
    table {
        height: 500px;
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
@stop