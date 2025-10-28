<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | SINOVACE</title>

    @vite(['resources/js/app.js']) <!-- Laravel Vite -->

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Qwitcher Grypen Font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@400;700&display=swap');

        .kota-depok {
            font-family: 'Qwitcher Grypen', cursive;
        }
    </style>
</head>
<body class="min-vh-100 d-flex flex-column" style="
    background-image: url('{{ asset('img/bg-image.png') }}'); 
background-size: cover; 
background-repeat: no-repeat;
background-attachment: fixed;
background-position: center;
">
@php
use Illuminate\Support\Facades\Auth;
    // Debugging
    $isAuthenticated = Auth::check();
    $currentGuard = Auth::guard('user')->check();
@endphp

<div class="container">
    <!-- Header Section -->
    <div class="row align-items-center mt-4 d-flex justify-content-between">
        <div class="col-auto d-flex align-items-center">
          <!-- Logo -->
          <a href="{{ Auth::check() ? url('beranda') : url('') }}" class="d-flex align-items-center">
              <img src="{{ asset('/img/Logo-disdik.png') }}" alt="Logo Disdik Depok" class="img-fluid" style="max-width: 48px;">
              <!-- Text next to logo -->
              <div class="ms-2">
                  <h3 class="mb-0 text-white">DISDIK</h3>
                  <h4 class="mb-0 kota-depok text-white">Kota Depok</h4>
              </div>
          </a>
        </div>
    {{-- <p>Authenticated: {{ $isAuthenticated ? 'Yes' : 'No' }}</p>
    <p>User Guard: {{ $currentGuard ? 'Yes' : 'No' }}</p> --}}

    <!-- Main content section -->


</div>
<div class="mt-5">
    @yield('content')
</div>

  
<!-- / Footer -->

<!-- Optional Bootstrap JS -->
<!-- Optional Bootstrap JS --><!-- Optional Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
