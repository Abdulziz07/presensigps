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
        font-size: 10px;
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
<body class="A4 landscape">
     
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

  <table style="width: 100%;">
        <tr style="vertical-align: middle;">
            <td style="width: 10px; text-align: left; vertical-align: middle; padding: 10px;">
              <img src="{{ asset('assets/img/logohb.png') }}" alt="Logo" width="100">
            </td>
            <td style="text-align: left;">
                <h3 style="margin-bottom: 10px;">
                    CV. HABERINDO <br>
                    LAPORAN PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                </h3>
                <span><i>Jln Gendul no 46 Kel. Pengasinan, kec. Rawalumbu, kota Bekasi Timur-Jawa Barat,17115</i></span>
            </td>
        </tr>
    </table>
    <span style="display:block; text-align:center; transform: translateY(-5px);"><i>_________________________________________________________________________________________________________________________________</i></span>
    
    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">NRP</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">OT</th>
            <th rowspan="2">Total Telat</th>
        </tr>
        <tr>
            <?php for($i = 1; $i <= 31; $i++) { ?>
                <th>{{ $i }}</th>
            <?php } ?>>
        </tr>

        @foreach($rekap as $d)
    <tr>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <?php
        $totalhadir = 0;
        $jumlahtelat = 0;

        for ($i = 1; $i <= 31; $i++) {
            $tgl = "tgl_" . $i;
            $cell = $d->$tgl;

            $warnajam = '';
            $jam_in = '';
            $jam_out = '';
            $status = '';
            $ot = '';

            if (!empty($cell)) {
                // Pisahkan berdasarkan <br>
                $parts = explode('<br>', $cell);

                // Format: [jam_in-jam_out], OT (opsional), status
                $jam = explode('-', $parts[0] ?? '');
                $jam_in = trim($jam[0] ?? '');
                $jam_out = trim($jam[1] ?? '');
                $ot = isset($parts[1]) && str_contains($parts[1], 'OT') ? 'OT' : '';
                $status = $parts[count($parts) - 1] ?? ''; // status selalu di akhir

                // Hitung hadir
                if (!empty($jam_in)) {
                    $totalhadir++;

                    // Cek apakah telat
                    if (
                        ($status == 'p' && $jam_in >= '00:00:00' && $jam_in <= '20:00:00') || 
                        ($status == 's' && (
                            ($jam_in >= '07:05:00' && $jam_in <= '23:59:59') || 
                            ($jam_in < '03:00:00')
                        )) || 
                        ($status == 'm' && (
                            ($jam_in >= '16:05:00' && $jam_in <= '23:59:59') || 
                            ($jam_in < '12:00:00')
                        ))
                    ) {
                        $warnajam = 'red';
                        $jumlahtelat++;
                    }
                }
            }
        ?>
            <td>
                <span style="color: {{ $warnajam }}">
                    {{ $jam_in }}
                </span>
                @if ($jam_out)
                    - {{ $jam_out }}
                @endif
                @if ($status)
                <br>
                @php
                    $keterangan_shift = match(strtolower($status)) {
                        'p' => 'Shift 1',
                        's' => 'Shift 2',
                        'm' => 'Shift 3',
                        'd' => 'Dinas Luar',
                        default => strtoupper($status),
                    };
                @endphp
                {{ $keterangan_shift }}
            @endif
            @if ($ot)
                    <br>{{ $ot }}
                @endif
            </td>
        <?php } ?>
        <td>{{ $totalhadir }}</td>
        <td>{{ $d->total_ot ?? 0 }} Jam</td>
        <td>{{ $jumlahtelat }}</td>
    </tr>
@endforeach

    </table>
    
    <table width="100%" style="margin-top: 80px;">
        <tr>
            <td colspan="2" style="text-align: right; padding-right: 170px;">Kota Bekasi, {{date('d-m-Y')}}</td>
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