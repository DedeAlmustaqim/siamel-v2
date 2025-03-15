<div class="modal fade" id="modalApbd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Input data APBD
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="FormApbd" method="POST">
                    @csrf
                    <input type="text" hidden class="form-control form-control-sm" id="id_unit" name="id_unit">
                    <input type="text" hidden class="form-control form-control-sm" id="id_bln" name="id_bln">
                    <hr>
                    <div class="">
                        <div class="card-header">


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
                                                        id="rk_keu_op_rp" name="rk_keu_op_rp">
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
</div>