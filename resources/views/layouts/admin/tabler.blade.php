
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
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="{{ asset ('tabler/dist/libs/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset ('tabler/dist/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset ('tabler/dist/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset ('tabler/dist/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset ('tabler/dist/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset ('tabler/dist/css/demo.min.css')}}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <style>
      body {
      	display: none;
      }
    </style>
  </head>
  <body class="antialiased">
        @include('layouts.admin.sidebar')
    <div class="page">
        @include('layouts.admin.header')
      <div class="content">
        @yield('content')
        
      </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset ('tabler/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset ('tabler/dist/libs/jquery/dist/jquery.slim.min.js')}}"></script>
    <script src="{{ asset ('tabler/dist/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{ asset ('tabler/dist/libs/jqvmap/dist/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset ('tabler/dist/libs/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <!-- Tabler Core -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset ('tabler/dist/js/tabler.min.js')}}"></script>
    <script>document.body.style.display = "block"</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    @stack('myscript')
    @include('layouts.admin.footer')
  </body>
</html>