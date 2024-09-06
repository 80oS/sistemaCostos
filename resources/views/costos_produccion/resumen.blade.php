@extends('adminlte::page')

@section('title', 'resumen')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Resumen de costos de producción de la sdp')}} {{ $sdp->numero_sdp }}
</h2>
@stop

@section('content')
    <div class="p-12">
        <div class="flex items-end justify-end mb-4 gap-5">
            <a href="{{ route('costos_produccion.show', $sdp->numero_sdp) }}" class="btn btn-warning">volver</a>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h1>RESUMEN DE COSTOS DE PRODUCCION DE LA SDP {{ $sdp->numero_sdp }}</h1>
                    <h2>ANALISIS DE COSTOS</h2>
                    <div class="cont">
                        <div class="cards">
                            <div class="card-1">
                                <h3>* Valor de venta</h3>
                                <p>
                                    <strong>Articulos <br></strong> 
                                    @foreach ($sdp->articulos as $index => $articulo)
                                        <p>
                                            <strong>
                                            | {{ $index + 1 }} |
                                            </strong> <br>
                                            <strong>Descricion del articulo: </strong>{{ $articulo->descripcion }}
                                            <br> <strong>Cantidad del articulo:</strong> {{ $articulo->pivot->cantidad }}
                                            <br> <strong>valor del articulo:</strong> {{ number_format($articulo->subtotal, 2, ',', '.') }}
                                        </p><br><br>
                                    @endforeach
                                    <strong>TOTAL:</strong> {{ number_format($total, 2, ',', '.') }}
                                </p>
                            </div>
                            <div class="card-2">
                                <h3>* Mano de obra directa</h3>
                                <p>
                                    <strong>Operarios</strong>
                                    @foreach ($costosProduccionPorOperario as $index => $item)
                                        <p>
                                            <strong>
                                                | {{ $index + 1 }} |
                                            </strong> <br>
                                            <strong>Nombre del operario:</strong> {{ $item['nombre_operario'] }} <br>
                                            <strong>Horas trabajadas:</strong> {{ $item['total_horas'] }} <br>
                                            <strong>Valor de la mano de obra:</strong> {{ number_format($item['mano_obra_directa_total'], 2, ',', '.') }} <br>
                                        </p> <br>
                                    @endforeach
                                    <strong>TOTAL:</strong> {{ number_format($totalManoObra, 2, ',', '.') }}
                                </p>
                            </div>
                            <div class="card-3">
                                <h3>* Materias primas</h3>
                                <p>
                                    <strong>Directas</strong>
                                    @foreach ($materiasPrimasDirectas as $index => $materiaDirecta)
                                        <p>
                                            <strong>
                                                | {{ $index + 1 }} |
                                            </strong> <br>
                                            <strong>Descricion:</strong> {{ $materiaDirecta->descripcion }} <br>
                                            <strong>Cantidad cantidad:</strong> {{ $materiaDirecta->pivot->cantidad }} <br>
                                            <strong>Cantidad precio untitario:</strong> {{ number_format($materiaDirecta->precio_unit, 2, ',', '.') }} <br>
                                            <strong>total:</strong> {{ number_format($totalDirectas, 2, ',', '.') }} <br>
                                        </p>
                                    @endforeach
                                        <br>
                                    <strong>Indirectas</strong>
                                    @foreach ($materiasPrimasIndirectas as $index => $materiaDirecta)
                                        <p>
                                            <strong>
                                                | {{ $index + 1 }} |
                                            </strong> <br>
                                            <strong>Descricion:</strong> {{ $materiaDirecta->descripcion }} <br>
                                            <strong>Cantidad cantidad:</strong> {{ $materiaDirecta->pivot->cantidad }} <br>
                                            <strong>Cantidad precio untitario:</strong> {{ number_format($materiaDirecta->precio_unit, 2, ',', '.') }} <br>
                                            <strong>total:</strong> {{ number_format($totalIndirectas, 2, ',', '.') }} <br>
                                        </p>
                                    @endforeach
                                </p>
                            </div>
                            <div class="card-4">
                                <h3>* Costos indirectos de fabrica (CIF)</h3>
                                <strong>Gasto Operativo Indirecto (GOI): </strong>{{ number_format($totalGOI, 2, ',', '.') }} <br>
                                <strong>Mano de Obra Indirecta (MOI): </strong>{{ number_format($totalMOI, 2, ',', '.') }} <br>
                                <strong>Otros costos indirectos (CMI): </strong>{{ number_format($totalOCI, 2, ',', '.') }} <br>
                                <h3>* Total de horas de los operarios</h3>
                                horas: {{ number_format($totalHorasOperarios, 2, ',', '.') }}
                                <h3>* total CIF</h3>
                                CIF: {{ number_format($cif, 2, ',', '.') }}
                                <br> <br>
                                <h2>Utilidad bruta</h2>
                                valor: {{ number_format($utilidad_bruta, 2, ',', '.') }}
                                <br> <br>
                                <h2>Margen bruto</h2>
                                valor: {{ number_format($margen_bruto, 2, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
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
    </style>
@stop

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop