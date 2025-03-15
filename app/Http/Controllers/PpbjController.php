<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PpbjController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'PROSES PENGADAAN BARANG DAN JASA ',
            'unit' => DB::table('tbl_unit')->get()
        ];
        return view('ppbj.index', $data);
    }

    public function getPpbj($id_bln, $unit)
    {

        $ppbj50 = DB::table('tbl_ppbj_50')->where('id_unit', $unit)->where('id_bln', $id_bln)->where('tahun', session('ta'))->first();
        $ppbj200 = DB::table('tbl_ppbj_200')->where('id_unit', $unit)->where('id_bln', $id_bln)->where('tahun', session('ta'))->first();
        $ppbj25 = DB::table('tbl_ppbj_25')->where('id_unit', $unit)->where('id_bln', $id_bln)->where('tahun', session('ta'))->first();

        $data = (object) array_merge((array) $ppbj50, (array) $ppbj200, (array) $ppbj25);
        return response()->json($data);
    }
    public function updatePpbj50(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bln' => 'required',
            'id_unit' => 'required',
            'jml_pkt_50' => 'required',
            'jml_pg_50' => 'required',
            'pl_pkt_50' => 'required',
            'pl_rp_50' => 'required',
            'h_pl_pkt_50' => 'required',
            'h_pl_rp_50' => 'required',
            'kontrak_pkt_50' => 'required',
            'kontrak_rp_50' => 'required',
            'st_pkt_50' => 'required',
            'st_rp_50' => 'required',
            'bp_pkt_50' => 'required',
            'bp_rp_50' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $id_unit = $request->id_unit;
        $id_bln = $request->id_bln;
        $jml_pkt_50 = $request->jml_pkt_50;
        $jml_pg_50 = str_replace(',', '', $request->jml_pg_50);
        $pl_pkt_50 = $request->pl_pkt_50;
        $pl_rp_50 = str_replace(',', '', $request->pl_rp_50);
        $h_pl_pkt_50 = $request->h_pl_pkt_50;
        $h_pl_rp_50 = str_replace(',', '', $request->h_pl_rp_50);
        $kontrak_pkt_50 = $request->kontrak_pkt_50;
        $kontrak_rp_50 = str_replace(',', '', $request->kontrak_rp_50);
        $st_pkt_50 = $request->st_pkt_50;
        $st_rp_50 = str_replace(',', '', $request->st_rp_50);
        $bp_pkt_50 = $request->bp_pkt_50;
        $bp_rp_50 = str_replace(',', '', $request->bp_rp_50);

        $data = [
            'id_bln' => $id_bln,
            'id_unit' => $id_unit,
            'jml_pkt_50' => $jml_pkt_50,
            'jml_pg_50' => $jml_pg_50,
            'pl_pkt_50' => $pl_pkt_50,
            'pl_rp_50' => $pl_rp_50,
            'h_pl_pkt_50' => $h_pl_pkt_50,
            'h_pl_rp_50' => $h_pl_rp_50,
            'kontrak_pkt_50' => $kontrak_pkt_50,
            'kontrak_rp_50' => $kontrak_rp_50,
            'st_pkt_50' => $st_pkt_50,
            'st_rp_50' => $st_rp_50,
            'bp_pkt_50' => $bp_pkt_50,
            'bp_rp_50' => $bp_rp_50,
            'status_ppbj_50' => 1,
        ];

        try {
            DB::table('tbl_ppbj_50')->where('id_unit', $id_unit)->where('id_bln', $id_bln)->where('tahun', session('ta'))->update($data);

            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (Exception) {


            return response()->json(['success' => false, 'message' => 'Gagal']);
        }
    }

    public function updatePpbj200(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bln_ppbj_200' => 'required',
            'id_unit_ppbj_200' => 'required',
            'jml_pkt_200' => 'required',
            'jml_pg_200' => 'required',
            'pl_pkt_200' => 'required',
            'pl_rp_200' => 'required',
            'h_pl_pkt_200' => 'required',
            'h_pl_rp_200' => 'required',
            'kontrak_pkt_200' => 'required',
            'kontrak_rp_200' => 'required',
            'st_pkt_200' => 'required',
            'st_rp_200' => 'required',
            'bp_pkt_200' => 'required',
            'bp_rp_200' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $id_unit = $request->id_unit_ppbj_200;
        $id_bln = $request->id_bln_ppbj_200;
        $jml_pkt_200 = $request->jml_pkt_200;
        $jml_pg_200 = str_replace(',', '', $request->jml_pg_200);
        $pl_pkt_200 = $request->pl_pkt_200;
        $pl_rp_200 = str_replace(',', '', $request->pl_rp_200);
        $h_pl_pkt_200 = $request->h_pl_pkt_200;
        $h_pl_rp_200 = str_replace(',', '', $request->h_pl_rp_200);
        $kontrak_pkt_200 = $request->kontrak_pkt_200;
        $kontrak_rp_200 = str_replace(',', '', $request->kontrak_rp_200);
        $st_pkt_200 = $request->st_pkt_200;
        $st_rp_200 = str_replace(',', '', $request->st_rp_200);
        $bp_pkt_200 = $request->bp_pkt_200;
        $bp_rp_200 = str_replace(',', '', $request->bp_rp_200);

        $data = [
            'id_bln' => $id_bln,
            'id_unit' => $id_unit,
            'jml_pkt_200' => $jml_pkt_200,
            'jml_pg_200' => $jml_pg_200,
            'pl_pkt_200' => $pl_pkt_200,
            'pl_rp_200' => $pl_rp_200,
            'h_pl_pkt_200' => $h_pl_pkt_200,
            'h_pl_rp_200' => $h_pl_rp_200,
            'kontrak_pkt_200' => $kontrak_pkt_200,
            'kontrak_rp_200' => $kontrak_rp_200,
            'st_pkt_200' => $st_pkt_200,
            'st_rp_200' => $st_rp_200,
            'bp_pkt_200' => $bp_pkt_200,
            'bp_rp_200' => $bp_rp_200,
            'status_ppbj_200' => 1,
        ];

        try {
            DB::table('tbl_ppbj_200')->where('id_unit', $id_unit)->where('id_bln', $id_bln)->where('tahun', session('ta'))->update($data);

            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (Exception) {


            return response()->json(['success' => false, 'message' => 'Gagal']);
        }
    }

    public function updatePpbj25(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bln_ppbj_25' => 'required',
            'id_unit_ppbj_25' => 'required',
            'jml_pkt_25' => 'required',
            'jml_pg_25' => 'required',
            'pl_pkt_25' => 'required',
            'pl_rp_25' => 'required',
            'h_pl_pkt_25' => 'required',
            'h_pl_rp_25' => 'required',
            'kontrak_pkt_25' => 'required',
            'kontrak_rp_25' => 'required',
            'st_pkt_25' => 'required',
            'st_rp_25' => 'required',
            'bp_pkt_25' => 'required',
            'bp_rp_25' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $id_unit = $request->id_unit_ppbj_25;
        $id_bln = $request->id_bln_ppbj_25;
        $jml_pkt_25 = $request->jml_pkt_25;
        $jml_pg_25 = str_replace(',', '', $request->jml_pg_25);
        $pl_pkt_25 = $request->pl_pkt_25;
        $pl_rp_25 = str_replace(',', '', $request->pl_rp_25);
        $h_pl_pkt_25 = $request->h_pl_pkt_25;
        $h_pl_rp_25 = str_replace(',', '', $request->h_pl_rp_25);
        $kontrak_pkt_25 = $request->kontrak_pkt_25;
        $kontrak_rp_25 = str_replace(',', '', $request->kontrak_rp_25);
        $st_pkt_25 = $request->st_pkt_25;
        $st_rp_25 = str_replace(',', '', $request->st_rp_25);
        $bp_pkt_25 = $request->bp_pkt_25;
        $bp_rp_25 = str_replace(',', '', $request->bp_rp_25);

        $data = [
            'id_bln' => $id_bln,
            'id_unit' => $id_unit,
            'jml_pkt_25' => $jml_pkt_25,
            'jml_pg_25' => $jml_pg_25,
            'pl_pkt_25' => $pl_pkt_25,
            'pl_rp_25' => $pl_rp_25,
            'h_pl_pkt_25' => $h_pl_pkt_25,
            'h_pl_rp_25' => $h_pl_rp_25,
            'kontrak_pkt_25' => $kontrak_pkt_25,
            'kontrak_rp_25' => $kontrak_rp_25,
            'st_pkt_25' => $st_pkt_25,
            'st_rp_25' => $st_rp_25,
            'bp_pkt_25' => $bp_pkt_25,
            'bp_rp_25' => $bp_rp_25,
            'status_ppbj_25' => 1,
        ];

        try {
            DB::table('tbl_ppbj_25')->where('id_unit', $id_unit)->where('id_bln', $id_bln)->where('tahun', session('ta'))->update($data);

            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (Exception) {


            return response()->json(['success' => false, 'message' => 'Gagal']);
        }
    }

    public function reportPpbj50($id_bln, $id_unit)
    {
        $ppbj = DB::table('tbl_ppbj_50')
            ->where('id_bln', $id_bln)
            ->where('id_unit', $id_unit)
            ->where('tahun', session('ta'))
            ->first();

        $unit = DB::table('tbl_unit')->where('id_unit', $id_unit)->first();

        $data = [
            'title' => 'PAKET NON STRATEGIS (>RP. 50 JT S/D Rp. 200 JT)',
            'unit' => $unit,
            'ppbj' => $ppbj,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('ppbj.report_ppbj_50', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Folio', 'landscape');

        return $pdf->stream('PAKET NON STRATEGIS >RP. 50 JT S D Rp. 200 JT ' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . str_replace(['/', '\\'], '', \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) . '-' . $unit->nm_unit . '.pdf');
    }

    public function reportPpbj200($id_bln, $id_unit)
    {
        $ppbj = DB::table('tbl_ppbj_200')
            ->where('id_bln', $id_bln)
            ->where('id_unit', $id_unit)
            ->where('tahun', session('ta'))
            ->first();

        $unit = DB::table('tbl_unit')->where('id_unit', $id_unit)->first();

        $data = [
            'title' => 'PAKET NON STRATEGIS (>RP. 200 JT S/D Rp. 2,5 M)',
            'unit' => $unit,
            'ppbj' => $ppbj,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('ppbj.report_ppbj_200', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Folio', 'landscape');

        return $pdf->stream('PAKET NON STRATEGIS 200 jt - 2_5 M ' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . str_replace(['/', '\\'], '', \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) . '-' . $unit->nm_unit . '.pdf');
    }

    public function reportPpbj25($id_bln, $id_unit)
    {
        $ppbj = DB::table('tbl_ppbj_25')
            ->where('id_bln', $id_bln)
            ->where('id_unit', $id_unit)
            ->where('tahun', session('ta'))
            ->first();

        $unit = DB::table('tbl_unit')->where('id_unit', $id_unit)->first();

        $data = [
            'title' => 'PAKET NON STRATEGIS (>RP. 2,5 M S/D Rp. 5 M)',
            'unit' => $unit,
            'ppbj' => $ppbj,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('ppbj.report_ppbj_25', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Folio', 'landscape');

        return $pdf->stream('PAKET NON STRATEGIS 2_5 M - 5 M ' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . str_replace(['/', '\\'], '', \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) . '-' . $unit->nm_unit . '.pdf');
    }
}