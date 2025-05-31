<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { 
    size: A4
     }
     h3{
        font-family: Arial, Helvetica, sans-serif;
     }

     .tabeldatakaryawan td {
        padding: 5px;
     }
     .tabelpresensi{
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
     }

     .tabelpresensi tr th{
        border: 2px solid rgb(0, 0, 0);
        padding: 8px;
        background-color:rgb(218, 218, 218);
     }

     .tabelpresensi tr td{
        border: 2px solid rgb(0, 0, 0);
        padding: 5px;
        font-size: 14px;
        text-align: center;
     }

  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
     
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%">
        <tr>
            <td>
                <img src="{{asset ('assets/img/logohb.png')}}" width="120" height="120" alt="">
            </td>
            <td>
                <h3 style="margin-bottom: 10px; text-align: center; margin-right: 90px;" >
                    CV. HABERINDO <br>
                    LAPORAN PRESENSI KARYAWAN <br>
                    PERIODE {{strtoupper($namabulan[$bulan])}} {{$tahun}}<br>
                </h3>
                <span><i>Jln Gendul no 46 Kel. Pengasinan, kec. Rawalumbu, kota Bekasi Timur-Jawa Barat,17115</i></span>
            </td>
        </tr>
    </table>
    <span style="display:block; text-align:center; transform: translateY(-5px);"><i>_________________________________________________________________________________________</i></span>
    <table class="tabeldatakaryawan" style="margin-top: 10px">
        <tr>
            <td rowspan="6">
                @php
                    $path = Storage::url('upload/karyawan/'.$karyawan->foto1);
                @endphp
                <img src="{{url($path)}}" alt="" width="120px" height="150px">
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{$karyawan->nik}}</td>
        </tr>
        <tr>
            <td>Nama Karyawan</td>
            <td>:</td>
            <td>{{$karyawan->nama_lengkap}}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{$karyawan->jabatan}}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{$karyawan->nama_dept}}</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>:</td>
            <td>{{$karyawan->no_hp}}</td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Foto</th>
            <th>Jam Pulang</th>
            <th>Foto</th>
            <th>Keterangan</th>
            <th>Jam Kerja</th>
        </tr>
        @foreach ($presensi as $d)
        @php
            $path_in = Storage::url('upload/absensi'.$d->foto_in);
            $path_out = Storage::url('upload/absensi'.$d->foto_out);

            $jamIn = \Carbon\Carbon::parse($d->jam_in);
            $jamOut = $d->jam_out ? \Carbon\Carbon::parse($d->jam_out) : null;

            $jamMasukString = $jamIn->format('H:i');

            // Tentukan shift dan batas waktu masuk
            if ($jamMasukString >= '07:15' && $jamMasukString <= '15:30') {
            // Shift 1
            $batasMasuk = \Carbon\Carbon::parse($jamIn->format('Y-m-d').' 07:15:00');
            } elseif ($jamMasukString >= '16:15' && $jamMasukString <= '23:30') {
            // Shift 2
            $batasMasuk = \Carbon\Carbon::parse($jamIn->format('Y-m-d').' 16:15:00');
            } elseif ($jamMasukString >= '00:30' && $jamMasukString <= '06:30') {
            // Shift 3 (tanpa subDay)
            $batasMasuk = \Carbon\Carbon::parse($jamIn->format('Y-m-d').' 00:30:00');
            } else {
            // Fallback jika tidak sesuai shift
            $batasMasuk = $jamIn;
            }

            // Hitung keterlambatan
            $terlambat = $jamIn->greaterThan($batasMasuk) ? $jamIn->diffInMinutes($batasMasuk) : 0;

            // Hitung jam kerja
            $jamKerja = $jamOut ? $jamOut->diffInMinutes($jamIn) : 0;
            $jamKerjaFormatted = $jamOut ? floor($jamKerja / 60) . ' Jam ' . ($jamKerja % 60) . ' Menit' : '0';

            // Keterangan
            $status = $terlambat > 0 ? 'Terlambat ('.$terlambat.' Menit)' : 'Tepat Waktu';
        @endphp
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ date("d-m-Y",strtotime($d->tgl_presensi))}}</td>
            <td>{{ $d->jam_in }}</td>
            <td><img src="{{url($path_in)}}" alt="" width="60px" height="60px"></td>
            <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen'}}</td>
            <td>
                @if ($d->jam_out != null)
                <img src="{{ url($path_out)}}" alt="" width="60px" height="60px">
                @else
                <img src="{{ asset('assets/img/camera.jpg')}}" alt="" width="60px" height="60px">
                @endif
            </td>
            <td>
                @if ($terlambat > 0)
                {{ $status }}
                @else
                {{ $status }}
                @endif
            </td>
            <td>{{ $jamKerjaFormatted }}</td>
        </tr>
        @endforeach
    </table>
    <table width="100%" style="margin-top: 80px;">
        <tr>
            <td colspan="2" style="text-align: right; padding-right: 90px;">Kota Bekasi, {{date('d-m-Y')}}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align:bottom; height: 100px;">
                <u>nama hrd</u><br>
                <i><b>HRD Manager</b></i>
            </td>
            <td style="text-align: center; vertical-align:bottom;">
                <u>nama direktur</u><br>
                <i><b>Direktur</b></i>
            </td>
        </tr>
    </table>

  </section>

</body>

</html>