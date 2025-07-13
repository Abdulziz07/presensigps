@extends('layouts.admin.tabler')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-item-center">
                <div class="col">
                    <h2 class="page-title">Data Karyawan</h2>
                </div>           
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(Session::get('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                @if(Session::get('warning'))
                                    <div class="alert alert-warning">
                                        {{Session::get('warning')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahKaryawan">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah Data 
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <form action="/karyawan" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" placeholder="Nama Karyawan" value="{{Request('nama_karyawan')}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <select name="kode_dept" id="kode_dept" class="form-select">
                                                    <option value="">Departemen</option>
                                                    @foreach ($departemen as $d)
                                                        <option {{Request('kode_dept')==$d->kode_dept ? 'selected' : ''}} value="{{ $d->kode_dept }}">{{ $d->nama_dept}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NRP</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Alamat</th>
                                        <th>Domisili Sekarang</th>
                                        <th>Jabatan</th>
                                        <th>No HP</th>
                                        <th>Foto</th>
                                        <th>Departemen</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($karyawan as $d)
                                @php
                                    $path = Storage::url('upload/karyawan/'.$d->foto1);
                                @endphp
                                    <tr>
                                        <td>{{$loop->iteration + $karyawan->firstitem()-1}}</td>
                                        <td>{{$d->nik}}</td>
                                        <td>{{$d->nama_lengkap}}</td>
                                        <td>{{$d->nik1}}</td>
                                        <td>{{$d->alamat}}</td>
                                        <td>{{$d->domisiliskrng}}</td>
                                        <td>{{$d->jabatan}}</td>
                                        <td>{{$d->no_hp}}</td>
                                        <td>
                                            @if (empty($d->foto1))
                                            <img src="{{ asset ('assets/img/sample/avatar/avatar1.jpg') }}" class="avatar" alt="">
                                            @else
                                            <img src="{{ url($path) }}" class="avatar" alt="">
                                            @endif
                                        </td>
                                        <td>{{$d->nama_dept}}</td>
                                        <td>{{$d->status1}}</td>
                                        <td>
                                            <div class="btn-group">
                                            <a href="#" class="edit btn btn-info btn-sm rounded" nik="{{ $d->nik }}" ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>Edit</a>
                                            <form action="/karyawan/{{$d->nik}}/delete" style="margin-left:5px;" method="POST">
                                                @csrf
                                            <a class="delete-confirm btn btn-danger btn-sm rounded" ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
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
    </div>
</div>
<div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Karyawan</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadeditform">
            </div>
        </div>
      </div>
    </div>
    <div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Karyawan</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/karyawan/store" method="POST" id="frmkaryawan" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" value="" id="nik" class="form-control" name="nik" placeholder="NRP">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>                        </span>
                        <input type="text" value="" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" value="" id="nik1" class="form-control" name="nik1" placeholder="NIK">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg></span>
                        <input type="text" value="" id="alamat" class="form-control" name="alamat" placeholder="Alamat">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-question"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M19 22v.01" /><path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>                        </span>
                        <input type="text" value="" id="jabatan" class="form-control" placeholder="Jabatan" name="jabatan">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>                        </span>
                        <input type="text" value="" id="no_hp" class="form-control" placeholder="No HP" name="no_hp">
                    </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="row">
                    <div class="col-12">
                    <select name="kode_dept" id="kode_dept" class="form-select">
                        <option value="">Departemen</option>
                        @foreach ($departemen as $d)
                        <option {{Request('kode_dept')==$d->kode_dept ? 'selected' : ''}} value="{{ $d->kode_dept }}">{{ $d->nama_dept}}</option>
                    @endforeach
                </select>
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
        $("#btnTambahKaryawan").click(function(){
            $("#modal-inputkaryawan").modal("show");
        });
        $(".edit").click(function(){
           var nik = $(this).attr('nik');
           $.ajax({
                type:'POST',
                url:'/karyawan/edit',
                cache:false,
                data:{
                    _token:"{{ csrf_token(); }}",
                    nik:nik
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
           });
           $("#modal-editkaryawan").modal("show");
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

        $("#frmkaryawan").submit(function(){
            var nik = $("#nik").val();
            var nama_lengkap = $("#nama_lengkap").val();
            var nik1 = $("#nik1").val();
            var alamat = $("#alamat").val();
            var jabatan = $("#jabatan").val();
            var no_hp = $("#no_hp").val();
            var foto = $("input[name='foto']").val();
            var kode_dept = $("#frmkaryawan").find("#kode_dept").val();
            if(nik == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'NRP Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#nik").focus();
                    });
                return false;
            } else if(nama_lengkap == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'Nama Lengkap Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#nama_lengkap").focus();
                    });
                return false;
            }else if(nik1 == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'NIK Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#nik1").focus();
                    });
                return false;
            }else if(alamat == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'Alamat Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#alamat").focus();
                    });
                return false;
            }else if(jabatan == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'Jabatan Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#jabatan").focus();
                    });
                return false;
            }  else if(no_hp == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'No HP Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#no_hp").focus();
                    });
                return false;
            } else if(foto == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'Foto Harus Diunggah',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    });
                return false;
            } else if(kode_dept == ""){
                Swal.fire({
                    title: 'Warning',
                    text: 'Departemen Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then( ()=> {
                        $("#kode_dept").focus();
                    });
                return false;
            }
        });
    });
</script>
@endpush