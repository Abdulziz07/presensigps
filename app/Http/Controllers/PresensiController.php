<?php
namespace App\Http\Controllers;

use App\Models\Kirimbarang;
use App\Models\Pengajuanizin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function create(){
        $hariini = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi',$hariini)->where('nik',$nik)->count();
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        return view('presensi.create',compact('cek','lok_kantor'));
    }
    
    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        $lok = explode(",", $lok_kantor->lokasi_kantor);
        $latitudekantor = $lok[0];
        $longitudekantor = $lok[1];

        $lokasi = $request->lokasi;
        $lokasiuser = explode(",",$lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        
        $jarak = $this->distance($latitudekantor,$longitudekantor,$latitudeuser,$longitudeuser);
        $radius = round($jarak [ "meters"]);
        
        $cek = DB::table('presensi')->where('tgl_presensi',$tgl_presensi)->where('nik',$nik)->count();
        
        if($cek > 0){
            $ket = "out";
        }else{
            $ket = "in";
        }
        $image = $request->image;
        $folderPath = "public/upload/absensi";
        $formatName = $nik."-".$tgl_presensi."-".$ket;
        $image_parts = explode(";base64",$image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName.".png";
        $file = $folderPath.$fileName;
        
        
        if($radius > $lok_kantor->radius){
            echo "error|Maaf jarak Anda diluar lokasi sejauh ".$radius." Meter dari Perusahaan|radius";
            
        }else{
            
            
        if ($cek > 0){
            $data_pulang = [
                'jam_out' => $jam,
                'foto_out' => $fileName,
                'lokasi_out' => $lokasi,
                
            ];
            $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik',$nik)->update($data_pulang);
            if($update){
                echo "success|Terimakasih, Hati hati dijalan|out";
                Storage::put($file, $image_base64);
            }else{
                echo "error|Maaf Gagal absen, Hubungi It Dept|out";
            }
        }else{
            
        $data = [
            'nik' => $nik,
            'tgl_presensi' => $tgl_presensi,
            'jam_in' => $jam,
            'foto_in' => $fileName,
            'lokasi_in' => $lokasi, 
        ];
        
        $simpan = DB::table('presensi')->insert($data);
        if($simpan){
            echo "success|Terimakasih, Selamat Bekerja|in";
            Storage::put($file, $image_base64);
        }else{
            echo "error|Maaf Gagal absen, Hubungi It Dept|in";
        }
    }
}
}

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
    
    public function editprofile(){
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik',$nik)
        ->first();
        return view('presensi.editprofile', compact('karyawan'));
    }

    public function updateprofile(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;
        $domisiliskrng = $request->domisiliskrng;
        $status1 = $request->status1;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        if($request->hasFile('foto')){
            $foto = $nik."user.".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }
        
        if(empty($request->password)){
        $data = [
            'nama_lengkap' => $nama_lengkap,
            'domisiliskrng'=> $domisiliskrng,
            'no_hp' => $no_hp,
            'status1'=> $status1,
            'foto' => $foto
        ];
    }else{
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'domisiliskrng'=> $domisiliskrng,
                'no_hp' => $no_hp,
                'status1'=> $status1,
                'password' => $password,
                'foto' => $foto
            ];
        }
        $update = DB::table('karyawan')->where('nik',$nik)->update($data);
        if($update){
            if($request->hasFile('foto')){
                $folderPath = "public/upload/karyawan/user/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Update']);
        }
    }
    public function histori(){
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return view('presensi.histori', compact('namabulan'));
    }
    public function gethistori(Request $request){
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;
    
        // Ambil data untuk 6 bulan terakhir
        $months = [];
        for ($i = 0; $i < 3; $i++) {
            $month = date("m", strtotime("-$i month"));
            $months[] = $month;
        }
    
        $histori = DB::table('presensi')
            ->whereIn(DB::raw('MONTH(tgl_presensi)'), $months)
            ->whereYear('tgl_presensi', $tahun)
            ->where('nik', $nik)
            ->orderBy('tgl_presensi', 'desc')
            ->get();
    
        return view('presensi.gethistori', compact('histori'));
    }
    
    public function izin(){
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik',$nik)->get();
        return view('presensi.izin',compact('dataizin'));
    }
    public function buatizin(){
        return view('presensi.buatizin');
    }
    public function storeizin(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status =  $request->status;
        $keterangan = $request->keterangan;
        
        
        if($request->hasFile('foto')){
            $foto = $tgl_izin.",".$nik."Izin.".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }
    
        // Cek jika status adalah "Cuti", pastikan hanya satu kali dalam sebulan
        if($status == 'c') {
            $bulanTahun = date('Y-m', strtotime($tgl_izin));
            $cutiTahunBulan = DB::table('pengajuan_izin')
                ->where('nik', $nik)
                ->where('status', 'c')
                ->whereRaw("DATE_FORMAT(tgl_izin, '%Y-%m') = ?", [$bulanTahun])
                ->exists();
    
            if ($cutiTahunBulan) {
                return redirect('/presensi/izin')->with(['error' => 'Anda sudah mengajukan cuti bulan ini.']);
            }
        }
    
        $data = [
            'nik' => $nik,
            'tgl_izin'=>$tgl_izin,
            'status'=>$status,
            'keterangan'=>$keterangan,
            'fotoizin'=>$foto,
            'status_approved' => '0'
        ];
    
        $simpan = DB::table('pengajuan_izin')->insert($data);
    
        if($simpan){
            if($request->hasFile('foto')){
                $folderPath = "public/upload/karyawan/izin/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil Disimpan']);
        }else{
            return redirect('/presensi/izin')->with(['error'=>'Data Gagal Disimpan']);
        }
    }

    public function cekpengajuanizin(Request $request){
        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('pengajuan_izin')->where('nik',$nik)->where('tgl_izin',$tgl_izin)->count();
        return $cek;
    }
    

    public function monitoring() {

        return view('presensi.monitoring');
        
    }

    public function getpresensi(Request $request){
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
        ->select('presensi.*','nama_lengkap','nama_dept')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->join('departemen','karyawan.kode_dept','=','departemen.kode_dept')
        ->where('tgl_presensi', $tanggal)
        ->get();

        return view('presensi.getpresensi',compact('presensi'));
    }

    public function tampilkanpeta (Request $request){
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id',$id)
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->first();
        return view('presensi.showmap',compact('presensi'));
    }

    public function laporan(){
            $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
            return view('presensi.laporan',compact('namabulan','karyawan'));
    }

    public function cetaklaporan(Request $request){
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $karyawan = DB::table('karyawan')->where('nik',$nik)
        ->join('departemen','karyawan.kode_dept','=','departemen.kode_dept')
        ->first();

        $presensi = DB::table('presensi')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->orderBy('tgl_presensi','desc')
        ->get();

        if (isset($_POST['exportexcel'])){
            $time = date("d-M-Y H:i:s");

            header("Content-type: application/vnd-ms-excel");

            header("Content-Disposition: attachment; filename=Laporan Presensi Karyawan $time.xls");

            return view('presensi.cetaklaporanexcel',compact('bulan','tahun','namabulan','karyawan','presensi'));
        }

        return view('presensi.cetaklaporan',compact('bulan','tahun','namabulan','karyawan','presensi'));
    }

    public function rekap(){
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        return view('presensi.rekap',compact('namabulan'));
}
    public function cetakrekap(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $rekap = DB::table('presensi')
        ->selectRaw('presensi.nik,nama_lengkap,
            MAX(IF(DAY(tgl_presensi) = 1,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_1,
            MAX(IF(DAY(tgl_presensi) = 2,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_2,
            MAX(IF(DAY(tgl_presensi) = 3,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_3,
            MAX(IF(DAY(tgl_presensi) = 4,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_4,
            MAX(IF(DAY(tgl_presensi) = 5,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_5,
            MAX(IF(DAY(tgl_presensi) = 6,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_6,
            MAX(IF(DAY(tgl_presensi) = 7,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_7,
            MAX(IF(DAY(tgl_presensi) = 8,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_8,
            MAX(IF(DAY(tgl_presensi) = 9,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_9,
            MAX(IF(DAY(tgl_presensi) = 10,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_10,
            MAX(IF(DAY(tgl_presensi) = 11,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_11,
            MAX(IF(DAY(tgl_presensi) = 12,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_12,
            MAX(IF(DAY(tgl_presensi) = 13,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_13,
            MAX(IF(DAY(tgl_presensi) = 14,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_14,
            MAX(IF(DAY(tgl_presensi) = 15,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_15,
            MAX(IF(DAY(tgl_presensi) = 16,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_16,
            MAX(IF(DAY(tgl_presensi) = 17,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_17,
            MAX(IF(DAY(tgl_presensi) = 18,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_18,
            MAX(IF(DAY(tgl_presensi) = 19,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_19,
            MAX(IF(DAY(tgl_presensi) = 20,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_20,
            MAX(IF(DAY(tgl_presensi) = 21,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_21,
            MAX(IF(DAY(tgl_presensi) = 22,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_22,
            MAX(IF(DAY(tgl_presensi) = 23,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_23,
            MAX(IF(DAY(tgl_presensi) = 24,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_24,
            MAX(IF(DAY(tgl_presensi) = 25,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_25,
            MAX(IF(DAY(tgl_presensi) = 26,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_26,
            MAX(IF(DAY(tgl_presensi) = 27,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_27,
            MAX(IF(DAY(tgl_presensi) = 28,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_28,
            MAX(IF(DAY(tgl_presensi) = 29,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_29,
            MAX(IF(DAY(tgl_presensi) = 30,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_30,
            MAX(IF(DAY(tgl_presensi) = 31,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_31')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->groupByRaw('presensi.nik,nama_lengkap')
        ->get();


        if (isset($_POST['exportexcel'])){
            $time = date("d-M-Y H:i:s");

            header("Content-type: application/vnd-ms-excel");

            header("Content-Disposition: attachment; filename=Rekap Presensi Karyawan $time.xls");
        }

        return view('presensi.cetakrekap',compact('bulan','tahun','namabulan','rekap'));
        }

        public function izinsakit(Request $request){
            $query = Pengajuanizin::query();
            $query->select('id','tgl_izin','pengajuan_izin.nik','nama_lengkap','jabatan','status','status_approved','keterangan','fotoizin');
            $query->join('karyawan','pengajuan_izin.nik','=','karyawan.nik');
            if(!empty ($request->dari) && !empty($request->sampai)){
                $query->whereBetween('tgl_izin',[$request->dari,$request->sampai]);
            }
            if(!empty ($request->nik)){
                $query->where('pengajuan_izin.nik',$request->nik);
            }
            if(!empty ($request->nama_lengkap)){
                $query->where('nama_lengkap','like','%'. $request->nama_lengkap .'%');
            }
            if($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2'){
                $query->where('status_approved',$request->status_approved);
            }
            $query->orderBy('tgl_izin','desc');
            $izinsakit = $query->paginate(10);
            $izinsakit->appends($request->all());
            return view('presensi.izinsakit',compact('izinsakit'));
        }

        public function approveizinsakit(Request $request){
            $status_approved = $request->status_approved;
            $id_izinsakit_form = $request->id_izinsakit_form;
            $update = DB::table('pengajuan_izin')->where('id',$id_izinsakit_form)->update([
                'status_approved' => $status_approved
            ]);
            if ($update){
                return Redirect::back()->with(['success'=>'Data Berhasil Di Update']);
            } else {
                return Redirect::back()->with(['warning'=>'Data Gagal Di Update']);
            }
        }

        public function batalkanizinsakit($id){
            $update = DB::table('pengajuan_izin')->where('id',$id)->update([
                'status_approved' => 0
            ]);
            if ($update){
                return Redirect::back()->with(['success'=>'Data Berhasil Di Update']);
            } else {
                return Redirect::back()->with(['warning'=>'Data Gagal Di Update']);
            }
        }

        public function kirimbarang(Request $request)
{
    // Query utama: barang_kiriman JOIN dengan karyawan
    $query = DB::table('barang_kiriman')
        ->join('karyawan', 'barang_kiriman.nik', '=', 'karyawan.nik')
        ->where('karyawan.jabatan', 'driver')
        ->select(
            'barang_kiriman.id',
            'barang_kiriman.nik',
            'barang_kiriman.nama_barang',
            'karyawan.nama_lengkap',
            'karyawan.jabatan',
            'barang_kiriman.tgl_kirim',
            'barang_kiriman.lokasi_tujuan',
            'barang_kiriman.tgl_terima',
            'barang_kiriman.jam_kirim',
            'barang_kiriman.tgl_selesai',
            'barang_kiriman.jam_selesai',
            'barang_kiriman.status_kirim'
        );

        // Filter berdasarkan rentang tanggal
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('barang_kiriman.tgl_kirim', [$request->dari, $request->sampai]);
        }

        // Urutkan dan paginate hasil
        $karyawan = $query->orderBy('barang_kiriman.tgl_kirim', 'desc')->paginate(10);
        $karyawan->appends($request->all());

        // Data semua driver untuk dropdown/select option
        $drivers = DB::table('karyawan')->where('jabatan', 'driver')->get();

        return view('presensi.kirimbarang', compact('karyawan', 'drivers'));
    }


        
        public function storeBarang(Request $request)
        {
            $nama_barang       = $request->nama_barang;
            $tgl_kirim         = $request->tgl_kirim;
            $lokasi_tujuan     = $request->lokasi_tujuan;
            $koordinat_tujuan  = $request->koordinat_tujuan;
            $nik               = $request->nik;
            $radius_tujuan     = $request->radius_tujuan;

            $data = [
                'nama_barang'      => $nama_barang,
                'tgl_kirim'        => $tgl_kirim,
                'lokasi_tujuan'    => $lokasi_tujuan,
                'koordinat_tujuan' => $koordinat_tujuan,
                'nik'              => $nik,
                'radius_tujuan'    => $radius_tujuan,
                'status_kirim'     => '0'
            ];

            $simpan = DB::table('barang_kiriman')->insert($data);

            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
        }


        public function barang(){
            $nik = Auth::guard('karyawan')->user()->nik;
            $datakirim = DB::table('barang_kiriman')->where('nik', $nik)->get();
            return view('presensi.barang', compact('datakirim'));
        }


        public function delete($nik){
            $barang = DB::table('barang_kiriman')->where('nik', $nik)->first();

        if ($barang) {
            // Hapus hanya data yang ditemukan
            DB::table('barang_kiriman')->where('nik', $nik)->where('id', $barang->id)->delete();
            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect()->back()->with(['warning' => 'Data Tidak Ditemukan']);
        }
            }
            
        public function terimaKiriman($id)
        {
            $data = DB::table('barang_kiriman')->where('id', $id)->first();

            if (!$data) {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }

            $today = Carbon::today()->toDateString();
            $tglKirim = optional($data)->tgl_kirim;

            // Jika belum diterima (status_kirim == 0), maka periksa tanggal
            if ($data->status_kirim == 0) {
                if ($tglKirim != $today) {
                    return redirect()->back()->with('error', 'Tanggal hari ini tidak sesuai dengan tanggal pengiriman.');
                }

                // Jika tanggal sesuai, update status dan simpan jam serta tgl_terima
                DB::table('barang_kiriman')->where('id', $id)->update([
                    'status_kirim'  => 1,
                    'jam_kirim'     => Carbon::now(),
                    'tgl_terima'    => $today,
                ]);
            }

            // Tetap boleh masuk ke halaman lihatbarang
            return redirect()->route('presensi.lihatbarang', ['id' => $id]);
        }
            
            public function lihatbarang($id)
            {
                $data = DB::table('barang_kiriman')->where('id', $id)->first();
                return view('presensi.lihatbarang', compact('data'));
            }

            public function selesaikanpengiriman(Request $request,$id){

                $koordinat_tujuan = DB::table('barang_kiriman')->where('id', $id)->first();
                $kordinat = explode(",", $koordinat_tujuan->koordinat_tujuan);
                $latkoordinat = $kordinat[0];
                $longkoordinat = $kordinat[1];

                $lokasi_sekarang = $request->lokasi_sekarang;
                $lokasiuser = explode(",",$lokasi_sekarang);
                $latitudeuser = $lokasiuser[0];
                $longitudeuser = $lokasiuser[1];

                $jarak =$this->distance($latkoordinat,$longkoordinat,$latitudeuser,$longitudeuser);
                $radius_tujuan = round($jarak ["meters"]);  
                
                if ($radius_tujuan > $koordinat_tujuan->radius_tujuan) {
                    // Jika di luar radius, tidak diupdate
                    return response("error|Maaf jarak Anda diluar dari Alamat lokasi tujuan|radius");
                } else {
                    $data = [
                        'status_kirim' => 2,
                        'jam_selesai' => Carbon::now(),
                        'tgl_selesai' => Carbon::today() 
                    ];
                
                    // Hanya update data sesuai ID
                    $update = DB::table('barang_kiriman')->where('id', $id)->update($data);
                
                    if ($update) {
                        return response("success|Terimakasih Atas Pengirimannya|in");
                    } else {
                        return response("error|Maaf Gagal Menyelesaikan, Hubungi IT Dept|in");
                    }
                }
                
            }


}