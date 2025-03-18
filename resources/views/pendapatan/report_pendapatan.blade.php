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



    <h2 class="text-center">LAPORAN KEMAJUAN PELAKSANAAN KEGIATAN</h2>
    <h2 class="text-center">DANA ALOKASI KHUSUS ( DAK ) FISIK REGULER </h2>




    <h2 class="text-center">

        Per
        {{ \Carbon\Carbon::create(session('ta'), $id_bln)->format('t') }}
        {{ strtoupper(\Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) }}
        {{ session('ta') }}

    </h2>
    <br>
    SKPD : <?php echo $unit->nm_unit; ?>
    <table cellspacing="0" cellpadding="3" border="1" width="100%">

        <tr class="text-center text_utama">
            <td rowspan="3">NO</td>
            <td rowspan="3">OPD</td>
            <td rowspan="3">TARGET TOTAL (Rp)</td>
            <td colspan="2" rowspan="2">TOTAL</td>
            <td colspan="3" rowspan="2">PENDAPATAN ASLI DAERAH</td>
            <td colspan="6">PENDAPATAN TRANSFER</td>
            <td colspan="3" rowspan="2">LAIN - LAIN PENDAPATAN DAERAH YANG SAH</td>
        </tr>
        <tr class="text-center text_utama">
            <td colspan="3">TRANSFER PUSAT</td>
            <td colspan="3">TRANSFER ANTAR DAERAH</td>
        </tr>
        <tr class="text-center text_utama">
            <td>REALISASI (Rp)</td>
            <td>(%)</td>
            <td>TARGET (Rp)</td>
            <td>REALISASI (Rp)</td>
            <td>(%)</td>
            <td>TARGET  (Rp)</td>
            <td>REALISASI (Rp)</td>
            <td>(%)</td>
            <td>TARGET  (Rp)</td>
            <td>REALISASI (Rp)</td>
            <td>(%)</td>
            <td>TARGET (Rp)</td>
            <td>REALISASI (Rp)</td>
            <td>(%)</td>
        </tr>
        <tr class="text-center text_utama">
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>11</td>
            <td>12</td>
            <td>13</td>
            <td>14</td>
            <td>15</td>
            <td>16</td>
            <td>17</td>
        </tr>

        <tr class="text_utama">
            <td class="text-center" width="1%">1</td>
            <td width="12%"><?php echo $unit->nm_unit; ?></td>

            <td class="text-right">{{ number_format($pendapatan->target_total, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($pendapatan->keu_total, 0, ',', '.') }}</td>
            <td class="text-right">{{ $pendapatan->keu_per_total }}</td>

            <td class="text-right">{{ number_format($pendapatan->pad_target, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($pendapatan->pad_real, 0, ',', '.') }}</td>
            <td class="text-right">{{ $pendapatan->pad_real_per }}</td>

            <td class="text-right">{{ number_format($pendapatan->tp_target, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($pendapatan->tp_keu, 0, ',', '.') }}</td>
            <td class="text-right">{{ $pendapatan->tp_per }}</td>

            <td class="text-right">{{ number_format($pendapatan->tad_target, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($pendapatan->tad_keu, 0, ',', '.') }}</td>
            <td class="text-right">{{ $pendapatan->tad_per }}</td>

            <td class="text-right">{{ number_format($pendapatan->pad_sah_target, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($pendapatan->pad_sah_keu, 0, ',', '.') }}</td>
            <td class="text-right">{{ $pendapatan->pad_sah_per }}</td>

        </tr>

    </table>

    <br><br>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td width="75%">&nbsp;</td>
                <?php if ($unit->ttd == null) {
                    $ttd_x = 'Mohon Setting pejabat yg menandatangani pada menu Setting->Profil Skpd<br>';
                } else {
                    $ttd_x = $unit->ttd;
                } ?>
                <td class="text-center">Tamiang Layang, {{ \Carbon\Carbon::now()->format('d') }}
                    {{ \Carbon\Carbon::now()->locale('id_ID')->monthName }}
                    <?php echo date('Y'); ?><br><?php echo $ttd_x; ?>&nbsp;<?php echo $unit->nm_unit; ?> :

                    <br><br><br><br><br><br>
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
                            <font size="10px">Printed by SIAMEL
                                {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}
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
