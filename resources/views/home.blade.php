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

<div class="container">
    <div class="card">
        <div class="card-body">
            <img src="https://www.acofi.edu.co/eiei2018/wp-content/uploads/2018/01/IDIMCOL.jpg" alt="IDIMCOL">
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .content {
        padding: 10px !important;
        text-align: center !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 90vh;
    }

    .card, .card-body {
        width: 400px !important;
        height: 400px !important;
        border-radius: 100% !important;
        box-shadow: 1px 10px 1px #000  !important;
        border: #979595 1px solid;
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