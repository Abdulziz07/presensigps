@extends('layouts.admin.tabler')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-item-center">
                <div class="col">
                    <h2 class="page-title">Rekap Presensi</h2>
                </div>           
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-6">
                <div class="card">
                <div class="card-body">
                    <form action="/presensi/cetakrekap" target= "_blank" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="bulan" id="bulan" class="form-select">
                                        <option value="">Bulan</option>
                                        @for ($i=1; $i<=12; $i++)
                                        <option value= "{{$i}}" {{date("m") == $i ? 'selected' : '' }}>{{$namabulan[$i]}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3" >
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="tahun" id="tahun" class="form-select">
                                        <option value="">Tahun</option>
                                        @php
                                            $tahunmulai = 2024;
                                            $tahunskrg = date("Y");
                                        @endphp
                                        @for ($tahun = $tahunmulai; $tahun <= $tahunskrg; $tahun++)
                                        <option value= "{{ $tahun }}" {{date("Y") == $tahun ? 'selected' : '' }}>{{$tahun}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" name= "exportexcel" class="btn btn-success w-100"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>Export ke Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection