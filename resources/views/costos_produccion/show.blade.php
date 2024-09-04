@extends('adminlte::page')

@section('title', 'sdp')

@section('content_header')
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Costos de producción de la sdp')}} {{ $sdp->numero_sdp }}
    </h2>
@stop

@section('content')
<div class="flex items-end justify-end mb-4">
    <a href="{{ route('costos_produccion.index') }}" class="btn btn-warning">volver</a>
</div>
<div class="p-12">
    <div class="sdp-content">
        <div class="sdp max-w-4x1 mx-auto bg-white p-8 shadow-lg mb-8" id="SdpContent">
            <!-- Encabezado -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsVpDdEZpcQyL21RirrUW88r-ATjStR6UG7X4GjWd2PQ&s" alt="IDIMCOL Logo" class="w-32 mb-2">
                    @foreach ($idimcols as $idimcol)
                        <p class="text-sm p"><b class="">{{ $idimcol->nombre }}</b></p>
                        <p class="text-sm p"><b>{{ $idimcol->direccion }}</b></p>
                        <p class="text-sm p">NIT: <b>{{ $idimcol->nit }}</b></p>
                        <p class="text-sm p">TEL: <b>{{ $idimcol->telefono }}</b></p>
                    @endforeach    
                </div>
                <div class="center">
                    <h1 class="text-2xl font-bold mb-2">COSTOS DE PRODUCCION</h1>
                    <p class="text-sm p"><b>Nro. S.D.P: {{ $sdp->numero_sdp }}</b></p>
                </div>
                <div class=" contentt text-center border border-black rounded p-3">
                    <p class="text-sm p">Fecha: {{ $sdp->created_at->format('d-m-y') }}</p>
                    
                    <p class="text-sm p">Hora: {{ $sdp->created_at->timezone('America/Bogota')->format('H:i:s A') }}</p>
                </div>
            </div>
        
            <!-- Información del cliente y vendedor -->
            <div class="border border-gray-800 p-4 mb-6 rounded cont">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Columna 1 -->
                    <div>
                        <p><span class="font-semibold">NIT/CI: </span> {{ $sdp->clientes->nit }}</p>
                        <p><span class="font-semibold">Cliente: </span> {{ $sdp->clientes->nombre }}</p>
                    </div>
                    <!-- Columna 2 -->
                    <div>
                        <p><span class="font-semibold">Vendedor: </span> {{ $sdp->vendedores->nombre }}</p>
                    </div>
                    <!-- Columna 3 -->
                    <div>
                        <p><span class="font-semibold">O.C: </span> {{ $sdp->orden_compra }}</p>
                        <p><span class="font-semibold">M.C: </span>{{ $sdp->memoria_calculo }}</p>
                    </div>
                    <!-- Columna 4 -->
                    <div>
                        <p><span class="font-semibold">Fecha S.D.P: </span>{{ $sdp->created_at->format('d-m-y') }}</p>
                    </div>
                </div>
            </div>
        
            <!-- Tabla de productos -->
            <table id="sdp-table" class="w-full mb-6 border border-black rounded">
                <thead>
                    <tr class="bg-gray-400 border border-black">
                        <th class="border p-1">Código</th>
                        <th class="border p-1">Descripción</th>
                        <th class="border p-1">Material</th>
                        <th class="border p-1">Fecha de Despacho Comercial</th>
                        <th class="border p-1">Fecha de Despacho Producción</th>
                        <th class="border p-1">Plano</th>
                        <th class="border p-1">Cantidad</th>
                        <th class="border p-1">Precio</th>
                        <th class="border p-1">Sub-Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sdp->articulos as $articulo)
                        <tr class="border border-black odd:bg-white even:bg-gray-200">
                            <td class="border p-1 text-center">{{ $articulo->codigo }}</td>
                            <td class="border p-1 text-left">{{ $articulo->descripcion }}</td>
                            <td class="border p-1 text-left">{{ $articulo->material }}</td>
                            <td class="border p-1 text-right">{{ $sdp->fecha_despacho_comercial }}</td>
                            <td class="border p-1 text-left">{{ $sdp->fecha_despacho_produccion }}</td>
                            <td class="border p-1 text-left">{{ $articulo->plano }}</td>
                            <td class="border p-1  text-center">{{ $articulo->pivot->cantidad }}</td>
                            <td class="border p-1  text-right">{{ number_format($articulo->precio, 2, ',', '.') }}</td>
                            <td class="border p-1  text-right">{{ number_format($articulo->subtotal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-100 border border-black">
                        <td colspan="8" class="border p-1 text-right font-semibold">Total: </td>
                        <td class="border p-1 text-right font-semibold">
                            {{ number_format($total, 2, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        
            <div class="border border-gray-300 p-4 mb-6">
                <table class="w-full mb-6 border border-black rounded">
                    <thead>
                        <tr class="bg-gray-400 border border-black">
                            <th class="border p-1" colspan="4">ANALISIS DE COSTOS</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr class="bg-gray-400 border border-black">
                            <th class="border p-1"> VALOR DE VENTA</th>
                            <th class="border p-1"> MANO DE OBRA DIRECTA</th>
                            <th class="border p-1"> MATERIAS PRIMAS DIRECTAS</th>
                            <th class="border p-1"> COSTOS INDIRECTOS DE FABRICA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border border-black odd:bg-white even:bg-gray-200">
                            <td class="border p-1">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#valor_venta">
                                    Detalles
                                </button>
                            </td>
                            <td class="border p-1">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mano_obra">
                                    Detalles
                                </button>
                            </td>
                            <td class="border p-1">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materias_primas">
                                    Detalles
                                </button>
                            </td>
                            <td class="border p-1">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CIF">
                                    Detalles
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-400 border border-gray-400">
                            <td class="border p-1">UTILIDAD BRUTA</td>
                            <td class="border p-1 text-right">{{ number_format($utilidad_bruta, 2, ',', '.') }}</td>
                        </tr>
                        <tr class="bg-gray-400 border border-gray-400">
                            <td class="border p-1">MARGEN BRUTO</td>
                            <td class="border p-1 text-right">
                                {{ number_format($margen_bruto, 2, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="valor_venta" tabindex="-1" aria-labelledby="valor_ventaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="valor_ventaLabel">VALORES DE VENTA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>articulo</th>
                            <th>cantidad</th>
                            <th>valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($sdp->articulos as $articulo)
                        <tr>
                            <td>{{ $articulo->descripcion }}</td>
                            <td>{{ $articulo->pivot->cantidad }}</td>
                            <td>{{ number_format($articulo->subtotal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">total</td>
                            <td>{{ number_format($total, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mano_obra" tabindex="-1" aria-labelledby="mano_obraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="mano_obraLabel">MANO DE OBRA DIRECTA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>operarios</th>
                            <th>horas</th>
                            <th>valor de mano de obra</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($costosProduccionPorOperario as $item)
                            <tr>
                                <td>{{ $item['nombre_operario'] }}</td>
                                <td>{{ $item['total_horas'] }}</td>
                                <td>{{ number_format($item['mano_obra_directa_total'], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">total de mano de obra</td>
                            <td>{{ number_format($totalManoObra, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="materias_primas" tabindex="-1" aria-labelledby="materias_primasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="materias_primasLabel">MATERIAS PRIMAS DIRECTAS</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>descripcion</th>
                            <th>cantidad</th>
                            <th>valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">total</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="CIF" tabindex="-1" aria-labelledby="CIFLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="CIFLabel">COSTOS INDIRECTOS DE FABRICA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>costos</th>
                            <th>total horas</th>
                            <th>total valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ol>
                                    <li>
                                        MOI: {{ number_format($totalMOI, 2, ',', '.') }}
                                    </li>
                                    <li>
                                        GOI: {{ number_format($totalGOI, 2, ',', '.') }}
                                    </li>
                                    <li>
                                        OCI: {{ number_format($totalOCI, 2, ',', '.') }}</td>
                                    </li>
                                </ol>
                            </td>
                            <td>
                                {{ number_format($totalHorasOperarios, 2, ',', '.') }}
                            </td>
                            <td>
                                {{ number_format($cif, 2, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    <style>
        table, thead, tr, th, td {
            border: 1px #000 solid;
        }

        th {
            text-align: center;
        }

        p b {
            font-size: 18px;
        }

        p.p {
            font-size: 18px;
        }
        
        .contentt {
            border: #000 1px solid;
            color: #000;
        }

        .cont {
            border: #000 1px solid;
            color: #000;
        }

        .cont div.row {
            max-height: 50px;
            display: flex;
            flex-direction: row;
            gap: 200px;
        }

        .print {
            margin-top: 20px;
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            justify-content: end; 
            gap: 10px;
        }

        .print button {
            width: 70px;
            height: 70px;
            text-align: center
        }

        .print button i {
            font-size: 25px;
        }
        .center{
            display: flex;
            flex-direction: column;
            text-align: center;
            transform: translateX(-150px);
        }
    </style>
@stop

@section('js')
    <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
    ></script>

    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
    ></script>
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
@stop
