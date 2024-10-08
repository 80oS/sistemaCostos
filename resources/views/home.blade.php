@extends('adminlte::page')

@section('title', 'home')

@section('content_header')
@stop
@section('content')
@if (session('success'))
    <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@stop

@section('css')

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