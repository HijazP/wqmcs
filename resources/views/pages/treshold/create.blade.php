@extends('pages.layouts.app')

@push('header')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/col_4_layout.css') }}">
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/css/tom-select.css" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold mb-0">Tambah data Treshold</h5>
                    <p class="text-gray fs-7">Harap isi semua form input lalu klik tombol simpan.</p>

                    {{-- Error Validation --}}
                    <x-error-validation-message errors="$errors" />

                    <form action="{{ route('tresholds.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="iot_node_serial_number">IOT Node</label>
                            <select name="iot_node_serial_number" id="iot_node_serial_number" class="form-control" required>
                                @foreach ($nodes as $serial_number)
                                <option value="{{ $serial_number }}" {{ old('iot_node_serial_number') == $serial_number ? 'selected' : '' }}>
                                    {{ $serial_number }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="variable">Sensor</label>
                            <select name="variable" id="variable" class="form-control" required>
                                @foreach ($sensor as $sensors)
                                <option value="{{ $sensors->namaSensor }}" {{ old('variable') == $sensors->namaSensor ? 'selected' : '' }}>
                                    {{ $sensors->namaSensor }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Value Min </label>
                            <input type="text" name="value_min" class="form-control" value="{{ old('value_min') }}" placeholder="Masukan Value Min Treshold" >
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Value Max </label>
                            <input type="text" name="value_max" class="form-control" value="{{ old('value_max') }}" placeholder="Masukan Value Max Treshold" >
                        </div>
                        <div class="form-group mb-2">
                            <label for="rules">Rules Engine</label>
                            <select name="rules" id="rules" class="form-control">
                                <option selected>Pilih Rules</option>
                                <option value=">">></option>
                                <option value="<"><</option>
                                <option value=">=">>=</option>
                                <option value="<="><=</option>
                            </select>
                        </div>

                        {{-- <div class="form-group mb-2">
                            <label for="">Sama Dengan </label>
                            <input type="text" name="status_sama_dengan" class="form-control" value="{{ old('status_sama_dengan') }}" placeholder="Masukan Status" >
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Lebih Kecil </label>
                            <input type="text" name="status_lebih_kecil" class="form-control" value="{{ old('status_lebih_kecil') }}" placeholder="Masukan Status" >
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Lebih Besar </label>
                            <input type="text" name="status_lebih_besar" class="form-control" value="{{ old('status_lebih_besar') }}" placeholder="Masukan Status" >
                        </div> --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan </button>
                        </div>
                        <hr>
                        <div class="p-2 border-flat alert-info fw-bold" style="font-size:.8em; opacity:.9;">
                            <div>* Isi semua input dengan benar</div>
                        </div>
                    </form>
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

    window.onload = function () {
        new TomSelect("[name='region_id']");
    }

</script>
@endpush
