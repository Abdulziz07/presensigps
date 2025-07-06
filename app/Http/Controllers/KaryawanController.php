<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request){

        
        $query = Karyawan::query();
        $query->select('karyawan.*','nama_dept');
        $query->join('departemen','karyawan.kode_dept',"=",'departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap','like','%'.$request->nama_karyawan.'%');
        }
        if(!empty($request->kode_dept)){
            $query->where('karyawan.kode_dept',$request->kode_dept);
        }
        $karyawan = $query->paginate(10);
    
        $departemen = DB::table('departemen')->get();

        return view('karyawan.index', compact('karyawan','departemen'));
    }

    public function store(Request $request){
        $nik = $request -> nik;
        $nama_lengkap = $request -> nama_lengkap;
        $alamat = $request -> alamat;
        $nik1 = $request -> nik1;
        $jabatan = $request -> jabatan;
        $no_hp = $request -> no_hp;
        $kode_dept = $request -> kode_dept;
        $password = Hash::make('12345');

        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try{
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'alamat'=> $alamat,
                'nik1' => $nik1,
                'jabatan'=> $jabatan,
                'no_hp' => $no_hp,
                'kode_dept'=> $kode_dept,
                'foto1'=> $foto,
                'password'=>$password
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if($request->hasFile('foto')){
                    $folderPath = "public/upload/karyawan/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan']);
            }
        } catch (\Exception $e){
            return Redirect::back()->with(['warning' => 'Data Gagal Di Simpan']);
        }
    }
public function edit(Request $request){
    $nik = $request->nik;
    $departemen = DB::table('departemen')->get();
    $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
    return view('karyawan.edit',compact('departemen','karyawan'));
}
public function update($nik, Request $request){
    $nik = $request -> nik;
        $nama_lengkap = $request -> nama_lengkap;
        $alamat = $request -> alamat;
        $nik1 = $request -> nik1;
        $jabatan = $request -> jabatan;
        $no_hp = $request -> no_hp;
        $kode_dept = $request -> kode_dept;
        $password = Hash::make('12345');
        $old_foto = $request->old_foto;
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try{
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'nik1' => $nik1,
                'alamat'=> $alamat,
                'jabatan'=> $jabatan,
                'no_hp' => $no_hp,
                'kode_dept'=> $kode_dept,
                'foto1'=> $foto,
                'password'=>$password
            ];
            $update = DB::table('karyawan')->where('nik',$nik)->update($data);
            if($update){
                if($request->hasFile('foto')){
                    $folderPath = "public/upload/karyawan/";
                    $folderPathOld = "public/upload/karyawan/".$old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
            }
        } catch (\Exception $e){
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
        }
        
        public function delete($nik){
            $delete = DB::table('karyawan')->where('nik',$nik)->delete();
            if($delete){
                return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
            } else {
                return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
            }
        }

        public function updatepwd(Request $request)
        {
            $messages = [
                'newpwd.required' => 'Password tidak boleh kosong.',
                'newpwd.min' => 'Password minimal 6 karakter.',
            ];

            $validated = $request->validate([
                'newpwd' => 'required|min:6',
            ], $messages);

            $user = Auth::guard('user')->user();

            if (!$user) {
                return redirect()->back()->with('warning', 'User tidak ditemukan.');
            }

            DB::table('users') // Ganti jika tabelnya bukan 'users'
                ->where('id', $user->id)
                ->update([
                    'password' => Hash::make($request->newpwd)
                ]);

            return redirect()->back()->with('success', 'Password berhasil diubah!');
        }
}
