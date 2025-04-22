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
    <h2 class="text-center">TABEL REALISASI KEUANGAN DAN FISIK APBD {{ $pemda->pemda }}</h2>
    <h2 class="text-center">

        Per
        {{ \Carbon\Carbon::create(session('ta'), $id_bln)->format('t') }}
        {{ strtoupper(\Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) }}
        {{ session('ta') }}

    </h2>
    <br>
    <table width="100%" border="1" cellpadding="2" cellspacing="0">

        <tr class="text-center text_td">
            <td rowspan="4" width="1%">No</td>
            <td rowspan="4" width="15%">PERANGKAT DAERAH</td>
            <td rowspan="4" width="6%">PAGU APBD (Rp.)</td>
            <td height="3%" colspan="4">BELANJA OPERASI</td>
            <td colspan="4">BELANJA MODAL</td>
            <td colspan="4">BELANJA TIDAK TERDUGA</td>
            <td colspan="4">BELANJA TRANSFER</td>
            <td colspan="3">REALISASI APBD</td>
        </tr>
        <tr class="text-center text_td">
            <td rowspan="3" width="5%">PAGU BELANJA OPERASI (Rp.)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="3%">REAL FISIK (%)</td>
            <td rowspan="3" width="5%">PAGU BELANJA MODAL (Rp.)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="3%">REAL FISIK (%)</td>
            <td rowspan="3" width="5%">PAGU BELANJA TIDAK TERDUGA (Rp.)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="3%">REAL FISIK (%)</td>
            <td rowspan="3" width="5%">PAGU BELANJA TRANSFER (Rp.)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="3%">REAL FISIK (%)</td>
            <td colspan="2" rowspan="2">REALISASI KEUANGAN</td>
            <td rowspan="3" width="5%">REAL FISIK (%)</td>
        </tr>
        <tr> </tr>
        <tr class="text-center text_td">
            <td width="1%">Rp</td>
            <td width="3%">(%)</td>
            <td width="1%">Rp</td>
            <td width="3%">(%)</td>
            <td width="1%">Rp</td>
            <td width="3%">(%)</td>
            <td width="1%">Rp</td>
            <td width="3%">(%)</td>
            <td width="6%">Rp</td>
            <td width="3%">(%)</td>
        </tr>

        <tr class="text-center text_td">
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
            <td>(15)</td>
            <td>(16)</td>
            <td>(17)</td>
            <td>(18)</td>
            <td>(19)</td>
            <td>(20)</td>
            <td>(21)</td>
            <td>(22)</td>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($apbd as $u) { ?>

        <tr class="text_utama">
            <td class="text-center text_td"><?php echo $no++; ?></td>
            <td width="20%"><?php echo $u->nm_unit; ?></td>
            <td class="text-right" width="7%"><?php if ($u->pg_apbd == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->pg_apbd);
                                                                                                } ?></td>
            <td class="text-right" width="7%"><?php if ($u->pg_bl_op == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->pg_bl_op);
                                                                                                } ?></td>
            <td class="text-right" width="7%"><?php if ($u->rk_keu_op_rp == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->rk_keu_op_rp);
                                                                                                    } ?></td>
            <td class="text-center" width="1%"><?php if ($u->rk_keu_op_per == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->rk_keu_op_per, 2);
                                                                                                        } ?></td>
            <td class="text-center" width="1%"><?php if ($u->rf_op == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->rf_op, 2);
                                                                                                } ?></td>
            <td class="text-right" width="1%"><?php if ($u->pg_bl_bm == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->pg_bl_bm);
                                                                                                } ?></td>
            <td class="text-right" width="7%"><?php if ($u->rk_keu_bm_rp == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->rk_keu_bm_rp);
                                                                                                    } ?></td>
            <td class="text-center" width="1%"><?php if ($u->rk_keu_bm_per == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->rk_keu_bm_per, 2);
                                                                                                        } ?></td>
            <td class="text-center" width="1%"><?php if ($u->rf_bm == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->rf_bm, 2);
                                                                                                } ?></td>
            <td class="text-right" width="7%"><?php if ($u->pg_btt == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->pg_btt);
                                                                                                } ?></td>
            <td class="text-right" width="7%"><?php if ($u->rk_keu_btt_rp == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->rk_keu_btt_rp);
                                                                                                    } ?></td>
            <td class="text-center" width="1%"><?php if ($u->rk_keu_btt_per == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->rk_keu_btt_per, 2);
                                                                                                        }  ?></td>
            <td class="text-center" width="1%"><?php if ($u->rf_btt == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->rf_btt, 2);
                                                                                                }  ?></td>
            <td class="text-right" width="7%"><?php if ($u->pg_btt == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->pg_bl_bt);
                                                                                                } ?></td>
            <td class="text-right" width="7%"><?php if ($u->rk_keu_bt_rp == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->rk_keu_bt_rp);
                                                                                                    } ?></td>
            <td class="text-center" width="1%"><?php if ($u->rk_keu_bt_per == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->rk_keu_bt_per);
                                                                                                        }  ?></td>
            <td class="text-center" width="1%"><?php if ($u->rf_bt == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->rf_bt, 2);
                                                                                                }  ?></td>
            <td class="text-right" width="7%"><?php if ($u->real_apbd == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo rupiah($u->real_apbd);
                                                                                                } ?></td>
            <td class="text-center" width="1%"><?php if ($u->real_apbd_per == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->real_apbd_per, 2);
                                                                                                        }  ?></td>
            <td class="text-center" width="1%"><?php if ($u->real_apbd_fisik == 0) {
                                                        echo "-";
                                                    } else { ?><?php echo round($u->real_apbd_fisik, 2);
                                                                                                        }  ?></td>
        </tr>
        <?php } ?>
        <tr class="text_utama">
            <td colspan="2" class="text-center"><b>Jumlah</b></td>
            <td class="text-right"><b><?php if ($apbdTotal['pg_apbd'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['pg_apbd']);
                                                                            } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['pg_bl_op'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['pg_bl_op']);
                                                                                } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['rk_keu_op_rp'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['rk_keu_op_rp']);
                                                                                    } ?></b></td>
            <td class="text-center"><b><?php if ($apbdTotal['rk_keu_op_per'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo $apbdTotal['rk_keu_op_per'];
                                                                                    } ?></b></td>
            <td class="text-center"><b><?php if ($apbdTotal['rf_op'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo $apbdTotal['rf_op'];
                                                                            } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['pg_bl_bm'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['pg_bl_bm']);
                                                                                } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['rk_keu_bm_rp'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['rk_keu_bm_rp']);
                                                                                    } ?></b></td>
            <td class="text-center"><b><?php if ($apbdTotal['rk_keu_bm_per'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo $apbdTotal['rk_keu_bm_per'];
                                                                                    } ?></b></td>
            <td class="text-center"><b><?php if ($apbdTotal['rf_bm'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo $apbdTotal['rf_bm'];
                                                                            } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['pg_btt'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['pg_btt']);
                                                                            } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['rk_keu_btt_rp'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['rk_keu_btt_rp']);
                                                                                    } ?></b></td>
            <td class="text-center"><b><?php if ($apbdTotal['rk_keu_btt_per'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo $apbdTotal['rk_keu_btt_per'];
                                                                                    } ?></b></td>
            <td class="text-center"><b><?php if ($apbdTotal['rf_btt'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo $apbdTotal['rf_btt'];
                                                                            } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['pg_bl_bt'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['pg_bl_bt']);
                                                                            } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['rk_keu_bt_rp'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['rk_keu_bt_rp']);
                                                                                    } ?></b></td>
            <td class="text-center"><b><?php if ($apbdTotal['rk_keu_bt_per'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo $apbdTotal['rk_keu_bt_per'];
                                                                                    } ?></b></td>
            <td class="text-center"><b><?php if ($apbdTotal['rf_bt'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo $apbdTotal['rf_bt'];
                                                                            } ?></b></td>
            <td class="text-right"><b><?php if ($apbdTotal['real_apbd'] == 0) {
                                        echo "-";
                                    } else { ?><?php echo rupiah($apbdTotal['real_apbd']);
                                                                                } ?></b></td>
            <td class="text-center"><b><?php echo $apbdTotal['real_apbd_per']; ?></b></td>
            <td class="text-center"><b><?php echo $apbdTotal['real_apbd_fisik']; ?></b></td>


        </tr>
    </table> <br><br>
    <br>
    <table cellspacing="0" cellpadding="2" border="1">

        <tr class="text_utama">
            <td rowspan="2" class="text-center">REALISASI APBD</td>
            <td rowspan="2" width="60" class="text-center">Pagu</td>
            <td colspan="2" class="text-center"> Realisasi Keuangan </td>
            <td rowspan="2" class="text-center"> Realisasi Fisik (%) </td>
        </tr>
        <tr class="text_utama">
            <td class="text-center" width="60"> Rp </td>
            <td class="text-center"> % </td>
        </tr>
        <tr class="text_utama">
            <td>Belanja Operasi</td>
            <td class="text-right"><?php echo rupiah($apbdTotal['pg_bl_op']); ?></span></td>
            <td class="text-right"><?php echo rupiah($apbdTotal['rk_keu_op_rp']); ?></span></td>
            <td class="text-center"><?php echo $apbdTotal['rk_keu_op_per']; ?></td>
            <td class="text-right"><?php echo $apbdTotal['rf_op']; ?></td>
        </tr>
        <tr class="text_utama">
            <td>Belanja Modal</td>
            <td class="text-right"><?php echo rupiah($apbdTotal['pg_bl_bm']); ?></span></td>
            <td class="text-right"><?php echo rupiah($apbdTotal['rk_keu_bm_rp']); ?></span></td>
            <td class="text-center"><?php echo $apbdTotal['rk_keu_bm_per']; ?></td>
            <td class="text-right"><?php echo $apbdTotal['rf_bm']; ?></td>
        </tr>
        <tr class="text_utama">
            <td>Belanja Tidak Terduga</td>
            <td class="text-right"><?php echo rupiah($apbdTotal['pg_btt']); ?></span></td>
            <td class="text-right"><?php echo rupiah($apbdTotal['rk_keu_btt_rp']); ?></span></td>
            <td class="text-center"><?php echo $apbdTotal['rk_keu_btt_per']; ?></td>
            <td class="text-right"><?php echo $apbdTotal['rf_btt']; ?></td>
        </tr>
        <tr class="text_utama">
            <td>Belanja Transfer</td>
            <td class="text-right"><?php echo rupiah($apbdTotal['pg_bl_bt']); ?></span></td>
            <td class="text-right"><?php echo rupiah($apbdTotal['rk_keu_bt_rp']); ?></span></td>
            <td class="text-center"><?php echo $apbdTotal['rk_keu_bt_per']; ?></td>
            <td class="text-right"><?php echo $apbdTotal['rf_bt']; ?></td>
        </tr>
        <tr class="text_utama">
            <td>Total (BO+BM+BTT+BT)</td>
            <td class="text-right"><?php echo rupiah($apbdTotal['pg_apbd']); ?></span></td>
            <td class="text-right"><?php echo rupiah($apbdTotal['real_apbd']); ?></span></td>
            <td class="text-center"><?php echo $apbdTotal['real_apbd_per']; ?></td>
            <td class="text-right"><?php echo $apbdTotal['real_apbd_fisik']; ?></td>
        </tr>
    </table>
    <br><br>

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
