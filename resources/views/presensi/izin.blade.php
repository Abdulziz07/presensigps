@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTittle">Data Izin / Sakit / Cuti</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top: 70px;">
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
    </div>
</div>
<div class="row">
    <div class="col">
@foreach ($dataizin as $d)
<ul class="listview image-listview">
    <li>
        <div class="item">
            <div class="in">
                <div>
                    <b>{{date("d-m-Y",strtotime($d->tgl_izin))}} 
                    ({{ $d->status == "s" ? "Sakit" : ($d->status == "c" ? "Cuti" : "Izin") }})</b><br>
                    <small class="text-muted">{{$d->keterangan}}</small>
                </div>
                @if ($d->status_approved == 0)
                <span class="badge bg-warning">Menunggu Persetujuan</span>
                @elseif ($d->status_approved == 1)
                <span class="badge bg-success">Disetujui</span>
                @elseif ($d->status_approved == 2)
                <span class="badge bg-danger">Ditolak</span>
                @endif
            </div>
        </div>
    </li>
</ul>


@endforeach
    </div>
</div>
<div class="fab-button bottom-right" style="margin-bottom: 70px;">
    <a href="/presensi/buatizin" class="fab">
        <ion-icon name="add-outline"></ion-icon>
    </a>
</div>


@endsection