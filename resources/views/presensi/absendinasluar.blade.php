@extends('layouts.presensi')
@section('header')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Presensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
     <style>
        .webcam-capture,
        .webcam-capture video{
            display: inline-block;
            width: 100% !important;
            margin: auto;
            height: auto !important;
            border-radius: 15px;

        }
        #map { height: 200px; }
        </style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


@endsection


@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        <input type="hidden" id="lokasi">
        <input type="hidden" value="d" id="statusshift">
        <input type="hidden" value="{{$lokasi->radius_tujuan}}" id="radius">
        <input type="hidden" value="{{$lokasi->koordinat_tujuan}}" id="koordinat">
        <div class="webcam-capture"></div>
    </div>
</div>
<div class="form-group boxed">
        <div class="input-wrapper">
            <input type="text" class="form-control" id="alasan" name="alasan" placeholder="Masukan Alasan Dinas">
        </div>
    </div>
<div class="row">
    <div class="col">
        <button id="takeabsen" class="btn btn-primary btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Masuk
        </button>
        <button id="takeabsenpulang" class="btn btn-danger btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Pulang
        </button>
    </div>
</div>
    <div class="form-group boxed">
        <div class="input-wrapper">
            <input type="text" class="form-control" id="ot" name="ot" placeholder="Jam OT hanya masuk saat Absen pulang">
        </div>
    </div>
<div class="row mt-2">
    <div class="col">
        <div id="map"></div>
    </div>
</div>
<div class="row mt-4">
    <div class="col">
    </div>
</div>

<div class="row mt-4">
    <div class="col">
    </div>
</div>

<div class="row mt-4">
    <div class="col">
    </div>
</div>

@endsection

<audio id="notifikasi_in">
    <source src="{{asset('assets/sound/notifikasi_in.mp3')}}" type="audio/mpeg">
</audio>
<audio id="notifikasi_out">
    <source src="{{asset('assets/sound/notifikasi_out.mp3')}}" type="audio/mpeg">
</audio>
<audio id="radius_sound">
    <source src="{{asset('assets/sound/radius.mp3')}}" type="audio/mpeg">
</audio>

@push('myscript')
<script> 

    var notifikasi_in = document.getElementById('notifikasi_in');
    var notifikasi_out = document.getElementById('notifikasi_out');
    var radius = document.getElementById('radius_sound');

    Webcam.set({
        height:320,
        width:480,
        image_format: 'jpeg',
        jpeg_quality:80
        });

    Webcam.attach('.webcam-capture');
    
    var lokasi = document.getElementById('lokasi');
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }

    function successCallback(position){
        lokasi.value = position.coords.latitude+", "+position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);

            var lokasi_kantor = "{{ $lokasi->koordinat_tujuan }}";
            var lok = lokasi_kantor.split(",");
            var lat_kantor = lok[0];
            var long_kantor = lok[1];
            var radius = "{{ $lokasi->radius_tujuan }}"

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

            var circle = L.circle([lat_kantor,long_kantor], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: radius
        }).addTo(map);
            }

    function errorCallback(){

    }

    $("#takeabsen").click(function(e){
    Webcam.snap(function(uri){
        image = uri;
    });

    var lokasi = $("#lokasi").val();
    var statusshift = $("#statusshift").val();
    var koordinat =$("#koordinat").val();
    var radius = $("#radius").val();
    var alasan = $("#alasan").val();

    if (alasan == "") {
        Swal.fire({
            title: 'Oops!',
            text: 'Alasan harus diisi terlebih dahulu.',
            icon: 'warning',
        });
        return false;
    }

    $.ajax({
        type: 'POST',
        url: '/presensi/masukdinas',
        data: {
            _token: "{{ csrf_token() }}",
            image: image,
            lokasi: lokasi,
            statusshift: statusshift,
            koordinat: koordinat,
            radius:radius,
            alasan:alasan
        },
        cache: false,
        success: function (respond) {
            var status = respond.split("|");
            if (status[0] == "success") {
                if (status[2] == "in") {
                    notifikasi_in.play();
                } else {
                    notifikasi_out.play();
                }
                Swal.fire({
                    title: 'Berhasil!',
                    text: status[1],
                    icon: 'success',
                });
                setTimeout("location.href='/dashboard'", 3000);
            } else {
                if (status[2] == "radius") {
                    radius_sound.play();
                }
                Swal.fire({
                    title: 'Error!',
                    text: status[1],
                    icon: 'error',
                });
            }
        }
    });
});

$("#takeabsenpulang").click(function(e){
    Webcam.snap(function(uri){
        image = uri;
    });

    var lokasi = $("#lokasi").val();
    var ot = $("#ot").val();
    var koordinat =$("#koordinat").val();
    var radius = $("#radius").val();


    $.ajax({
        type:'POST',
        url:'/presensi/pulangdinas', // Sudah diganti
        data:{
            _token:"{{csrf_token() }}",
            image:image,
            lokasi:lokasi,
            ot:ot,
            koordinat: koordinat,
            radius:radius
        },
        cache:false,
        success:function(respond){
            var status = respond.split("|");
            if(status[0] == "success"){
                notifikasi_out.play(); // pakai notifikasi pulang
                Swal.fire({
                    title: 'Berhasil!',
                    text: status[1],
                    icon: 'success',
                });
                setTimeout("location.href='/dashboard'",3000);
            } else {
                if (status[2] == "radius"){
                    radius_sound.play();
                }
                Swal.fire({
                    title: 'Error !',
                    text: status[1],
                    icon: 'error',
                });
            }
        }
    });
});

</script>
@endpush
