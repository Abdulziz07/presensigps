@extends('layouts.admin.tabler')

@section('content')
<div class="page-wrapper">
    <!-- Header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Data Barang</h2>
                </div>           
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">

                    <!-- Card Container -->
                    <div class="card">
                        <div class="card-body">

                            <!-- Flash Messages -->
                            <div class="row">
                                <div class="col-12">
                                    @if(Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if(Session::get('warning'))
                                        <div class="alert alert-warning">
                                            {{ Session::get('warning') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="btn btn-primary" id="btnTambahKirimbarang">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" 
                                            class="icon icon-tabler icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 5v14M5 12h14" />
                                        </svg>
                                        Kirim Barang
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <form action="/presensi/kirimbarang" method="GET" autocomplete="off">
                                        <div class="row">
                                            <div class="col-6">
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                                </span>
                                                <input type="text" value="{{Request('dari')}}" id="dari" class="form-control" name="dari" placeholder="Dari">
                                            </div>
                                            </div>
                                        <div class="col-6">
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                                </span>
                                                <input type="text" value="{{Request('sampai')}}" id="sampai" class="form-control" name="sampai" placeholder="Sampai">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary" type="submit">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                                        Cari data
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Driver</th>
                                                <th>Nama Barang</th>
                                                <th>Tanggal Ajukan</th>
                                                <th>Lokasi Tujuan</th>
                                                <th>Diterima Driver</th>
                                                <th>Terkirim</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($karyawan as $d)
                                            <tr>
                                                <td>{{$loop->iteration + $karyawan->firstItem()-1}}</td>
                                                <td>
                                                    @php
                                                        // Ambil nama driver berdasarkan NIK karyawan
                                                        $driver = DB::table('karyawan')->where('nik', $d->nik)->first();
                                                    @endphp
                                                    @if ($driver)
                                                        {{$driver->nama_lengkap}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{$d->nama_barang}}</td>
                                                <td>{{date('d-m-Y',strtotime($d->tgl_kirim))}}</td>
                                                <td>{{$d->lokasi_tujuan}}</td>
                                                <td>
                                                @if (is_null($d->jam_kirim))
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @else
                                                    {{date('d-m-Y',strtotime($d->tgl_terima))}} <br>
                                                    {{$d->jam_kirim}}
                                                @endif
                                                </td>
                                                <td>
                                                @if (is_null($d->jam_selesai))
                                                    @if ($d->status_kirim == 1)
                                                        <span class="badge bg-primary">Menunggu</span>
                                                    @else
                                                        <span class="badge bg-warning">Menunggu</span>
                                                    @endif
                                                @else
                                                    {{date('d-m-Y',strtotime($d->tgl_selesai))}} <br>
                                                    {{ $d->jam_selesai }}
                                                @endif
                                                </td>
                                                <td>
                                                @if ($d->status_kirim == 0)
                                                        <span class="badge bg-warning">Belum Dikirim</span>
                                                    @elseif ($d->status_kirim == 1)
                                                        <span class="badge bg-primary">Sedang Dikirim</span>
                                                    @elseif ($d->status_kirim == 2)
                                                        <span class="badge bg-success">Terkirim</span>
                                                    @else
                                                        <span class="badge bg-secondary">Tidak Diketahui</span>
                                                    @endif
                                                </td>
                                                <td>
                                                <form action="/presensi/{{$d->nik}}/delete" style="margin-left:5px;" method="POST">
                                                            @csrf
                                                            <a class="delete-confirm btn btn-danger btn-sm rounded" ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                        Hapus</a>
                                            
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $karyawan->links('vendor.pagination.bootstrap-5')}}
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Karyawan -->
            <div class="modal modal-blur fade" id="modal-inputkirimbarang" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Kirim Barang</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="/presensi/storeBarang" method="POST" id="frmpresensi" enctype="multipart/form-data">
                                @csrf

                                <div class="input-icon mb-3">
                                    <select name="nik" id="nik" class="form-select">
                                        <option value="">Pilih Driver</option>
                                        @foreach ($drivers as $d)
                                            @if(strtolower($d->jabatan) == 'driver')
                                                <option value="{{ $d->nik }}">{{ $d->nama_lengkap }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                                    </span>
                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang">
                                </div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                    </span>
                                    <input type="text" id="tgl_kirim" value="" class="form-control" name="tgl_kirim" placeholder="Tanggal Ajukan Kirim Barang">
                                </div>

                                <!-- Input Lokasi Tujuan -->
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" 
                                            class="icon icon-tabler icon-tabler-home">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" name="lokasi_tujuan" id="lokasi_tujuan" placeholder="Alamat Lokasi Tujuan">
                                </div>

                                <!-- Input Koordinat Tujuan -->
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                                    </span>
                                    <input type="text" class="form-control" name="koordinat_tujuan" id="koordinat_tujuan" placeholder="Koordinat Alamat Lokasi">
                                </div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-radar-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" /><path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" /><path d="M12 12v9" /></svg>
                                    </span>
                                    <input type="text" class="form-control" name="radius_tujuan" id="radius_tujuan" placeholder="Radius Alamat Lokasi 'contoh : 50'">
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group mt-3">
                                    <button class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" 
                                            class="icon icon-tabler icon-tabler-file-download">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M12 17v-6" />
                                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5" />
                                        </svg>
                                        Simpan
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(function() {
        $("#btnTambahKirimbarang").click(function() {
            $("#modal-inputkirimbarang").modal("show");
        });
    });

    $("#frmpresensi").submit(function () {
    var nama_barang = $("#nama_barang").val();
    var tgl_kirim = $("#tgl_kirim").val();
    var lokasi_tujuan = $("#lokasi_tujuan").val();
    var koordinat_tujuan = $("#koordinat_tujuan").val();
    var nik = $("#nik").val();
    var radius_tujuan = $("#radius_tujuan").val();
    

    if (nik == "") {
        Swal.fire({
            title: 'Warning',
            text: 'Pilih Driver',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            $("#nik").focus();
        });
        return false;
    } else if (nama_barang == "") {
        Swal.fire({
            title: 'Warning',
            text: 'Nama Barang Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            $("#nama_barang").focus();
        });
        return false;
    } else if (tgl_kirim == "") {
        Swal.fire({
            title: 'Warning',
            text: 'Tanggal Kirim Barang Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            $("#tgl_kirim").focus();
        });
        return false;
    } else if (lokasi_tujuan == "") {
        Swal.fire({
            title: 'Warning',
            text: 'Lokasi Tujuan Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            $("#lokasi_tujuan").focus();
        });
        return false;
        
    } else if (koordinat_tujuan == "") {
        Swal.fire({
            title: 'Warning',
            text: 'Koordinat Tujuan Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            $("#koordinat_tujuan").focus();
        });
        return false;
    } else if (radius_tujuan == "") {
        Swal.fire({
            title: 'Warning',
            text: 'Radius Tujuan Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            $("#radius_tujuan").focus();
        });
        return false;
    }
});

$(".delete-confirm").click(function(e){
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
              title: "Apakah Anda Yakin Menghapus Data Ini?",
              text: "Jika Ya Data Akan Terhapus Permanen",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Hapus"
            }).then((result) => {
              if (result.isConfirmed) {
                form.submit();
                Swal.fire({
                  title: "Deleted!",
                  text: "Data Berhasil Di Hapus",
                  icon: "success"
                });
              }
            });
        });

        $("#tgl_kirim").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format : "yyyy-mm-dd"
        });

        $("#dari").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format : "yyyy-mm-dd"
        });

        $("#sampai").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format : "yyyy-mm-dd"
        });

</script>
@endpush
