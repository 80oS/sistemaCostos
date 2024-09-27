@extends('adminlte::page')

@section('title', 'home')

@section('content_header')
@stop
@section('content')
<h1 class="text-center">BIENVENIDO AL SISTEMA DE <br> COSTOS DE IDIMCOL S.A.S</h1>
<div class="logo-container">
    
    <svg width="300" height="300" viewBox="0 0 300 300">
        <defs>
            <filter id="fire" x="-50%" y="-50%" width="200%" height="200%">
                <feTurbulence type="fractalNoise" baseFrequency="0.1 0.5" numOctaves="2" result="noise" />
                <feDisplacementMap in="SourceGraphic" in2="noise" scale="3" xChannelSelector="R" yChannelSelector="G" result="displacement" />
            </filter>
            <mask id="logo-mask">
                <image xlink:href="https://www.acofi.edu.co/eiei2018/wp-content/uploads/2018/01/IDIMCOL.jpg" width="200" height="200" x="50" y="50" />
            </mask>
            <linearGradient id="blue-fire-gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" style="stop-color:#00ffff" />
                <stop offset="50%" style="stop-color:#0000ff" />
                <stop offset="100%" style="stop-color:#000080" />
            </linearGradient>
            <linearGradient id="white-fire-gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" style="stop-color:#ffffff" />
                <stop offset="50%" style="stop-color:#f0f0f0" />
                <stop offset="100%" style="stop-color:#e0e0e0" />
            </linearGradient>
        </defs>
        
        <!-- Blue fire background -->
        <g filter="url(#fire)">
            <rect width="100%" height="100%" fill="url(#blue-fire-gradient)" />
        </g>
        
        <!-- White fire overlay -->
        <g filter="url(#fire)" opacity="0.7">
            <rect width="100%" height="100%" fill="url(#white-fire-gradient)" />
        </g>
        
        <!-- Logo -->
        <image xlink:href="https://www.acofi.edu.co/eiei2018/wp-content/uploads/2018/01/IDIMCOL.jpg" width="200" height="200" x="50" y="50" mask="url(#logo-mask)" />
    </svg>
</div>
@stop

@section('css')
<style>
    .logo-container {
        width: 300px;
        height: 300px;
        margin: auto;
    }
    
    @keyframes flicker {
        0% { opacity: 0.8; }
        50% { opacity: 1; }
        100% { opacity: 0.8; }
    }
    
    #blue-fire-gradient {
        animation: flicker 3s infinite;
    }
    
    #white-fire-gradient {
        animation: flicker 2s infinite;
    }

    .content, .content-header {
        background: #ffffff !important;
    }

    .content {
        width: 100%;
        height: 94vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@stop
@section('js')

@stop