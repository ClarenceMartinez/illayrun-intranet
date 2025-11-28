<?php 
$tipo_docs = ['', 'DNI', 'C.E', 'PASAPORTE'];
?>
<html>
    @include('pdf.font')
    @include('pdf.styles')
    <body>
        <table class="table">
            <tr>
                <td style="width: 60%">
                    <div>{{ $itinerario['sucursal']['razon_social'] }}</div>
                    <div>{{ $itinerario['sucursal']['direccion'] }}</div>
                </td>
                <td style="width: 40%">
                    <table class="w-100" style="border: 1px solid #000000; font-weight: bold">
                        <tr><td class="text-center border-bottom">RUC: {{ $itinerario['sucursal']['numero_documento'] }}</td></tr>
                        <tr><td class="text-center border-bottom">MANIFIESTO DE PASAJEROS</td></tr>
                        <tr><td class="text-center">N° {{ \Carbon\Carbon::parse($itinerario['created_at'])->year }}-{{ str_pad($itinerario['id'], 9, "0", 0) }}</td></tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="table text-uppercase fs-10">
            <tr>
                <td>
                    <table class="table">
                        <tr>
                            <td><span class="fw-bold">ORIGEN:</span> {{ $itinerario['origen']['nombre'] }}</td>
                            <td><span class="fw-bold">DESTINO:</span> {{ $itinerario['destino']['nombre'] }}</td>
                            <td><span class="fw-bold">F. DE VIAJE:</span> {{ \Carbon\Carbon::parse($itinerario['fecha_partida'])->format('d/m/y') }}</td>
                            <td><span class="fw-bold">TURNO:</span> {{ \Carbon\Carbon::parse($itinerario['hora_partida'])->format('h:i a') }}</td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold">BUS:</span> </td>
                            <td><span class="fw-bold">PLACA:</span> {{ $itinerario['bus']['placa'] }}</td>
                            <td><span class="fw-bold">MARCA:</span> {{ $itinerario['bus']['marca'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><span class="fw-bold">CHOFER:</span> {{ $itinerario['chofer']['apellidos'] }}, {{ $itinerario['chofer']['nombres'] }}</td>
                        </tr>
                        @if(isset($itinerario['copiloto']))
                        <tr>
                            <td colspan="3"><span class="fw-bold">COPILOTO:</span> {{ $itinerario['copiloto']['apellidos'] }}, {{ $itinerario['copiloto']['nombres'] }}</td>
                        </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>
        <table class="table fs-10">
            <tr>
                <th>ASI</th>
                <th>PASAJERO</th>
                <th>EDAD</th>
                <th>TIPO</th>
                <th>NÚMERO</th>
                <th>DOCUMENTO</th>
                <th>DESTINO</th>
                <th>IMPORTE S/</th>
            </tr>
            @foreach($itinerario['ventas'] as $venta)
            <tr class="text-uppercase">
                <td class="text-center">{{ $venta['asiento']['numero'] }}</td>
                <td>{{ $venta['cliente']['paterno'] }} {{ $venta['cliente']['materno'] }}, {{ $venta['cliente']['nombres'] }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($venta['cliente']['fecha_nacimiento'])->age }}</td>
                <td class="text-center">{{ $tipo_docs[$venta['cliente']['tipo_documento']] }}</td>
                <td class="text-center">{{ $venta['cliente']['numero_documento'] }}</td>
                <td class="text-center">{{ $venta['correlativo'] }}</td>
                <td class="text-center"></td>
                <td class="text-end">{{ number_format($venta['totalventa'],2)}}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>