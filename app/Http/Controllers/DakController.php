<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DakController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'DANA ALOKASI KHUSUS (DAK)',
            'unit' => DB::table('tbl_unit')->get()
        ];
        return view('dak.index', $data);
    }

    public function getDataDakFisik($bln, $unit): JsonResponse
    {
        $data = DB::table('tbl_dak_fisik')->where('id_bln', $bln)->where('id_unit', $unit)->where('tahun', session('ta'))->get();

        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }
    public function getDataDakNonFisik($bln, $unit): JsonResponse
    {
        $data = DB::table('tbl_dak_non_fisik')->where('id_bln', $bln)->where('id_unit', $unit)->where('tahun', session('ta'))->get();

        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function reportDakFisik($id_bln, $id_unit)
    {
        $main = DB::table('tbl_dak_fisik')
            ->where('id_bln', $id_bln)
            ->where('id_unit', $id_unit)
            ->where('tahun', session('ta'))
            ->get();

        $unit = DB::table('tbl_unit')->where('id_unit', $id_unit)->first();

        $data = [
            'title' => 'Laporan DAK Fisik',
            'unit' => $unit,
            'main' => $main,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('dak.report_dak_fisik', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'landscape');

        return $pdf->stream('laporan-dak-fisik' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '-' . $unit->nm_unit . '.pdf');
    }

    public function reportDakNonFisik($id_bln, $id_unit)
    {
        $main = DB::table('tbl_dak_non_fisik')
            ->where('id_bln', $id_bln)
            ->where('id_unit', $id_unit)
            ->where('tahun', session('ta'))
            ->get();

        $unit = DB::table('tbl_unit')->where('id_unit', $id_unit)->first();

        $data = [
            'title' => 'Laporan DAK non Fisik',
            'unit' => $unit,
            'main' => $main,
            'id_bln' => $id_bln

        ];
        // dd($data);
        $pdf = Pdf::loadView('dak.report_dak_non_fisik', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'path_to_font.ttf')
            ->setPaper('Legal', 'landscape');

        return $pdf->stream('laporan-dak-non-fisik' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->isoFormat('Y') . '-' . \Carbon\Carbon::create(session('ta'), $id_bln)->locale('id_ID')->monthName . '-' . $unit->nm_unit . '.pdf');
    }
}