@extends('adminlte::page')

@section('title', 'Paquetes de SDP')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
    {{ __('Paquetes de SDP') }}
</h2>
@stop

@section('content')
<div class=" flex items-end justify-end mb-4 px-20">
    <a href="{{ route('ADD_C_S') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">volver</a>
</div>
@if (session('success'))
<div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="mb-4">
                <a href="{{ route('sdp.create') }}" class="bg-blue-700 hover:bg-blue-800 px-3 py-2 mb-4 rounded">crear sdp</a>
            </div>
            <table class="table" id="sdp">
                <thead>
                    <tr>
                        <th>clientes</th>
                        <th>nit</th>
                        <th>cantidad se SDPs</th>
                        <th>sdps</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->nit }}</td>
                        <td>{{ $cliente->sdp->count() }}</td>
                        <td>
                            <a href="{{ route('sdp.lista', $cliente->nit) }}" class="bg-blue-700 hover:bg-blue-800 px-3 py-2  rounded">
                                lista de sdps
                            </a>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.tailwindcss.css">
@stop

@section('js')
{{-- Add here extra scripts --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    </script>
    <script>
        new DataTable('#sdp', {
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: '50vh',
        });
    </script>
@stop








