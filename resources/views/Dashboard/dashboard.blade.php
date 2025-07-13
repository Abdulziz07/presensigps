@extends('layouts.presensi')
@section('content')
<style>
.logout{
    position: absolute;
    color: white;
    font-size: 30px;
    text-decoration: none;
    right: 15px
}

.logout:hover{
    color:red;
}
</style>
<!-- App Capsule -->
<div id="appCapsule">
    <div class="section" id="user-section">
        <a href="/proseslogout" class="logout">
            <ion-icon name="log-out-outline"></ion-icon>

        </a>
        <div id="user-detail">
            <div class="avatar">
                @if(!empty(Auth::guard('karyawan')->user()->foto))
                @php
                $path = Storage::url('upload/karyawan/user/'.Auth::guard('karyawan')->user()->foto);
                @endphp
                <img src="{{ url ($path) }}" alt="" class="imaged w64 rounded" style="height: 60px;">
                @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                @endif
            </div>
                    <div id="user-info">
                        <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap}}</h2>
                        <div id="user-role">{{ Auth::guard('karyawan')->user()->jabatan}} ({{ Auth::guard('karyawan')->user()->nik}})</div>
                    </div>
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/editprofile" class="green" style="font-size: 40px;">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Profil</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                                    <ion-icon name="document-text"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Histori</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                                    <ion-icon name="mail-outline"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Izin</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/presensi/dinasluar" class="orange" style="font-size: 40px;">
                                    <ion-icon name="car-outline"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                Dinas Luar 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div id="rekappresensi" style="margin-top: 80px;">
                <h3>Rekap Absensi Bulan {{$namabulan[$bulanini]}} Tahun {{$tahunini}}</h3>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 8px 8px !important; line-height:0.8rem;">
                                <span class="badge bg-danger" style="position:absolute; top:3px; right:10px; font-size: 0.5rem; 
                            z-index:999;">{{$rekappresensi->jmlhadir}}</span>
                            <ion-icon name="checkbox-outline" style="font-size: 1.6rem;" class="text-success mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 8px 8px !important;line-height:0.8rem;">
                                <span class="badge bg-danger" style="position:absolute; top:3px; right:10px; font-size: 0.5rem; 
                            z-index:999;">{{$rekapizin->jmlizin}}</span>
                            <ion-icon name="receipt-outline" style="font-size: 1.6rem" class="text-primary mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 8px 8px !important;line-height:0.8rem;">
                                <span class="badge bg-danger" style="position:absolute; top:3px; right:10px; font-size: 0.5rem; 
                            z-index:999;">{{$rekapizin->jmlsakit}}</span>
                            <ion-icon name="medkit-outline" style="font-size: 1.6rem" class="text-danger mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                        </div>
                    </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 8px 8px !important;line-height:0.8rem;">
                            <span class="badge bg-danger" style="position:absolute; top:3px; right:10px; font-size: 0.5rem; 
                            z-index:999;">{{$rekappresensi->jmlterlambat}}</span>
                            <ion-icon name="alarm-outline" style="font-size: 1.6rem" class="text-warning mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
            <div class="presencetab mt-2">
                <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                    <ul class="nav nav-tabs style1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                Bulan Ini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Karyawan Hadir Sekarang
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($historibulanini as $d)
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="image-outline" role="img" class="md hydrated"
                                        aria-label="image outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>{{date("d-m-Y",strtotime($d->tgl_presensi))}}</div>
                                        @php
                                        $shift = match($d->status) {
                                            'p' => 'S1',
                                            's' => 'S2',
                                            'm' => 'S3',
                                            default => 'Dinas',
                                        };
                                        @endphp
                                        <span class="badge badge-primary">{{ $shift }}</span>
                                        <span class="badge badge-success">{{$d->jam_in}}</span>
                                        <span class="badge badge-danger">{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($leaderboard as $d)
                            <li>
                                <div class="item">
                                    <img src="{{ asset('storage/upload/karyawan/' . $d->foto1) }}" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <b>{{$d->nama_lengkap}}</b><br>
                                        <small class="text-muted">{{$d->jabatan}}</small>
                                        </div>
                                    </div>
                                        @php
                                            $jamIn = \Carbon\Carbon::parse($d->jam_in)->format('H:i:s'); // format ke H:i:s (bukan H:i)

                                            $status = 'bg-success';

                                            if (
                                                ($d->status == 'p' && $jamIn >= '00:00:00' && $jamIn <= '20:00:00') || 
                                                ($d->status == 's' && (
                                                    ($jamIn >= '07:05:00' && $jamIn <= '23:59:59') || 
                                                    ($jamIn < '03:00:00')
                                                )) || 
                                                ($d->status == 'm' && (
                                                    ($jamIn >= '16:05:00' && $jamIn <= '23:59:59') || 
                                                    ($jamIn < '12:00:00')
                                                ))
                                            ) {
                                                $status = 'bg-danger'; // Telat
                                            }
                                        @endphp
                                    <span class="badge {{ $status }}">
                                    {{ $jamIn }}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutLink = document.querySelector('.logout');

        if (logoutLink) {
            logoutLink.addEventListener('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin LogOut',
                    text: 'Kamu akan keluar dari akun ini',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = logoutLink.getAttribute('href');
                    }
                });
            });
        }
    });
</script>

@endsection

