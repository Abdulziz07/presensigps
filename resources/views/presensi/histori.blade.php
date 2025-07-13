@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTittle">Histori</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top: 70px;">
    <div class="col">
    <div class="row">
    <div class="col" id="showhistori"></div>
</div>
@endsection

@push('myscript')
<script>
    function loadHistori(bulanList = [], tahunList = []) {
        $.ajax({
            type: 'POST',
            url: '/gethistori',
            data: {
                _token: "{{ csrf_token() }}",
                bulan: bulanList,
                tahun: tahunList,
            },
            cache: false,
            success: function (respond) {
                $("#showhistori").html(respond);
            }
        });
    }

    $(function(){
        $("#getdata").click(function(e){
            e.preventDefault();
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            loadHistori([bulan], [tahun]);
        });

        // Auto load histori 3 bulan terakhir saat halaman dibuka
        var today = new Date();
        var bulanList = [];
        var tahunList = [];

        for (var i = 2; i >= 0; i--) { // 2 bulan ke belakang hingga bulan ini
            var d = new Date(today.getFullYear(), today.getMonth() - i, 1);
            bulanList.push(d.getMonth() + 1); // bulan (1-12)
            tahunList.push(d.getFullYear());  // tahun
        }

        loadHistori(bulanList, tahunList);
    });
</script>
@endpush