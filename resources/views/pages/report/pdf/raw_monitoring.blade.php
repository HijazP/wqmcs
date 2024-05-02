<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Monitoring</title>
    <style>
        body{
			font-family: Helvetica, sans-serif;
			margin:0;
            color: #0d1a2b;
            font-size: .6em;
		}
    </style>
</head>
<body>
    <center>
        <h3>Laporan Data Raw Monitoring</h3>
    </center>
    <br>
    <table class="table" width="100%" cellspacing="0" cellpadding="2" border="1">
        <thead style="background-color: rgb(250 250 250);">
            <tr>
                <th rowspan="2">IoT Node</th>
                <th rowspan="2">Waktu</th>
                <th colspan="14" class="text-center">Data Telemetry</th>
            </tr>
            <tr>
                @if(!empty($excel ?? null))
                <th>Suhu Node</th>
                <th>Suhu Edge</th>
                <th>Disolved Oxygen</th>
                <th>Turbidity</th>
                <th>Salinity</th>
                <th>COD</th>
                <th>pH</th>
                <th>ORP</th>
                <th>TDS</th>
                <th>Nitrat</th>
                <th>Temperature Air</th>
                <th>TSS</th>
                <th>Debit air</th>
                @else
                <th width="8.1%">Suhu Node</th>
                <th width="8.1%">Suhu Edge</th>
                <th width="8.1%">Disolved Oxygen</th>
                <th width="8.1%">Turbidity</th>
                <th width="8.1%">Salinity</th>
                <th width="8.1%">COD</th>
                <th width="8.1%">pH</th>
                <th width="8.1%">ORP</th>
                <th width="8.1%">TDS</th>
                <th width="8.1%">Nitrat</th>
                <th width="8.1%">Temperature Air</th>
                <th width="8.1%">TSS</th>
                <th width="8.1%">Debit air</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $row)
                <tr>
                    <td>{{ $row->iot_node_serial_number }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td class="fs-7" align="center">{{ $row->temperature_node }}<small>°C</small></td>
                    <td class="fs-7" align="center">{{ $row->temperature_edge }}<small>°C</small></td>
                    <td class="fs-7" align="center">{{number_format( $row->dissolver_oxygen,2) }}</td>
                    <td class="fs-7" align="center">{{ number_format($row->turbidity ,2)}}</td>
                    <td class="fs-7" align="center">{{ number_format($row->salinity ,2)}}</td>
                    <td class="fs-7" align="center">{{ number_format($row->cod ,2)}}<small>mg/L</small></td>
                    <td class="fs-7" align="center">{{ number_format($row->ph ,2)}}pH</td>
                    <td class="fs-7" align="center">{{ number_format($row->orp ,2)}}</td>
                    <td class="fs-7" align="center">{{ number_format($row->tds,2)}}</td>
                    <td class="fs-7" align="center">{{ number_format($row->amonium ,2)}}<small>mg/L</small></td>
                    <td class="fs-7" align="center">{{ number_format($row->temperature)}}<small>°C</small></td>
                    <td class="fs-7" align="center">{{ number_format($row->tss ,2)}}<small>mg/L</small></td>
                    <td class="fs-7" align="center">{{ number_format($row->debit ,2)}}<small>m3/s</small></td>
                </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</body>
</html>
