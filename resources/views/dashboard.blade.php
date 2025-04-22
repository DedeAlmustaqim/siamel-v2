@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-xxl-12">
        <div class="card">
            <div class="d-flex align-items-center row">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="card-body">
                        <div class="panel-body text-center">
                            <img height="120px" src="{{ url('/') }}/assets/siamel.png" alt class="mb-5" />
                            <br>

                            <h5 class="text-uppercase">Selamat Datang di</h5>
                            <h5 class="text-uppercase">SISTEM INFORMASI ANGGARAN MONITORING EVALUASI DAN PELAPORAN (SIAMEL)
                            </h5>

                            <div style="color:black" class="alert alert-info mt-3" role="alert">
                                Aplikasi SIAMEL masih dalam tahap migrasi ke versi terbaru, silahkan laporkan
                                kepada tim pengembang jika Anda menemukan bug, atau error pada aplikasi.<br> Kami berusaha
                                keras untuk mengembangkan aplikasi SIAMEL ke versi terbaru, namun perlu waktu dan kerjasama
                                dari semua pihak. Terima kasih atas pengertian dan kerjasamanya.
                            </div>




                        </div>
                    </div>

                </div>
                <div class="col-md-6 order-2 order-md-1">
                    <div class="card-body">
                        <h5 class="mb-3 text-uppercase">
                            <i class="ri-information-line me-1"></i>Tentang
                        </h5>
                        <br>
                        <strong>SISTEM INFORMASI ANGGARAN MONITORING EVALUASI DAN PELAPORAN</strong>
                        <hr>
                        <p style="text-align: justify">SIAMEL (Sistem Informasi Anggaran Monitoring Evaluasi dan
                            Pelaporan) adalah sebuah
                            aplikasi berbasis web yang dikembangkan oleh BIDANG PERENCANAAN, PENGENDALIAN DAN EVALUASI
                            PEMBANGUNAN DAERAH BAPPLITBANGDA KAB. BARTIM dan bekerja sama dengan DINAS KOMUNIKASI,
                            INFORMATIKA DAN STATISTIK KABUPATEN BARITO TIMUR.</p>

                        <p style="text-align: justify">Dikembangkan dan dikelola secara mandiri oleh BIDANG PERENCANAAN,
                            PENGENDALIAN DAN EVALUASI
                            PEMBANGUNAN DAERAH BAPPLITBANGDA KAB. BARTIM dengan tujuan mempermudah perangkat daerah se-
                            Kabupaten Barito Timur untuk melakukan pelaporan realisasi anggaran per bulannya.</p>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
