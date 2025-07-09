@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal{
        max-height: 467px !important;
    }
    .datepicker-date-display{
        background-color: #34c759 !important;
    }
</style>
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTittle">Form Izin / Sakit</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top: 70px;">
    <div class="col">
        <form method="POST" action="/presensi/storeizin" id="frmizin" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" id="tgl_izin" name="tgl_izin" class="form-control datepicker" placeholder="Tanggal">
            </div>
            <div class="form-group">
                <select name="status" id="status" class="form-control">
                    <option value="">Izin / Sakit / Cuti</option>
                    <option value="i">Izin</option>
                    <option value="s">Sakit</option>
                    <option value="c">Cuti</option>
                </select>
            </div>
            <div class="form-group" id="keterangan_group">
                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
            </div>
            <div class="form-group" id="foto_group">
                <label class="d-block text-center" style="font-size:14px;">Upload Bukti Pengajuan Izin</label>
                <input type="file" name="foto" id="foto" class="form-control ">
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('myscript')
<script>
var currYear = (new Date()).getFullYear();

$(document).ready(function() {
    $(".datepicker").datepicker({ 
        format: "yyyy-mm-dd"
    });

    function toggleFields() {
    var status = $('#status').val();

    if (status === 'c') {
        // Jika Cuti: sembunyikan foto
        $('#foto_group').addClass('d-none');
    } else if (status === 'i') {
        // Jika Izin: tampilkan keterangan, sembunyikan foto
        $('#keterangan_group').removeClass('d-none');
        $('#foto_group').addClass('d-none');
    } else if (status === 's') {
        // Jika Sakit: tampilkan semua
        $('#keterangan_group').removeClass('d-none');
        $('#foto_group').removeClass('d-none');
    } else {
        // Default: tampilkan semua
        $('#keterangan_group').removeClass('d-none');
        $('#foto_group').removeClass('d-none');
    }
}
    $('#status').change(toggleFields);
    toggleFields(); // run once on page load

    $('#tgl_izin').change(function(e){
        var tgl_izin = $(this).val();
        $.ajax({
           type: 'POST',
           url : '/presensi/cekpengajuanizin',
           data: {
            _token: "{{ csrf_token() }}",
            tgl_izin: tgl_izin
           }
           , cache:false,
           success:function(respond){
                if (respond == 1){
                    Swal.fire({
                        title: 'Oops !',
                        text: 'Anda Sudah Melakukan Pengajuan Izin Pada Tanggal Tersebut !',
                        icon: 'warning',
                    }).then((result)=> {
                        $("#tgl_izin").val("");
                    });
                }
           }
        });
    });
    $('#frmizin').submit(function(){
        var tgl_izin = $("#tgl_izin").val();
        var status = $("#status").val();
        var keterangan = $("#keterangan").val();
        var foto = $("#foto").val();

        if (tgl_izin == ""){
            Swal.fire({
                title: 'Oops !',
                text: 'Tanggal Harus Diisi',
                icon: 'warning',
            });
            return false;
        } else if(status == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Status harus Diisi',
                icon: 'warning',
            });
            return false;
        } else if( keterangan == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Keterangan harus Diisi',
                icon: 'warning',
            });
            return false;
        } else if(status != 'c' && status != 'i' && foto == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Foto harus diupload',
                icon: 'warning',
            });
            return false;
        }
    });
});

    document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const allowedTypes = ['image/jpeg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    event.target.value = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Format tidak didukung',
                        text: 'Hanya file JPG dan PNG yang diperbolehkan.',
                        confirmButtonColor: '#d33',
                    });
                }
            }
        });


</script>

@endpush
