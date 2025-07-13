<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        if (empty($request->nik) && empty($request->password)) {
            return redirect('/')->with('warning', 'NRP dan Password tidak boleh kosong');
        }

        if (empty($request->nik)) {
            return redirect('/')->with('warning', 'NRP tidak boleh kosong');
        }

        if (empty($request->password)) {
            return redirect('/')->with('warning', 'Password tidak boleh kosong');
        }

        if (Auth::guard('karyawan')->attempt([
            'nik' => $request->nik,
            'password' => $request->password
        ])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with('warning', 'NRP atau Password salah');
        }
    }

    public function proseslogout()
    {
        if(Auth::guard('karyawan')->check()){
           Auth::guard('karyawan')->logout();
           return redirect('/');
        }
    }

    public function proseslogoutadmin(){
        if(Auth::guard('user')->check()){
           Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    public function prosesloginadmin(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ], [
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Format email tidak valid',
        'password.required' => 'Password tidak boleh kosong'
    ]);

    // Proses login jika validasi berhasil
    if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect('/panel/dashboardadmin');
    } else {
        return redirect('/panel')->with(['warning' => 'Email atau Password Salah']);
    }
}


    public function showForm()
    {
        return view('auth.lupa_password'); // Pastikan file blade-nya sesuai
    }

    public function handleReset(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'no_telpon' => 'required',
        ]);

        $user = DB::table('karyawan')
            ->where('nik', $request->input('nik'))
            ->where('no_hp', $request->input('no_telpon'))
            ->first();

        if (!$user) {
            return back()->with('error', 'NIK atau No Telpon tidak cocok');
        }

        DB::table('karyawan')
            ->where('nik', $request->input('nik'))
            ->update([
                'password' => Hash::make('12345'),
            ]);

        return back()->with('success', 'Password berhasil direset ke 12345 ');
    }

    public function cekresetpassword(Request $request)
    {
        $nik = $request->input('nik');
        $no_hp = $request->input('no_hp');

        $karyawan = DB::table('karyawan')
            ->where('nik', $nik)
            ->where('no_hp', $no_hp)
            ->where('jabatan', 'Admin')
            ->first();

        if (!$karyawan){
            return back()->with('error', 'NIK atau No Telepon tidak cocok, atau Anda Bukan Admin');
        }

        DB::table('users')
            ->where('id', '1')
            ->update([
                'password' => Hash::make('123456'),
            ]);
            
            return back()->with('success', 'Password berhasil direset ke 12345 ');
        }
             
}