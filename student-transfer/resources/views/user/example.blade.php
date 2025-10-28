@extends('main-user')

@section('title', 'Beranda')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
@endphp


{{-- <div class="text-center text-white mt-5">
    <h1 class="display-4">SI-SI</h1>
    <p class="lead">Mutasi Siswa Secara Online</p>
</div> --}}

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
                <a href="{{ route('admin.izin_penelitian.create') }}" 
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

        <div class="row mb-0" style="background-color: #fff;">
            <!-- Kolom Tautan -->
            <div class="col-md-6">
                <h5><strong>Mutasi Siswa</strong></h5>
                <p>
                    Mutasi peserta didik adalah proses perpindahan siswa dari satu sekolah ke sekolah lain 
                    dengan jenjang yang sama. Mutasi ini diperuntukkan untuk peserta didik PAUD, SD, dan SMP. 
                    Selain pengajuan mutasi, Anda dapat melihat daftar sekolah yang masih memiliki sisa kuota 
                    siswa di setiap jenjang.
                </p>
                <a href="{{ route('admin.izin_penelitian.create') }}" 
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
        <!-- Tombol Form Layanan Baru -->
        <div class="col-md-6 mb-4 text-center">
            <a href="{{ route('form.create') }}" class="btn btn-custom w-100 py-3">
                <i class="bi bi-pencil-square me-2"></i> Formulir Layanan
            </a>  
        </div>
        <!-- Izin Penelitian -->
        <div class="col-md-6 mb-4 text-center">
            <a href="{{ route('user.izin_penelitian.create') }}" class="btn btn-custom w-100 py-3">
                <i class="bi bi-chat-left-text me-2"></i> Izin Penelitian
            </a>  
        </div>
        
        
        <div class="col-md-6 mb-4 text-center">
            <a href="{{ route('user.mutasi_siswa.create') }}" class="btn btn-custom w-100 py-3"><i class="bi bi-arrows-move me-2"></i> Mutasi Siswa (Sisi)</a>
           <div class="col-md-6 mb-4 text-center">
               <a href="{{ route('user.legalisir_piagam.create') }}" class="btn btn-custom w-100 py-3"><i class="bi bi-award me-2"></i> Legalisir Piagam Penghargaan</a>
           </div>
           
    </div>
</div>

<!-- Style -->
<style>
    .btn-custom {
        background: linear-gradient(45deg, #f1c40f, #f39c12); /* Kuning dan oranye terang */
        border: none;
        color: white;
        font-size: 1.1rem;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 50px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-custom:hover {
        background: linear-gradient(45deg, #f39c12, #e67e22); /* Sedikit lebih gelap saat hover */
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
</style>
@endsection

@section('isi')
<div class="container mt-0">
    <div class="row justify-content-center">
        <div class="row mb-0" style="background-color: #fff;">
            <!-- Kolom Tautan -->
            <div class="col-md-6">
                <h5><strong>Mutasi Siswa</strong></h5>
                <p>
                    Mutasi peserta didik adalah proses perpindahan siswa dari satu sekolah ke sekolah lain 
                    dengan jenjang yang sama. Mutasi ini diperuntukkan untuk peserta didik PAUD, SD, dan SMP. 
                    Selain pengajuan mutasi, Anda dapat melihat daftar sekolah yang masih memiliki sisa kuota 
                    siswa di setiap jenjang.
                </p>
                <a href="{{ route('admin.izin_penelitian.create') }}" 
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

<!-- Style -->
<style>
    .btn-custom {
        background: linear-gradient(45deg, #f1c40f, #f39c12); /* Kuning dan oranye terang */
        border: none;
        color: white;
        font-size: 1.1rem;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 50px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-custom:hover {
        background: linear-gradient(45deg, #f39c12, #e67e22); /* Sedikit lebih gelap saat hover */
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
</style>
@endsection
