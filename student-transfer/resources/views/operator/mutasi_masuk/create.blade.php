@extends('main-operator')
@section('title', 'Mutasi Masuk')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Tambah Layanan Mutasi Siswa Masuk</h4>
        @php
            use App\Helpers\MutasiChecker;
            // dd($tipe, auth()->user()->nisn)
            // Sesuaikan nama layanan yang digunakan di helper
            $layanan = $tipe === 'dalam' ? 'sbaru' : 'sbaru_luar';
            $adaPengajuan = MutasiChecker::siswaPunyaPengajuanAktif(auth()->user()->nisn, $layanan);
        @endphp
    
        @if ($adaPengajuan)
        <div class="alert alert-danger">
            Kamu masih punya pengajuan yang sedang diproses untuk Mutasi Masuk.
        </div>
        @endif
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Layanan Mutasi Masuk</h5>
                    </div>
                    <div class="card-body ms-3 me-5 mb-2">
                        <ul class="nav nav-underline custom-tabs" id="sbaruTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('operator.sbaru.create', ['tipe' => 'dalam']) }}" 
                                   class="nav-link {{ $tipe == 'dalam' ? 'active' : '' }}" 
                                   id="dalam" role="tab">
                                    Dalam Kota
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('operator.sbaru.create', ['tipe' => 'luar']) }}" 
                                   class="nav-link {{ $tipe == 'luar' ? 'active' : '' }}" 
                                   id="luar" role="tab">
                                    Luar Kota
                                </a>
                            </li>
                        </ul>
                        @if (!$adaPengajuan)
                            @include('operator.mutasi_masuk.form-jenjang-' . $tipe)
                        @else
                            <div class="alert alert-warning mt-3">
                                Anda tidak bisa mengajukan permohonan karena masih ada pengajuan yang sedang diproses.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
<style>
    .custom-card {
        border-radius: 40px;
    }
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
    .input-line {
        border: none;
        border-bottom: 2px solid #ccc;
        border-radius: 0;
        background-color: transparent;
        width: 100%;
        padding: 8px 4px;
        transition: border-color 0.3s;
    }

    .input-line:focus {
        outline: none;
        border-bottom-color: #0d6efd; /* biru bootstrap */
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const kelasData = {
            PAUD: ['PAUD A', 'PAUD B'],
            SD: ['1', '2', '3', '4', '5', '6'],
            SMP: ['7', '8', '9']
        };

        ['dalam', 'luar'].forEach(function(tipe) {
            $(`#jenjang_${tipe} input[type=radio]`).on('change', function() {
                const jenjang = $(this).val();
                let html = '<option value="">Pilih Kelas</option>';

                (kelasData[jenjang] || []).forEach(function(kelas) {
                    html += `<option value="${kelas}">${kelas}</option>`;
                });

                $(`#kelas_${tipe}`).html(html);
            });
        });
    });
</script>
@endsection