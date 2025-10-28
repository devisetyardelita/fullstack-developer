@extends('main-user')

@section('title', 'Profil - Disdik Depok')

@section('content')
<div class="container my-5">
    <!-- Header -->
    <h2 class="text-center mb-5 text-white fw-bold">Profil Pengguna</h2>

    <!-- Card Informasi Pengguna -->
    <div class="card shadow-lg border-0 mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i> Informasi Pengguna</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-3">
                        <strong><i class="bi bi-person me-2"></i>Nama Lengkap:</strong>
                        {{ Auth::user()->name }}
                    </p>
                    <p class="mb-3">
                        <strong><i class="bi bi-envelope me-2"></i>Email:</strong>
                        {{ Auth::user()->email }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-3">
                        <strong><i class="bi bi-check-circle me-2"></i>Status Pengguna:</strong>
                        <span class="badge bg-success">Aktif</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Status Mutasi Keluar -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i> Riwayat Pengajuan</h5>
        </div>
        <div class="card-body">
            <!-- Tab Navigation -->
            <ul class="nav nav-underline custom-tabs" id="schoolTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#" onclick="loadMutasi('keluar', this)">Mutasi Keluar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadMutasi('masuk', this)">Mutasi Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadMutasi('siswa', this)">Mutasi Siswa</a>
                </li>
            </ul>

            <!-- Container untuk menampilkan data -->
            <div id="mutasi-content" class="mt-3">
                <div class="text-center">
                    <span class="text-muted">Pilih tab untuk melihat data.</span>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .custom-tabs {
        display: flex;
        width: 100%;
        border-bottom: 2px solid #ddd; /* Biar ada garis bawah full */
    }

    .custom-tabs .nav-item {
        flex: 1; /* Supaya rata dan lebar */
        text-align: center;
    }

    .custom-tabs .nav-link {
        width: 100%;
        font-weight: bold;
        padding: 12px 0;
        color: #333;
        border-bottom: 3px solid transparent; /* Untuk transisi underline */
    }

    .custom-tabs .nav-link.active {
        color: #007bff !important; /* Warna biru saat aktif */
        border-bottom: 3px solid #007bff !important; /* Underline saat aktif */
    }

    .custom-tabs .nav-link:hover {
        color: #0056b3;
        border-bottom: 3px solid #0056b3; /* Underline saat hover */
    }
</style>
<script>
    function loadMutasi(type, element) {
        // Tambahkan class active di tab yang diklik
        document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
        element.classList.add('active');

        // Tampilkan loading indikator
        document.getElementById('mutasi-content').innerHTML = '<div class="text-center"><i class="bi bi-arrow-repeat"></i> Memuat...</div>';

        // Fetch data dari route
        fetch(`profil/load/${type}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('mutasi-content').innerHTML = data;
            })
            .catch(error => {
                document.getElementById('mutasi-content').innerHTML = '<div class="alert alert-danger">Gagal memuat data.</div>';
                console.error('Error:', error);
            });
    }
</script>
@endsection
