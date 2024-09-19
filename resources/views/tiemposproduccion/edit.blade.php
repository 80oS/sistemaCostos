@extends('adminlte::page')

@section('title', 'editar tiempo de produccion')

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('editar tiempo de produccion') }}
    </h2>
@stop

@section('content')
<div class="box">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tiempos-produccion.update', $tiempo_produccion->id) }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <div class="mb-4">
                        <div class="mb-4">
                            <label for="codigo_operario">Código del Operario</label>
                            <input type="text" id="codigo_operario" name="operativo_id"  value="{{ old('operativo_id', $tiempo_produccion->operativo_id) }}" readonly placeholder="Código del operario">
                        </div>
        
                        <div class="mb-4">
                            <label for="nombre_operario">Nombre del Operario</label>
                            <input type="text" id="nombre_operario" name="nombre_operario" value="{{ old('nombre_operario', $tiempo_produccion->nombre_operario) }}" readonly placeholder="Nombre del operario">
                        </div>
                    </div>
        
                    <div class="mb-4">
                        <div class="mb-4">
                            <label for="dia">Día</label>
                            <select name="dia" id="dia" required>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ $tiempo_produccion->dia == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
        
                        <div class="mb-4">
                            <label for="mes">Mes</label>
                            <select name="mes" id="mes" required>
                                @foreach ([
                                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
                                    7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                                ] as $numero => $nombre)
                                    <option value="{{ $numero }}" {{ $tiempo_produccion->mes == $numero ? 'selected' : '' }}
                                    >
                                        {{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="mb-4">
                            <label for="año">Año</label>
                            <select name="año" id="año" required>
                                @for ($i = date('Y'); $i >= 1900; $i--)
                                    <option value="{{ $i }}" {{ $tiempo_produccion->año == $i ? 'selected' : '' }}
                                    >
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
        
                    <div class="mb-4">
                        <div class="mb-4">
                            <label for="hora_inicio">Hora Inicio</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio', $tiempo_produccion->hora_inicio) }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="hora_fin">Hora Fin</label>
                            <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin', $tiempo_produccion->hora_fin) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="laboral_descanso">Laboral con descansos</label>
                            <input type="checkbox" id="laboral_descanso">
                            
                            <label for="tiempo_a_restar">Tiempo a restar (en minutos)</label>
                            <input type="number" min="0" step="1" placeholder="Minutos a restar" id="tiempo_restar">
                        </div>
                    </div>
        
                    <div class="mb-4">
                        <div class="mb-4">
                            <label for="nombre_servicio">Proceso/Servicio</label>
                            <div class="">
                                <button id="abrirModalServicios" type="button" class="btn btn-info">ver servicios</button>
                                <input type="text" id="nombre_servicio" name="nombre_servicio" value="{{ old('nombre_servicio', $tiempo_produccion->nombre_servicio) }}" readonly placeholder="Nombre del servicio">
                            </div>
                        </div>
        
                        <div class="mb-4">
                            <label for="proseso_id">Código Servicio</label>
                            <input type="text" id="proseso_id" name="proseso_id" value="{{ old('proseso_id', $tiempo_produccion->proseso_id) }}" readonly placeholder="Código del servicio">
                        </div>
        
                        <div class="mb-4">
                            <label for="sdp_id">SDP</label>
                            <div class="">
                                <button id="abrirModalSDP" type="button" class="btn btn-info">ver SDP</button>
                            <input type="text" id="sdp_id" name="sdp_id" value="{{ old('sdp_id', $tiempo_produccion->sdp_id) }}" required placeholder="Número del SDP">
                            </div>
                        </div>
                    </div>
        
                    <div class="buttons">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('tiempos.group') }}" class="btn btn-default">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modalServicios" class="modal" style="display: none;">
    <div class="modal-contenido">
        <span class="cerrar">&times;</span>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('lista de servicios') }}
        </h2>
        <div class="containerz">
            <div class="mb-4">
                <input type="text" id="searchServicios" placeholder="Buscar..." class="p-2 border rounded w-full">
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>select</th>
                            <th>codigo</th>
                            <th>nombre</th>
                        </tr>
                    </thead>
                    <tbody id="serviciosTableBody">
                        @foreach ($servicios as $servicio)
                        <tr>
                            <td>
                                <input type="radio" name="proseso_select" id="proseso_select" 
                                value="{{ $servicio->codigo }}" data-codigo="{{ $servicio->codigo }}" 
                                data-nombre="{{ $servicio->nombre }}">
                            </td>
                            <td>{{ $servicio->codigo }}</td>
                            <td>{{ $servicio->nombre }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="buton mb-4">
                <button type="submit" id="selectServicio" class="btn btn-primary">seleccionar servicio</button>
                <button class="btn btn-default cerrarModal">cancelar</button>
            </div>
        </div>
    </div>
</div>

<div id="modalSDP" class="modal" style="display: none;">
    <div class="modal-contenido">
        <span class="cerrar">&times;</span>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('lista de SDP') }}
        </h2>
        <div class="containerz">
            <div class="mb-4">
                <input type="text" id="searchSDP" placeholder="Buscar..." class="p-2 border rounded w-full">
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>select</th>
                            <th>codigo</th>
                            <th>descripcion</th>
                            <th>cliente</th>
                        </tr>
                    </thead>
                    <tbody id="sdpTableBody">
                        @foreach ($sdps as $sdp)
                        <tr>
                            <td>
                                <input type="radio" name="SDP_select" id="SDP_select" 
                                value="{{ $sdp->numero_sdp }}" data-codigo="{{ $sdp->numero_sdp }}" >
                            </td>
                            <td>{{ $sdp->numero_sdp }}</td>
                            <td>{{ $sdp->articulos->first()->descripcion }}</td>
                            <td>{{ $sdp->clientes->nombre }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="buton mb-4">
                <button type="submit" id="selectSDP" class="btn btn-primary">seleccionar SDP</button>
                <button class="btn btn-default cerrarModal">cancelar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 20rem;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-contenido {
            background-color: #3a7280;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50rem;
            max-width: 60rem;
            border-radius: 10px;
        }

        .cerrar {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .cerrar:hover,
        .cerrar:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .containerx {
            padding: 20px;
            background: #cccdce;
            border-radius: 10px;
        }

        .table {
            background: #cccdce;
            max-height: 400px;
            overflow-y: auto; 
            padding: 10px;
            border-radius: 10px;
            display: grid;
            justify-content: center;
        }

        table {
            border: 1px #000 solid;
            width: 600px;
            border-collapse: collapse;
            border-radius: 20px;
        }
        
        table thead tr th, table tbody tr td {
            border: 1px #000 solid;
            text-align: center;
            text-transform: capitalize;
        }

        table thead tr th {
            background: #4f4b5f;
            color: #fff;
        }

        table tbody tr td {
            background: #b2c8e6;
            color: #000;
        }
    </style>
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .box {
            padding: 10px;
        }

        .container {
            
        }

        form {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 10px;
        }

        label {
            display:block;
        }

        input, select {
            padding: 10px;
            /* width: 400px; */
            display:inline-block;
            border-radius: 8px;
            background: #d0d7de !important;
            color: #000 !important;
        }

        input:focus, select:focus {
            border-color: rgb(24, 160, 160) !important;
        }


        .card, .card-body {
            border-radius: 10px;
            background: #d6d6d2 !important;
            color: #000 !important;
        }

        .ver {
            display: flex;
            flex-direction: col;
            align-items: flex-end;
            justify-content: flex-end;
        }
        
        .btn {
            background: #c4c10b;
            color: #000;
        }

        .btn:hover {
            background: #5c5a05;
        }

        .content, .content-header {
            background: #fff !important;
        }

        .operario {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 10px;

            
        }

        .servicio, .sdp {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 10px;
            
        }

    </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#hora_inicio", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:S",
            time_24hr: true,
            enableSeconds: true,
            minuteIncrement: 1,
        });
    
        flatpickr("#hora_fin", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:S",
            time_24hr: true,
            enableSeconds: true,
            minuteIncrement: 1,
        });
    </script>
