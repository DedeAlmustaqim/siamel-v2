<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'login'
        ];
        return view('login', $data);
    }

    public function login(Request $request)
    {
        // Validasi input dari form login
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'NIP atau Password salah');
        }
        $ta = $request->input('ta');
        // Coba autentikasi pengguna pada tabel admin
        $user = DB::table('admin')
            ->where('username', $request->username)
            ->join('tbl_akses', 'admin.id_akses', '=', 'tbl_akses.id_akses')
            ->first();

        if ($user && password_verify($request->password, $user->password)) {
            // Regenerasi sesi untuk mencegah serangan session fixation
            $request->session()->regenerate();
            // Simpan data pengguna ke session
            $sessionData = [
                'login' => true,
                'akses' => $user->id_akses,
                'hak_akses' => $user->hak_akses,
                'ses_id' => $user->id_user,
                'ses_user' => $user->username,
                'ses_nm' => $user->nama,
                'ta' => $ta,
            ];
            $request->session()->put($sessionData);
            return redirect('dashboard');
        }

        // Jika tidak ditemukan pada tabel admin, cek ke tabel user
        $user = DB::table('tbl_user')
            ->where('username', $request->username)
            ->join('tbl_akses', 'tbl_user.id_akses', '=', 'tbl_akses.id_akses')
            ->join('tbl_unit', 'tbl_user.id_unit', '=', 'tbl_unit.id_unit')
            ->first();

        if ($user && password_verify($request->password, $user->password)) {
            // Regenerasi sesi untuk mencegah serangan session fixation
            $request->session()->regenerate();
            // Simpan data pengguna ke session
            $sessionData = [
                'login' => true,
                'akses' => $user->id_akses,
                'hak_akses' => $user->hak_akses,
                'ses_id' => $user->id_user, // Assuming the field is id_user in tbl_user
                'ses_user' => $user->username,
                'ses_nm' => $user->nama,
                'ses_id_unit' => $user->id_unit,
                'ses_nm_unit' => $user->nm_unit,
                'ta' => $ta,
            ];
            $request->session()->put($sessionData);
            return redirect('dashboard');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return redirect()->back()->with('error', 'Username atau Password salah');
    }

    protected function redirectBasedOnRole()
    {

        if (auth()->user()->role === 'admin') {
            return redirect('dashboard');
        } elseif (auth()->user()->role === 'pt') {
            return redirect('dashboard');
        } elseif (auth()->user()->role === 'pegawai') {
            return redirect('/peg/dashboard');
        }



        // Default redirect jika role tidak terdeteksi
        return redirect('/login');
    }
    function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}