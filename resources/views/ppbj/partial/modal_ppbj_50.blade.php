<!-- Modal -->
<div class="modal fade" id="ModalPpbj50" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <h6 class="text-center">
                    PROSES PENGADAAN BARANG DAN JASA PAKET NON STRATEGIS (>RP. 50 JUTA S/D Rp. 200 JUTA)
                </h6>
                <hr>
                <form novalidate="" id="FormPpbj50" method="post">
                    <input type="text" hidden class="form-control" id="id_unit" name="id_unit">
                    <input type="text" hidden class="form-control" id="id_bln" name="id_bln">


                    <div class="form-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">

                                        <label class="">JUMLAH PAKET</label>
                                        <input type="text" id="jml_pkt_50" name="jml_pkt_50" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label class="">JUMLAH PAGU (Rp.)</label>
                                        <input type="text" id="jml_pg_50" name="jml_pg_50" class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                        </div>
                        <hr>
                        <h6 class="">PEMILIHAN/PELAKSANAAN</h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">
                                        <label>PAKET</label>
                                        <input type="text" id="pl_pkt_50" name="pl_pkt_50" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label>Rp.</label>
                                        <input type="text" id="pl_rp_50" name="pl_rp_50" class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                        <hr>
                        <h6 class="">HASIL PEMILIHAN </h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">
                                        <label>PAKET</label>
                                        <input type="text" id="h_pl_pkt_50" name="h_pl_pkt_50" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label>Rp.</label>
                                        <input type="text" id="h_pl_rp_50" name="h_pl_rp_50" class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                        <hr>
                        <h6 class="">KONTRAK </h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">
                                        <label>PAKET</label>
                                        <input type="text" id="kontrak_pkt_50" name="kontrak_pkt_50"
                                            class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label>Rp.</label>
                                        <input type="text" id="kontrak_rp_50" name="kontrak_rp_50"
                                            class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                        <hr>
                        <h6 class="">SERAH TERIMA</h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">
                                        <label>PAKET</label>
                                        <input type="text" id="st_pkt_50" name="st_pkt_50" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label>Rp.</label>
                                        <input type="text" id="st_rp_50" name="st_rp_50" class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                        <hr>
                        <h6 class="">BELUM PENGADAAN </h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-warning">
                                        <label>PAKET</label>
                                        <input type="text" readonly id="bp_pkt_50" name="bp_pkt_50"
                                            class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-warning">
                                        <label>Rp.</label>
                                        <input type="text" readonly id="bp_rp_50" name="bp_rp_50"
                                            class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>

                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- sample modal content -->
{{-- <div class="modal fade" id="ModalPpbj50" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    <h3 id="NmBlnPpbj50"></h3>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5>PROSES PENGADAAN BARANG DAN JASA PAKET NON STRATEGIS (>RP. 50 JUTA S/D Rp. 200 JUTA)</h5>

                <form novalidate="" id="FormPpbj50" method="post">
                    <input type="text" class="form-control" id="id_unit" name="id_unit">
                    <input type="text" class="form-control" id="id_bln" name="id_bln">

                    <div class="form-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">

                                        <label class="">JUMLAH PAKET</label>
                                        <input type="text" id="jml_pkt_50" name="jml_pkt_50" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label class="">JUMLAH PAGU (Rp.)</label>
                                        <input type="text" id="jml_pg_50" name="jml_pg_50" class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                        </div>
                        <h6 class="">PEMILIHAN/PELAKSANAAN</h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">
                                        <label>PAKET</label>
                                        <input type="text" id="pl_pkt_50" name="pl_pkt_50" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label>Rp.</label>
                                        <input type="text" id="pl_rp_50" name="pl_rp_50" class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>

                        <h6 class="">HASIL PEMILIHAN </h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">
                                        <label>PAKET</label>
                                        <input type="text" id="h_pl_pkt_50" name="h_pl_pkt_50" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label>Rp.</label>
                                        <input type="text" id="h_pl_rp_50" name="h_pl_rp_50" class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>

                        <h6 class="">KONTRAK </h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">
                                        <label>PAKET</label>
                                        <input type="text" id="kontrak_pkt_50" name="kontrak_pkt_50"
                                            class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label>Rp.</label>
                                        <input type="text" id="kontrak_rp_50" name="kontrak_rp_50"
                                            class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>

                        <h6 class="">SERAH TERIMA</h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-success">
                                        <label>PAKET</label>
                                        <input type="text" id="st_pkt_50" name="st_pkt_50" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-success">
                                        <label>Rp.</label>
                                        <input type="text" id="st_rp_50" name="st_rp_50"
                                            class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>

                        <h6 class="">BELUM PENGADAAN </h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-warning">
                                        <label>PAKET</label>
                                        <input type="text" readonly id="bp_pkt_50" name="bp_pkt_50"
                                            class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-8">
                                    <div class="form-group has-warning">
                                        <label>Rp.</label>
                                        <input type="text" readonly id="bp_rp_50" name="bp_rp_50"
                                            class="form-control rp">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn waves-effect waves-light btn-success">Simpan</button>
                        <button type="reset" class="btn waves-effect waves-light btn-danger"
                            data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div> --}}
<!-- /.modal -->
