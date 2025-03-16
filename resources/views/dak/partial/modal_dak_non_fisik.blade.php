<!-- Modal -->
<div class="modal fade" id="ModalDakNonFisik" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel1">Mekanisame dan Realisasi</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg">

                <form class="m-t-0" novalidate="" id="FormDakNonFisikInput" method="post">
                    <input type="text" hidden class="form-control" id="id_dak_non_fisik" name="id_dak_non_fisik">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-warning">
                                <label for="exampleInputEmail1">Kegiatan</label>
                                <input type="text" readonly class="form-control readonly-bg" id="keg_non_fisik"
                                    name="keg_non_fisik">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <h6>PERENCANAAN KEGIATAN </h6>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="exampleInputEmail1">Volume</label>
                                <input type="text" class="form-control" id="per_vol_non_fisik"
                                    name="per_vol_non_fisik">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="exampleInputEmail1">Satuan</label>
                                <input type="text" class="form-control" id="per_satuan_non_fisik"
                                    name="per_satuan_non_fisik">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="exampleInputEmail1">Jumlah Penerima Manfaat </label>
                                <input type="text" class="form-control " id="per_jlm_penerima_non_fisik"
                                    name="per_jlm_penerima_non_fisik">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-warning">
                                <label for="exampleInputEmail1">Pagu DAK Fisik (Rp)</label>
                                <input type="text" class="form-control rp readonly-bg" id="pagu_non_fisik"
                                    name="pagu_non_fisik">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6>MEKANISME PELAKSANAAN </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Jenis Mekanisme Pelaksanaan</label>

                            <div class="form-group ">
                                <select class="form-select form-select-sm" id="jns_mekanisme_non_fisik"
                                    name="jns_mekanisme_non_fisik">
                                    <option value="">--Pilih--</option>
                                    <option value="Swakelola">Swakelola</option>
                                    <option value="Kontraktual">Kontraktual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" hidden class="form-control" id="mek_metode_non_fisik"
                                name="mek_metode_non_fisik">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Swakelola</h6>
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="exampleInputEmail1">Volume</label>
                                    <input type="text" class="form-control cek_mekanisme" id="mek_vol_swa_non_fisik"
                                        name="mek_vol_swa_non_fisik">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="exampleInputEmail1">Nilai (Rp)</label>
                                    <input type="text" class="form-control rp cek_mekanisme"
                                        id="mek_nilai_swa_non_fisik" name="mek_nilai_swa_non_fisik">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Kontraktual</h6>
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="exampleInputEmail1">Volume</label>
                                    <input type="text" class="form-control cek_mekanisme" id="mek_vol_kon_non_fisik"
                                        name="mek_vol_kon_non_fisik">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="exampleInputEmail1">Nilai (Rp)</label>
                                    <input type="text" class="form-control rp cek_mekanisme"
                                        id="mek_nilai_kon_non_fisik" name="mek_nilai_kon_non_fisik">
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <h6>REALISASI </h6>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Keuangan (Rp)</label>

                            <div class="form-group ">
                                <input type="text" class="form-control rp" id="real_keu_non_fisik"
                                    name="real_keu_non_fisik">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1">Keu (%)</label>

                            <div class="form-group ">
                                <input type="text" readonly class="form-control decimal"
                                    id="real_keu_per_non_fisik" name="real_keu_per_non_fisik">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1">Fisik (%)</label>

                            <div class="form-group ">
                                <input type="text" class="form-control decimal" id="real_fik_non_fisik"
                                    name="real_fik_non_fisik">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Kodefikasi</label>

                            <div class="form-group ">
                                <textarea cols="5" class="form-control h-px-100" id="kodefikasi_non_fisik" name="kodefikasi_non_fisik"></textarea>
                            </div>
                        </div>

                    </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-secondary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
