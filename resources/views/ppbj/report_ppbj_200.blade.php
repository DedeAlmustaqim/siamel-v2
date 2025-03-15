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
            right: 20px;
            height: 200px;

            /** Extra personal styles **/
            color: #000000;
            text-align: center;
            line-height: 30px;
        }

        table {
            border-collapse: collapse;
            font-size: 11px;
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
    </style>
</head>


<body>
    @php
        $ta = session('ta');
        $bln = $id_bln;
    @endphp
    <h2 class="text-center">PAKET NON STRATEGIS (>RP. 200 JT S/D Rp. 2,5 M)
        <br>{{ $unit->nm_unit }}
    </h2>
    <h2 class="text-center">

        Per
        {{ \Carbon\Carbon::create(session('ta'), $id_bln)->format('t') }}
        {{ strtoupper(\Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) }}
        {{ session('ta') }}

    </h2>
    <br>

    <table border="1" width="100%" cellpadding="5">
        <thead>
            <tr class="text-center">
                <th rowspan="4" width="3%">NO</th>
                <th rowspan="4">SKPD</th>
                <th rowspan="4">JUMLAH PAKET</th>
                <th rowspan="4">JUMLAH PAGU (Rp.)</th>
                <th colspan="10">PROSES PENGADAAN</th>
            </tr>
            <tr class="text-center">
                <th colspan="8">SUDAH PENGADAAN</th>
                <th colspan="2">BELUM PENGADAAN</th>
            </tr>
            <tr class="text-center">
                <th colspan="2" width="5%">PEMILIHAN/PELAKSANAAN</th>
                <th colspan="2">HASIL PEMILIHAN</th>
                <th colspan="2">KONTRAK</th>
                <th colspan="2">SERAH TERIMA</th>
                <th>PAKET</th>
                <th>Rp.</th>
            </tr>
            <tr class="text-center">
                <th>PAKET</th>
                <th>Rp.</th>
                <th>PAKET</th>
                <th>Rp.</th>
                <th>PAKET</th>
                <th>Rp.</th>
                <th>PAKET</th>
                <th>Rp.</th>
                <th>PAKET</th>
                <th>Rp.</th>
            </tr>
            <tr class="text-center">
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13=3-5</th>
                <th>14=4-6</th>
            </tr>
        </thead>
        <tr>

            <th align="center" height="12%">1</th>
            <th width="20%">{{ $unit->nm_unit }}</th>
            <th width="3%" class="text-center">{{ $ppbj->jml_pkt_200 }}</th>
            <th class="text-right">{{ number_format($ppbj->jml_pg_200, 0, ',', '.') }}</th>
            <th width="3%" class="text-center">{{ $ppbj->pl_pkt_200 }}</th>
            <th class="text-right">{{ number_format($ppbj->pl_rp_200, 0, ',', '.') }}</th>
            <th width="3%" class="text-center">{{ $ppbj->h_pl_pkt_200 }}</th>
            <th class="text-right">{{ number_format($ppbj->h_pl_rp_200, 0, ',', '.') }}</th>
            <th width="3%" class="text-center">{{ $ppbj->kontrak_pkt_200 }}</th>
            <th class="text-right">{{ number_format($ppbj->kontrak_rp_200, 0, ',', '.') }}</th>
            <th width="3%" class="text-center">{{ $ppbj->st_pkt_200 }}</th>
            <th class="text-right">{{ number_format($ppbj->st_rp_200, 0, ',', '.') }}</th>
            <th width="3%" class="text-center">{{ $ppbj->bp_pkt_200 }}</th>
            <th class="text-right">{{ number_format($ppbj->bp_rp_200, 0, ',', '.') }}</th>

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
