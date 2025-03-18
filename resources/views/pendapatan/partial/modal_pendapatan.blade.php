<!-- sample modal content -->
<div class="modal fade" id="ModalPd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h6 class="modal-title mb-2" id="myLargeModalLabel">
                    Form Pendapatan {{ session('ses_nm_unit') }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="m-t-0" novalidate="" id="FormPd" method="post">
                    <input type="text" hidden class="form-control form-control-sm" id="id_unit_pd" name="id_unit_pd">
                    <input type="text" hidden class="form-control form-control-sm" id="id_bln_pd" name="id_bln_pd">


                    <h6 class="text-left">TOTAL PENDAPATAN</h6>


                    <div class="row show-grid">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">TARGET TOTAL (Rp)</label>
                                <input type="text" readonly class="form-control form-control-sm rp" id="target_total"
                                    name="target_total">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Real. Keu (Rp)</label>
                                <input type="text" readonly class="form-control form-control-sm rp" id="keu_total"
                                    name="keu_total">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Real. Keu (%)</label>
                                <input type="text" readonly class="form-control form-control-sm rp"
                                    id="keu_per_total" name="keu_per_total">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <h6>PENDAPATAN ASLI DAERAH</h6>

                    <div class="row show-grid">
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="form-label">TARGET (Rp)</label>
                                <input type="text" class="form-control form-control-sm rp sumpd" id="pad_target"
                                    name="pad_target">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="form-label">Real. Keu (Rp)</label>
                                <input type="text" class="form-control form-control-sm rp keu" id="pad_real"
                                    name="pad_real">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Real. Keu (%)</label>
                                <input type="text" readonly class="form-control form-control-sm" id="pad_real_per"
                                    name="pad_real_per">
                            </div>
                        </div>

                    </div>

                    <hr>
                    <h6>TRANSFER PUSAT</h6>
                    <div class="row show-grid">
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="form-label">TARGET (Rp)</label>
                                <input type="text" class="form-control form-control-sm rp sumpd" id="tp_target"
                                    name="tp_target">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="form-label">Real. Keu (Rp)</label>
                                <input type="text" class="form-control form-control-sm rp keu" id="tp_keu"
                                    name="tp_keu">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Real. Keu (%)</label>
                                <input type="text" readonly class="form-control form-control-sm" id="tp_per"
                                    name="tp_per">
                            </div>
                        </div>

                    </div>

                    <hr>
                    <h6>TRANSFER ANTAR DAERAH</h6>
                    <div class="row show-grid">
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="form-label">TARGET (Rp)</label>
                                <input type="text" class="form-control form-control-sm rp sumpd" id="tad_target"
                                    name="tad_target">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="form-label">Real. Keu (Rp)</label>
                                <input type="text" class="form-control form-control-sm rp keu" id="tad_keu"
                                    name="tad_keu">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Real. Keu (%)</label>
                                <input type="text" readonly class="form-control form-control-sm" id="tad_per"
                                    name="tad_per">
                            </div>
                        </div>

                    </div>

                    <hr>
                    <h6>LAIN - LAIN PENDAPATAN DAERAH YANG SAH</h6>
                    <div class="row show-grid">
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="form-label">TARGET (Rp)</label>
                                <input type="text" class="form-control form-control-sm rp sumpd"
                                    id="pad_sah_target" name="pad_sah_target">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="form-label">Real. Keu (Rp)</label>
                                <input type="text" class="form-control form-control-sm rp keu" id="pad_sah_keu"
                                    name="pad_sah_keu">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Real. Keu (%)</label>
                                <input type="text" readonly class="form-control form-control-sm rp"
                                    id="pad_sah_per" name="pad_sah_per">
                            </div>
                        </div>

                    </div>
                    <hr>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-secondary">Simpan</button>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- /.modal -->
