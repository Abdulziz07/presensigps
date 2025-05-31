@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTittle">Edit Profile</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection

@section('content')
<div class="row" style="margin-top:4rem">
    <div class="col">
        @php
            $messagesuccess= Session::get('success');
            $messageerror= Session::get('error');
        @endphp
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{$messagesuccess}}
        </div>
        @endif
        @if(Session::get('error'))
        <div class="alert alert-danger">
            {{$messageerror}}
        </div>
        @endif
    </div>
</div>
<form action="/presensi/{{$karyawan->nik}}/updateprofile" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="custom-file-upload" id="fileUpload1">
            
            <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
            <label for="fileuploadInput">
                <span>
                    <strong>
                        @if(!empty(Auth::guard('karyawan')->user()->foto))
                        @php
                        $path = Storage::url('upload/karyawan/user/'.Auth::guard('karyawan')->user()->foto);
                        @endphp
                        <img src="{{ url ($path) }}" alt="" class="imaged w64 rounded" style="height: 60px;">
                        @else
                        <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                        @endif
                        <i>Tap untuk Update Foto Profile</i>
                    </strong>
                </span>
            </label>
        </div>
    <div class="col">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $karyawan->nama_lengkap }}" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off" readonly>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <textarea type="text" class="form-control" name="domisiliskrng" placeholder="Domisili Sekarang" autocomplete="off">{{ $karyawan->domisiliskrng ?? $karyawan->alamat }}</textarea>
            </div>
        </div>
        <div class="form-group boxed">
        <div class="input-wrapper">
            <select name="status1" class="form-control">
                    <option value="Lajang" {{ $karyawan->status1 == 'Lajang' ? 'selected' : '' }}>Lajang</option>
                    <option value="Menikah" {{ $karyawan->status1 == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                </select>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $karyawan->no_hp }}" name="no_hp" placeholder="No. HP" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
            </div>
        </div>
        
        <div class="form-group boxed">
            <div class="input-wrapper">
                <button type="submit" class="btn btn-primary btn-block">
                    <ion-icon name="refresh-outline"></ion-icon>
                    Update
                </button>
            </div>
        </div>
    </div>
</form>