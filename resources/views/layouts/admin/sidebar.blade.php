<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
      <div class="container">
        <div class="navbar-nav flex-row d-lg-none">
          <div class="nav-item dropdown d-none d-md-flex mr-3">
            <a href="#" class="nav-link px-0" data-toggle="dropdown" tabindex="-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
              <span class="badge bg-red"></span>
            </a>
          </div>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
              <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
              <div class="d-none d-xl-block pl-2">
                <div>Paweł Kuna</div>
                <div class="mt-1 small text-muted">UI Designer</div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <a href="#" class="dropdown-item">Set status</a>
              <a href="#" class="dropdown-item">Profile & account</a>
              <a href="#" class="dropdown-item">Feedback</a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">Settings</a>
              <a href="#" class="dropdown-item">Logout</a>
            </div>
          </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
          <ul class="navbar-nav pt-lg-3">
            <li class="nav-item {{ request()->is('panel/dashboardadmin') ? 'active' : ''}}">
              <a class="nav-link " href="/panel/dashboardadmin" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  Home
                </span>
              </a>
            </li>
            <li class="nav-item dropdown {{ request()->is(['karyawan','departemen']) ? 'show' : ''}}">
              <a class="nav-link dropdown-toggle "
               href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="
               {{ request()->is(['karyawan','departemen']) ? 'true' : ''}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                </span>
                <span class="nav-link-title">
                  Data Master
                </span>
              </a>
              <div class="dropdown-menu {{ request()->is(['karyawan','departemen']) ? 'show' : ''}}">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column ">
                    <a class="dropdown-item {{ request()->is(['karyawan']) ? 'active' : ''}}" href="/karyawan" >
                      Karyawan
                    </a>
                    <a class="dropdown-item {{ request()->is(['departemen']) ? 'active' : ''}}" href="/departemen" >
                      Departemen
                    </a>
                  </div>
                </div>
            </li>
            <li class="nav-item {{ request()->is('presensi/monitoring') ? 'active' : ''}}">
              <a class="nav-link " href="/presensi/monitoring" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-desktop"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10z" /><path d="M7 20h10" /><path d="M9 16v4" /><path d="M15 16v4" /></svg>
                </span>
                <span class="nav-link-title">
                  Monitoring Presensi
                </span>
              </a>
            </li>
            <li class="nav-item {{ request()->is('presensi/izinsakit') ? 'active' : ''}}">
              <a class="nav-link " href="/presensi/izinsakit" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-desktop"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10z" /><path d="M7 20h10" /><path d="M9 16v4" /><path d="M15 16v4" /></svg>
                </span>
                <span class="nav-link-title">
                  Data Izin / Sakit / Cuti
                </span>
              </a>
            </li>
            <li class="nav-item dropdown {{ request()->is(['presensi/laporan','presensi/rekap']) ? 'show' : ''}}">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="
              {{ request()->is(['karyawan','departemen']) ? 'true' : ''}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" /></svg>
                </span>
                <span class="nav-link-title">
                  Laporan
                </span>
              </a>
              <div class="dropdown-menu {{ request()->is(['presensi/laporan','presensi/rekap']) ? 'show' : ''}}">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">
                    <a class="dropdown-item {{ request()->is(['presensi/laporan']) ? 'active' : ''}}" href="/presensi/laporan" >
                      Presensi
                    </a>
                    <a class="dropdown-item {{ request()->is(['presensi/rekap']) ? 'active' : ''}}" href="/presensi/rekap" >
                      Rekap Presensi
                    </a>
                  </div>
                </div>
              </div>
              
            </li>
            <li class="nav-item dropdown {{ request()->is(['konfigurasi/lokasikantor','konfigurasi/lokasidinasluarkantor']) ? 'show' : ''}}">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="
              {{ request()->is(['lokasikantor','lokasidinasluarkantor']) ? 'true' : ''}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings-pin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.578 20.905c-.88 .299 -1.983 -.109 -2.253 -1.222a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c.574 .14 .96 .5 1.16 .937" /><path d="M14.99 12.256a3 3 0 1 0 -2.33 2.671" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
              </span>
                <span class="nav-link-title">
                  Konfigurasi
                </span>
              </a>
              <div class="dropdown-menu {{ request()->is(['konfigurasi/lokasikantor','konfigurasi/lokasidinasluarkantor']) ? 'show' : ''}}">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">
                    <a class="dropdown-item {{ request()->is(['konfigurasi/lokasikantor']) ? 'active' : ''}}" href="/konfigurasi/lokasikantor">
                      Lokasi Kantor
                    </a>
                    <a class="dropdown-item {{ request()->is(['konfigurasi/lokasidinasluarkantor']) ? 'active' : ''}}" href="/konfigurasi/lokasidinasluarkantor">
                      Lokasi Dinas Luar Kantor
                    </a>
                  </div>
                </div>
              </div>

            </li>
          </ul>
        </div>
      </div>
    </aside>