<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        /** Define the margins of your page **/
        @page folio {
            size: 215mm 330mm;
            margin: 10mm 10mm 10mm 10mm;
        }


        header {
            position: fixed;
            top: -60px;
            left: 10px;
            right: 10px;
            height: 50px;

            /** Extra personal styles **/
            color: #000000;
            text-align: center;
            line-height: 30px;
        }

        table {
            border-collapse: collapse;
            font-size: 14px;
        }



        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 80px;

            /** Extra personal styles **/
            color: #000000;
            text-align: left;
            line-height: 35px;
        }

        h1 {
            display: block;
            font-size: 24px;
            margin-top: 0.2em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h2 {
            display: block;
            font-size: 20px;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h3 {
            display: block;
            font-size: 1.0em;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h4 {
            display: block;
            font-size: 0.8em;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        .text_td {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            padding: 2;
        }

        .text_utama {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 8px;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            padding: 2;
        }


        .text-center {

            text-align: center;
        }

        .text-right {

            text-align: right;
        }

        .text-left {

            text-align: left;
        }

        .text-tr {
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>


<body>

    @php
        function rupiah($angka)
        {
            $hasil_rupiah = number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
        }
    @endphp
    @php
        $ta = session('ta');
        $bln = $id_bln;
    @endphp
    <h2 class="text-center">TABEL REALISASI KEUANGAN DAN FISIK APBD {{ $unit->nm_unit }}</h2>
    <h2 class="text-center">

        Per
        {{ \Carbon\Carbon::create(session('ta'), $id_bln)->format('t') }}
        {{ strtoupper(\Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) }}
        {{ session('ta') }}

    </h2>
    <br>
    <table width="100%" class="table table-bordered" border="1" cellpadding="5" cellspacing="5">
        <tr class="text-center text_td text-tr">
            <td rowspan="2" width="40%"> Uraian</td>
            <td rowspan="2" width="20%"> Pagu</td>
            <td colspan="3"> Realisasi</td>
        </tr>
        <tr class="text-center text_td text-tr">
            <td width="15%"> Keu. (Rp)</td>
            <td width="10%"> Keu. (%)</td>
            <td width="10%"> Fisik (%)</td>
        </tr>


        <tr class="text_td">
            <td><b>BELANJA OPERASI<b></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->pg_bl_op); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->rk_keu_op_rp); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->rk_keu_op_per; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->rf_op; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Pegawai</td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bl_peg); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_peg_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_peg_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_peg; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Subsidi</td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bl_sub); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_sub_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_sub_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_sub; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Barang dan Jasa</td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bl_bj); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_bj_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_bj_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_bj; ?></td>

        </tr>

        <tr class="text_td">
            <td>Belanja Hibah</td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bl_hibah); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_hibah_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_hibah_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_hibah; ?></td>

        </tr>

        <tr class="text_td">
            <td>Belanja Bantuan Sosial</td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bl_bansos); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_bansos_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_bansos_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_bansos; ?></td>

        </tr>
        <tr class="text_td">
            <td><b>BELANJA MODAL</b></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->pg_bl_bm); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->rk_keu_bm_rp); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->rk_keu_bm_per; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->rf_bm; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Modal Tanah</td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bm_tanah); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_bm_tanah_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_bm_tanah_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_bm_tanah; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Modal Peralatan dan Mesin</td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bm_alat_mesin); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_alat_mesin_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_alat_mesin_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_alat_mesin; ?></td>

        </tr>

        <tr class="text_td">
            <td>Belanja Modal Gedung dan Bangunan </td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bm_gedung); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_gedung_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_gedung_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_gedung; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Modal Jalan, Jaringan, dan Irigasi </td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bm_jalan); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_jalan_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_jalan_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_jalan; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Modal Aset Tetap Lainnya </td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bm_aset); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_aset_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_aset_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_aset; ?></td>

        </tr>

        <tr class="text_td">
            <td><b>BELANJA TIDAK TERDUGA</b></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->pg_btt); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->rk_keu_btt_rp); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->rk_keu_btt_per; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->rf_btt; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Tidak Terduga</td>
            <td class="text-right"><?php echo rupiah($apbd->pg_btt); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_btt_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_btt_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_btt; ?></td>

        </tr>
        <tr class="text_td">
            <td><b>BELANJA TRANSFER</b></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->pg_bl_bt); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->rk_keu_bt_rp); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->rk_keu_bt_per; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->rf_bt; ?></td>

        </tr>

        <tr class="text_td">
            <td>Belanja Bagi Hasil </td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bl_bagi_hasil); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_bagi_hasil_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_bagi_hasil_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_bagi_hasil; ?></td>

        </tr>
        <tr class="text_td">
            <td>Belanja Bantuan Keuangan </td>
            <td class="text-right"><?php echo rupiah($apbd->pg_bl_bantuan_keu); ?></td>
            <td class="text-right"><?php echo rupiah($apbd->rk_keu_bantuan_keu_rp); ?></td>
            <td class="text-right"><?php echo $apbd->rk_keu_bantuan_keu_per; ?></td>
            <td class="text-right"><?php echo $apbd->rf_bantuan_keu; ?></td>

        </tr>
        <tr class="text_td">
            <td style="font-size: 8;"><b>BELANJA (Operasi + Modal + Tidak Terduga + Transfer)<b></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->pg_apbd); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo rupiah($apbd->real_apbd); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->real_apbd_per; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo $apbd->real_apbd_fisik; ?></td>

        </tr>


    </table>


    <br><br>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td width="50%">&nbsp;</td>
                <?php if ($unit->ttd == null) {
                    $ttd_x = 'Mohon Setting pejabat yg menandatangani pada menu Setting->Profil Skpd<br>';
                } else {
                    $ttd_x = $unit->ttd;
                } ?>
                <td class="text-center">Tamiang Layang, {{ \Carbon\Carbon::now()->format('d') }}
                    {{ \Carbon\Carbon::now()->locale('id_ID')->monthName }}
                    <?php echo date('Y'); ?><br><?php echo $ttd_x; ?>&nbsp;<?php echo $unit->nm_unit; ?> :<br><br><br><br>
                    <font size="14px"><b><u><?php echo $unit->nm_pimpinan; ?></u></b></font>
                    <br><?php echo $unit->gol_jab; ?><br>NIP.<?php echo $unit->nip; ?>
                </td>
            </tr>
        </tbody>
    </table>




    <footer>
        <table width="100%">
            <tr>
                <td width="85%">
                    <i><u>
                            <font size="10px">Printed by SIAMEL {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}
                                WIB
                            </font>
                        </u></i>
                    </u></i>
                </td>
                <td>
                    <i><u>
                            <font size="10px">{{ url('/') }}</font>
                        </u></i>
                </td>
            </tr>
    </footer>
</body>

</html>
