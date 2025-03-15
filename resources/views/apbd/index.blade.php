@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-xxl-7">
        <div class="card">
            <h5 class="card-header text-center">TABEL REALISASI KEUANGAN DAN FISIK APBD<br>
                TAHUN ANGGARAN {{ session('ta') }}</h5>
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
                <div class="table-responsive text-nowrap">
                    <table cellspacing="0" width="100%" class="table table-bordered">
                        <tbody>
                            <tr class="bg-light">
                                <th rowspan="2" width="25%" class="text-center">Keterangan</th>
                                <th rowspan="2" width="20%" class="text-center">Pagu</th>
                                <th colspan="2" width="20%" class="text-center">&nbsp;Realisasi Keuangan&nbsp;</th>
                                <th rowspan="2" width="15%" class="text-center">&nbsp;Fisik (%)&nbsp;</th>
                            </tr>
                            <tr class="bg-light">
                                <th width="20%" class="text-center ">&nbsp;Rp&nbsp;</th>
                                <th width="15%" class="text-center ">&nbsp;%&nbsp;</th>

                            </tr>
                            <tr>
                                <th>Belanja Operasi</th>
                                <th class="text-right"><span id="pg_bl_op_detail"></span></th>
                                <th class="text-right bg-warning"><span id="rk_keu_op_rp_detail"></span></th>
                                <th class="text-right"><span id="rk_keu_op_per_detail"></span></th>
                                <th class="text-right"><span id="rf_op_detail"></span></th>
                            </tr>
                            <tr>
                                <th>Belanja Modal</th>
                                <th class="text-right"><span id="pg_bl_bm_detail"></span></th>
                                <th class="text-right bg-warning"><span id="rk_keu_bm_rp_detail"></span></th>
                                <th class="text-right"><span id="rk_keu_bm_per_detail"></span></th>
                                <th class="text-right"><span id="rf_bm_detail"></span></th>
                            </tr>
                            <tr>
                                <th>Belanja Tidak Terduga</th>
                                <th class="text-right"><span id="pg_btt_detail"></span></th>
                                <th class="text-right bg-warning"><span id="rk_keu_btt_rp_detail"></span></th>
                                <th class="text-right"><span id="rk_keu_btt_per_detail"></span></th>
                                <th class="text-right"><span id="rf_btt_detail"></span></th>
                            </tr>
                            <tr>
                                <th>Belanja Transfer</th>
                                <th class="text-right"><span id="pg_bl_bt_detail"></span></th>
                                <th class="text-right bg-warning"><span id="rk_keu_bt_rp_detail"></span></th>
                                <th class="text-right"><span id="rk_keu_bt_per_detail"></span></th>
                                <th class="text-right"><span id="rf_bt_detail"></span></th>
                            </tr>
                            <tr class="bg-warning">
                                <th>Total (BO+BM+BTT+BT)</th>
                                <th class="text-right"><span id="pg_apbd_detail"></span></th>
                                <th class="text-right"><span id="real_apbd_detail"></span></th>
                                <th class="text-right"><span id="real_apbd_per_detail"></span></th>
                                <th class="text-right"><span id="real_apbd_fisik_detail"></span></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xxl-5">
        <div class="card">
            <div class="card-header header-elements">
                <h5 class="card-title mb-0">Grafik APBD</h5>

            </div>
            <div class="card-body">
                <canvas id="barChartApbd" class="chartjs" data-height="400" height="400"
                    style="display: block; box-sizing: border-box; height: 400px; width: 644px;" width="644"></canvas>
            </div>
        </div>
    </div>
   @include('apbd.partial.modal')
@endsection

@section('style')
@endsection

@push('scripts')
    <script src="{{ asset('assets/custom_js/apbd.js') . '?t=' . time() }}"></script>
@endpush
