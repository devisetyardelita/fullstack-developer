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

    <!-- Bootstrap 5 JS + Popper.js (WAJIB ADA) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Intro.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js/minified/introjs.min.css">
        <!-- Intro.js JS -->
        <script src="https://cdn.jsdelivr.net/npm/intro.js/minified/intro.min.js"></script>

    <!-- Qwitcher Grypen Font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@400;700&display=swap');

        .kota-depok {
            font-family: 'Qwitcher Grypen', cursive;
        }
    
        .dropdown-menu-end {
            right: 0 !important; /* Pastikan tetap di dalam batas layar */
            left: auto !important;
        }

        /* Jika dropdown terlalu ke kanan, geser ke kiri */
        .dropdown-menu[data-align="left"] {
            right: auto !important;
            left: 0 !important;
            transform: translateX(-100%) !important;
        }
        .nav-link {
            border-bottom: 3px solid transparent; /* Biar default-nya ga ada underline */
            transition: border-color 0.3s ease-in-out;
        }

        .nav-link.active {
            border-bottom: 3px solid white !important; /* Underline cuma buat yang aktif */
            color: white !important;
            font-weight: bold;
        }
        .nav-underline .nav-link {
            border-bottom: 3px solid transparent; /* Defaultnya no underline */
        }

        .nav-underline .nav-link.active {
            border-bottom: 3px solid white !important; /* Hanya yang aktif */
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

        <div class="col-auto d-flex align-items-center">
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a class="nav-link text-white me-2 {{ request()->is('beranda*') ? 'active' : '' }}" 
                       href="{{ route('home2') }}">
                       Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white me-2 {{ request()->is('layanan*') ? 'active' : '' }}" 
                       href="{{ route('services') }}">
                       Layanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('sekolah*') ? 'active' : '' }}" 
                       href="{{ route('schools') }}">
                       Sekolah
                    </a>
                </li>
            </ul>            
        </div>

        <div class="col-auto d-flex align-items-center">
            {{-- <a href="{{ route('login') }}" class="btn btn-outline-warning me-2">Masuk</a>
            <a href="{{ route('user.registration') }}" class="btn btn-outline-warning">Daftar</a> --}}

            @guest
                <!-- Tampilkan tombol login dan register jika pengguna belum login -->
                @if(!request()->routeIs('login') && !request()->routeIs('register'))
                    <a href="{{ route('login') }}" class="btn btn-outline-warning me-2">Masuk</a>
                    <a href="{{ route('user.registration') }}" class="btn btn-outline-warning">Daftar</a>
                @endif
            @endguest

            {{-- <pre>{{ dump(Auth::guard('admin')->check()) }}</pre>
            <pre>{{ dump(Auth::guard('user')->check()) }}</pre>
            <pre>{{ dump(Auth::user()) }}</pre> --}}
            
            
            @auth('user')
                <!-- Cek apakah ini halaman utama -->
                @if(request()->routeIs(['home2', 'services', 'schools'])) <!-- Pastikan rute halaman utama adalah 'home' -->
                    <!-- Dropdown untuk Profil dan Logout -->
                    <div class="dropdown">
                        <button class="btn btn-outline-warning dropdown-toggle p-2" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-3"></i> <!-- Ikon Profil -->
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profil') }}">
                                    <i class="bi bi-person me-2"></i> Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            @endauth
        </div>
    </div>
    {{-- <p>Authenticated: {{ $isAuthenticated ? 'Yes' : 'No' }}</p>
    <p>User Guard: {{ $currentGuard ? 'Yes' : 'No' }}</p> --}}

    <!-- Main content section -->


</div>
<div class="mt-0">
    @yield('content')
</div>
<div class="mt-0" style="background-color: rgba(255, 255, 255, 0.8); 
        box-shadow: 0 -15px 25px rgba(0, 0, 0, 0.3);">
    @yield('layanan')
    @yield('scripts')
</div>

<div class="mt-0">
    @yield('sekolah')
</div>

