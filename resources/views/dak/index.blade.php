@extends('layouts.app')

@section('content')
    <div class="card h-100">
        <div class="card-header">
            <h5 class="mb-0 me-sm-auto me-6 text-center">{{ $title }} <br>TAHUN ANGGARAN {{ session('ta') }}</h5>


        </div>
        <div class="card-body p-2">
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
                    <span id="BtnDakFisik"></span>
                    <span id="BtnDakNonFisik"></span>

                </div>
            </div>
            <hr>
            <style>

            </style>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr class="text-center">
                            <td width="2%" rowspan="3">NO.</td>
                            <td width="30%" rowspan="3">UB BIDANG/KEGIATAN</td>
                            <td rowspan="2" width="10%">Pagu DAK Fisik / Non Fisik (Rp)</td>
                            <td colspan="3" width="30%">REALISASI</td>
                            <td width="8%" rowspan="3">AKSI</td>
                        </tr>
                        <tr class="text-center ">
                            <td width="8%">Keuangan</td>
                            <td width="5%">%</td>
                            <td width="5%">Fisik (%)</td>
                        </tr>
                    </thead>
                    <tbody id="show_dak_fisik"></tbody>
                    <tbody id="show_dak_non_fisik"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@push('scripts')
    <script src="{{ asset('assets/custom_js/dak.js') . '?t=' . time() }}"></script>
@endpush
