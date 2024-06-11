@extends('pages.layouts.app')

@push('header')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/css/tom-select.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-flat">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bolder mb-0">Laporan Data</h5>
                                <p class="text-gray fs-7">Raw data Monitoring</p>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm fw-bold" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Export
                                    </button>
                                    <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{ route('report.rawMonitoring.pdf') }}"
                                                target="_blank">PDF</a></li>
                                        <li><a class="dropdown-item" href="{{ route('report.rawMonitoring.excel') }}"
                                                target="_blank">Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-md-">
                                    <a class="btn text-white btn-sm fw-bold" style="background: #1e88e5;"
                                        data-bs-toggle="collapse" href="#collapseFilter" role="button"
                                        aria-expanded="false" aria-controls="collapseFilter">
                                        Munculkan Filter
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="collapse" id="collapseFilter">
                                    <form action="" method="GET" id="form-filter">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="">Provinsi</label>
                                                <select name="region_id" placeholder="Pilih Provinsi" autocomplete="off">
                                                    @foreach ($regions as $i => $region)
                                                        <option value="{{ $region->id }}"
                                                            {{ request('region_id') == $region->id ? 'selected' : '' }}>
                                                            {{ $region->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Kota</label>
                                                <select name="city_id" autocomplete="off"></select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Dari Tanggal</label>
                                                <input type="date" name="date" class="form-control"
                                                    value="{{ request('date') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Sampai Tanggal</label>
                                                <input type="date" name="to_date" class="form-control"
                                                    value="{{ request('to_date') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Dari Jam</label>
                                                <input type="time" name="time" class="form-control"
                                                    value="{{ request('time') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Sampai Jam</label>
                                                <input type="time" name="to_time" class="form-control"
                                                    value="{{ request('to_time') }}">
                                            </div>
                                            {{-- <div class="col-md-2">
                                            <label for="">Edge Computing</label>
                                            <select name="edge_computing_id" class="form-select">
                                                <option value=""></option>
                                            </select>
                                        </div> --}}
                                            <div class="col-md-2">
                                                <label for="">IoT Node</label>
                                                <select name="iot_node_id" autocomplete="off">
                                                    <option value="*">Semua</option>
                                                    @foreach ($nodes as $id => $number)
                                                        <option value="{{ $id }}">{{ $number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <button type="submut" class="btn btn-primary mt-4">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table fs-7">
                                <thead>
                                    <tr>
                                        <th rowspan="2">IoT Node</th>
                                        <th rowspan="2">Waktu</th>
                                        <th colspan="20" class="text-center">Data Telemetry</th>
                                    </tr>
                                    <tr>
                                        <th width="9.1%" align="center" class="text-center">Suhu Node</th>
                                        <th width="9.1%" align="center" class="text-center">Suhu Edge</th>
                                        <th width="9.1%" align="center" class="text-center">Dissolved Oxygen</th>
                                        <th width="9.1%" align="center" class="text-center">Turbidity</th>
                                        <th width="9.1%" align="center" class="text-center">EC/Salinity</th>
                                        <th width="9.1%" align="center" class="text-center">COD</th>
                                        <th width="9.1%" align="center" class="text-center">pH</th>
                                        <th width="9.1%" align="center" class="text-center">ORP</th>
                                        <th width="9.1%" align="center" class="text-center">TDS</th>
                                        <th width="9.1%" align="center" class="text-center">Nitrat</th>
                                        <th width="9.1%" align="center" class="text-center">Temperature Air</th>
                                        <th width="9.1%" align="center" class="text-center">TSS</th>
                                        <th width="9.1%" align="center" class="text-center">Debit air</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $row)
                                        <tr>
                                            <td>{{ $row->iot_node_serial_number }}</td>
                                            <td>{{ $row->created_at }}</td>
                                            <td align="center">{{ $row->temperature_node }}<small>°C</small></td>
                                            <td align="center">{{ $row->temperature_edge }}<small>°C</small></td>
                                            <td align="center">{{ number_format($row->dissolver_oxygen, 2) }}</td>
                                            <td align="center">{{ number_format($row->turbidity, 2) }}</td>
                                            <td align="center">{{ number_format($row->salinity, 2) }}</td>
                                            <td align="center">{{ number_format($row->cod, 2) }}<small>mg/L</small></td>
                                            <td align="center">{{ number_format($row->ph, 2) }}pH</td>
                                            <td align="center">{{ number_format($row->orp, 2) }}</td>
                                            <td align="center">{{ number_format($row->tds, 2) }}</td>
                                            <td align="center">{{ number_format($row->nitrat, 2) }}<small>mg/L</small></td>
                                            <td align="center">{{ $row->temperature_air }}<small>°C</small></td>
                                            <td align="center">{{ number_format($row->tss, 2) }}<small>mg/L</small></td>
                                            <td align="center">{{ $row->debit_air }}<small>m3/s</small></td>
                                        </tr>
                                    @empty
                                        -tidak ada data-, <a href="{{ route('report.rawMonitoring') }}"
                                            style="color: #1e88e5;">segarkan kembali</a>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('footer')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/js/tom-select.complete.min.js"></script>
@endpush

@push('script')
    <script>
        let objects = JSON.parse(`{!! json_encode($regions->toArray()) !!}`);
        let cityOptions = false;
        let iotNodesOptions = false;
        let selectedCityId = "{{ old('city_id') }}" || false;

        window.onload = function() {
            setCity(getRegionId(), selectedCityId);
            new TomSelect("[name='region_id']", {
                onChange: (id) => setCity(id)
            });
            iotNodesOptions = new TomSelect("[name='iot_node_id']");
        }

        function getRegionId() {
            return document.querySelector('[name="region_id"]').value;
        }

        function setCity(id, selected_id = false) {
            let object = objects.find(row => row.id == id);
            if (object) {
                let raw = '';
                for (let i = 0; i < object.cities.length; i++) {
                    raw +=
                        `<option value="${object.cities[i].id}" ${selected_id == object.cities[i].id ? 'selected' : ''} >${object.cities[i].name}</option>`;
                }
                if (raw.length !== '') setOptions(raw);
            }
        }

        function setOptions(element) {
            if (cityOptions) cityOptions.destroy();
            document.querySelector('[name="city_id"]').innerHTML = element;
            cityOptions = new TomSelect("[name='city_id']");
        }
    </script>
@endpush
