@extends('layouts.admin.tabler')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-item-center">
                <div class="col">
                    <h2 class="page-title">Monitoring Presensi</h2>
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
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                </span>
                                <input type="text" id="tanggal" name="tanggal" value="{{date("Y-m-d")}}" value="" class="form-control" placeholder="Tanggal Presensi" autocomplete="off">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NRP</th>
                                            <th>Nama Karyawan</th>
                                            <th>Departemen</th>
                                            <th>Jam Masuk</th>
                                            <th>Foto</th>
                                            <th>Jam Pulang</th>
                                            <th>Foto</th>
                                            <th>Keterangan</th>
                                            <th>Over Time</th>
                                            <th>Alasan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadpresensi"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Lokasi Karyawan</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadmap">
            </div>
        </div>
      </div>
    </div>
@endsection
@push('myscript')
<script>
  $("#tanggal").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format : "yyyy-mm-dd"
  });

  function loadpresensi(){
    var tanggal = $("#tanggal").val();
    $.ajax ({
        type:'POST',
        url:'/getpresensi',
        data:{
            _token:"{{csrf_token() }}",
            tanggal : tanggal
        },
        cache:false,
        success:function(respond){
            $("#loadpresensi").html(respond);
        }
    });
  }
  $("#tanggal").change(function(e){
    loadpresensi();
  });
  loadpresensi();

</script>
@endpush