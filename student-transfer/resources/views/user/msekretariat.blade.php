@extends('main-user')

@section('title', 'Beranda')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
@endphp

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="row mb-0" style="color: #fff;">
            <!-- Kolom Tautan -->
            <div class="col-md-6">
                <h5><strong>Mutasi Siswa</strong></h5>
                <p>
                    Mutasi peserta didik adalah proses perpindahan siswa dari satu sekolah ke sekolah lain 
                    dengan jenjang yang sama. Mutasi ini diperuntukkan untuk peserta didik PAUD, SD, dan SMP. 
                    Selain pengajuan mutasi, Anda dapat melihat daftar sekolah yang masih memiliki sisa kuota 
                    siswa di setiap jenjang.
                </p>
                <a href="{{ route('schools') }}" 
                   class="btn btn-sm rounded-pill btn-light d-inline-flex align-items-center gap-1">
                   <span class="mx-1">Daftar Sekolah</span> 
                   <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
            
            <!-- Kolom Alamat -->
            <div class="col-md-6">
                <img src="img/MERDEKA 1.png" alt="Gambar" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection

@section('layanan')
<div class="container mt-3 mb-5">
    <div class="row align-items-end mt-4">
        <div class="col-md-10 text-start"> 
            <h3><strong>Layanan</strong></h3>
            <p>
                Menu dan Layanan akan membantu Anda melakukan mutasi dengan cara mudah. Tidak perlu bolak-balik ke sekolah-sekolah terkait. Cukup melalui website ini Anda dapat melakukan mutasi secara online.
            </p>
        </div>
        <div class="col-md-2 text-end"> 
            <a href="{{ route('services') }}" 
               class="btn btn-sm rounded-pill btn-dark d-inline-flex align-items-center gap-1">
               <span class="mx-1">Lainnya</span> 
               <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>
    
    <div id="menuCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#menuCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#menuCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row justify-content-center">
                    <div class="col-md-3 me-3">
                        <div class="card custom-card">
                            <img src="img/Mutasi Masuk.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <strong>SI-MA | Mutasi Masuk</strong>
                                <p class="card-text">Pendaftaran Mutasi Masuk Peserta Didik ke Sekolah Tujuan.</p>
                                <a href="{{ route('user.sbaru.create') }}" class="btn btn-sm btn-custom1 d-inline-flex gap-1">
                                    <span class="mx-1">Daftar</span> 
                                    <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 me-3">
                        <div class="card custom-card">
                            <img src="img/Mutasi Keluar.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <strong>SI-KE | Mutasi Keluar</strong>
                                <p class="card-text">Pengajuan Mutasi Keluar Peserta Didik dari Sekolah Asal.</p>
                                <a href="{{ route('user.slama.create') }}" class="btn btn-sm btn-custom2 d-inline-flex gap-1">
                                    <span class="mx-1">Daftar</span> 
                                    <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card custom-card">
                            <img src="img/Lapor Mutasi.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <strong>POR-SI | Lapor Mutasi</strong>
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
    
            <div class="carousel-item">
                <div class="row justify-content-center">
                    <div class="col-md-3 me-3">
                        <div class="card custom-card">
                            <img src="img/Mutasi Masuk.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <strong>SI-MA | Mutasi Masuk</strong>
                                <p class="card-text">Pendaftaran Mutasi Masuk Peserta Didik ke Sekolah Tujuan.</p>
                                <a href="{{ route('user.sbaru.create') }}" class="btn btn-sm btn-custom1 d-inline-flex gap-1">
                                    <span class="mx-1">Daftar</span> 
                                    <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 me-3">
                        <div class="card custom-card">
                            <img src="img/Mutasi Keluar.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <strong>SI-KE | Mutasi Keluar</strong>
                                <p class="card-text">Pengajuan Mutasi Keluar Peserta Didik dari Sekolah Asal.</p>
                                <a href="{{ route('user.slama.create') }}" class="btn btn-sm btn-custom2 d-inline-flex gap-1">
                                    <span class="mx-1">Daftar</span> 
                                    <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card custom-card">
                            <img src="img/Lapor Mutasi.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <strong>POR-SI | Lapor Mutasi</strong>
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
    
        </div>
    
        <!-- Tombol Navigasi -->
        <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
            <span><i class="bi bi-caret-left-fill text-black fs-2"></i></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
            <span><i class="bi bi-caret-right-fill text-black fs-2"></i></span>
            <span class="visually-hidden">Next</span>
        </button>
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
        color: black;
    }
    .carousel-indicators {
        position: absolute;
        bottom: -30px; /* Geser ke bawah */
    }
</style>
@endsection


