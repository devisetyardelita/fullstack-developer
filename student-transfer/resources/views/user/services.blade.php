@extends('main-user')

@section('title', 'Layanan')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
@endphp

<div class="text-center text-white mt-3 mb-4">
    <h1 class="display-4">SI-SI</h1>
    <p class="lead">Sistem Layanan Mutasi Siswa Secara Online Dinas Pendidikan Kota Depok</p>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-3 me-3" id="step1">
            <div class="card custom-card">
                <img src="img/Mutasi Masuk.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <strong>1. SI-MA | Mutasi Masuk</strong>
                    <p class="card-text">Pendaftaran Mutasi Masuk Peserta Didik ke Sekolah Tujuan.</p>
                    <a href="{{ route('user.sbaru.create') }}" class="btn btn-sm btn-custom1 d-inline-flex gap-1">
                        <span class="mx-1">Daftar</span> 
                        <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 me-3" id="step2">
            <div class="card custom-card">
                <img src="img/Mutasi Keluar.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <strong>2. SI-KE | Mutasi Keluar</strong>
                    <p class="card-text">Pengajuan Mutasi Keluar Peserta Didik dari Sekolah Asal.</p>
                    <a href="{{ route('user.slama.create') }}" class="btn btn-sm btn-custom2 d-inline-flex gap-1">
                        <span class="mx-1">Daftar</span> 
                        <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3" id="step3">
            <div class="card custom-card">
                <img src="img/Lapor Mutasi.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <strong>3. POR-SI | Lapor Mutasi</strong>
                    <p class="card-text">Pengajuan Pembaruan Data Peserta Didik.</p>
                    <a href="{{ route('user.mutasi_siswa.create') }}" class="btn btn-sm btn-custom3 d-inline-flex gap-1">
                        <span class="mx-1">Daftar</span> 
                        <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Style -->
<style>
    .btn-custom1 {
        background: rgba(53, 106, 86, 0.95); /* Kuning dan oranye terang */
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 50px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-custom2 {
        background: rgba(160, 40, 54, 0.95); /* Kuning dan oranye terang */
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 50px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-custom3 {
        background: rgba(0, 154, 222, 0.95); /* Kuning dan oranye terang */
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 50px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-custom:hover {
        background: #021C3F; /* Sedikit lebih gelap saat hover */
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    }

    .bi {
        font-size: 1.5rem;
    }

    /* Mengubah ukuran teks judul */
    h1.display-4 {
        font-size: 3rem;
        font-weight: bold;
    }

    /* Mengubah jarak antar elemen */
    .row > div {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    section {
    background-attachment: fixed;
    background-size: cover;
    }
    .carousel-indicators .active {
    background-color: rgba(0, 154, 222, 0.95); /* Warna indikator aktif jadi merah */
    }
    /* .carousel-indicators, */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(1); /* Ubah warna jadi hitam */
    }
    .custom-card {
        background-color: rgba(255, 255, 255, 0.25); /* Warna putih transparan */
        border: none; /* Hilangin border biar lebih clean (opsional) */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Tambahin shadow biar lebih elegan */
        color: white
    }    
    .introjs-skipbutton {
        display: none !important;
    }
</style>
@endsection
@section('layanan')
<div class="container mt-3 mb-0">
    <div class="row align-items-end mt-4" id="step4">
        <div class="col-md-10 text-start"> 
            <h3><strong>Alur Mutasi</strong></h3>
            <p>
                Perhatikan dengan baik alur mutasi berikut agar Anda dapat 
                memahami setiap tahapan dengan benar dan tidak melewatkan dokumen atau proses penting.
            </p>
        </div>
        <img src="img/Alur.png" style="width: 85%;" alt="Gambar" class="img-fluid d-block mx-auto">
    </div>
</div>
@endsection

@section('scripts')
<!-- Intro.js CDN -->
<link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!sessionStorage.getItem('introSeen')) {
            sessionStorage.setItem('introSeen', 'true');
            introJs().setOptions({
                steps: [
                    {
                        intro: "Selamat datang di halaman layanan! Yuk kita jelajahi satu per satu."
                    },
                    {
                        element: '#step1',
                        intro: "1️⃣ Pertama, lakukan pendaftaran ke sekolah tujuan melalui menu <strong>SI-MA</strong> untuk mendapatkan surat bukti penerimaan.",
                    },
                    {
                        element: '#step2',
                        intro: "2️⃣ Setelah dapat surat penerimaan, ajukan mutasi ke sekolah asal melalui menu <strong>SI-KE</strong> untuk dapat surat bukti keluar.",
                    },
                    {
                        element: '#step3',
                        intro: "3️⃣ Terakhir, gunakan menu <strong>POR-SI</strong> untuk melaporkan perubahan data siswa ke Disdik.",
                    },
                    {
                        element: '#step4',
                        intro: "📌 Ini adalah alur proses mutasi. Pastikan kamu membacanya dengan teliti agar semua langkah dilakukan secara berurutan."
                    }
                ],
                showProgress: true,
                showBullets: true,
                showSkipButton: false,
                exitOnEsc: false,
                exitOnOverlayClick: true,
                skipLabel: '',
            }).start();
        }
    });
</script>
@endsection
