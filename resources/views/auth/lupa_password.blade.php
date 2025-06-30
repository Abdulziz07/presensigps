<!doctype html>
<html lang="en">

<style>
.left {
    margin-top: 20px; /* geser agak ke bawah */
}

.left .headerButton {
    font-size: 28px; /* perbesar ikon */
    color: white; /* warna putih */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    margin-left: 12px;
}

/* Kalau kamu mau efek hover */
.left .headerButton:hover {
    color: #ccc;
}
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body style="background-color: #00004a;">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">
    <div class="left">
        <a href="/" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>


        <div class="login-form mt-5">
        <div class="row">
            <div class="col">

            </div>
        </div>
            <div class="section mt-5 text-center">
                <h1 style="color: white;">Lupa Password</h1>
                <h4 style="color: white;">Silahkan Masukkan NRP & No Telpon</h4>
            </div>

            <div class="section mt-1 mb-5">

                <form action="{{ route('password.reset.post') }}" method="POST">
                    @csrf
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NRP" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="no_telpon" name="no_telpon" placeholder="No Telpon" required>
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-danger btn-block btn-lg">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- * App Capsule -->

    <!-- JS -->
    <script src="{{ asset ('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset ('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset ('assets/js/lib/bootstrap.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset ('assets/js/base.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session("success") }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session("error") }}',
        confirmButtonColor: '#d33'
    });
</script>
@endif
</body>

</html>
