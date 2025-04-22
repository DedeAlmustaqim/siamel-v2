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
    <h2 class="text-center">TABEL REALISASI PENDAPATAN {{ $pemda->pemda }}</h2>
    <h2 class="text-center">

        Per
        {{ \Carbon\Carbon::create(session('ta'), $id_bln)->format('t') }}
        {{ strtoupper(\Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) }}
        {{ session('ta') }}

    </h2>
    <br>

    <table width="100%" cellpadding="2" cellspacing="0" border="1">

        <tr class="text-center bg-primary text-white">
            <td width="5%"><b>NO</b></td>
            <td width="30%"><b>KETERANGAN</b></td>
            <td width="20%"><b>PAGU</b></td>
            <td width="20%"><b>REALISASI</b></td>
            <td width="11%"><b>%</b></td>
        </tr>
        <tr>
            <td class="text-center">1</td>
            <td><b>PENDAPATAN ASLI DAERAH</b></td>
            <td class="text-right"><?php echo Rupiah($pendapatan->pad_target); ?></span></td>
            <td class="text-right"><?php echo Rupiah($pendapatan->pad_real); ?></span></td>
            <td class="text-right"><?php echo number_format((float) $pendapatan->pad_real_per, 2, '.', ','); ?></span></td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td colspan="4"><b>PENDAPATAN TRANSFER</b></td>

        </tr>
        <tr>
            <td class="text-center">-</td>
            <td>TRANSFER PUSAT</td>
            <td class="text-right"><?php echo Rupiah($pendapatan->tp_target); ?></span></td>
            <td class="text-right"><?php echo Rupiah($pendapatan->tp_keu); ?></span></td>
            <td class="text-right"><?php echo number_format((float) $pendapatan->tp_per, 2, '.', ','); ?></span></td>
        </tr>
        <tr>
            <td class="text-center">-</td>
            <td>TRANSFER ANTAR DAERAH</td>
            <td class="text-right"><?php echo Rupiah($pendapatan->tad_target); ?></span></td>
            <td class="text-right"><?php echo Rupiah($pendapatan->tad_keu); ?></span></td>
            <td class="text-right"><?php echo number_format((float) $pendapatan->tad_per, 2, '.', ','); ?></td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td><b>LAIN - LAIN PENDAPATAN DAERAH YANG SAH</b></td>
            <td class="text-right"><?php echo Rupiah($pendapatan->pad_sah_target); ?></span></td>
            <td class="text-right"><?php echo Rupiah($pendapatan->pad_sah_keu); ?></span></td>
            <td class="text-right"><?php echo number_format((float) $pendapatan->pad_sah_per, 2, '.', ','); ?></span></td>
        </tr>
        <tr class="bg-warning">
            <td class="text-center ">4</td>
            <td><b>TARGET TOTAL</b></td>
            <td class="text-right"><?php echo Rupiah($pendapatan->target_total); ?></span></td>
            <td class="text-right"><?php echo Rupiah($pendapatan->keu_total); ?></span></td>
            <td class="text-right"><?php echo number_format((float) $pendapatan->keu_per_total, 2, '.', ','); ?></span></td>
        </tr>
    </table>
    <br><br><br><br>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td width="60%">&nbsp;</td>
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
                            <font size="10px">Printed by SIP Kab. Barito Timur <?php echo date('d-m-Y'); ?>
                                <?php echo date('H:i:s'); ?> WIB</font>
                        </u></i>
                </td>
                <td>
                    <i><u>
                            <font size="10px">{{ url('url', []) }}</font>
                        </u></i>
                </td>
            </tr>
        </table>
    </footer>
</body>

</html>
