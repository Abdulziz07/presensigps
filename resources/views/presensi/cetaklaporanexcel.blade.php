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

    <table style="width: 100%;">
        <tr style="vertical-align: middle;">
            <td style="width: 10px; text-align: center; vertical-align: middle; padding: 10px;">
              <img src="{{ asset('assets/img/logohb.png') }}" alt="Logo" width="100">
            </td>
            <td style="text-align: center;">
                <h3 style="margin-bottom: 10px;">
                    CV. HABERINDO <br>
                    LAPORAN PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
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
                <img src="{{url($path)}}" alt="Logo" width="80">
            </td>
        </tr>
        <tr>
            <td>NRP</td>
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
            <th>Jam Pulang</th>
            <th>Keterangan</th>
            <th>Jam Kerja</th>
        </tr>
        @php
            $totalTerlambatMenit = 0;
        @endphp

        @foreach ($presensi as $d)
            @php
                $path_in = $d->foto_in ? Storage::url('upload/absensi' . $d->foto_in) : asset('assets/img/camera.jpg');
                $path_out = $d->foto_out ? Storage::url('upload/absensi' . $d->foto_out) : null;

                $jamIn = \Carbon\Carbon::parse($d->jam_in);
                $jamOut = $d->jam_out ? \Carbon\Carbon::parse($d->jam_out) : null;
                $statusShift = strtolower($d->status);
                $terlambat = false;
                $terlambatMenit = 0;

                // Tentukan batas jam masuk berdasarkan shift dan atur ulang tanggal jika perlu
                if ($statusShift == 'p') {
                    $batas = \Carbon\Carbon::parse($jamIn->format('Y-m-d') . ' 00:00:00');
                } elseif ($statusShift == 's') {
                    $batas = \Carbon\Carbon::parse($jamIn->format('Y-m-d') . ' 07:05:00');
                    if ($jamIn->format('H:i:s') < '03:00:00') {
                        $batas->subDay(); // Masuk dini hari = masih shift sore sebelumnya
                    }
                } elseif ($statusShift == 'm') {
                    $batas = \Carbon\Carbon::parse($jamIn->format('Y-m-d') . ' 16:05:00');
                    if ($jamIn->format('H:i:s') < '12:00:00') {
                        $batas->subDay(); // Masuk pagi = masih shift malam sebelumnya
                    }
                } else {
                    $batas = $jamIn; // fallback
                }

                // Hitung keterlambatan
                if ($jamIn->greaterThan($batas)) {
                    $terlambat = true;
                    $terlambatMenit = $jamIn->diffInMinutes($batas);
                }

                $totalTerlambatMenit += $terlambatMenit;

                $status = $terlambat ? "Terlambat ({$terlambatMenit} Menit)" : "Tepat Waktu";
                $jamKerja = $jamOut ? $jamOut->diffInMinutes($jamIn) : 0;
                $jamKerjaFormatted = $jamOut ? floor($jamKerja / 60) . ' Jam ' . ($jamKerja % 60) . ' Menit' : '0';

                $shiftLabel = match($statusShift) {
                    'p' => '(Shift 1)',
                    's' => '(Shift 2)',
                    'm' => '(Shift 3)',
                    default => '(Dinas Luar)',
                };
            @endphp

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</td>
                <td>
                    <span style="color: {{ $terlambat ? 'red' : 'black' }}">
                        {{ $d->jam_in }}
                    </span>
                </td>
                <td>
                    {{ $d->jam_out ?? 'Belum Absen' }}
                </td>
                <td>
                    {{ $status }} <br>
                    {{ $shiftLabel }}
                </td>
                <td>
                    {{ $jamKerjaFormatted }}<br>
                    OT {{ $d->ot ?? 0 }} Jam
                </td>
            </tr>
        @endforeach

    </table>
    <table width="100%" style="margin-top: 80px;">
        <tr>
            <td colspan="2" style="text-align: right; padding-right: 90px;">Kota Bekasi, {{date('d-m-Y')}}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align:bottom; height: 100px;">
                <u></u><br>
                <i><b>HRD Manager</b></i>
            </td>
            <td style="text-align: center; vertical-align:bottom;">
                <u></u><br>
                <i><b>Direktur</b></i>
            </td>
        </tr>
    </table>

  </section>

</body>

</html>