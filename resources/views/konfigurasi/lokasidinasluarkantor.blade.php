@extends('layouts.admin.tabler')

@section('content')
<div class="page-wrapper">
    <!-- Header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Data Lokasi Dinas Luar Kantor</h2>
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
                                    <a href="#" class="btn btn-primary" id="btnTambahDinasLuar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" 
                                            class="icon icon-tabler icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 5v14M5 12h14" />
                                        </svg>
                                        Tambah Lokasi Dinas Luar
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Alamat Dinas Luar</th>
                                                <th>Radius</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($lokasi as $d)
                                            <tr>
                                                <td>{{ $loop->index + $lokasi->firstItem() }}</td>
                                                <td>{{ $d->Alamat }}</td>
                                                <td>{{ $d->radius_tujuan }}</td>
                                                <td>
                                                <button class="btn btn-sm btn-danger btnHapus" data-id="{{ $d->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="20" height="20"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7l0 -3h6l0 3" />
                                                    </svg>
                                                </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="modal modal-blur fade" id="modal-inputalamatdinasluar" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Lokasi Absen Dinas Luar</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/konfigurasi/datalokasidinasluar" method="POST" id="frmdinasluar" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                        </span>
                        <input type="text" value="" id="alamatdinas" class="form-control" name="alamatdinas" placeholder="Alamat Dinas Luar Kantor">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                        </span>
                        <input type="text" value="" id="koordinatdinas" class="form-control" name="koordinatdinas" placeholder="Koordinat Lokasi Dinas Luar Kantor">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-radar-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" /><path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" /><path d="M12 12v9" /></svg>
                        </span>
                        <input type="text" value="" id="radiusdinas" class="form-control" name="radiusdinas" placeholder="Radius">
                    </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-group">
                        <button class="btn btn-primary w-100">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 17v-6" /><path d="M9.5 14.5l2.5 2.5l2.5 -2.5" /></svg>
                            Simpan
                        </button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
      </div>
    </div>
    @endsection

@push('myscript')
<script>
$(function(){
        $("#btnTambahDinasLuar").click(function(){
            $("#modal-inputalamatdinasluar").modal("show");
        });
    });

    $("#frmdinasluar").submit(function(){
            var alamatdinas = $("#alamatdinas").val();
            var koordinatdinas = $ ("#koordinatdinas").val();
            var radiusdinas = $("#radiusdinas").val();
            if(alamatdinas == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'Alamat Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#alamatdinas").focus();
                    });
                return false;
            } else if(koordinatdinas == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'Koordinat Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#koordinatdinas").focus();
                    });
                return false;
            }  else if(radiusdinas == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'Radius Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#radiusdinas").focus();
                    });
                return false;
            }
    });

    $(document).ready(function () {
        $(".btnHapus").click(function () {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Yakin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/konfigurasi/lokasidinasluarkantor/" + id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                Swal.fire('Berhasil!', response.message, 'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            } else {
                                Swal.fire('Gagal!', response.message, 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus data', 'error');
                        }
                    });
                }
            });
        });
    });
</script>

@endpush