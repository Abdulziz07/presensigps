<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik',$nik)->where('tgl_presensi',$hariini)->first();
        $historibulanini = DB::table('presensi')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')
        ->orderBy('tgl_presensi')
        ->get();


        $rekappresensi = DB::table('presensi')
        ->selectRaw("
            COUNT(nik) as jmlhadir,
            SUM(
                CASE 
                    WHEN status = 'p' AND TIME(jam_in) BETWEEN '00:00:00' AND '20:00:00' THEN 1
                    WHEN status = 's' AND (
                        TIME(jam_in) BETWEEN '07:05:00' AND '23:59:59'
                        OR TIME(jam_in) < '03:00:00'
                    ) THEN 1
                    WHEN status = 'm' AND (
                        TIME(jam_in) BETWEEN '16:05:00' AND '23:59:59'
                        OR TIME(jam_in) < '12:00:00'
                    ) THEN 1
                    ELSE 0
                END
            ) as jmlterlambat
        ")
        ->where('nik', $nik)
        ->whereRaw("MONTH(tgl_presensi) = '$bulanini'")
        ->whereRaw("YEAR(tgl_presensi) = '$tahunini'")
        ->first();

        
        $leaderboard = DB::table('presensi')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->where('tgl_presensi',$hariini)
        ->orderBy('jam_in')
        ->get();
        
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_izin)="'.$bulanini.'"')
        ->where('status_approved',1)
        ->first();

        return view('dashboard.dashboard', compact('presensihariini','historibulanini','namabulan','bulanini','tahunini',
        'rekappresensi','leaderboard','rekapizin'));
    }

    public function dashboardadmin(){
        $hariini = date("Y-m-d");
        $rekappresensi = DB::table('presensi')
        ->selectRaw("
            COUNT(nik) as jmlhadir,
            SUM(
                CASE 
                    WHEN status = 'p' AND TIME(jam_in) BETWEEN '00:00:00' AND '20:00:00' THEN 1
                    WHEN status = 's' AND (
                        TIME(jam_in) BETWEEN '07:05:00' AND '23:59:59'
                        OR TIME(jam_in) < '03:00:00'
                    ) THEN 1
                    WHEN status = 'm' AND (
                        TIME(jam_in) BETWEEN '16:05:00' AND '23:59:59'
                        OR TIME(jam_in) < '12:00:00'
                    ) THEN 1
                    ELSE 0
                END
            ) as jmlterlambat
        ")
        ->where('tgl_presensi', $hariini)
        ->first();

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin', $hariini)
        ->where('status_approved',1)
        ->first();
        return view('dashboard.dashboardadmin', compact('rekappresensi','rekapizin'));
    }
}
