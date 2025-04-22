@extends('layouts.app')

@section('content')
    <div class="row mb-5">

        <div class="col-3">
            <label>Pilih Bulan</label>
            <select id="bulan" class="select2 form-select form-select-lg" data-allow-clear="true">
                <option value="" selected></option>
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
        <div class="col-9">
            <div id="btnRekap" class="mt-5"></div>
        </div>
    </div>

    @include('rekapitulasi.partial.apbd')

    @include('rekapitulasi.partial.pendapatan')
    @include('rekapitulasi.partial.ppbj')
    @include('rekapitulasi.partial.dak')
@endsection

@section('style')
@endsection

@push('scripts')
    <script src="{{ asset('assets/custom_js/rekapitulasi.js') . '?t=' . time() }}"></script>
@endpush
