<?php 
$tipo_docs = ['', 'DNI', 'C.E', 'PASAPORTE'];

$rows = [];

foreach($asientos as $asiento){
    $piso = $asiento->piso;
    $fila = $asiento->fila;
    $columna = $asiento->columna;

    if(!isset($rows[$piso][$fila]))
        $rows[$piso][$fila] = [];
    
    $rows[$piso][$fila][$columna] = $asiento;
}

?>
<html>
    @include('pdf.font')
    @include('pdf.styles')
    <body>
        <table class="table mb-2">
            <tr>
                <td style="width: 60%">
                    <table class="table">
                        <tr><td class="fw-bold">{{ $itinerario['sucursal']['razon_social'] }}</td></tr>
                        <tr><td class="fw-bold">{{ $itinerario['sucursal']['direccion'] }}</td></tr>
                    </table>
                </td>
                <td style="width: 40%">
                    <table class="w-100" style="border: 1px solid #000000; font-weight: bold">
                        <tr><td class="text-center border-bottom">RUC: {{ $itinerario['sucursal']['numero_documento'] }}</td></tr>
                        <tr><td class="text-center border-bottom">CROQUIS</td></tr>
                        <tr><td class="text-center">N° {{ \Carbon\Carbon::parse($itinerario['created_at'])->year }}-{{ str_pad($itinerario['id'], 9, "0", 0) }}</td></tr>
                    </table>
                </td>
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
        
        @foreach($rows as $index=>$piso)
        <table class="table mb-2">
            <tr>
                <td colspan="5" class="text-center fw-bold border">Piso {{ $index + 1 }}</td>
            </tr>
            @foreach($piso as $fila)
            <tr>
                @for($i=0;$i<5;$i++)
                <td class="border" style="width: {{ isset($fila[$i]) ? '23%' : '4%' }}; max-width: {{ isset($fila[$i]) ? '23%' : '4%' }}">
                    @if(isset($fila[$i]))
                    <div>
                        <span class="fw-bold">[{{ $fila[$i]->numero }}]</span>
                        @if($fila[$i]->venta_id !== null)
                        <span class="fs-11">{{ $tipo_docs[$fila[$i]->cliente_tipo_documento] }} {{ $fila[$i]->cliente_numero_documento }}</span>
                        @endif
                    </div>
                    <div>
                        @if($fila[$i]->venta_id !== null)
                        <span class="fs-11">{{ $fila[$i]->cliente_nombres }} {{ $fila[$i]->cliente_paterno }}</span>
                        @else
                        <span>&nbsp;</span>
                        @endif
                    </div>
                    @endif
                </td>
                @endfor
            </tr>
            @endforeach
        </table>
        @endforeach
    </body>
</html>