<!-- Footer -->
<footer class="container-xxl py-2" style="background-color: #021C3F; font-size: 14px;">
    <div class="row mb-0 me-4 ms-4" style="color: #fff;">
        <!-- Kolom Alamat -->
        <div class="col-md-8 d-flex gap-3">
            <div class="col-auto d-flex align-items-center">
                <!-- Logo -->
                <a href="{{ Auth::check() ? url('beranda') : url('') }}" class="d-flex align-items-center">
                    <img src="{{ asset('/img/Logo.png') }}" alt="Logo Disdik Depok" class="img-fluid" style="max-width: 200px;">
                </a>
            </div>
            {{-- <strong>Alamat</strong> --}}
            <p>
                Gedung Dibaleka II, <br>
                Jl. Margonda No.54 Lt. 4, Depok,
                Kec. Pancoran Mas, Kota Depok,
                Jawa Barat 16431
            </p>
        </div>
        <!-- Kolom Tautan -->
        <div class="col-md-4">
            <strong>Tautan</strong>
            <ul class="list-unstyled d-flex gap-5">
            <li><a href="{{ route('home2') }}" class="text-white text-decoration-none">Home</a></li>
            <li><a href="{{ route('services') }}" class="text-white text-decoration-none">Layanan</a></li>
            <li><a href="{{ route('schools') }}" class="text-white text-decoration-none">Sekolah</a></li>
            <li><a href="{{ route('profil') }}" class="text-white text-decoration-none">Profil</a></li>            
        </ul>
        </div>
    </div>
    <!-- Garis pemisah -->
    <hr style="width: 100%; border: none; border-top: 1px solid #C5DBE7;margin-top: 0px;">
    <!-- Baris Ikon Sosial Media -->
    {{-- <div class="text-center mb-1">
        <a href="https://www.facebook.com/yourprofile" class="me-3" style="color: #C5DBE7;text-decoration: none;" target=" ">
            <i class="bi bi-facebook" style="font-size: 1rem;"></i>
        </a>
        <a href="https://www.instagram.com/yourprofile" class="me-3" style="color: #C5DBE7;text-decoration: none;" target=" ">
            <i class="bi bi-instagram" style="font-size: 1rem;"></i>
        </a>
        <a href="https://twitter.com/yourprofile" class="me-3" style="color: #C5DBE7;text-decoration: none;" target=" ">
            <i class="bi bi-twitter" style="font-size: 1rem;"></i>
        </a>
        <a href="https://www.youtube.com/yourchannel" class="me-3" style="color: #C5DBE7;text-decoration: none;" target=" ">
            <i class="bi bi-youtube" style="font-size: 1rem;"></i>
        </a>
        <a href="mailto:youremail@example.com" class="me-3" style="color: #C5DBE7;text-decoration: none;" target=" ">
            <i class="bi bi-envelope-fill" style="font-size: 1rem;"></i>
        </a>
        <a href="https://wa.me/yourwhatsappnumber" style="color: #C5DBE7;text-decoration: none;" target=" ">
            <i class="bi bi-whatsapp" style="font-size: 1rem;"></i>
        </a>
    </div> --}}
    <!-- Baris Hak Cipta -->
    <div class="text-center" style="color: #C5DBE7; font-size: 12px">
        HAK CIPTA © <script>document.write(new Date().getFullYear());</script> Dinas Pendidikan Kota Depok
        <br>
        Seluruh hak cipta dilindungi undang-undang dan terdaftar pada Direktorat Jenderal Kekayaan Intelektual 
        Republik Indonesia
    </div>
</footer>
  
<!-- / Footer -->

<!-- Optional Bootstrap JS -->
<!-- Optional Bootstrap JS --><!-- Optional Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dropdownButton = document.getElementById("profileDropdown");
        var dropdownMenu = document.querySelector(".dropdown-menu");

        dropdownButton.addEventListener("click", function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove("show");
            }
        });
    });
</script>

    <!-- Intro.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/intro.js/minified/intro.min.js"></script>
</body>
</html>
