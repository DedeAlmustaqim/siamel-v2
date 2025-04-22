<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        /** Define the margins of your page **/
        @page folio {
            size: 330mm 215mm;
            margin: 10mm 15mm 15mm 10mm;
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
            font-size: 8px;
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
            font-size: 10px;
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
    <h2 class="text-center">PROSES PENGADAAN BARANG DAN JASA PAKET STRATEGIS (>RP. 200 JUTA S/D Rp. 2,5 M)</h2>
    <h2 class="text-center">

        Per
        {{ \Carbon\Carbon::create(session('ta'), $id_bln)->format('t') }}
        {{ strtoupper(\Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) }}
        {{ session('ta') }}

    </h2>
    <br>
    <table border="1" width="100%" cellpadding="2" class="text_utama">
        <thead>

            <tr class="text-center">
                <td rowspan="4" width="3%">NO</td>
                <td rowspan="4" width="20%">SKPD</td>
                <td rowspan="4">JUMLAH PAKET</td>
                <td rowspan="4">JUMLAH PAGU (Rp.)</td>
                <td colspan="10">PROSES PENGADAAN</td>
            </tr>
            <tr class="text-center">
                <td colspan="8">SUDAH PENGADAAN</td>
                <td colspan="2" rowspan="2">BELUM PENGADAAN</td>
            </tr>
            <tr class="text-center">
                <td colspan="2" width="5%">PEMILIHAN/PELAKSANAAN</td>
                <td colspan="2">HASIL PEMILIHAN</td>
                <td colspan="2">KONTRAK</td>
                <td colspan="2">SERAH TERIMA</td>

            </tr>
            <tr class="text-center">
                <td>PAKET</td>
                <td>Rp.</td>
                <td>PAKET</td>
                <td>Rp.</td>
                <td>PAKET</td>
                <td>Rp.</td>
                <td>PAKET</td>
                <td>Rp.</td>
                <td>PAKET</td>
                <td>Rp.</td>
            </tr>
            <tr class="text-center">
                <td>(1)</td>
                <td>(2)</td>
                <td>(3)</td>
                <td>(4)</td>
                <td>(5)</td>
                <td>(6)</td>
                <td>(7)</td>
                <td>(8)</td>
                <td>(9)</td>
                <td>(10)</td>
                <td>(11)</td>
                <td>(12)</td>
                <td>(13)</td>
                <td>(14)</td>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <?php foreach ($ppbj200All as $u) { ?>

        <tr>
            <td align="center"><?php echo $no++; ?></td>
            <td><?php echo $u->nm_unit; ?></td>
            <td width="3%" class="text-center"><?php if ($u->jml_pkt_200 == 0) {
                echo '-';
            } else {
                echo $u->jml_pkt_200;
            } ?></td>
            <td class="text-right"><?php if ($u->jml_pg_200 == 0) {
                echo '-';
            } else {
                echo rupiah($u->jml_pg_200);
            } ?></td>
            <td width="3%" class="text-center"><?php if ($u->pl_pkt_200 == 0) {
                echo '-';
            } else {
                echo $u->pl_pkt_200;
            } ?></td>
            <td class="text-right"><?php if ($u->pl_rp_200 == 0) {
                echo '-';
            } else {
                echo rupiah($u->pl_rp_200);
            } ?></td>
            <td width="3%" class="text-center"><?php if ($u->h_pl_pkt_200 == 0) {
                echo '-';
            } else {
                echo $u->h_pl_pkt_200;
            } ?></td>
            <td class="text-right"><?php if ($u->h_pl_rp_200 == 0) {
                echo '-';
            } else {
                echo rupiah($u->h_pl_rp_200);
            } ?></td>
            <td width="3%" class="text-center"><?php if ($u->kontrak_pkt_200 == 0) {
                echo '-';
            } else {
                echo $u->kontrak_pkt_200;
            } ?></td>
            <td class="text-right"><?php if ($u->kontrak_rp_200 == 0) {
                echo '-';
            } else {
                echo rupiah($u->kontrak_rp_200);
            } ?></td>
            <td width="3%" class="text-center"><?php if ($u->st_pkt_200 == 0) {
                echo '-';
            } else {
                echo $u->st_pkt_200;
            } ?></td>
            <td class="text-right"><?php if ($u->st_rp_200 == 0) {
                echo '-';
            } else {
                echo rupiah($u->st_rp_200);
            } ?></td>
            <td width="3%" class="text-center"><?php if ($u->bp_pkt_200 == 0) {
                echo '-';
            } else {
                echo $u->bp_pkt_200;
            } ?></td>
            <td class="text-right"><?php if ($u->bp_rp_200 == 0) {
                echo '-';
            } else {
                echo rupiah($u->bp_rp_200);
            } ?></td>

        </tr>
        <?php } ?>

        <tr class="text-tr">
            <td colspan="3" class="text-center">TOTAL</td>
            <td class="text-right"><?php echo rupiah($total->jml_pg_200); ?></td>
            <td class="text-center"><?php echo $total->pl_pkt_200; ?></td>
            <td class="text-right"><?php echo rupiah($total->pl_rp_200); ?></td>
            <td class="text-center"><?php echo $total->h_pl_pkt_200; ?></td>
            <td class="text-right"><?php echo rupiah($total->h_pl_rp_200); ?></td>
            <td class="text-center"><?php echo $total->kontrak_pkt_200; ?></td>
            <td class="text-right"><?php echo rupiah($total->kontrak_rp_200); ?></td>
            <td class="text-center"><?php echo $total->st_pkt_200; ?></td>
            <td class="text-right"><?php echo rupiah($total->st_rp_200); ?></td>
            <td class="text-center"><?php echo $total->bp_pkt_200; ?></td>
            <td class="text-right"><?php echo rupiah($total->bp_rp_200); ?></td>
        </tr>

    </table>
    <br>
    <br>


    <table width="100%" border="0">
        <tbody>
            <tr>
                <td width="50%">&nbsp;</td>
                <?php if ($pemda->nm_institusi == null) {
                    $ttd_x = 'Mohon Setting pejabat yg menandatangani pada menu Setting->Profil Skpd<br>';
                } else {
                    $ttd_x = $pemda->nm_institusi;
                } ?>
                <td class="text-center">Tamiang Layang, {{ \Carbon\Carbon::now()->format('d') }}
                    {{ \Carbon\Carbon::now()->locale('id_ID')->monthName }}
                    <?php echo date('Y'); ?><br>KEPALA <?php echo $ttd_x; ?>&nbsp;<?php echo $pemda->pemda; ?>
                    :<br><br><br><br><br>
                    <font size="14px"><b><u><?php echo $pemda->nm_pimpinan; ?></u></b></font>
                    <br><?php echo $pemda->jabatan_gol; ?><br>NIP.<?php echo $pemda->nip; ?>
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
