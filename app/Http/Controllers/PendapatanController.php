<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PendapatanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'TABEL REALISASI PENERIMAAN PENDAPATAN',
            'unit' => DB::table('tbl_unit')->get()
        ];
        return view('pendapatan.index', $data);
    }

    public function getDataPendapatan($bln, $unit): JsonResponse
    {
        $data = DB::table('tbl_pendapatan')->where('id_bln', $bln)->where('id_unit', $unit)->where('tahun', session('ta'))->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }


    public function update()
    {
        $validator = Validator::make(request()->all(), [
            'id_unit_pd' => 'required',
            'id_bln_pd' => 'required',
            'target_total' => 'required',
            'keu_total' => 'required',
            'keu_per_total' => 'required',
            'pad_target' => 'required',
            'pad_real' => 'required',
            'pad_real_per' => 'required',
            'tp_target' => 'required',
            'tp_keu' => 'required',
            'tp_per' => 'required',
            'tad_target' => 'required',
            'tad_keu' => 'required',
            'tad_per' => 'required',
            'pad_sah_target' => 'required',
            'pad_sah_keu' => 'required',
            'pad_sah_per' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $id_unit = request('id_unit_pd');
        $id_bln = request('id_bln_pd');
        $target_total = str_replace(',', '', request('target_total'));
        $keu_total = str_replace(',', '', request('keu_total'));
        $keu_per_total = request('keu_per_total');
        $pad_target = str_replace(',', '', request('pad_target'));
        $pad_real = str_replace(',', '', request('pad_real'));
        $pad_real_per = request('pad_real_per');
        $tp_target = str_replace(',', '', request('tp_target'));
        $tp_keu = str_replace(',', '', request('tp_keu'));
        $tp_per = request('tp_per');
        $tad_target = str_replace(',', '', request('tad_target'));
        $tad_keu = str_replace(',', '', request('tad_keu'));
        $tad_per = request('tad_per');
        $pad_sah_target = str_replace(',', '', request('pad_sah_target'));
        $pad_sah_keu = str_replace(',', '', request('pad_sah_keu'));
        $pad_sah_per = request('pad_sah_per');

        $data = [
            'id_bln' => $id_bln,
            'id_unit' => $id_unit,
            'target_total' => $target_total,
            'keu_total' => $keu_total,
            'keu_per_total' => $keu_per_total,
            'pad_target' => $pad_target,
            'pad_real' => $pad_real,
            'pad_real_per' => $pad_real_per,
            'tp_target' => $tp_target,
            'tp_keu' => $tp_keu,
            'tp_per' => $tp_per,
            'tad_target' => $tad_target,
            'tad_keu' => $tad_keu,
            'tad_per' => $tad_per,
            'pad_sah_target' => $pad_sah_target,
            'pad_sah_keu' => $pad_sah_keu,
            'pad_sah_per' => $pad_sah_per,
            'status_pd' => 1,
        ];

        try {
            DB::table('tbl_pendapatan')->where('id_bln', $id_bln)->where('id_unit', $id_unit)->update($data);
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    public function reportPendapatan($id_bln, $id_unit)
    {
        $pendapatan = DB::table('tbl_pendapatan')
            ->where('id_bln', $id_bln)
            ->where('id_unit', $id_unit)
            ->where('tahun', session('ta'))
            ->first();

        $unit = DB::table('tbl_unit')->where('id_unit', $id_unit)->first();

        $data = [
            'title' => 'REALISASI PENERIMAAN PENDAPATAN',
            'unit' => $unit,
            'pendapatan' => $pendapatan,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('pendapatan.report_pendapatan', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Folio', 'landscape');

        return $pdf->stream('REALISASI PENERIMAAN PENDAPATAN ' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . str_replace(['/', '\\'], '', \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName) . '-' . $unit->nm_unit . '.pdf');
    }
}