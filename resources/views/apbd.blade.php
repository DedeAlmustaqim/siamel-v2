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

            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalApbd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Input data APBD
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="" novalidate="" id="FormApbd" method="POST">
                        @csrf
                        <input type="text" hidden class="form-control form-control-sm" id="id_unit" name="id_unit">
                        <input type="text" hidden class="form-control form-control-sm" id="id_bln" name="id_bln">
                        <hr>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-left">Total APBD</h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-warning">
                                            <label class="form-label">Pagu APBD</label>
                                            <input type="text" readonly
                                                class="form-control form-control-sm readonly-bg" id="pg_apbd"
                                                name="pg_apbd">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-warning">
                                            <label class="form-label">Real. Keu (Rp)</label>
                                            <input type="text" readonly
                                                class="form-control form-control-sm readonly-bg" id="real_apbd"
                                                name="real_apbd">
                                            <span id="per_bln1"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-warning">
                                            <label class="form-label">Real. Keu (%)</label>
                                            <input type="text" readonly
                                                class="form-control form-control-sm decimal readonly-bg"
                                                id="real_apbd_per" name="real_apbd_per">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-warning">
                                            <label class="form-label">Real. Fisik (%)</label>
                                            <input type="text" readonly
                                                class="form-control form-control-sm decimal readonly-bg"
                                                id="real_apbd_fisik" name="real_apbd_fisik">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="card-body p-0">
                                <div class="nav-align-top">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link waves-effect active" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#belanja_operasi"
                                                aria-controls="navs-justified-new" aria-selected="true">
                                                Belanja Operasi
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link waves-effect" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#belanja_modal"
                                                aria-controls="navs-justified-link-preparing" aria-selected="false"
                                                tabindex="-1">
                                                Belanja Modal
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link waves-effect" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#btt_tab"
                                                aria-controls="navs-justified-link-shipping" aria-selected="false"
                                                tabindex="-1">
                                                Belanja Tidak Terduga
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link waves-effect" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#btf_tab"
                                                aria-controls="navs-justified-link-shipping" aria-selected="false"
                                                tabindex="-1">
                                                Belanja Transfer
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link waves-effect" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#permasalahan_tab"
                                                aria-controls="navs-justified-link-shipping" aria-selected="false"
                                                tabindex="-1">
                                                Permasalahan
                                            </button>
                                        </li>
                                        <span class="tab-slider" style="left: 0px; width: 126.55px; bottom: 0px;"></span>
                                    </ul>
                                    <div class="tab-content border-0 pb-0 px-6 mx-1">
                                        <div class="tab-pane fade active show" id="belanja_operasi" role="tabpanel">
                                            {{-- Belanja Operasi --}}
                                            <div class="row mb-5 ">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu Belanja Operasi</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_op" name="pg_bl_op">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text" readonly
                                                            class="form-control form-control-sm rp  readonly-bg"
                                                            id="rk_keu_op_rp" name="rk_keu_op_rp">add
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm readonly-bg"
                                                            id="rk_keu_op_per" name="rk_keu_op_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm decimal fisik  readonly-bg"
                                                            id="rf_op" name="rf_op">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rinci Belanja Operasi -->
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu Belanja Pegawai</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_peg" name="pg_bl_peg">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealOp"
                                                            id="rk_keu_peg_rp" name="rk_keu_peg_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm  readonly-bg"
                                                            id="rk_keu_peg_per" name="rk_keu_peg_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal rfOp fisik"
                                                            id="rf_peg" name="rf_peg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu Belanja Subsidi</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_sub" name="pg_bl_sub">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealOp"
                                                            id="rk_keu_sub_rp" name="rk_keu_sub_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm  readonly-bg"
                                                            id="rk_keu_sub_per" name="rk_keu_sub_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal rfOp fisik"
                                                            id="rf_sub" name="rf_sub">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-left"><u>Belanja Barang dan Jasa</u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_bj" name="pg_bl_bj">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealOp"
                                                            id="rk_keu_bj_rp" name="rk_keu_bj_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm  readonly-bg"
                                                            id="rk_keu_bj_per" name="rk_keu_bj_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal rfOp fisik"
                                                            id="rf_bj" name="rf_bj">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- hibah -->
                                            <h6 class="text-left"><u>Belanja Hibah</u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_hibah" name="pg_bl_hibah">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealOp"
                                                            id="rk_keu_hibah_rp" name="rk_keu_hibah_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm  readonly-bg"
                                                            id="rk_keu_hibah_per" name="rk_keu_hibah_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal rfOp fisik"
                                                            id="rf_hibah" name="rf_hibah">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Bantuan sosial -->
                                            <h6 class="text-left"><u>Belanja Bantuan Sosial</u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_bansos" name="pg_bl_bansos">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealOp"
                                                            id="rk_keu_bansos_rp" name="rk_keu_bansos_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm  readonly-bg"
                                                            id="rk_keu_bansos_per" name="rk_keu_bansos_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal rfOp fisik"
                                                            id="rf_bansos" name="rf_bansos">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="belanja_modal" role="tabpanel">
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_bm" name="pg_bl_bm">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text" readonly
                                                            class="form-control form-control-sm  rp  readonly-bg"
                                                            id="rk_keu_bm_rp" name="rk_keu_bm_rp">
                                                        <span id="per_bln3"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="form-control form-control-sm  readonly-bg"
                                                            id="rk_keu_bm_per" name="rk_keu_bm_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm decimal fisik  readonly-bg"
                                                            id="rf_bm" name="rf_bm">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-left"><u>Belanja Modal Tanah </u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bm_tanah" name="pg_bm_tanah">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealBm"
                                                            id="rk_keu_bm_tanah_rp" name="rk_keu_bm_tanah_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm readonly-bg"
                                                            id="rk_keu_bm_tanah_per" name="rk_keu_bm_tanah_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal fisik"
                                                            id="rf_bm_tanah" name="rf_bm_tanah">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-left"><u>Belanja Modal Peralatan dan Mesin </u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bm_alat_mesin" name="pg_bm_alat_mesin">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealBm"
                                                            id="rk_keu_alat_mesin_rp" name="rk_keu_alat_mesin_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm readonly-bg"
                                                            id="rk_keu_alat_mesin_per" name="rk_keu_alat_mesin_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal fisik"
                                                            id="rf_alat_mesin" name="rf_alat_mesin">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-left"><u>Belanja Modal Gedung dan Bangunan </u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bm_gedung" name="pg_bm_gedung">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealBm"
                                                            id="rk_keu_gedung_rp" name="rk_keu_gedung_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm readonly-bg"
                                                            id="rk_keu_gedung_per" name="rk_keu_gedung_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal fisik"
                                                            id="rf_gedung" name="rf_gedung">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-left"><u>Belanja Modal Jalan, Jaringan, dan Irigasi </u>
                                            </h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bm_jalan" name="pg_bm_jalan">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealBm"
                                                            id="rk_keu_jalan_rp" name="rk_keu_jalan_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm readonly-bg"
                                                            id="rk_keu_jalan_per" name="rk_keu_jalan_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal fisik"
                                                            id="rf_jalan" name="rf_jalan">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-left"><u>Belanja Modal Aset Tetap Lainnya </u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bm_aset" name="pg_bm_aset">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealBm"
                                                            id="rk_keu_aset_rp" name="rk_keu_aset_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm readonly-bg"
                                                            id="rk_keu_aset_per" name="rk_keu_aset_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal fisik"
                                                            id="rf_aset" name="rf_aset">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="btt_tab" role="tabpanel">
                                            {{-- Belanja tidak terduga --}}
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_btt" name="pg_btt">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp"
                                                            id="rk_keu_btt_rp" name="rk_keu_btt_rp">
                                                        <span id="per_bln4"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="form-control form-control-sm readonly-bg"
                                                            id="rk_keu_btt_per" name="rk_keu_btt_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal fisik"
                                                            id="rf_btt" name="rf_btt">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="btf_tab" role="tabpanel">
                                            <h5 class="text-center">Belanja Transfer</h5>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_bt" name="pg_bl_bt">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm rp readonly-bg"
                                                            id="rk_keu_bt_rp" name="rk_keu_bt_rp">
                                                        <span id="per_bln5"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="form-control form-control-sm readonly-bg"
                                                            id="rk_keu_bt_per" name="rk_keu_bt_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text" readonly
                                                            class="form-control form-control-sm decimal fisik readonly-bg"
                                                            id="rf_bt" name="rf_bt">
                                                    </div>
                                                </div>

                                            </div>
                                            <h6 class="text-left"><u>Belanja Bagi Hasil </u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_bagi_hasil" name="pg_bl_bagi_hasil">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealBt"
                                                            id="rk_keu_bagi_hasil_rp" name="rk_keu_bagi_hasil_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm readonly-bg"
                                                            id="rk_keu_bagi_hasil_per" name="rk_keu_bagi_hasil_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal fisik"
                                                            id="rf_bagi_hasil" name="rf_bagi_hasil">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-left"><u>Belanja Bantuan Keuangan</u></h6>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Pagu</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm sumapbd rp readonly-bg"
                                                            id="pg_bl_bantuan_keu" name="pg_bl_bantuan_keu">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Keu (Rp)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm apbd_real rp sumRealBt"
                                                            id="rk_keu_bantuan_keu_rp" name="rk_keu_bantuan_keu_rp">
                                                        <span id="per_bln2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-warning">
                                                        <label class="form-label">Real. Keu (%)</label>
                                                        <input type="text" readonly
                                                            class="decimal form-control form-control-sm readonly-bg"
                                                            id="rk_keu_bantuan_keu_per" name="rk_keu_bantuan_keu_per">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Real. Fisik (%)</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm decimal fisik"
                                                            id="rf_bantuan_keu" name="rf_bantuan_keu">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="permasalahan_tab" role="tabpanel">
                                            <div class="row mb-5">
                                                <div class="col-md-12">
                                                    <div class="form-group has-success">
                                                        <label class="form-label">Permasalahan</label>
                                                        <textarea class="form-control form-control-sm" rows="5" id="permasalahan" name="permasalahan"
                                                            aria-invalid="false"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn waves-effect waves-light btn-info  float-end">Simpan</button>
                        <button type="button" class="btn waves-effect waves-light btn-secondary float-end me-2"
                            data-bs-dismiss="modal">Batal</button>

                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('style')
    @endsection

    @push('scripts')
        <script src="{{ asset('assets/custom_js/apbd.js') }}"></script>
    @endpush
