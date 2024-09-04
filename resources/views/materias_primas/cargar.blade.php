@extends('adminlte::page')

@section('title', 'cargar materia prima')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-400 leading-tight">
    {{ __('Cargar materias primas') }}
</h2>
@stop

@section('content')
    <div class="p-12">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="" class="form space-y-4">
                        <div class="">
                            <label for="">sdp</label>
                            <select name="" id="">
                                @foreach($sdps as $sdp)
                                <option value="{{$sdp->numero_sdp}}">{{$sdp->numero_sdp}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="">codigo/materia</label>
                            <input type="text">
                        </div>
                        <div class="">
                            <label for="">descripcion</label>
                            <input type="text">
                        </div>
                        <div class="">
                            <label for="">cantidad</label>
                            <input type="text">
                        </div>
                        <div class="">
                            <label for="">valor</label>
                            <input type="text">
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="button">cargar</button>
                            <a href="" class="buton">cancelar</a>
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
    <style>
        .form {
            max-width: 24rem;
            margin-left: auto;
            margin-right: auto;
        }

        .space-y-4 > :not([hidden]) ~ :not([hidden]) {
            --tw-space-y-reverse: 0;
            margin-top: calc(1rem /* 16px */ * calc(1 - var(--tw-space-y-reverse)));
            margin-bottom: calc(1rem /* 16px */ * var(--tw-space-y-reverse));
        }

        label {
            display: block;
            color: #fff;
            text-transform: capitalize;
        }

        input, select {
            width: 300px;
            height: 30px;
            padding: 8px;
            background: #666666;
            color: #fff;
            border: 2px #8d8c8c solid;
            border-radius: 5px;
        }

        button.button {
            background-color: #007cb5;
            padding-left: 16px;
            padding-right: 16px;
            padding-top: 8px;
            padding-bottom: 8px;
            border: #fafafa10 2px solid;
            border-radius: 5px;
            text-transform: capitalize;
        }

        a.buton {
            background-color: #5e5e5e;
            padding-left: 16px;
            padding-right: 16px;
            padding-top: 9px;
            padding-bottom: 9px;
            border: #fafafa10 2px solid;
            border-radius: 5px;
            text-transform: capitalize;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop