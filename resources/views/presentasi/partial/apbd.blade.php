<div class="card mb-5">
    <div class="row">
        <div class="col-md-8 col-xxl-7">

            <h5 class="card-header text-center">TABEL REALISASI KEUANGAN DAN FISIK APBD</h5>
            <div class="card-body">
                <div id="status_apbd" class="mb-5"></div>
                <div class="table-responsive text-nowrap">
                    <table cellspacing="0" width="100%" class="table table-bordered">
                        <tbody>
                            <tr class="bg-light">
                                <th rowspan="2" width="25%" class="text-center">
                                    Keterangan</th>
                                <th rowspan="2" width="20%" class="text-center">Pagu
                                </th>
                                <th colspan="2" width="20%" class="text-center">
                                    &nbsp;Realisasi Keuangan&nbsp;</th>
                                <th rowspan="2" width="15%" class="text-center">
                                    &nbsp;Fisik (%)&nbsp;</th>
                            </tr>
                            <tr class="bg-light">
                                <th width="20%" class="text-center ">&nbsp;Rp&nbsp;</th>
                                <th width="15%" class="text-center ">&nbsp;%&nbsp;</th>

                            </tr>
                            <tr>
                                <th>Belanja Operasi</th>
                                <th class="text-right"><span id="pg_bl_op_presentasi"></span></th>
                                <th class="text-right bg-warning"><span id="rk_keu_op_rp_presentasi"></span></th>
                                <th class="text-right"><span id="rk_keu_op_per_presentasi"></span>
                                </th>
                                <th class="text-right"><span id="rf_op_presentasi"></span></th>
                            </tr>
                            <tr>
                                <th>Belanja Modal</th>
                                <th class="text-right"><span id="pg_bl_bm_presentasi"></span></th>
                                <th class="text-right bg-warning"><span id="rk_keu_bm_rp_presentasi"></span></th>
                                <th class="text-right"><span id="rk_keu_bm_per_presentasi"></span>
                                </th>
                                <th class="text-right"><span id="rf_bm_presentasi"></span></th>
                            </tr>
                            <tr>
                                <th>Belanja Tidak Terduga</th>
                                <th class="text-right"><span id="pg_btt_presentasi"></span></th>
                                <th class="text-right bg-warning"><span id="rk_keu_btt_rp_presentasi"></span></th>
                                <th class="text-right"><span id="rk_keu_btt_per_presentasi"></span></th>
                                <th class="text-right"><span id="rf_btt_presentasi"></span></th>
                            </tr>
                            <tr>
                                <th>Belanja Transfer</th>
                                <th class="text-right"><span id="pg_bl_bt_presentasi"></span></th>
                                <th class="text-right bg-warning"><span id="rk_keu_bt_rp_presentasi"></span></th>
                                <th class="text-right"><span id="rk_keu_bt_per_presentasi"></span>
                                </th>
                                <th class="text-right"><span id="rf_bt_presentasi"></span></th>
                            </tr>
                            <tr class="bg-warning">
                                <th>Total (BO+BM+BTT+BT)</th>
                                <th class="text-right"><span id="pg_apbd_presentasi"></span></th>
                                <th class="text-right"><span id="real_apbd_presentasi"></span>
                                </th>
                                <th class="text-right"><span id="real_apbd_per_presentasi"></span>
                                </th>
                                <th class="text-right"><span id="real_apbd_fisik_presentasi"></span></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-4 col-xxl-5">
            <div class="card-header header-elements">
                <h5 class="card-title mb-0">Grafik APBD</h5>

            </div>
            <div class="card-body">
                <canvas id="barChartApbdPresentasi" class="chartjs" data-height="400" height="400"
                    style="display: block; box-sizing: border-box; height: 350px; width: 644px;"
                    width="644"></canvas>
            </div>
        </div>
    </div>
</div>
