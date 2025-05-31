@extends('layouts.presensi')
@section('header')
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTittle">Detail</div>
    <div class="right"></div>
    <style>
    #map {
         height: 300px; 
    }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</div>
@endsection

@section('content')
<div class="row" style="margin-top: 70px;">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Lokasi Tujuan:<br> {{ $data->lokasi_tujuan }}</h4>
                <h4>Diajukan Tanggal : {{date ('d-m-Y',strtotime($data->tgl_kirim))}}</h4>
                <div class="row mt-2">
                    <div class="col">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="row mt-2"></div>
                <p><b>Nama Barang :</b>{{ $data->nama_barang }}</p>
                <p><b>Status Kirim:</b>
                    @if($data->status_kirim == 0)
                        <span class="badge bg-warning">Belum Dikirim</span>
                    @elseif($data->status_kirim == 1)
                        <span class="badge bg-primary">Sedang Dikirim</span>
                    @elseif($data->status_kirim == 2)
                        <span class="badge bg-success">Terkirim</span>
                    @else
                        <span class="badge bg-secondary">Tidak Diketahui</span>
                    @endif
                </p>
                <p><b>Diterima Tanggal : </b> {{$data->tgl_terima ? date('d-m-Y', strtotime($data->tgl_terima)) : '-' }}</p>
                <p><b>Jam barang dikirim : </b> {{ $data->jam_kirim ?? '-' }}</p>
                <p><b>Terkirim Tanggal : </b> {{ $data->tgl_selesai ? date('d-m-Y', strtotime($data->tgl_selesai)) : '-' }}</p>
                <p><b>Jam barang terkirim : </b> {{ $data->jam_selesai??'-' }}</p>
                <p>
                    <input type="hidden" id="lokasi_sekarang">   
                </p>

                <div class="d-grid gap-2 mb-5">
                    @if ($data->status_kirim == 2)
                        <p class="text-center text-success " style="font-size: 1.2rem; vertical-align: middle;">
                        <ion-icon name="checkmark-circle-outline" style="font-size: 1.5rem; vertical-align: middle;"></ion-icon>
                        Selesai</p>
                    @else
                        <button type="button" id="selesaikan" class="btn btn-primary btn-block">Selesaikan</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>

    var lokasi_sekarang = document.getElementById('lokasi_sekarang');
    if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }
    function successCallback(position){
        lokasi_sekarang.value = position.coords.latitude+", "+position.coords.longitude;
        var koordinat = "{{ $data->koordinat_tujuan }}";
        var split = koordinat.split(',');
        var lat_koordinat = split[0];
        var long_koordinat = split[1];
        var radius_tujuan = "{{ $data->radius_tujuan }}"
        var map = L.map('map').setView([lat_koordinat,long_koordinat], 10);
        
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
        
            var mobilIcon = L.icon({
                iconUrl: '{{ asset("assets/icons/mobil.png") }}',
                iconSize: [38, 38],
                iconAnchor: [19, 38],
                popupAnchor: [0, -38]
            });

            // Tambahkan marker lokasi pengguna
            var markerAnda = L.marker([position.coords.latitude, position.coords.longitude], { icon: mobilIcon })
                .addTo(map)
                .bindPopup("Anda");

            // Tambahkan marker tujuan
            var markerTujuan = L.marker([lat_koordinat, long_koordinat])
                .addTo(map)
                .bindPopup("Tujuan");

            // Buka kedua popup dengan delay agar tidak saling menutup
            markerAnda.openPopup();
            setTimeout(function() {
                markerTujuan.openPopup();
            }, 500);
        
            L.circle([lat_koordinat,long_koordinat], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius_tujuan
            }).addTo(map);
    }

        function errorCallback(){

        }

        
        $("#selesaikan").click(function(e){
            var lokasi_sekarang = $("#lokasi_sekarang").val();
            var id = "{{ $data->id }}"
            $.ajax({
            type:'POST',
            url:'/presensi/selesaikanpengiriman/' + id,
            data:{
                _token:"{{csrf_token() }}",
                lokasi_sekarang:lokasi_sekarang
            },
            cache:false,
            success: function(respond) {
            var status = respond.split("|");
            if (status[0] === "success") {
                Swal.fire({
                    title: 'Berhasil!',
                    text: status[1],
                    icon: 'success',
                });
                setTimeout(function() {
                    location.reload();
                }, 3000);
            } else {
                Swal.fire({
                    title: 'Gagal!',
                    text: status[1],
                    icon: 'error',
                });
                }
            }
        })
    });
</script>
@endpush
