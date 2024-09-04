<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('crear remicion para el cliente')}}
        </h2>
    </x-slot>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remisión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    .h {
        margin: 0 auto;
        color: #420024 ; 
    }

    @media print {
            body * {
                visibility: hidden;
            }
            .print-section, .print-section * {
                visibility: visible;
            }
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
            }
            .no-print {
                display: none;
            }
        }

</style>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden print-section">
        <div class="flex justify-between items-center border-b p-4">
            <div class="flex items-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsVpDdEZpcQyL21RirrUW88r-ATjStR6UG7X4GjWd2PQ&s" alt="IDIMCOL" class="h-20 mr-4">
                <h1 class="text-2xl font-bold text-center h ">REMICIÓN</h1>
            </div>
            <div class="text-right">
                <p class="font-semibold">coigo: {{$remicion->codigo_remicion}}</p>
                <p>version: 001</p>
                <p>fecha: {{$remicion->created_at}}</p>
            </div>
        </div>
        
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p><span class="font-semibold">Código de la remicion:</span> {{$remicion->codigo_remicion}}</p>
                    <p class="uppercase"><span class="font-semibold">Cliente:</span> {{$remicion->cliente->nombre}}</p>
                    <p><span class="font-semibold">NIT:</span> {{$remicion->cliente->nit}}</p>
                </div>
                <div>
                    <p><span class="font-semibold">Fecha de despacho:</span> {{$remicion->fecha_despacho }}</p>
                    <p><span class="font-semibold">solicitud de produccion:</span> {{$remicion->solicitud_produccion }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <h2 class="text-lg font-semibold bg-blue-900 text-white p-2 uppercase text-center">{{$remicion->cliente->nombre}}</h2>
                <table class="w-full border-collapse" id="itemTable">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2 text-left">descripcion</th>
                            <th class="border p-2 text-left">cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border p-2">{{$remicion->descripcion}}</td>
                            <td class="border p-2" id="cantidad">
                                <input type="number" class="w-full quantity-input rounded" value="{{ $remicion->cantidad }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-2">Total</td>
                            <td class="border p-2 font-semibold" id="totalQuantity"></td>
                        </tr>
                    </tbody>
                </table>
                <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded no-print" onclick="addRow()">Agregar fila</button>
            </div>
            <div class="mb-4">
                <h3 class="font-semibold">observaciones</h3>
                <p class="border p-2">{{$remicion->observaciones }}</p>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold">despachado por:</h3>
                    <p class="border p-2">{{$remicion->despacho}}</p>
                </div>
                <div>
                    <h3 class="font-semibold">recibido por:</h3>
                    <p class="border p-2">{{$remicion->recibido}}</p>
                </div>
            </div>
        </div>
    </div>
</body>
    <div class="flex flex-row items-end justify-end py-20 px-20">
        <button  id="saveRemicionBtn" class="bg-blue-900 hover:bg-blue-400 text-white font-bold py-2 px-3 rounded">guardar remicion como pdf</button>
    </div>
    <div class="col-12 px-20">
        <a href="{{ route('remiciones.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded">volver</a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.getElementById("saveRemicionBtn").addEventListener("click", function() {
            // Selecciona el contenedor de la remisión
            const remicionContent = document.querySelector("body");

            // Opciones para el PDF
            const opt = {
                margin:       0.5,
                filename:     'remicion.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            // Crear el PDF
            html2pdf().from(remicionContent).set(opt).save().then(() => {
                // Imprimir el PDF después de guardarlo
                window.print();
            });
        });
    </script>
    <script>
        function updateTotal() {
            const quantities = document.querySelectorAll('.quantity-input');
            let total = 0;
            quantities.forEach(input => {
                total += parseInt(input.value) || 0;
            });
            document.getElementById('totalQuantity').textContent = total;
        }

        function addRow() {
            const tbody = document.querySelector('#itemTable tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="border p-2"><input type="text" class="w-full"></td>
                <td class="border p-2"><input type="number" class="w-full quantity-input" value="0"></td>
            `;
            tbody.appendChild(newRow);
            attachEventListeners();
            updateTotal();
        }

        function attachEventListeners() {
            const inputs = document.querySelectorAll('.quantity-input');
            inputs.forEach(input => {
                input.addEventListener('input', updateTotal);
            });
        }

        // Initial setup
        attachEventListeners();
        updateTotal();
    </script>
</html>
</x-app-layout>