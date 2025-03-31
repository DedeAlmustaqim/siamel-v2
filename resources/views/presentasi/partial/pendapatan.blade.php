<div class="row mb-5">
    <div class="col-md-8 col-xxl-7">
        <div class="card">
            <h5 class="card-header text-center">TABEL REALISASI PENDAPATAN</h5>
            <div class="card-body">
                <div id="status_pd" class="mb-5"></div>
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
                <canvas id="barChartPendapatan" class="chartjs" data-height="400" height="400"
                    style="display: block; box-sizing: border-box; height: 390px; width: 644px;"
                    width="644"></canvas>
            </div>
        </div>
    </div>
</div>
