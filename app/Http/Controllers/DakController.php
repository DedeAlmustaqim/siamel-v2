<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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



    // CETAK
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

    public function getDataDakFisikbyId($id): JsonResponse
    {
        $data = DB::table('tbl_dak_fisik')->where('id_dak_fisik', $id)->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function updateDakFisik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_dak_fisik' => 'required',
            'keg_fisik' => 'required',
            'per_vol_fisik' => 'required',
            'per_satuan_fisik' => 'required',
            'per_jlm_penerima_fisik' => 'required',
            'pagu_fisik' => 'required',
            'jns_mekanisme_fisik' => 'required',
            'mek_vol_swa_fisik' => 'required',
            'mek_nilai_swa_fisik' => 'required',
            'mek_vol_kon_fisik' => 'required',
            'mek_nilai_kon_fisik' => 'required',
            'mek_metode_fisik' => 'required',
            'real_keu_fisik' => 'required',
            'real_keu_per_fisik' => 'required',
            'real_fik_fisik' => 'required',
            'kodefikasi_fisik' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $id_dak_fisik = $request->input('id_dak_fisik');
        $keg = $request->input('keg_fisik');
        $per_vol = $request->input('per_vol_fisik');
        $per_satuan = $request->input('per_satuan_fisik');
        $per_jlm_penerima = $request->input('per_jlm_penerima_fisik');
        $pagu = $request->input('pagu_fisik');
        $jns_mekanisme = $request->input('jns_mekanisme_fisik');
        $mek_vol_swa = $request->input('mek_vol_swa_fisik');
        $mek_nilai_swa = $request->input('mek_nilai_swa_fisik');
        $mek_vol_kon = $request->input('mek_vol_kon_fisik');
        $mek_nilai_kon = $request->input('mek_nilai_kon_fisik');
        $mek_metode = $request->input('mek_metode_fisik');
        $real_keu = $request->input('real_keu_fisik');
        $real_keu_per = $request->input('real_keu_per_fisik');
        $real_fik = $request->input('real_fik_fisik');
        $kodefikasi = $request->input('kodefikasi_fisik');

        $data = [
            'keg' => $keg,
            'per_vol' => $per_vol,
            'per_satuan' => $per_satuan,
            'per_jlm_penerima' => $per_jlm_penerima,
            'pagu' => str_replace(',', '', $pagu),
            'jns_mekanisme' => $jns_mekanisme,
            'mek_vol_swa' => $mek_vol_swa,
            'mek_nilai_swa' => str_replace(',', '', $mek_nilai_swa),
            'mek_vol_kon' => $mek_vol_kon,
            'mek_nilai_kon' => str_replace(',', '', $mek_nilai_kon),
            'mek_metode' => $mek_metode,
            'real_keu' => str_replace(',', '', $real_keu),
            'real_keu_per' => $real_keu_per,
            'real_fik' => $real_fik,
            'kodefikasi' => $kodefikasi,
            'status_dak_fisik' => 1,
        ];

        try {
            DB::table('tbl_dak_fisik')->where('id_dak_fisik', $id_dak_fisik)->update($data);
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    public function getDataDakNonFisikbyId($id): JsonResponse
    {
        $data = DB::table('tbl_dak_non_fisik')->where('id_dak_non_fisik', $id)->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }
    public function updateDakNonFisik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_dak_non_fisik' => 'required',
            'keg_non_fisik' => 'required',
            'per_vol_non_fisik' => 'required',
            'per_satuan_non_fisik' => 'required',
            'per_jlm_penerima_non_fisik' => 'required',
            'pagu_non_fisik' => 'required',
            'jns_mekanisme_non_fisik' => 'required',
            'mek_vol_swa_non_fisik' => 'required',
            'mek_nilai_swa_non_fisik' => 'required',
            'mek_vol_kon_non_fisik' => 'required',
            'mek_nilai_kon_non_fisik' => 'required',
            'mek_metode_non_fisik' => 'required',
            'real_keu_non_fisik' => 'required',
            'real_keu_per_non_fisik' => 'required',
            'real_fik_non_fisik' => 'required',
            'kodefikasi_non_fisik' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $id_dak_non_fisik = $request->input('id_dak_non_fisik');
        $keg = $request->input('keg_non_fisik');
        $per_vol = $request->input('per_vol_non_fisik');
        $per_satuan = $request->input('per_satuan_non_fisik');
        $per_jlm_penerima = $request->input('per_jlm_penerima_non_fisik');
        $pagu = $request->input('pagu_non_fisik');
        $jns_mekanisme = $request->input('jns_mekanisme_non_fisik');
        $mek_vol_swa = $request->input('mek_vol_swa_non_fisik');
        $mek_nilai_swa = $request->input('mek_nilai_swa_non_fisik');
        $mek_vol_kon = $request->input('mek_vol_kon_non_fisik');
        $mek_nilai_kon = $request->input('mek_nilai_kon_non_fisik');
        $mek_metode = $request->input('mek_metode_non_fisik');
        $real_keu = $request->input('real_keu_non_fisik');
        $real_keu_per = $request->input('real_keu_per_non_fisik');
        $real_fik = $request->input('real_fik_non_fisik');
        $kodefikasi = $request->input('kodefikasi_non_fisik');

        $data = [
            'keg' => $keg,
            'per_vol' => $per_vol,
            'per_satuan' => $per_satuan,
            'per_jlm_penerima' => $per_jlm_penerima,
            'pagu' => str_replace(',', '', $pagu),
            'jns_mekanisme' => $jns_mekanisme,
            'mek_vol_swa' => $mek_vol_swa,
            'mek_nilai_swa' => str_replace(',', '', $mek_nilai_swa),
            'mek_vol_kon' => $mek_vol_kon,
            'mek_nilai_kon' => str_replace(',', '', $mek_nilai_kon),
            'mek_metode' => $mek_metode,
            'real_keu' => str_replace(',', '', $real_keu),
            'real_keu_per' => $real_keu_per,
            'real_fik' => $real_fik,
            'kodefikasi' => $kodefikasi,
            'status_dak_non_fisik' => 1,
        ];

        try {
            DB::table('tbl_dak_non_fisik')->where('id_dak_non_fisik', $id_dak_non_fisik)->update($data);
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }
}