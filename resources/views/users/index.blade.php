@extends('adminlte::page')

@section('title', 'users')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Lista de usuarios') }}
</h2>

@stop

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="mb-4">
                <a href="{{route('register')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear nuevo usuario</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50 text-gray-700">
                            <th class="px-4 py-2 border">id</th>
                            <th class="px-4 py-2 border">nombre</th>
                            <th class="px-4 py-2 border">correo</th>
                            <th class="px-4 py-2 border">actualizar y eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="bg-gray-50 text-gray-700">
                            <td class="px-4 py-2 border">{{$user->id}}</td>
                            <td class="px-4 py-2 border">{{$user->name}}</td>
                            <td class="px-4 py-2 border">{{$user->email}}</td>
                            <td class="px-4 py-2 border flex items-center justify-center">
                                <a href="{{route('profile.show')}}" class="btn font-bold py-1 px-3 rounded">eliminar y actualizar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 p">
        <a href="{{route('home')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded">volver</a>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .btn {
            background: linear-gradient(45deg, #FF0202, #2DD400);
            transition: all 1s;
        }
        .btn:hover {
            background: linear-gradient(45deg, #D82A2A, #124F01);
        }
        .btn:active {
            transform: scale(-2);
        }
        .p {
            padding: 20px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop