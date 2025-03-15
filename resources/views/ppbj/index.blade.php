@extends('layouts.app')

@section('content')
    <div class="col-md">
        <div class="card mb-6">
            <div class="card-header text-center">
                <h5 class="mb-0 me-sm-auto me-6">PROSES PENGADAAN BARANG DAN JASA<br>TAHUN ANGGARAN {{ session('ta') }}</h5>

            </div>
            <div class="card-body">
                <div class="row">
                    @if (session('hak_akses') != 'Superadmin')
                        <input type="hidden" id="id_unit_apbd" value="{{ session('ses_id_unit') }}">
                    @else
                        <div class="col-4">
                            <select id="id_unit_apbd" class="form-select form-select-sm">
                                <option value="">Pilih SKPD</option>
                                @foreach ($unit as $item)
                                    <option value="{{ $item->id_unit }}">{{ $item->nm_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="col-3">
                        <select id="bulan_apbd" class="form-select form-select-sm">
                            <option value="">Pilih Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <div id="btnApbd"></div>

                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <style>
                                table td,
                                table th {
                                    font-size: 0.8rem;
                                }
                            </style>
                            @include('ppbj.partial.tabel_ppbj')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('ppbj.partial.modal_ppbj_50')
    @include('ppbj.partial.modal_ppbj_200')
    @include('ppbj.partial.modal_ppbj_25')
@endsection

@section('style')
@endsection

@push('scripts')
    <script src="{{ asset('assets/custom_js/ppbj.js') . '?t=' . time() }}"></script>
@endpush
