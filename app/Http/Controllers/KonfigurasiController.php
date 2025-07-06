<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasikantor(){
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        return view('konfigurasi.lokasikantor', compact('lok_kantor'));
    }
    public function updatelokasikantor(Request $request){
        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;

        $update = DB::table('konfigurasi_lokasi')->where('id',1)->update([
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
        ]);

        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function lokasidinasluarkantor(){
    
        $lokasi = DB::table('konfigurasi_dinas')->orderBy('id', 'desc')->paginate(10);
        return view('konfigurasi.lokasidinasluarkantor', compact('lokasi'));

    }

    public function datalokasiluardinas(Request $request){
        $alamatdinas = $request -> alamatdinas;
        $koordinatdinas = $request -> koordinatdinas;
        $radiusdinas = $request -> radiusdinas;
        
        $data = [
            'alamat' => $alamatdinas,
            'koordinat_tujuan' => $koordinatdinas,
            'radius_tujuan'=> $radiusdinas,
        ];
        $simpan = DB::table('konfigurasi_dinas')->insert($data);

        if ($simpan) {
            return redirect()->back()->with('success', 'Data lokasi dinas luar berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data lokasi dinas luar.');
        }

    }

    public function hapuslokasidinasluar($id)
{
    $hapus = DB::table('konfigurasi_dinas')->where('id', $id)->delete();

    return response()->json([
        'status' => $hapus ? 'success' : 'error',
        'message' => $hapus ? 'Data berhasil dihapus' : 'Data gagal dihapus'
    ]);
}
}
