<?php 
$tipo_docs = ['', 'DNI', 'C.E', 'PASAPORTE'];
?>
<html>
    @include('pdf.font')
    @include('pdf.styles')
    <body>
        <table class="table mb-2">
            <tr>
                <td class="text-center">MANIFIESTO POR PTO VENTA</td>
            </tr>
        </table>
        <table class="table text-uppercase fs-10 mb-2">
            <tr>
                <td>
                    <table class="table">
                        <tr>
                            <td><span class="fw-bold">FECHA:</span> {{ \Carbon\Carbon::parse($itinerario['fecha_partida'])->format('d/m/y') }}</td>
                            <td><span class="fw-bold">ORIGEN:</span> {{ $itinerario['origen']['nombre'] }}</td>
                            <td><span class="fw-bold">DESTINO:</span> {{ $itinerario['destino']['nombre'] }}</td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold">HORA SALIDA:</span> {{ \Carbon\Carbon::parse($itinerario['hora_partida'])->format('h:i a') }}</td>
                            <td><span class="fw-bold">PLACA:</span> {{ $itinerario['bus']['placa'] }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        @foreach($ptos as $ptoventa)
        <table class="table mb-2">
            <tr>
                <td class="border" colspan="7">&nbsp;{{ $ptoventa['nombre_comercial'] }}</td>
            </tr>
            <tr class="fs-10">
                <th>ASI</th>
                <th>PASAJERO</th>
                <th>NRO DOC</th>
                <th>CELULAR</th>
                <th>DOCUMENTO</th>
                <th>DESTINO</th>
                <th>PRECIO</th>
            </tr>
            @foreach($ptoventa['ventas'] as $venta)
            <tr class="fs-10">
                <td class="text-center">{{ $venta['asiento']['numero'] }}</td>
                <td>{{ $venta['cliente']['paterno'] }} {{ $venta['cliente']['materno'] }}, {{ $venta['cliente']['nombres'] }}</td>
                <td class="text-center">{{ $tipo_docs[$venta['cliente']['tipo_documento']] }} {{ $venta['cliente']['numero_documento'] }}</td>
                <td class="text-center">{{ $venta['cliente']['telefono'] }}</td>
                <td class="text-center">{{ $venta['correlativo'] }}</td>
                <td></td>
                <td class="text-end">{{ $venta['totalpago'] }}</td>
            </tr>
            @endforeach
        </table>
        @endforeach
    </body>
</html>