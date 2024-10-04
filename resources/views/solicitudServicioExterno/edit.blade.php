@extends('adminlte::page')

@section('title', 'Editar SSE')

@section('content_header')
    
@stop

@section('content')
<h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
    {{ __('editar  SSE') }}

</h2>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop