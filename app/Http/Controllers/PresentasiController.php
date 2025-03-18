<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresentasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Presentasi'
        ];
        return view('presentasi.index', $data);
    }
}