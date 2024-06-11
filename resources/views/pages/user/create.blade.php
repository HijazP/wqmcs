@extends('pages.layouts.app')

@push('header')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/col_4_layout.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold mb-0">Tambah data User</h5>
                    <p class="text-gray fs-7">Harap isi semua form input lalu klik tombol simpan.</p>
                    
                    {{-- Error Validation --}}
                    <x-error-validation-message errors="$errors" />

                    <form action="{{ route($route . 'store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukan Nama" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukan Email" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                            <div class="required fs-7 text-gray ps-2 pt-1">
                                <div>&check; Password minimal 6 digit</div>
                                <div>&check; Password wajib mengandung Angka numeric</div>
                                <div>&check; Password wajib mengandung huruf spesial</div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Role</label>
                            <input type="text" class="form-control" value="Petugas (default)" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Foto</label>
                            <input type="file" name="picture" class="form-control" accept="image/png, image/jpg, image/jpeg">
                            <small class="text-gray fw-bold" style="font-size:.7em;">* Opsional | Boleh dikosongkan</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" disabled>Simpan </button>
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

@push('script')
<script>
    let elemBtn = document.querySelector('button[type="submit"]');
    window.onload = function () {
        document.querySelector('input[name="password"]').addEventListener('keyup', function () {
            let {value}    = this;
            let elems      = document.querySelectorAll('.required div');
            let validation = [
                (value.length >= 6),
                /[0-9]/.test(value),
                /[^a-zA-Z0-9 ]/.test(value)
            ];

            for (let i = 0; i < 3; i++) {
                if (validation[i])  elems[i].classList.add('text-success', 'fw-bold');
                else elems[i].classList.remove('text-success', 'fw-bold');
            }

            if (validation.every(v => v)) {
                elemBtn.removeAttribute('disabled');
            } else {
                elemBtn.setAttribute('disabled', true)
            }
        });
    }
</script>
@endpush