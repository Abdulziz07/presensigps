@extends('layouts.presensi')

@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Lokasi Dinas</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection

@section('content')
<div class="row" style="margin-top: 70px;">
    <div class="col">
        @foreach ($dataLokasi as $d)
        <div class="card mt-1" style="border-radius: 10px;">
            <div class="card-body d-flex justify-content-between align-items-center p-2">
                <div>
                    <b>{{ $d->Alamat }}</b><br>
                    <small class="text-muted"></small>
                </div>
                <div class="text-end">
                    <a href="{{ url('/presensi/dinasluar/absen/'.$d->id) }}" class="badge bg-primary text-white" style="padding: 10px 16px; font-size: 14px; border-radius: 8px;">
                    <ion-icon name="camera" style="vertical-align: middle; margin-right: 4px;"></ion-icon>
                    Absen
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
