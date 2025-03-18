@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-xxl-7">
        <div class="card">
            <h5 class="card-header text-center">{{ $title }}<br>
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
                        <div id="BtnNavigasiPd"></div>

                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered">

                        <tr class="text-center bg-light">
                            <td width="5%"><b>NO</b></td>
                            <td width="30%"><b>KETERANGAN</b></td>
                            <td width="20%"><b>PAGU</b></td>
                            <td width="20%"><b>REALISASI</b></td>
                            <td width="11%"><b>%</b></td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td><b>PENDAPATAN ASLI DAERAH</b></td>
                            <td class="text-right"><span id="pad_target_detail"></span></td>
                            <td class="text-right"><span id="pad_real_detail"></span></td>
                            <td class="text-right"><span id="pad_real_per_detail"></span></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td colspan="4"><b>PENDAPATAN TRANSFER</b></td>

                        </tr>
                        <tr>
                            <td class="text-center">-</td>
                            <td>TRANSFER PUSAT</td>
                            <td class="text-right"><span id="tp_target_detail"></span></td>
                            <td class="text-right"><span id="tp_keu_detail"></span></td>
                            <td class="text-right"><span id="tp_per_detail"></span></td>
                        </tr>
                        <tr>
                            <td class="text-center">-</td>
                            <td>TRANSFER ANTAR DAERAH</td>
                            <td class="text-right"><span id="tad_target_detail"></span></td>
                            <td class="text-right"><span id="tad_keu_detail"></span></td>
                            <td class="text-right"><span id="tad_per_detail"></span></td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td><b>LAIN - LAIN PENDAPATAN DAERAH YANG SAH</b></td>
                            <td class="text-right"><span id="pad_sah_target_detail"></span></td>
                            <td class="text-right"><span id="pad_sah_keu_detail"></span></td>
                            <td class="text-right"><span id="pad_sah_per_detail"></span></td>
                        </tr>
                        <tr class="bg-warning">
                            <td class="text-center ">4</td>
                            <td><b>TARGET TOTAL</b></td>
                            <td class="text-right"><span id="target_total_detail"></span></td>
                            <td class="text-right"><span id="keu_total_detail"></span></td>
                            <td class="text-right"><span id="keu_per_total_detail"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xxl-5">
        <div class="card">
            <div class="card-header header-elements">
                <h5 class="card-title mb-0">Grafik Pendapatan</h5>

            </div>
            <div class="card-body">
                <canvas id="barChartPendapatan" class="chartjs" data-height="450px" height="450px"
                    style="display: block; box-sizing: border-box; height: 450px; width: 644px;" width="644"></canvas>
            </div>
        </div>
    </div>
    @include('pendapatan.partial.modal_pendapatan')
@endsection

@section('style')
@endsection

@push('scripts')
    <script src="{{ asset('assets/custom_js/pendapatan.js') . '?t=' . time() }}"></script>
@endpush
