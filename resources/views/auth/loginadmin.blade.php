<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-alpha.14
* @link https://tabler.io
* Copyright 2018-2020 The Tabler Authors
* Copyright 2018-2020 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign in - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/demo.min.css') }}" rel="stylesheet"/>
    <style>
      body {
      	display: none;
      }
    </style>
  </head>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">
  <div class="flex-fill d-flex flex-column justify-content-center py-4">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      
      <!-- Kolom Gambar (Pindah ke Kiri) -->
      <div class="col-md-6 text-center">
        <img src="{{ asset('assets/img/login/loginadmin.png') }}" height="300" class="img-fluid" alt="">
      </div>

      <!-- Kolom Form (Pindah ke Kanan) -->
      <div class="col-md-5"> 
        <form class="card card-md mx-auto w-100" action="/prosesloginadmin" method="post" autocomplete="off" style="max-width: 400px;">
          @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to your account</h2>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email">
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
              </label>
              <div class="input-group input-group-flat">
                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-toggle="tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="12" cy="12" r="2" />
                      <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                    </svg>
                  </a>
                </span>
              </div>
            </div>
            <div class="mb-2">
              <label class="form-check">
                <span class="form-label-description">
                  <a href="{{ url('/lupapassword') }}">Lupa Password</a>
                </span>
              </label>
            </div>
            @php
                    $messagewarning = Session::get('warning');
                    @endphp
                    @if (Session::get('warning'))
                    <div class="alert alert-danger text-center">
                        {{Session::get('warning')}}
                    </div>
                    @endif

                    @if ($errors->has('email') && $errors->has('password'))
                      <div class="alert alert-danger text-center">
                        Email dan Password tidak boleh kosong
                      </div>
                    @elseif ($errors->has('email'))
                      <div class="alert alert-danger text-center">
                        Email tidak boleh kosong
                      </div>
                    @elseif ($errors->has('password'))
                      <div class="alert alert-danger text-center">
                        Password tidak boleh kosong
                      </div>
                    @endif

            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset ('tabler/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset ('tabler/dist/js/tabler.min.js') }}"></script>
    <script>
      document.body.style.display = "block"
    </script>
  </body>
</html>