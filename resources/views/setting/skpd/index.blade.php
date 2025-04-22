@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row mb-5">
            <div class="card-body">
                @if (session('hak_akses') == 'Superadmin')
                    <button type="button" onClick="TambahSkpd(this)" class="btn btn-primary">+
                        SKPD</button>
                    <hr>
                @endif
                <div class="table-responsive">
                    <table id="TabelUnit" class="table table-bordered " width="100%">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">NO</th>
                                <th width="25%" class="text-center">SKPD</th>
                                <th width="25%" class="text-center">PIMPINAN</th>
                                <th width="25%" class="text-center">SETTING</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalSkpd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <h6 class="text-center">Edit SKPD
                    </h6>
                    <hr>

                    <form class="m-t-0" novalidate="" id="FormSkpd" method="post">

                        <div class="form-group mb-2 row">
                            <label for="example-text-input" class="col-3 col-form-label">SKPD</label>
                            <div class="col-8">
                                <input class="form-control" hidden type="text" id="id_unit" name="id_unit"
                                    id="example-text-input">
                                <input class="form-control" type="text" id="skpd" name="skpd"
                                    id="example-text-input">
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label for="example-text-input" class="col-3 col-form-label">Nama Pimpinan</label>
                            <div class="col-6">
                                <input class="form-control" type="text" id="pimpinan" name="pimpinan"
                                    id="example-text-input">
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="example-text-input" class="col-3 col-form-label">Status Kepala</label>
                            <div class="col-6">
                                <select class="form-control" name="stts_pimpinan" id="stts_pimpinan">
                                    <option value="">--Pilih--</option>
                                    <option value="Kepala">Pengguna Anggaran (Kepala)</option>
                                    <option value="Plt">Pelaksana Tugas (Plt)</option>
                                    <option value="Plh">Pelaksana Harian (Plh)</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-2 row">
                            <label for="example-text-input" class="col-3 col-form-label">NIP</label>
                            <div class="col-4">
                                <input class="form-control" type="text" id="nip" name="nip"
                                    id="example-text-input">
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label for="example-month-input2" class="col-3 col-form-label">Jabatan</label>
                            <div class="col-5">
                                <select class="form-control" id="gol" name="gol">
                                    <option selected="">Pilih</option>
                                    <option selected="Pembina Utama Madya (IV/d)">Pembina Utama Madya (IV/d)
                                    </option>
                                    <option selected="Pembina Utama Muda (IV/c)">Pembina Utama Muda (IV/c)</option>
                                    <option selected="Pembina Tingkat I (IV/b)">Pembina Tingkat I (IV/b)</option>
                                    <option selected="Pembina (IV/a)">Pembina (IV/a)</option>
                                    <option selected="Penata Tingkat I (III/d)">Penata Tingkat I (III/d)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <label for="example-text-input" class="col-3 col-form-label">Ditandatangani
                                oleh</label>
                            <div class="col-8">
                                <textarea class="form-control" rows="5" id="ttd" name="ttd"></textarea>
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



    <div class="modal fade" id="ModalPagu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <h3 class="text-center">Pengaturan Pagu SKPD
                    </h3>
                    <hr>

                    <form role="form" id="FormPagu" class="p-5">
                        <input type="text" hidden id="id_unit_pg" name="id_unit_pg" class="form-control">
                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Pagu Total</label>
                            <div class="col-sm-4">
                                <input type="text" readonly id="pg_apbd_pg" name="pg_apbd_pg"
                                    class="form-control rp readonly-bg">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Pagu Belanja
                                Operasi</label>
                            <div class="col-sm-4">
                                <input type="text" readonly id="pg_bl_op_pg" name="pg_bl_op_pg"
                                    class="form-control rp readonly-bg">
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Pagu Belanja
                                Pegawai</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bl_peg_pg" name="pg_bl_peg_pg"
                                    class="form-control pg rp pg_op">

                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bl_peg_disable"
                                        name="pg_bl_peg_disable">
                                    <label class="form-check-label" for="pg_bl_peg_disable">
                                        Matikan Input Realisasi Belanja Pegawai
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Pagu Belanja
                                Subsidi</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bl_sub_pg" name="pg_bl_sub_pg"
                                    class="form-control pg rp pg_op">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bl_sub_disable"
                                        name="pg_bl_sub_disable">
                                    <label class="form-check-label" for="pg_bl_sub_disable">
                                        Matikan Input Realisasi Belanja Subsidi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Barang dan
                                Jasa</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bl_bj_pg" name="pg_bl_bj_pg"
                                    class="form-control pg rp pg_op">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bl_bj_disable"
                                        name="pg_bl_bj_disable">
                                    <label class="form-check-label" for="pg_bl_bj_disable">
                                        Matikan Input Realisasi Belanja Barang dan Jasa
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Hibah</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bl_hibah_pg" name="pg_bl_hibah_pg"
                                    class="form-control pg rp pg_op">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bl_hibah_disable"
                                        name="pg_bl_hibah_disable">
                                    <label class="form-check-label" for="pg_bl_hibah_disable">
                                        Matikan Input Realisasi Belanja Hibah
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Bantuan
                                Sosial</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bl_bansos_pg" name="pg_bl_bansos_pg"
                                    class="form-control pg rp pg_op">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bl_bansos_disable"
                                        name="pg_bl_bansos_disable">
                                    <label class="form-check-label" for="pg_bl_bansos_disable">
                                        Matikan Input Realisasi Belanja Bantuan Sosial
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Pagu Belanja
                                Modal</label>
                            <div class="col-sm-4">
                                <input type="text" readonly id="pg_bl_bm_pg" name="pg_bl_bm_pg"
                                    class="form-control rp readonly-bg">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Modal
                                Tanah</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bm_tanah_pg" name="pg_bm_tanah_pg"
                                    class="form-control pg rp pg_bm">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bm_tanah_disable"
                                        name="pg_bm_tanah_disable">
                                    <label class="form-check-label" for="pg_bm_tanah_disable">
                                        Matikan Input Realisasi Belanja Modal Tanah
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Modal Gedung dan
                                Bangunan</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bm_gedung_pg" name="pg_bm_gedung_pg"
                                    class="form-control pg rp pg_bm">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bm_gedung_disable"
                                        name="pg_bm_gedung_disable">
                                    <label class="form-check-label" for="pg_bm_gedung_disable">
                                        Matikan Input Realisasi Belanja Modal Gedung dan Bangunan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Modal Jalan,
                                Jaringan, dan Irigasi</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bm_jalan_pg" name="pg_bm_jalan_pg"
                                    class="form-control pg rp pg_bm">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bm_jalan_disable"
                                        name="pg_bm_jalan_disable">
                                    <label class="form-check-label" for="pg_bm_jalan_disable">
                                        Matikan Input Belanja Modal Jalan, Jaringan, dan Irigasi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Modal Aset Tetap
                                Lainnya</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bm_aset_pg" name="pg_bm_aset_pg"
                                    class="form-control pg rp pg_bm">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bm_aset_disable"
                                        name="pg_bm_aset_disable">
                                    <label class="form-check-label" for="pg_bm_aset_disable">
                                        Matikan Input Belanja Modal Aset Tetap Lainnya
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Modal Peralatan
                                dan
                                Mesin</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bm_alat_mesin_pg" name="pg_bm_alat_mesin_pg"
                                    class="form-control pg rp pg_bm">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bm_alat_mesin_disable"
                                        name="pg_bm_alat_mesin_disable">
                                    <label class="form-check-label" for="pg_bm_alat_mesin_disable">
                                        Matikan Input Realisasi Belanja Modal Peralatan dan Mesin
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Pagu Belanja Tidak
                                Terduga</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_btt_pg" name="pg_btt_pg" class="form-control pg rp">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="btt_disable" name="btt_disable">
                                    <label class="form-check-label" for="btt_disable">
                                        Matikan Input Realisasi BTT
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Pagu Transfer</label>
                            <div class="col-sm-4">
                                <input type="text" readonly id="pg_bt_pg" name="pg_bt_pg"
                                    class="form-control rp readonly-bg">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Bagi
                                Hasil</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bl_bagi_hasil_pg" name="pg_bl_bagi_hasil_pg"
                                    class="form-control rp pg pg_bt">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bl_bagi_hasil_disable"
                                        name="pg_bl_bagi_hasil_disable">
                                    <label class="form-check-label" for="pg_bl_bagi_hasil_disable">
                                        Matikan Input Realisasi Belanja Bagi Hasil
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-3 col-form-label" for="example-input-normal">Belanja Bantuan
                                Keuangan</label>
                            <div class="col-sm-4">
                                <input type="text" id="pg_bl_bantuan_keu_pg" name="pg_bl_bantuan_keu_pg"
                                    class="form-control rp pg pg_bt">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="pg_bl_bantuan_keu_disable"
                                        name="pg_bl_bantuan_keu_disable">
                                    <label class="form-check-label" for="pg_bl_bantuan_keu_disable">
                                        Matikan Input Realisasi Belanja Bantuan Keuangan
                                    </label>
                                </div>
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


    <div class="modal fade" id="ModalSetUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <h6 class="text-center">Edit SKPD
                    </h6>
                    <hr>

                    <table id="TabelUser" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">NO</th>
                                <th width="25%" class="text-center">USERNAME</th>
                                <th width="25%" class="text-center">SETTING</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section('style')
    @endsection

    @push('scripts')
        <script src="{{ asset('assets/custom_js/skpd.js') . '?t=' . time() }}"></script>
    @endpush
