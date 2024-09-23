@extends('adminlte::page')

@section('title', 'Resumen de Costos de Producción')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Resumen de costos de producción de la SDP')}} {{ $sdp->numero_sdp }}
    </h2>
@stop

@section('content')
<div class="no-print">
    <button id="printButton" class="btn btn-info">
        <i class="fas fa-print"></i>
    </button>
</div>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Resumen de SDP: {{ $sdp->numero_sdp }}</h1>

    <div class="mb-6">
        <h2 class="text-xl font-semibold">Información General</h2>
        <p><strong>Total Mano de Obra:</strong> {{ number_format($totalManoObra, 2) }}</p>
        <p><strong>Total Horas Operativas:</strong> {{ $totalHorasOperarios }}</p>
        <p><strong>Total CIF:</strong> {{ number_format($totalCIF, 2) }}</p>
    </div>

    <h2 class="text-xl font-semibold mb-2">Artículos</h2>
    <table class="min-w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Descripción</th>
                <th class="border px-4 py-2">Cantidad</th>
                <th class="border px-4 py-2">Precio</th>
                <th class="border px-4 py-2">Subtotal</th>
                <th class="border px-4 py-2">Mano de Obra Directa</th>
                <th class="border px-4 py-2">Materias Primas Directas</th>
                <th class="border px-4 py-2">Materias Primas  Indirectas</th>

                <th class="border px-4 py-2">CIF</th>
                <th class="border px-4 py-2">Utilidad Bruta</th>
                <th class="border px-4 py-2">Margen Bruto (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articulosConSubtotales as $articulo)
            <tr>
                <td class="border px-4 py-2">{{ $articulo->descripcion }}</td>
                <td class="border px-4 py-2">{{ $articulo->pivot->cantidad }}</td>
                <td class="border px-4 py-2">{{ number_format($articulo->pivot->precio, 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($articulo->subtotal, 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($articulo->mano_obra_directa, 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($articulo->materias_primas_directas, 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($articulo->materias_primas_indirectas, 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($articulo->cif, 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($articulo->utilidad_bruta, 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($articulo->margen_bruto, 2) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        <h2 class="text-xl font-semibold">Costos de Producción</h2>
        <ul>
            @foreach($costosProduccion as $costo)
                <li>Mano de Obra Directa: {{ number_format($costo->mano_obra_directa, 2) }}</li>
                <!-- Agrega más campos de costos según sea necesario -->
            @endforeach
        </ul>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold">Información Adicional</h2>
        <p><strong>IDIMCOL:</strong> {{ implode(', ', $idimcols->pluck('nombre')->toArray()) }}</p>
        <p><strong>CIF Totales:</strong> MOI: {{ number_format($totalMOI, 2) }}, GOI: {{ number_format($totalGOI, 2) }}, OCI: {{ number_format($totalOCI, 2) }}</p>
    </div>

    <div class="no-print mt-4">
        <a href="{{ route('costos_produccion.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Volver</a>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .card {
            background: #fff !important;
            color: #000 !important;
        }
        h1{
            text-align: center;
        }

        .cont {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cards {
            display: flex;
            flex-direction: row;

            gap: 10px;
            padding: 8px;
        }
        .card-1, .card-2, .card-3, .card-4 {
            padding: 8px;
            border: #000 solid 1px;
            border-radius: 10px;
        }

        .content, .content-header {
            background: #fff !important;
        }

        .content {
            height: 90vh;
        }

        @media print {
            @page {
                size: landscape !important; /* Establecer la orientación en CSS también */
                margin: 0 !important;
            }
            .no-print {
                display: none ;
            }
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        document.getElementById('printButton').addEventListener('click', function () {
            // Ocultar el botón de impresión antes de generar el PDF
    
            const SdpContent = document.querySelector(".sdp");
    
            const opt = {
                margin:       0.5,
                filename:     'costos_sdp.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
            };
    
            window.print();
        });
    </script>
@stop