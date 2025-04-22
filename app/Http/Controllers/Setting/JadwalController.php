<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JadwalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Jadwal'
        ];
        return view('setting.jadwal.index', $data);
    }

    public function getDatatablesBln()
    {
        $data = DB::table('tbl_bln')
            ->select('*')
            ->selectRaw("DATE_FORMAT(tbl_bln.tgl_awal, '%d-%m-%Y %H:%i:%s') as tgl_awal")
            ->selectRaw("DATE_FORMAT(tbl_bln.tgl_akhir, '%d-%m-%Y %H:%i:%s') as tgl_akhir")
            ->selectRaw("case when tgl_awal < CURRENT_TIMESTAMP() AND CURRENT_TIMESTAMP()  < tgl_akhir then '1' else '0'
            end as kunci_bln")
            ->orderBy('tbl_bln.id_bln', 'ASC')

            ->get()
            ->map(function ($item) {

                $item->hariAwal = \Carbon\Carbon::parse($item->tgl_awal)->locale('id_ID')->dayName;
                $item->hariAkhir = \Carbon\Carbon::parse($item->tgl_akhir)->locale('id_ID')->dayName;

                return $item;
            });
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataBlnbyId($id): JsonResponse
    {
        $data = DB::table('tbl_bln')->where('id_bln', $id)->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IdBln' => 'required',
                'TglAwal' => 'required',
                'TglAkhir' => 'required',
                'WktInputAwal' => 'required',
                'WktInputAkhir' => 'required',
            ],

        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $id = $request->input('IdBln');
        $TglAwal = $request->input('TglAwal');
        $TglAkhir = $request->input('TglAkhir');
        $WktInputAwal = $request->input('WktInputAwal');
        $WktInputAkhir = $request->input('WktInputAkhir');
        $validatedData = [
            'tgl_awal' => $TglAwal . " " . $WktInputAwal,
            'tgl_akhir' => $TglAkhir . " " . $WktInputAkhir,
        ];

        try {
            DB::table('tbl_bln')->where('id_bln', $id)->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    public function updateAktif(Request $request, $id)
    {
        $value = $request->input('value');


        try {
            if ($value == 1) {
                DB::table('tbl_bln')
                    ->where('id_bln', '<>', $id)
                    ->update([
                        'aktif' => 0,
                    ]);

                DB::table('tbl_bln')
                    ->where('id_bln', $id)
                    ->update([
                        'aktif' => 1,
                    ]);
            } else {
                DB::table('tbl_bln')
                    ->where('id_bln', $id)
                    ->update([
                        'aktif' => 0,
                    ]);
            }

            return response()->json(['success' => true, 'message' => 'Jadwal berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Jadwal memperbarui produk'], 500); // 500: Internal Server Error
        }
    }
}