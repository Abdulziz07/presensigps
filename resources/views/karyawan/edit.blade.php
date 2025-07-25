<form action="/karyawan/{{$karyawan->nik}}/update" method="POST" id="frmkaryawan" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                            <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                            <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                            <path d="M5 11h1v2h-1z" />
                            <path d="M10 11l0 2" />
                            <path d="M14 11h1v2h-1z" />
                            <path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" readonly value="{{ $karyawan->nik }}" id="nik" class="form-control" name="nik" placeholder="NRP">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>                        </span>
                        <input type="text" value="{{ $karyawan->nama_lengkap }}" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                            <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                            <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                            <path d="M5 11h1v2h-1z" />
                            <path d="M10 11l0 2" />
                            <path d="M14 11h1v2h-1z" />
                            <path d="M19 11l0 2" /></svg>                         </span>
                        <input type="text" value="{{ $karyawan->nik1 }}" id="nik1" class="form-control" name="nik1" placeholder="NIK">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>                        </span>
                        <input type="text" value="{{ $karyawan->alamat }}" id="alamat" class="form-control" name="alamat" placeholder="Alamat">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-question"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M19 22v.01" /><path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>                        </span>
                        <input type="text" value="{{ $karyawan->jabatan }}" id="jabatan" class="form-control" placeholder="Jabatan" name="jabatan">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>                        </span>
                        <input type="text" value="{{ $karyawan->no_hp }}" id="no_hp" class="form-control" placeholder="No HP" name="no_hp">
                    </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="file" name="foto" class="form-control">
                    <input type="hidden" name="old_foto" value="{{$karyawan->foto}}">
                </div>
                <div class="row">
                    <div class="col-12">
                    <select name="kode_dept" id="kode_dept" class="form-select">
                        <option value="">Departemen</option>
                        @foreach ($departemen as $d)
                        <option {{$karyawan->kode_dept == $d->kode_dept ? 'selected' : ''}} value="{{ $d->kode_dept }}">{{ $d->nama_dept}}</option>
                    @endforeach
                </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-group">
                        <button class="btn btn-primary w-100">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 17v-6" /><path d="M9.5 14.5l2.5 2.5l2.5 -2.5" /></svg>
                            Simpan
                        </button>
                        </div>
                    </div>
                </div>
            </form>