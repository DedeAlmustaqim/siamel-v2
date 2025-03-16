<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $jadwal = DB::table('tbl_bln')
            ->where('aktif', '1')
            ->select(
                DB::raw("CASE 
                    WHEN id_bln = 1 THEN 'Januari'
                    WHEN id_bln = 2 THEN 'Februari'
                    WHEN id_bln = 3 THEN 'Maret'
                    WHEN id_bln = 4 THEN 'April'
                    WHEN id_bln = 5 THEN 'Mei'
                    WHEN id_bln = 6 THEN 'Juni'
                    WHEN id_bln = 7 THEN 'Juli'
                    WHEN id_bln = 8 THEN 'Agustus'
                    WHEN id_bln = 9 THEN 'September'
                    WHEN id_bln = 10 THEN 'Oktober'
                    WHEN id_bln = 11 THEN 'November'
                    WHEN id_bln = 12 THEN 'Desember'
                END as nama_bulan"),
                DB::raw("DATE_FORMAT(tgl_akhir, '%Y/%m/%d %H:%i:%s') as tgl_akhir")
            )
            ->first();



        View::share('jadwal', $jadwal);
    }
}