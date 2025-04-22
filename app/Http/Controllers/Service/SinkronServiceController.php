<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SinkronServiceController extends Controller
{
    public function btnSinkron(Request $request)
    {
        $ta = session('ta');
        $id_unit = session('ses_id_unit');

        $exists = DB::table('tbl_apbd')
            ->where('id_unit', $id_unit)
            ->where('tahun', $ta)
            ->exists();

        return response()->json($exists);
    }



    public function sinkron(Request $request)
    {
        $id_unit = session('ses_id_unit');
        $ta = session('ta');

        // Cek apakah data sudah ada
        $exists = DB::table('tbl_apbd')
            ->where('id_unit', $id_unit)
            ->where('tahun', $ta)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Data sudah disinkron sebelumnya.'
            ]);
        }

        // Siapkan data bulan 1-12
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = [
                'id_bln' => $i,
                'id_unit' => $id_unit,
                'tahun' => $ta
            ];
        }

        // Daftar tabel yang akan diisi
        $tables = [
            'tbl_apbd',
            'tbl_ppbj_50',
            'tbl_ppbj_200',
            'tbl_ppbj_25',
            'tbl_pendapatan',
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

        // Transaksi agar lebih aman
        DB::beginTransaction();

        try {
            foreach ($tables as $table) {
                DB::table($table)->insert($data);
            }

            // Update kolom sinkron
            DB::table('tbl_unit')
                ->where('id_unit', $id_unit)
                ->update(['sinkron' => 1]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disinkronisasi.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Gagal sinkronisasi: ' . $e->getMessage()
            ]);
        }
    }
}