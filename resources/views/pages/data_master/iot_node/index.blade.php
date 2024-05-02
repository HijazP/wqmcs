@extends('pages.layouts.app')

@php
 use Carbon\Carbon;
@endphp

@section('content')
<style>
    .box img.picture {
        height: 90px;
        object-fit: cover;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bolder mb-0">Data IOT Node</h5>
                            <p class="text-gray fs-7">Total {{ $data->count() }} data IOT Node yang ada di aplikasi.</p>
                        </div>
                        <div>
                            <a href="{{ route($route . 'create') }}" class="btn btn-primary btn-sm fw-bold">Tambah data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    {{-- Searching & Filtering --}}
                    <form id="form-filter" action="" method="GET">
                        <div class="row mt-2" style="font-size: .8em;">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="search" name="search" class="form-control border-flat" placeholder="Cari berdasarkan nomor serial atau alamat" style="font-size:.95em;" value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" name="filter" value="{{ request('filter') ?? 1 }}">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:1em;">
                                        @if(request('filter'))
                                            @if(request('filter') == 1)
                                            Tampilkan Semua
                                            @elseif(request('filter') == 2)
                                            Sudah Diaktivasi
                                            @elseif(request('filter') == 3)
                                            Belum Diaktivasi
                                            @endif
                                        @else
                                        Tampilkan Semua
                                        @endif
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-filter border shadow" aria-labelledby="dropdownMenuButton1" style="font-size:1em;">
                                      <li><a class="dropdown-item" data-filter="1" href="#" >Tampilkan Semua</a></li>
                                      <li><a class="dropdown-item" data-filter="2" href="#">Sudah diaktivasi</a></li>
                                      <li><a class="dropdown-item" data-filter="3" href="#">Belum diaktivasi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Alert Message --}}
                    @if(session()->has('success'))
                    <div class="row">
                        <div class="col-md-12">
                            <x-success-message action="{{ session()->get('success') }}" />
                        </div>
                    </div>
                    @endif

                    {{-- Row Data --}}
                    <div class="row mt-3" style="font-size: .8em;">
                        @forelse($data as $row)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route($route . 'show', $row->id) }}" class="unstyled text-decoration-none">
                                <div class="box border rounded">
                                    <img src="{{ asset($row->picture ?? 'images/default_404.png') }}" alt="picture" class="picture" width="100%">
                                    <div class="py-2 px-2">
                                        <div class="px-1">
                                            <span class="badge rounded-pill bg-outline-{{ $row->activated_at ? 'success' : 'warning' }}">
                                                {{ $row->activated_at ? 'Sudah' : 'Belum' }} diaktivasi
                                            </span>
                                            <h6 class="mt-2">{{ $row->serial_number }}</h6>
                                            <p class="text-gray">
                                                <img src="{{ asset('svg/icon/map-pin.svg') }}" alt="ic" width="15px">
                                                <td>{{ $row->city ? $row->city->name : 'undefined' }}, {{ $row->city && $row->city->region ? $row->city->region->name : 'undefined'}}</td>
                                            </p>
                                            @if($row->activated_at && $row->expired_at)
                                                @php
                                                $expirted_at = Carbon::parse($row->expired_at);
                                                $deadline = Carbon::parse($row->expired_at)->subDays(30);

                                                $hari = now();

                                                if ($hari->gte($deadline)) {
                                                    echo "<small class='text-danger'>Masa aktivasi akan segera habis!</small> (" . $hari->diffInDays($deadline) . "hari )";
                                                }
                                                @endphp
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @empty
                        <p>- Tidak ada data ditemukan. -</p>
                        @endforelse

                        {{-- Pagination --}}
                        <div class="text-center">
                            {{ $data->links() }}
                        </div>
                    </div>
                    {{-- End Row Data --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    window.onload = function () {
        document.querySelectorAll('.dropdown-menu-filter li a')
            .forEach(el => {
                el.addEventListener('click', function (e) {
                    document.querySelector('[name="filter"]').value = this.getAttribute('data-filter');
                    document.getElementById('form-filter').submit();

                    e.preventDefault();
                });
            });
    }
</script>
@endpush
