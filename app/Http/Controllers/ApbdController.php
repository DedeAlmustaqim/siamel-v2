<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Service\JadwalServiceContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApbdController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'APBD',
            'unit' => DB::table('tbl_unit')->get()
        ];
        return view('apbd', $data);
    }

    public function getApbd(Request $request, $unit, $bln)
    {
        $tabel = [
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
            'tbl_bm_tanah',
        ];
        $data = DB::table('tbl_apbd')->where('tbl_apbd.id_unit', $unit)->where('tbl_apbd.id_bln', $bln)->where('tbl_apbd.tahun', session('ta'));

        foreach ($tabel as $t) {
            $data = $data->leftJoin($t, function ($join) use ($t) {
                $join->on('tbl_apbd.id_bln', '=', $t . '.id_bln')
                    ->on('tbl_apbd.id_unit', '=', $t . '.id_unit');
            });
        }

        $data = $data->first();
        $jadwalService = new JadwalServiceContoller();
        if ($data) {
            $data->kunci_input = $jadwalService->kunciInput($bln);
        }
        return response()->json($data);
    }

    public function getPagu(Request $request, $unit)
    {
        $data = DB::table('tbl_pagu')->where('id_unit', $unit)->first();
        return response()->json($data);
    }


    public function updateApbd(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_unit' => 'required',
                'id_bln' => 'required',
                'pg_apbd' => 'required',
                'real_apbd' => 'required',
                'real_apbd_per' => 'required',
                'real_apbd_fisik' => 'required',
                'pg_bl_op' => 'required',
                'rk_keu_op_rp' => 'required',
                'rk_keu_op_per' => 'required',
                'rf_op' => 'required',
                'pg_bl_bm' => 'required',
                'rk_keu_bm_rp' => 'required',
                'rk_keu_bm_per' => 'required',
                'rf_bm' => 'required',
                'pg_btt' => 'required',
                'rk_keu_btt_rp' => 'required',
                'rk_keu_btt_per' => 'required',
                'rf_btt' => 'required',
                'pg_bl_bt' => 'required',
                'rk_keu_bt_rp' => 'required',
                'rk_keu_bt_per' => 'required',
                'rf_bt' => 'required',
                'permasalahan' => 'nullable',
                'pg_bl_peg' => 'required',
                'rk_keu_peg_rp' => 'required',
                'rk_keu_peg_per' => 'required',
                'rf_peg' => 'required',
            ],
            [
                'id_unit.required' => 'Unit wajib diisi.',
                'id_bln.required' => 'Bulan wajib diisi.',
                'pg_apbd.required' => 'Pagu APBD wajib diisi.',
                'real_apbd.required' => 'Realisasi APBD wajib diisi.',
                'real_apbd_per.required' => 'Persentase Realisasi APBD wajib diisi.',
                'real_apbd_fisik.required' => 'Realisasi APBD Fisik wajib diisi.',
                'pg_bl_op.required' => 'Pagu Belanja Operasional wajib diisi.',
                'rk_keu_op_rp.required' => 'Rencana Keuangan Belanja Operasional (Rp) wajib diisi.',
                'rk_keu_op_per.required' => 'Rencana Keuangan Belanja Operasional (%) wajib diisi.',
                'rf_op.required' => 'Rencana Fisik Belanja Operasional wajib diisi.',
                'pg_bl_bm.required' => 'Pagu Belanja Modal wajib diisi.',
                'rk_keu_bm_rp.required' => 'Rencana Keuangan Belanja Modal (Rp) wajib diisi.',
                'rk_keu_bm_per.required' => 'Rencana Keuangan Belanja Modal (%) wajib diisi.',
                'rf_bm.required' => 'Rencana Fisik Belanja Modal wajib diisi.',
                'pg_btt.required' => 'Pagu Belanja Tidak Terduga wajib diisi.',
                'rk_keu_btt_rp.required' => 'Rencana Keuangan Belanja Tidak Terduga (Rp) wajib diisi.',
                'rk_keu_btt_per.required' => 'Rencana Keuangan Belanja Tidak Terduga (%) wajib diisi.',
                'rf_btt.required' => 'Rencana Fisik Belanja Tidak Terduga wajib diisi.',
                'pg_bl_bt.required' => 'Pagu Belanja Transfer wajib diisi.',
                'rk_keu_bt_rp.required' => 'Rencana Keuangan Belanja Transfer (Rp) wajib diisi.',
                'rk_keu_bt_per.required' => 'Rencana Keuangan Belanja Transfer (%) wajib diisi.',
                'rf_bt.required' => 'Rencana Fisik Belanja Transfer wajib diisi.',
                'pg_bl_peg.required' => 'Pagu Belanja Pegawai wajib diisi.',
                'rk_keu_peg_rp.required' => 'Rencana Keuangan Belanja Pegawai (Rp) wajib diisi.',
                'rk_keu_peg_per.required' => 'Rencana Keuangan Belanja Pegawai (%) wajib diisi.',
                'rf_peg.required' => 'Rencana Fisik Belanja Pegawai wajib diisi.',

            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        //APBD
        $validatedApbd = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_apbd' => $request->input('pg_apbd'),
            'real_apbd' => $request->input('real_apbd'),
            'real_apbd_per' => $request->input('real_apbd_per'),
            'real_apbd_fisik' => $request->input('real_apbd_fisik'),
            'pg_bl_op' => $request->input('pg_bl_op'),
            'rk_keu_op_rp' => $request->input('rk_keu_op_rp'),
            'rk_keu_op_per' => $request->input('rk_keu_op_per'),
            'rf_op' => $request->input('rf_op'),
            'pg_bl_bm' => $request->input('pg_bl_bm'),
            'rk_keu_bm_rp' => $request->input('rk_keu_bm_rp'),
            'rk_keu_bm_per' => $request->input('rk_keu_bm_per'),
            'rf_bm' => $request->input('rf_bm'),
            'pg_btt' => $request->input('pg_btt'),
            'rk_keu_btt_rp' => $request->input('rk_keu_btt_rp'),
            'rk_keu_btt_per' => $request->input('rk_keu_btt_per'),
            'rf_btt' => $request->input('rf_btt'),
            'pg_bl_bt' => $request->input('pg_bl_bt'),
            'rk_keu_bt_rp' => $request->input('rk_keu_bt_rp'),
            'rk_keu_bt_per' => $request->input('rk_keu_bt_per'),
            'rf_bt' => $request->input('rf_bt'),
            'permasalahan' => $request->input('permasalahan'),
            'status' => 1,

        ];

        //Tabel Pegawai
        $validatedPegawai = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bl_peg' => str_replace(',', '', $request->input('pg_bl_peg')),
            'rk_keu_peg_rp' => str_replace(',', '', $request->input('rk_keu_peg_rp')),
            'rk_keu_peg_per' => $request->input('rk_keu_peg_per'),
            'rf_peg' => $request->input('rf_peg'),
        ];

        //Belanja Subsidi
        $validatedSubsidi = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bl_sub' => str_replace(',', '', $request->input('pg_bl_sub')),
            'rk_keu_sub_rp' => str_replace(',', '', $request->input('rk_keu_sub_rp')),
            'rk_keu_sub_per' => $request->input('rk_keu_sub_per'),
            'rf_sub' => $request->input('rf_sub'),
        ];

        //Barang Jasa
        $validatedBj = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bl_bj' => str_replace(',', '', $request->input('pg_bl_bj')),
            'rk_keu_bj_rp' => str_replace(',', '', $request->input('rk_keu_bj_rp')),
            'rk_keu_bj_per' => $request->input('rk_keu_bj_per'),
            'rf_bj' => $request->input('rf_bj'),
        ];

        //Hibah
        $validatedHibah = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bl_hibah' => str_replace(',', '', $request->input('pg_bl_hibah')),
            'rk_keu_hibah_rp' => str_replace(',', '', $request->input('rk_keu_hibah_rp')),
            'rk_keu_hibah_per' => $request->input('rk_keu_hibah_per'),
            'rf_hibah' => $request->input('rf_hibah'),
        ];

        //Bantuan Sosial
        $validatedBantuanSosial = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bl_bansos' => str_replace(',', '', $request->input('pg_bl_bansos')),
            'rk_keu_bansos_rp' => str_replace(',', '', $request->input('rk_keu_bansos_rp')),
            'rk_keu_bansos_per' => $request->input('rk_keu_bansos_per'),
            'rf_bansos' => $request->input('rf_bansos'),
        ];

        //BM Tanah
        $validatedBmTanah = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bm_tanah' => str_replace(',', '', $request->input('pg_bm_tanah')),
            'rk_keu_bm_tanah_rp' => str_replace(',', '', $request->input('rk_keu_bm_tanah_rp')),
            'rk_keu_bm_tanah_per' => $request->input('rk_keu_bm_tanah_per'),
            'rf_bm_tanah' => $request->input('rf_bm_tanah'),
        ];

        //BM Alat Mesin
        $validatedBmAlatMesin = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bm_alat_mesin' => str_replace(',', '', $request->input('pg_bm_alat_mesin')),
            'rk_keu_alat_mesin_rp' => str_replace(',', '', $request->input('rk_keu_alat_mesin_rp')),
            'rk_keu_alat_mesin_per' => $request->input('rk_keu_alat_mesin_per'),
            'rf_alat_mesin' => $request->input('rf_alat_mesin'),
        ];

        //BM Gedung
        $validatedBmGedung = [
            'pg_bm_gedung' => str_replace(',', '', $request->input('pg_bm_gedung')),
            'rk_keu_gedung_rp' => str_replace(',', '', $request->input('rk_keu_gedung_rp')),
            'rk_keu_gedung_per' => $request->input('rk_keu_gedung_per'),
            'rf_gedung' => $request->input('rf_gedung'),
        ];

        //BM Jalan
        $validatedBmJalan = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bm_jalan' => str_replace(',', '', $request->input('pg_bm_jalan')),
            'rk_keu_jalan_rp' => str_replace(',', '', $request->input('rk_keu_jalan_rp')),
            'rk_keu_jalan_per' => $request->input('rk_keu_jalan_per'),
            'rf_jalan' => $request->input('rf_jalan'),
        ];

        //BM Aset
        $validatedBmAset = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bm_aset' => str_replace(',', '', $request->input('pg_bm_aset')),
            'rk_keu_aset_rp' => str_replace(',', '', $request->input('rk_keu_aset_rp')),
            'rk_keu_aset_per' => $request->input('rk_keu_aset_per'),
            'rf_aset' => $request->input('rf_aset'),
        ];

        //Bagi Hasil
        $validatedBagiHasil = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bl_bagi_hasil' => str_replace(',', '', $request->input('pg_bl_bagi_hasil')),
            'rk_keu_bagi_hasil_rp' => str_replace(',', '', $request->input('rk_keu_bagi_hasil_rp')),
            'rk_keu_bagi_hasil_per' => $request->input('rk_keu_bagi_hasil_per'),
            'rf_bagi_hasil' => $request->input('rf_bagi_hasil'),
        ];

        //Bantuan Keu
        $validatedBantuanKeu = [
            'tahun' => session('ta'),
            'id_unit' => $request->input('id_unit'),
            'id_bln' => $request->input('id_bln'),
            'pg_bl_bantuan_keu' => str_replace(',', '', $request->input('pg_bl_bantuan_keu')),
            'rk_keu_bantuan_keu_rp' => str_replace(',', '', $request->input('rk_keu_bantuan_keu_rp')),
            'rk_keu_bantuan_keu_per' => $request->input('rk_keu_bantuan_keu_per'),
            'rf_bantuan_keu' => $request->input('rf_bantuan_keu'),
        ];

        // dd($validatedApbd, $validatedBantuanSosial, $validatedBmTanah, $validatedBmAlatMesin, $validatedBmGedung, $validatedBmJalan, $validatedBmAset, $validatedBagiHasil, $validatedBantuanKeu);

        try {
            DB::table('tbl_apbd')->where('id_bln', $validatedApbd['id_bln'])->where('id_unit', $validatedApbd['id_unit'])->update($validatedApbd);
            DB::table('tbl_bl_pegawai')->where('id_bln', $validatedPegawai['id_bln'])->where('id_unit', $validatedPegawai['id_unit'])->update($validatedPegawai);
            DB::table('tbl_bl_subsidi')->where('id_bln', $validatedSubsidi['id_bln'])->where('id_unit', $validatedSubsidi['id_unit'])->update($validatedSubsidi);
            DB::table('tbl_bl_barang_jasa')->where('id_bln', $validatedBj['id_bln'])->where('id_unit', $validatedBj['id_unit'])->update($validatedBj);
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }
}