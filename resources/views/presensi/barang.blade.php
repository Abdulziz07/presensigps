@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTittle">Data Kiriman Barang</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top: 70px;">
    <div class="col">
    </div>
</div>

<div class="row">
    <div class="col">
        @foreach ($datakirim as $d)
        <ul class="listview image-listview">
            <li>
                <div class="item">
                    <div class="in">
                    <div class="d-flex justify-content-between align-items-center w-100">
                            <div>
                                <b>{{ $d->lokasi_tujuan }}</b><br>
                                <small class="text-muted">{{ $d->nama_barang }}</small>
                                <small class="text-muted">{{ $d->tgl_kirim }}</small>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <!-- Status -->
                                <span class="badge @if($d->status_kirim == 0) bg-warning @elseif($d->status_kirim == 1) bg-primary @elseif($d->status_kirim == 2) bg-success @else bg-secondary @endif">
                                    @if ($d->status_kirim == 0) Belum Dikirim
                                    @elseif ($d->status_kirim == 1) Sedang Dikirim
                                    @elseif ($d->status_kirim == 2) Terkirim
                                    @else Tidak Diketahui
                                    @endif
                                </span>
                                <div class="ms-auto">
                                <!-- Button -->
                                @if($d->status_kirim == 1 || $d->status_kirim == 2)
                                    <a href="{{ route('presensi.terima', $d->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                @else
                                    <a href="{{ route('presensi.terima', $d->id) }}" class="btn btn-sm btn-primary">Terima dan Lihat</a>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        @endforeach
    </div>
</div>
@endsection

@push('myscript')
@if(session('error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session("error") }}',
        confirmButtonColor: '#d33',
    });
</script>
@endif
@endpush

