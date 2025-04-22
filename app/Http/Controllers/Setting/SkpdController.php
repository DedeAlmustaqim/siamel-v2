<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SkpdController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengaturan SKPD'
        ];
        return view('setting.skpd.index', $data);
    }

    public function getDatatablesSkpd()
    {
        $data = DB::table('tbl_unit')

            //->join('table_2', 'table.id_kec', '=', 'table_2.id')
            // ->where('table.id', $where)
            ->orderBy('tbl_unit.urut', 'ASC')
            //Gunakan kondisi sesuai role login
            //->when(auth()->user()->role === 'role', function ($query) {
            //return $query->where('table.role', session('role'));
            //})
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function updateSkpd(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'input' => 'required|string|max:255',
            ],
            [
                'input.required' => 'Wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $validatedData = [
            'input' => $request->input('input'),
        ];

        try {
            DB::table('table')->insert($validatedData);
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    public function getSkpdById($id): JsonResponse
    {
        $data = DB::table('tbl_unit')->where('id_unit', $id)->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function getPagu($id)
    {
        $row = DB::table('tbl_pagu')->where('id_unit', $id)->first();
        if ($row) {
            $data = [
                'id_pg' => $row->id_pg,
                'id_unit' => $row->id_unit,
                'pg_apbd' => $row->pg_apbd,
                'pg_bl_op' => $row->pg_bl_op,
                'pg_bl_bm' => $row->pg_bl_bm,
                'pg_btt' => $row->pg_btt,
                'pg_bt' => $row->pg_bt,
                'btt_disable' => $row->btt_disable,
                'bt_disable' => $row->bt_disable,
                'pg_bl_peg' => $row->pg_bl_peg,
                'pg_bl_sub' => $row->pg_bl_sub,
                'pg_bl_bj' => $row->pg_bl_bj,
                'pg_bl_hibah' => $row->pg_bl_hibah,
                'pg_bl_bansos' => $row->pg_bl_bansos,
                'pg_bm_tanah' => $row->pg_bm_tanah,
                'pg_bm_alat_mesin' => $row->pg_bm_alat_mesin,
                'pg_bm_gedung' => $row->pg_bm_gedung,
                'pg_bm_jalan' => $row->pg_bm_jalan,
                'pg_bm_aset' => $row->pg_bm_aset,
                'pg_bl_bagi_hasil' => $row->pg_bl_bagi_hasil,
                'pg_bl_bantuan_keu' => $row->pg_bl_bantuan_keu,
                'pg_bl_peg_disable' => $row->pg_bl_peg_disable,
                'pg_bl_sub_disable' => $row->pg_bl_sub_disable,
                'pg_bl_bj_disable' => $row->pg_bl_bj_disable,
                'pg_bl_hibah_disable' => $row->pg_bl_hibah_disable,
                'pg_bl_bansos_disable' => $row->pg_bl_bansos_disable,
                'pg_bm_tanah_disable' => $row->pg_bm_tanah_disable,
                'pg_bm_alat_mesin_disable' => $row->pg_bm_alat_mesin_disable,
                'pg_bm_gedung_disable' => $row->pg_bm_gedung_disable,
                'pg_bm_jalan_disable' => $row->pg_bm_jalan_disable,
                'pg_bm_aset_disable' => $row->pg_bm_aset_disable,
                'pg_bl_bagi_hasil_disable' => $row->pg_bl_bagi_hasil_disable,
                'pg_bl_bantuan_keu_disable' => $row->pg_bl_bantuan_keu_disable,
            ];
        } else {
            $data = [
                'id_pg' => 0,
                'id_unit' => 0,
                'pg_apbd' => 0,
                'pg_bl_op' => 0,
                'pg_bl_bm' => 0,
                'pg_btt' => 0,
                'pg_bt' => 0,
                'btt_disable' => 0,
                'bt_disable' => 0,
            ];
        }
        return response()->json($data);
    }


    public function updatePagu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_unit_pg' => 'required',
            'pg_apbd_pg' => 'required',
            'pg_bl_op_pg' => 'required',
            'pg_bl_bm_pg' => 'required',
            'pg_btt_pg' => 'required',
            'pg_bt_pg' => 'required',

            'pg_bl_peg_pg' => 'required',
            'pg_bl_sub_pg' => 'required',
            'pg_bl_bj_pg' => 'required',
            'pg_bl_hibah_pg' => 'required',
            'pg_bl_bansos_pg' => 'required',
            'pg_bm_tanah_pg' => 'required',
            'pg_bm_alat_mesin_pg' => 'required',
            'pg_bm_gedung_pg' => 'required',
            'pg_bm_jalan_pg' => 'required',
            'pg_bm_aset_pg' => 'required',
            'pg_bl_bagi_hasil_pg' => 'required',
            'pg_bl_bantuan_keu_pg' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }
        $id_unit = $request->input('id_unit_pg');
        $pg_apbd = $request->input('pg_apbd_pg');
        $pg_bl_op = $request->input('pg_bl_op_pg');
        $pg_bl_bm = $request->input('pg_bl_bm_pg');
        $pg_btt = $request->input('pg_btt_pg');
        $pg_bt = $request->input('pg_bt_pg');

        $pg_bl_peg = $request->input('pg_bl_peg_pg');
        $pg_bl_sub = $request->input('pg_bl_sub_pg');
        $pg_bl_bj = $request->input('pg_bl_bj_pg');
        $pg_bl_hibah = $request->input('pg_bl_hibah_pg');
        $pg_bl_bansos = $request->input('pg_bl_bansos_pg');
        $pg_bm_tanah = $request->input('pg_bm_tanah_pg');
        $pg_bm_alat_mesin = $request->input('pg_bm_alat_mesin_pg');
        $pg_bm_gedung = $request->input('pg_bm_gedung_pg');
        $pg_bm_jalan = $request->input('pg_bm_jalan_pg');
        $pg_bm_aset = $request->input('pg_bm_aset_pg');
        $pg_bl_bagi_hasil = $request->input('pg_bl_bagi_hasil_pg');
        $pg_bl_bantuan_keu = $request->input('pg_bl_bantuan_keu_pg');

        $btt_disable = $request->input('btt_disable', false) ? 1 : 0;
        $pg_bl_peg_disable = $request->input('pg_bl_peg_disable', false) ? 1 : 0;
        $pg_bl_sub_disable = $request->input('pg_bl_sub_disable', false) ? 1 : 0;
        $pg_bl_bj_disable = $request->input('pg_bl_bj_disable', false) ? 1 : 0;
        $pg_bl_hibah_disable = $request->input('pg_bl_hibah_disable', false) ? 1 : 0;
        $pg_bl_bansos_disable = $request->input('pg_bl_bansos_disable', false) ? 1 : 0;
        $pg_bm_tanah_disable = $request->input('pg_bm_tanah_disable', false) ? 1 : 0;
        $pg_bm_alat_mesin_disable = $request->input('pg_bm_alat_mesin_disable', false) ? 1 : 0;
        $pg_bm_gedung_disable = $request->input('pg_bm_gedung_disable', false) ? 1 : 0;
        $pg_bm_jalan_disable = $request->input('pg_bm_jalan_disable', false) ? 1 : 0;
        $pg_bm_aset_disable = $request->input('pg_bm_aset_disable', false) ? 1 : 0;
        $pg_bl_bagi_hasil_disable = $request->input('pg_bl_bagi_hasil_disable', false) ? 1 : 0;
        $pg_bl_bantuan_keu_disable = $request->input('pg_bl_bantuan_keu_disable', false) ? 1 : 0;

        $data = [
            'id_unit' => $id_unit,
            'pg_apbd' => str_replace(',', '', $pg_apbd),
            'pg_bl_op' => str_replace(',', '', $pg_bl_op),
            'pg_bl_bm' => str_replace(',', '', $pg_bl_bm),
            'pg_btt' => str_replace(',', '', $pg_btt),
            'pg_bt' => str_replace(',', '', $pg_bt),

            'pg_bl_peg' => str_replace(',', '', $pg_bl_peg),
            'pg_bl_sub' => str_replace(',', '', $pg_bl_sub),
            'pg_bl_bj' => str_replace(',', '', $pg_bl_bj),
            'pg_bl_hibah' => str_replace(',', '', $pg_bl_hibah),
            'pg_bl_bansos' => str_replace(',', '', $pg_bl_bansos),
            'pg_bm_tanah' => str_replace(',', '', $pg_bm_tanah),
            'pg_bm_alat_mesin' => str_replace(',', '', $pg_bm_alat_mesin),
            'pg_bm_gedung' => str_replace(',', '', $pg_bm_gedung),
            'pg_bm_jalan' => str_replace(',', '', $pg_bm_jalan),
            'pg_bm_aset' => str_replace(',', '', $pg_bm_aset),
            'pg_bl_bagi_hasil' => str_replace(',', '', $pg_bl_bagi_hasil),
            'pg_bl_bantuan_keu' => str_replace(',', '', $pg_bl_bantuan_keu),

            'btt_disable' => $btt_disable,
            'pg_bl_peg_disable' => $pg_bl_peg_disable,
            'pg_bl_sub_disable' => $pg_bl_sub_disable,
            'pg_bl_bj_disable' => $pg_bl_bj_disable,
            'pg_bl_hibah_disable' => $pg_bl_hibah_disable,
            'pg_bl_bansos_disable' => $pg_bl_bansos_disable,
            'pg_bm_tanah_disable' => $pg_bm_tanah_disable,
            'pg_bm_alat_mesin_disable' => $pg_bm_alat_mesin_disable,
            'pg_bm_gedung_disable' => $pg_bm_gedung_disable,
            'pg_bm_jalan_disable' => $pg_bm_jalan_disable,
            'pg_bm_aset_disable' => $pg_bm_aset_disable,
            'pg_bl_bagi_hasil_disable' => $pg_bl_bagi_hasil_disable,
            'pg_bl_bantuan_keu_disable' => $pg_bl_bantuan_keu_disable,
        ];



        // $this->m_master->pagu($data, $id_unit, $ta);
        try {
            DB::table('tbl_pagu')->where('id_unit', $id_unit)->update($data);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function getUser($id)
    {
        $data = DB::table('tbl_user')
            ->select(
                'tbl_user.id_user',
                'tbl_user.username',
            )
            ->where('tbl_user.id_unit', $id)
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }


    public function reset_pass(Request $request, $id)
    {

        $data = [
            'password' => bcrypt('SiamelBartim'),
        ];


        try {
            DB::table('tbl_user')->where('id_user', $id)->update($data);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {

            return response()->json(['success' => false]);
        }
    }
}
