<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        /** Define the margins of your page **/
        @page folio {
            margin-top: 50px;
            margin-left: 20px;
            margin-right: 20px;
            margin-bottom: 30px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 10px;
            right: 20px;
            height: 50px;

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
    <h2 class="text-center">TABEL REALISASI KEUANGAN DAN FISIK APBD {{ $unit->nm_unit }}</h2>
    <h2 class="text-center">

        Per
        {{ \Carbon\Carbon::create(session('ta'), $id_bln)->format('t') }}
        {{ strtoupper(\Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) }}
        {{ session('ta') }}

    </h2>
    <br>
    <table width="100%" border="1" cellpadding="2" cellspacing="0">
        <tr class="text-center text_td">
            <td rowspan="4" width="2%">No</td>
            <td rowspan="4" width="18%">PERANGKAT DAERAH</td>
            <td rowspan="4" width="8%">PAGU APBD (Rp.)</td>
            <td colspan="4">BELANJA OPERASI</td>
            <td colspan="4">BELANJA MODAL</td>
            <td colspan="4">BELANJA TIDAK TERDUGA</td>
            <td colspan="4">BELANJA TRANSFER</td>
            <td colspan="3">REALISASI APBD</td>
        </tr>
        <tr class="text-center text_td">
            <td rowspan="3" width="6%">PAGU BELANJA OPERASI (Rp.)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="4%">REAL FISIK (%)</td>
            <td rowspan="3" width="6%">PAGU BELANJA MODAL (Rp.)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="4%">REAL FISIK (%)</td>
            <td rowspan="3" width="6%">PAGU BELANJA TIDAK TERDUGA (Rp.)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="4%">REAL FISIK (%)</td>
            <td rowspan="3" width="6%">PAGU BELANJA TRANSFER (Rp.)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="4%">REAL FISIK (%)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="6%">REAL FISIK (%)</td>
        </tr>
        <tr></tr>
        <tr class="text-center text_td">
            <td width="4%">Rp</td>
            <td width="4%">(%)</td>
            <td width="4%">Rp</td>
            <td width="4%">(%)</td>
            <td width="4%">Rp</td>
            <td width="4%">(%)</td>
            <td width="4%">Rp</td>
            <td width="4%">(%)</td>
            <td width="8%">Rp</td>
            <td width="4%">(%)</td>
        </tr>
        <tr class="text-center text_td">
            <td>1</td>
            <td>2</td>
            <td>3=4+8+12+16</td>
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
            <td>18</td>
            <td>19</td>
            <td>20</td>
            <td>21</td>
            <td>22</td>
        </tr>
        @foreach ($apbd as $u)
            <tr class="text_utama">
                <td class="text-center text_td">1</td>
                <td>{{ $unit->nm_unit }}</td>
                <td class="text-right">{{ number_format($u->pg_apbd, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($u->pg_bl_op, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($u->rk_keu_op_rp, 0, ',', '.') }}</td>
                <td class="text-right">{{ $u->rk_keu_op_per }}</td>
                <td class="text-right">{{ $u->rf_op }}</td>
                <td class="text-right">{{ number_format($u->pg_bl_bm, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($u->rk_keu_bm_rp, 0, ',', '.') }}</td>
                <td class="text-right">{{ $u->rk_keu_bm_per }}</td>
                <td class="text-right">{{ $u->rf_bm }}</td>
                <td class="text-right">{{ number_format($u->pg_btt, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($u->rk_keu_btt_rp, 0, ',', '.') }}</td>
                <td class="text-right">{{ $u->rk_keu_btt_per }}</td>
                <td class="text-right">{{ $u->rf_btt }}</td>
                <td class="text-right">{{ number_format($u->pg_bl_bt, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($u->rk_keu_bt_rp, 0, ',', '.') }}</td>
                <td class="text-right">{{ $u->rk_keu_bt_per }}</td>
                <td class="text-right">{{ $u->rf_bt }}</td>
                <td class="text-right">{{ number_format($u->real_apbd, 0, ',', '.') }}</td>
                <td class="text-right">{{ $u->real_apbd_per }}</td>
                <td class="text-right">{{ $u->real_apbd_fisik }}</td>
            </tr>
        @endforeach
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
