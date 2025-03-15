<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    //

    public function getGrafikApbdSkpd($id_unit): JsonResponse
    {
        $data = DB::table('tbl_apbd')
            ->selectRaw("*, CASE id_bln
                            WHEN 1 THEN 'Januari'
                            WHEN 2 THEN 'Februari'
                            WHEN 3 THEN 'Maret'
                            WHEN 4 THEN 'April'
                            WHEN 5 THEN 'Mei'
                            WHEN 6 THEN 'Juni'
                            WHEN 7 THEN 'Juli'
                            WHEN 8 THEN 'Agustus'
                            WHEN 9 THEN 'September'
                            WHEN 10 THEN 'Oktober'
                            WHEN 11 THEN 'November'
                            WHEN 12 THEN 'Desember'
                        END as nama_bulan")
            ->where('id_unit', $id_unit)
            ->where('tahun', session('ta'))
            ->get();

        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }
}