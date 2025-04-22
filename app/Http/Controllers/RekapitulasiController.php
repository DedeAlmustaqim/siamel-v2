<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RekapitulasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Rekapitulasi'
        ];
        return view('rekapitulasi.index', $data);
    }
    public function apbd($id_bln)
    {
        $ta = session('ta');
        $fields = [
            // belanja operasi
            'pg_bl_op' => 'SUM(pg_bl_op) AS pg_bl_op',
            'rk_keu_op_rp' => 'SUM(rk_keu_op_rp) AS rk_keu_op_rp',
            'rk_keu_op_per' => 'SUM(rk_keu_op_rp) / SUM(pg_bl_op) * 100 as rk_keu_op_per',
            'rf_op' => 'SUM(rf_op * pg_bl_op / 100) / SUM(pg_bl_op) * 100 as rf_op',
            // belanja modal
            'pg_bl_bm' => 'SUM(pg_bl_bm) AS pg_bl_bm',
            'rk_keu_bm_rp' => 'SUM(rk_keu_bm_rp) AS rk_keu_bm_rp',
            'rk_keu_bm_per' => 'SUM(rk_keu_bm_rp) / SUM(pg_bl_bm) * 100 as rk_keu_bm_per',
            'rf_bm' => 'SUM(rf_bm * pg_bl_bm / 100) / SUM(pg_bl_bm) * 100 as rf_bm',
            // belanja tidak terduga
            'pg_btt' => 'SUM(pg_btt) AS pg_btt',
            'rk_keu_btt_rp' => 'SUM(rk_keu_btt_rp) AS rk_keu_btt_rp',
            'rk_keu_btt_per' => 'SUM(rk_keu_btt_rp) / SUM(pg_btt) * 100 as rk_keu_btt_per',
            'rf_btt' => 'SUM(rf_btt * pg_btt / 100) / SUM(pg_btt) * 100 as rf_btt',
            // belanja transfer
            'pg_bl_bt' => 'SUM(pg_bl_bt) AS pg_bl_bt',
            'rk_keu_bt_rp' => 'SUM(rk_keu_bt_rp) AS rk_keu_bt_rp',
            'rk_keu_bt_per' => 'SUM(rk_keu_bt_rp) / SUM(pg_bl_bt) * 100 as rk_keu_bt_per',
            'rf_bt' => 'SUM(rf_bt * pg_bl_bt / 100) / SUM(pg_bl_bt) * 100 as rf_bt',
            // belanja total
            'pg_apbd' => 'SUM(pg_apbd) AS pg_apbd',
            'real_apbd' => 'SUM(real_apbd) AS real_apbd',
            'real_apbd_per' => 'SUM(real_apbd) / SUM(pg_apbd) * 100 as real_apbd_per',
            'real_apbd_fisik' => 'SUM(real_apbd_fisik * pg_apbd / 100) / SUM(pg_apbd) * 100 as real_apbd_fisik',
        ];

        $query = DB::table('tbl_apbd')
            ->selectRaw(implode(', ', $fields))
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->first();

        $data = array_map(fn ($value) => round($value, 2), (array)$query);

        return response()->json($data);
    }

    public function grafikapbd(): JsonResponse
    {


        $data = DB::table('tbl_bln')
            ->selectRaw('
            sum(pg_apbd) as pg_apbd,
            sum(real_apbd) as real_apbd,
            sum(real_apbd)/sum(pg_apbd)*100 as real_apbd_per,
            SUM(real_apbd_fisik*pg_apbd/100)/sum(pg_apbd)*100 as real_apbd_fisik,
            nm_bln
            ')
            ->join('tbl_apbd', 'tbl_bln.id_bln', '=', 'tbl_apbd.id_bln')
            ->groupBy('tbl_bln.nm_bln')
            ->orderBy('tbl_bln.id_bln', 'asc')
            ->where('tbl_apbd.tahun', session('ta'))
            ->get();



        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function reportApbd($id_bln)
    {

        $tables = [
            'tbl_bl_bagi_hasil',
            'tbl_bl_bantuan_keu',
            'tbl_bl_bantuan_sosial',
            'tbl_bl_barang_jasa',
            'tbl_bl_hibah',
            'tbl_bl_pegawai',
            'tbl_bl_subsidi',
            'tbl_bm_alat_mesin',
            'tbl_bm_aset',
            'tbl_bm_gedung_bangunan',
            'tbl_bm_jalan',
            'tbl_bm_tanah'
        ];

        $apbd = DB::table('tbl_apbd')
            ->select('tbl_apbd.*', 'tbl_unit.*', ...array_map(fn ($t) => "$t.*", $tables))
            ->leftJoin('tbl_unit', 'tbl_apbd.id_unit', '=', 'tbl_unit.id_unit');

        foreach ($tables as $table) {
            $apbd->leftJoin($table, function ($join) use ($table) {
                $join->on('tbl_apbd.id_bln', '=', "$table.id_bln")
                    ->where('tbl_apbd.tahun', '=', "$table.tahun");
            });
        }

        $apbd = $apbd->where('tbl_apbd.id_bln', $id_bln)
            ->where('tbl_apbd.tahun', session('ta'))
            ->get();



        $fields = [
            // belanja operasi
            'pg_bl_op' => 'SUM(pg_bl_op) AS pg_bl_op',
            'rk_keu_op_rp' => 'SUM(rk_keu_op_rp) AS rk_keu_op_rp',
            'rk_keu_op_per' => 'SUM(rk_keu_op_rp) / SUM(pg_bl_op) * 100 as rk_keu_op_per',
            'rf_op' => 'SUM(rf_op * pg_bl_op / 100) / SUM(pg_bl_op) * 100 as rf_op',
            // belanja modal
            'pg_bl_bm' => 'SUM(pg_bl_bm) AS pg_bl_bm',
            'rk_keu_bm_rp' => 'SUM(rk_keu_bm_rp) AS rk_keu_bm_rp',
            'rk_keu_bm_per' => 'SUM(rk_keu_bm_rp) / SUM(pg_bl_bm) * 100 as rk_keu_bm_per',
            'rf_bm' => 'SUM(rf_bm * pg_bl_bm / 100) / SUM(pg_bl_bm) * 100 as rf_bm',
            // belanja tidak terduga
            'pg_btt' => 'SUM(pg_btt) AS pg_btt',
            'rk_keu_btt_rp' => 'SUM(rk_keu_btt_rp) AS rk_keu_btt_rp',
            'rk_keu_btt_per' => 'SUM(rk_keu_btt_rp) / SUM(pg_btt) * 100 as rk_keu_btt_per',
            'rf_btt' => 'SUM(rf_btt * pg_btt / 100) / SUM(pg_btt) * 100 as rf_btt',
            // belanja transfer
            'pg_bl_bt' => 'SUM(pg_bl_bt) AS pg_bl_bt',
            'rk_keu_bt_rp' => 'SUM(rk_keu_bt_rp) AS rk_keu_bt_rp',
            'rk_keu_bt_per' => 'SUM(rk_keu_bt_rp) / SUM(pg_bl_bt) * 100 as rk_keu_bt_per',
            'rf_bt' => 'SUM(rf_bt * pg_bl_bt / 100) / SUM(pg_bl_bt) * 100 as rf_bt',
            // belanja total
            'pg_apbd' => 'SUM(pg_apbd) AS pg_apbd',
            'real_apbd' => 'SUM(real_apbd) AS real_apbd',
            'real_apbd_per' => 'SUM(real_apbd) / SUM(pg_apbd) * 100 as real_apbd_per',
            'real_apbd_fisik' => 'SUM(real_apbd_fisik * pg_apbd / 100) / SUM(pg_apbd) * 100 as real_apbd_fisik',
        ];

        $query = DB::table('tbl_apbd')
            ->selectRaw(implode(', ', $fields))
            ->where('id_bln', $id_bln)
            ->where('tahun', session('ta'))
            ->first();

        $apbdTotal = array_map(fn ($value) => round($value, 2), (array)$query);
        $data = [
            'title' => 'Laporan APBD Kabupaten Barito Timur',

            'apbd' => $apbd,
            'apbdTotal' => $apbdTotal,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('rekapitulasi.report_apbd_form_ii', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'landscape');

        return $pdf->stream('laporan-apbd-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '.pdf');
    }

    public function pendapatan($id_bln)
    {
        $ta = session('ta');

        $results = DB::table('tbl_pendapatan')
            ->selectRaw('
            SUM(pad_target) AS pad_target,
            SUM(pad_real) AS pad_real,
            SUM(pad_real) / SUM(pad_target) * 100 AS pad_real_per,
            SUM(tp_target) AS tp_target,
            SUM(tp_keu) AS tp_keu,
            SUM(tp_keu) / SUM(tp_target) * 100 AS tp_per,
            SUM(tad_target) AS tad_target,
            SUM(tad_keu) AS tad_keu,
            SUM(tad_keu) / SUM(tad_target) * 100 AS tad_per,
            SUM(pad_sah_target) AS pad_sah_target,
            SUM(pad_sah_keu) AS pad_sah_keu,
            SUM(pad_sah_keu) / SUM(pad_sah_target) * 100 AS pad_sah_per,
            SUM(target_total) AS target_total,
            SUM(keu_total) AS keu_total,
            SUM(keu_total) / SUM(target_total) * 100 AS keu_per_total
        ')
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->first();

        $data = [
            'pad_target' => $results->pad_target,
            'pad_real' => $results->pad_real,
            'pad_real_per' => round($results->pad_real_per, 2),
            'tp_target' => $results->tp_target,
            'tp_keu' => $results->tp_keu,
            'tp_per' => round($results->tp_per, 2),
            'tad_target' => $results->tad_target,
            'tad_keu' => $results->tad_keu,
            'tad_per' => round($results->tad_per, 2),
            'pad_sah_target' => $results->pad_sah_target,
            'pad_sah_keu' => $results->pad_sah_keu,
            'pad_sah_per' => round($results->pad_sah_per, 2),
            'target_total' => $results->target_total,
            'keu_total' => $results->keu_total,
            'keu_per_total' => round($results->keu_per_total, 2),
        ];

        return response()->json($data);
    }

    public function grafikPd()
    {
        $data = DB::table('tbl_pendapatan')
            ->selectRaw('
                tbl_bln.id_bln,
                tbl_bln.nm_bln,
                SUM(keu_total) / SUM(target_total) * 100 as keu_per_total,
                SUM(target_total) as target_total,
                SUM(keu_total) as keu_total
            ')
            ->join('tbl_bln', 'tbl_bln.id_bln', '=', 'tbl_pendapatan.id_bln')
            ->groupBy('tbl_bln.id_bln', 'tbl_bln.nm_bln')
            ->orderBy('tbl_bln.id_bln', 'asc')
            ->where('tbl_pendapatan.tahun', session('ta'))
            ->get();

        return response()->json($data);
    }

    public function reportPd($id_bln)
    {
        $ta = session('ta');

        $results = DB::table('tbl_pendapatan')
            ->selectRaw('
            SUM(pad_target) AS pad_target,
            SUM(pad_real) AS pad_real,
            SUM(pad_real) / SUM(pad_target) * 100 AS pad_real_per,
            SUM(tp_target) AS tp_target,
            SUM(tp_keu) AS tp_keu,
            SUM(tp_keu) / SUM(tp_target) * 100 AS tp_per,
            SUM(tad_target) AS tad_target,
            SUM(tad_keu) AS tad_keu,
            SUM(tad_keu) / SUM(tad_target) * 100 AS tad_per,
            SUM(pad_sah_target) AS pad_sah_target,
            SUM(pad_sah_keu) AS pad_sah_keu,
            SUM(pad_sah_keu) / SUM(pad_sah_target) * 100 AS pad_sah_per,
            SUM(target_total) AS target_total,
            SUM(keu_total) AS keu_total,
            SUM(keu_total) / SUM(target_total) * 100 AS keu_per_total
        ')
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->first();


        $data = [
            'title' => 'Laporan Pendapatan Kabupaten Barito Timur',

            'pendapatan' => $results,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('rekapitulasi.report_pendapatan', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'potrait');

        return $pdf->stream('laporan-pendapatan-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '.pdf');
    }

    public function getPpbj($id_bln)
    {
        $ta = session('ta');
        $ppbj50 = DB::table('tbl_ppbj_50')
            ->select(
                'tahun',
                DB::raw('SUM(jml_pkt_50) AS total_jml_pkt_50'),
                DB::raw('SUM(jml_pg_50) AS total_jml_pg_50'),
                DB::raw('SUM(pl_pkt_50) AS total_pl_pkt_50'),
                DB::raw('SUM(pl_rp_50) AS total_pl_rp_50'),
                DB::raw('SUM(h_pl_pkt_50) AS total_h_pl_pkt_50'),
                DB::raw('SUM(h_pl_rp_50) AS total_h_pl_rp_50'),
                DB::raw('SUM(kontrak_pkt_50) AS total_kontrak_pkt_50'),
                DB::raw('SUM(kontrak_rp_50) AS total_kontrak_rp_50'),
                DB::raw('SUM(st_pkt_50) AS total_st_pkt_50'),
                DB::raw('SUM(st_rp_50) AS total_st_rp_50'),
                DB::raw('SUM(bp_pkt_50) AS total_bp_pkt_50'),
                DB::raw('SUM(bp_rp_50) AS total_bp_rp_50')
            )
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->first();

        $ppbj200 = DB::table('tbl_ppbj_200')
            ->select(
                'tahun',
                DB::raw('SUM(jml_pkt_200) AS total_jml_pkt_200'),
                DB::raw('SUM(jml_pg_200) AS total_jml_pg_200'),
                DB::raw('SUM(pl_pkt_200) AS total_pl_pkt_200'),
                DB::raw('SUM(pl_rp_200) AS total_pl_rp_200'),
                DB::raw('SUM(h_pl_pkt_200) AS total_h_pl_pkt_200'),
                DB::raw('SUM(h_pl_rp_200) AS total_h_pl_rp_200'),
                DB::raw('SUM(kontrak_pkt_200) AS total_kontrak_pkt_200'),
                DB::raw('SUM(kontrak_rp_200) AS total_kontrak_rp_200'),
                DB::raw('SUM(st_pkt_200) AS total_st_pkt_200'),
                DB::raw('SUM(st_rp_200) AS total_st_rp_200'),
                DB::raw('SUM(bp_pkt_200) AS total_bp_pkt_200'),
                DB::raw('SUM(bp_rp_200) AS total_bp_rp_200')
            )
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->first();
        $ppbj25 = DB::table('tbl_ppbj_25')
            ->select(
                'tahun',
                DB::raw('SUM(jml_pkt_25) AS total_jml_pkt_25'),
                DB::raw('SUM(jml_pg_25) AS total_jml_pg_25'),
                DB::raw('SUM(pl_pkt_25) AS total_pl_pkt_25'),
                DB::raw('SUM(pl_rp_25) AS total_pl_rp_25'),
                DB::raw('SUM(h_pl_pkt_25) AS total_h_pl_pkt_25'),
                DB::raw('SUM(h_pl_rp_25) AS total_h_pl_rp_25'),
                DB::raw('SUM(kontrak_pkt_25) AS total_kontrak_pkt_25'),
                DB::raw('SUM(kontrak_rp_25) AS total_kontrak_rp_25'),
                DB::raw('SUM(st_pkt_25) AS total_st_pkt_25'),
                DB::raw('SUM(st_rp_25) AS total_st_rp_25'),
                DB::raw('SUM(bp_pkt_25) AS total_bp_pkt_25'),
                DB::raw('SUM(bp_rp_25) AS total_bp_rp_25')
            )
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->first();

        $data = (object) array_merge((array) $ppbj50, (array) $ppbj200, (array) $ppbj25);
        return response()->json($data);
    }


    public function reportPpbj50($id_bln)
    {

        $ta = session('ta');
        $ppbj50Total = DB::table('tbl_ppbj_50')
            ->select(
                'tahun',
                DB::raw('SUM(jml_pkt_50) AS jml_pkt_50'),
                DB::raw('SUM(jml_pg_50) AS jml_pg_50'),
                DB::raw('SUM(pl_pkt_50) AS pl_pkt_50'),
                DB::raw('SUM(pl_rp_50) AS pl_rp_50'),
                DB::raw('SUM(h_pl_pkt_50) AS h_pl_pkt_50'),
                DB::raw('SUM(h_pl_rp_50) AS h_pl_rp_50'),
                DB::raw('SUM(kontrak_pkt_50) AS kontrak_pkt_50'),
                DB::raw('SUM(kontrak_rp_50) AS kontrak_rp_50'),
                DB::raw('SUM(st_pkt_50) AS st_pkt_50'),
                DB::raw('SUM(st_rp_50) AS st_rp_50'),
                DB::raw('SUM(bp_pkt_50) AS bp_pkt_50'),
                DB::raw('SUM(bp_rp_50) AS bp_rp_50')
            )
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->first();

        $ppbj50All = DB::table('tbl_ppbj_50')
            ->leftJoin('tbl_unit', 'tbl_ppbj_50.id_unit', '=', 'tbl_unit.id_unit')
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->orderBy('tbl_unit.urut', 'asc')
            ->get();
        $data = [
            'title' => 'Laporan Pendapatan Kabupaten Barito Timur',

            'total' => $ppbj50Total,
            'ppbj50All' => $ppbj50All,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('rekapitulasi.report_ppbj_50', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'landscape');

        return $pdf->stream('laporan-ppbj-50-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '.pdf');
    }

    public function reportPpbj200($id_bln)
    {

        $ta = session('ta');
        $ppbj200Total = DB::table('tbl_ppbj_200')
            ->select(
                'tahun',
                DB::raw('SUM(jml_pkt_200) AS jml_pkt_200'),
                DB::raw('SUM(jml_pg_200) AS jml_pg_200'),
                DB::raw('SUM(pl_pkt_200) AS pl_pkt_200'),
                DB::raw('SUM(pl_rp_200) AS pl_rp_200'),
                DB::raw('SUM(h_pl_pkt_200) AS h_pl_pkt_200'),
                DB::raw('SUM(h_pl_rp_200) AS h_pl_rp_200'),
                DB::raw('SUM(kontrak_pkt_200) AS kontrak_pkt_200'),
                DB::raw('SUM(kontrak_rp_200) AS kontrak_rp_200'),
                DB::raw('SUM(st_pkt_200) AS st_pkt_200'),
                DB::raw('SUM(st_rp_200) AS st_rp_200'),
                DB::raw('SUM(bp_pkt_200) AS bp_pkt_200'),
                DB::raw('SUM(bp_rp_200) AS bp_rp_200')
            )
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->first();

        $ppbj200All = DB::table('tbl_ppbj_200')
            ->leftJoin('tbl_unit', 'tbl_ppbj_200.id_unit', '=', 'tbl_unit.id_unit')
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->orderBy('tbl_unit.urut', 'asc')
            ->get();
        $data = [
            'title' => 'Laporan Pendapatan Kabupaten Barito Timur',

            'total' => $ppbj200Total,
            'ppbj200All' => $ppbj200All,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('rekapitulasi.report_ppbj_200', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'landscape');

        return $pdf->stream('laporan-ppbj-200-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '.pdf');
    }


    public function reportPpbj25($id_bln)
    {

        $ta = session('ta');
        $ppbj25Total = DB::table('tbl_ppbj_25')
            ->select(
                'tahun',
                DB::raw('SUM(jml_pkt_25) AS jml_pkt_25'),
                DB::raw('SUM(jml_pg_25) AS jml_pg_25'),
                DB::raw('SUM(pl_pkt_25) AS pl_pkt_25'),
                DB::raw('SUM(pl_rp_25) AS pl_rp_25'),
                DB::raw('SUM(h_pl_pkt_25) AS h_pl_pkt_25'),
                DB::raw('SUM(h_pl_rp_25) AS h_pl_rp_25'),
                DB::raw('SUM(kontrak_pkt_25) AS kontrak_pkt_25'),
                DB::raw('SUM(kontrak_rp_25) AS kontrak_rp_25'),
                DB::raw('SUM(st_pkt_25) AS st_pkt_25'),
                DB::raw('SUM(st_rp_25) AS st_rp_25'),
                DB::raw('SUM(bp_pkt_25) AS bp_pkt_25'),
                DB::raw('SUM(bp_rp_25) AS bp_rp_25')
            )
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->first();

        $ppbj25All = DB::table('tbl_ppbj_25')
            ->leftJoin('tbl_unit', 'tbl_ppbj_25.id_unit', '=', 'tbl_unit.id_unit')
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->orderBy('tbl_unit.urut', 'asc')
            ->get();
        $data = [
            'title' => 'Laporan Pendapatan Kabupaten Barito Timur',

            'total' => $ppbj25Total,
            'ppbj25All' => $ppbj25All,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('rekapitulasi.report_ppbj_25', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'landscape');

        return $pdf->stream('laporan-ppbj-25-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '.pdf');
    }
    public function getDak($id_bln)
    {
        $sumDakFisik = DB::table('tbl_dak_fisik')
            ->selectRaw('ROUND(SUM(pagu), 2) AS pagu_dak_fisik, SUM(real_keu) AS real_keu_dak_fisik, ROUND(SUM(real_fik*pagu)/SUM(pagu), 2) AS real_fik_dak_fisik')
            ->where('id_bln', $id_bln)
            ->where('tahun', session('ta'))
            ->groupBy('tahun')
            ->first();

        $sumDakNonFisik = DB::table('tbl_dak_non_fisik')
            ->selectRaw('SUM(pagu) AS pagu_dak_non_fisik, SUM(real_keu) AS real_keu_dak_non_fisik,  ROUND(SUM(real_fik*pagu)/sum(pagu),2) AS real_fik_dak_non_fisik')
            ->where('id_bln', $id_bln)
            ->where('tahun', session('ta'))
            ->groupBy('tahun')
            ->first();
        $data = (object) array_merge((array) $sumDakFisik, (array) $sumDakNonFisik);
        return response()->json($data);
    }

    public function reportDakFisik($id_bln)
    {
        $ta = session('ta');

        $results = DB::table('tbl_dak_fisik')
            ->leftJoin('tbl_unit', 'tbl_dak_fisik.id_unit', '=', 'tbl_unit.id_unit')
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->orderBy('tbl_unit.urut', 'asc')
            ->get();

        $sumDak = DB::table('tbl_dak_fisik')
            ->selectRaw('ROUND(SUM(pagu), 2) AS pagu, SUM(real_keu) AS real_keu, ROUND(SUM(real_keu)/SUM(pagu)*100, 2) AS real_keu_per, ROUND(SUM(real_fik*pagu)/SUM(pagu), 2) AS real_fik')
            ->where('id_bln', $id_bln)
            ->where('tahun', session('ta'))
            ->groupBy('tahun')
            ->first();
        $data = [
            'title' => 'Laporan Dak Fisik Kabupaten Barito Timur',

            'main' => $results,
            'sum' => $sumDak,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('rekapitulasi.report_dak_fisik', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'landscape');

        return $pdf->stream('laporan-dak-fisik-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '.pdf');
    }

    public function reportDakNonFisik($id_bln)
    {
        $ta = session('ta');

        $results = DB::table('tbl_dak_non_fisik')
            ->leftJoin('tbl_unit', 'tbl_dak_non_fisik.id_unit', '=', 'tbl_unit.id_unit')
            ->where('id_bln', $id_bln)
            ->where('tahun', $ta)
            ->orderBy('tbl_unit.urut', 'asc')
            ->get();

        $sumDak = DB::table('tbl_dak_non_fisik')
            ->selectRaw('ROUND(SUM(pagu), 2) AS pagu, SUM(real_keu) AS real_keu, ROUND(SUM(real_keu)/SUM(pagu)*100, 2) AS real_keu_per, ROUND(SUM(real_fik*pagu)/SUM(pagu), 2) AS real_fik')
            ->where('id_bln', $id_bln)
            ->where('tahun', session('ta'))
            ->groupBy('tahun')
            ->first();
        $data = [
            'title' => 'Laporan Dak Non Fisik Kabupaten Barito Timur',

            'main' => $results,
            'sum' => $sumDak,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('rekapitulasi.report_dak_non_fisik', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'landscape');

        return $pdf->stream('laporan-dak-non-fisik-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '.pdf');
    }
}
