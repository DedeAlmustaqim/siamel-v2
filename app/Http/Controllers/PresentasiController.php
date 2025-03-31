<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentasiController extends Controller
{
    public function index()
    {
        $data = [
            'unit' => DB::table('tbl_unit')->get(),
            'title' => 'Presentasi'
        ];
        return view('presentasi.index', $data);
    }
}