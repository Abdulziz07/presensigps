<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Lupa Password</title>
    <!-- CSS -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/demo.min.css') }}" rel="stylesheet"/>
    <style>
      body {
        display: none;
      }
    </style>
  </head>
  <body class="border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center py-4">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6 text-center">
            <img src="{{ asset('assets/img/login/lupapassword.png') }}" height="300" class="img-fluid" alt="Forgot Password">
          </div>
          <div class="col-md-5">
            <form class="card card-md mx-auto w-100" action="/cekresetpassword" method="post" autocomplete="off" style="max-width: 400px;">
              @csrf
              <div class="card-body">
                <h2 class="card-title text-center mb-4">Lupa Password</h2>

                <div class="mb-3">
                  <label class="form-label">NIK</label>
                  <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK Admin" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">No. Telepon</label>
                  <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No. HP Admin" required>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-footer">
                  <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </div>

                <div class="text-center text-muted mt-3">
                  <a href="/panel">Kembali ke Login</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('tabler/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tabler/dist/js/tabler.min.js') }}"></script>
    <script>
      document.body.style.display = "block"
    </script>
  </body>
</html>