<script>
    // modal servicios
    document.addEventListener('DOMContentLoaded', function() {
        const modalServicios = document.getElementById('modalServicios');
        const btnSelectServicio = document.getElementById('selectServicio');
        const btnCerrarModal = modalServicios.querySelector('.cerrarModal');
        const inputNombre_servicio = document.getElementById('nombre_servicio');
        const inputProseso_id = document.getElementById('proseso_id');

        btnSelectServicio.addEventListener('click', function() {
            const selectServicio = document.querySelector('input[name="proseso_select"]:checked');
            if (selectServicio) {
                const codigo = selectServicio.dataset.codigo;
                const nombre = selectServicio.dataset.nombre;
                
                inputProseso_id.value = codigo;
                inputNombre_servicio.value = nombre;
                
                modalServicios.style.display = 'none';
            } else {
                alert('Por favor, seleccione un servicio.');
            }
        });

        btnCerrarModal.addEventListener('click', function() {
            modalServicios.style.display = 'none';
        });
    });
</script>
<script>
    // modal sdp
    document.addEventListener('DOMContentLoaded', function() {
        const modalServicios = document.getElementById('modalSDP');
        const btnSelectSDP = document.getElementById('SDP_select');
        const btnCerrarModal = modalSDP.querySelector('.cerrarModal');
        const inputNumero_sdp = document.getElementById('sdp_id');

        btnSelectSDP.addEventListener('click', function() {
            const SDPSelect = document.querySelector('input[name="SDP_select"]:checked');
            if (SDPSelect) {
                const codigo = SDP_select.dataset.codigo;
                
                inputNumero_sdp.value = codigo;
                
                modalServicios.style.display = 'none';
            } else {
                alert('Por favor, seleccione un servicio.');
            }
        });

        btnCerrarModal.addEventListener('click', function() {
            modalServicios.style.display = 'none';
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Función para manejar la apertura y cierre de modales
        function setupModal(modalId, btnId) {
            var modal = document.getElementById(modalId);
            var btn = document.getElementById(btnId);
            var span = modal.getElementsByClassName("cerrar")[0];

            btn.onclick = function() {
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        // Configurar modales
        setupModal("modalServicios", "abrirModalServicios");
        setupModal("modalSDP", "abrirModalSDP");
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Función para filtrar una tabla
        function filterTable(inputId, tableBodyId) {
            const searchInput = document.getElementById(inputId);
            const tableBody = document.getElementById(tableBodyId);

            searchInput.addEventListener('input', function () {
                const searchValue = searchInput.value.toLowerCase();
                const rows = tableBody.getElementsByTagName('tr');

                Array.from(rows).forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    let rowContainsSearchValue = false;

                    Array.from(cells).forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(searchValue)) {
                            rowContainsSearchValue = true;
                        }
                    });

                    if (rowContainsSearchValue) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Inicializar búsqueda para cada tabla
        filterTable('searchOperarios', 'operariosTableBody');
        filterTable('searchServicios', 'serviciosTableBody');
        filterTable('searchSDP', 'sdpTableBody');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            const horaFinInput = document.getElementById('hora_fin');
            const tiempoRestarInput = document.getElementById('tiempo_restar');
            const laboral_descanso = document.getElementById('laboral_descanso');

            function calcularNuevaHoraFin() {
                if (!horaFinInput.value || !tiempoRestarInput.value) return;

                let [horas, minutos, segundos] = horaFinInput.value.split(':').map(Number);
                let minutosARestar = parseInt(tiempoRestarInput.value);

                if (!laboral_descanso.checked) return;

                let totalSegundos = (horas * 3600) + (minutos * 60) + (segundos);
                let segundosARestar = minutosARestar * 60;

                let nuvosTotalSegundos = totalSegundos - segundosARestar;

                let nuevasHoras = Math.floor(nuvosTotalSegundos / 3600);
                let nuevosMinutos = Math.floor((nuvosTotalSegundos % 3600) / 60);
                let nuevosSegundos = nuvosTotalSegundos % 60;

                let nuevaHoraFin = `${nuevasHoras.toString().padStart(2, '0')}:${nuevosMinutos.toString().padStart(2, '0')}:${nuevosSegundos.toString().padStart(2, '0')}`;

                horaFinInput.value = nuevaHoraFin;
            }

            tiempoRestarInput.addEventListener('input', calcularNuevaHoraFin);
            laboral_descanso.addEventListener('change', calcularNuevaHoraFin);
        });
    </script>
@stop