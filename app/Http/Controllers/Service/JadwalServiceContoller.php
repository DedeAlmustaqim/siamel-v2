<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalServiceContoller extends Controller
{
    public function kunciInput($id_bln)
    {
        $result = DB::table('tbl_bln')->select(DB::raw('case when tgl_awal < CURRENT_TIMESTAMP() AND CURRENT_TIMESTAMP()  < tgl_akhir then true else false
        end as kunci_bln'))->where('id_bln', $id_bln)->first();
        return $result->kunci_bln;
    }
}
