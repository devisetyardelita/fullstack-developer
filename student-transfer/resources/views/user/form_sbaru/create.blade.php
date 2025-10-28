@extends('main-user')

@section('title', 'Sekolah Tujuan')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
    <div class="row">
        <!-- Bagian Deskripsi Kiri -->
        <div class="col-md-6">
            <div class="text-white">
                <h2>Mutasi Siswa Masuk</h2>
                <p>
                    Layanan ini merupakan proses pendaftaran siswa yang ingin mutasi ke sekolah tujuan.
                    Pada proses ini, orang tua atau siswa akan mendapatkan Surat Rekomendasi Mutasi dari Sekolah yang dituju yang menyatakan bahwa siswa yang mendaftar diterima pindah ke sekolah
                    tersebut.
                </p>
            </div>
            <div style="border: 1px solid #0174BE; background-color: #E0F0FF; padding: 20px; border-radius: 8px;">
                <h6><strong>PERSYARATAN</strong></h6>
                <ul style="font-size: 0.925rem">
                    <li>
                        Surat Permohonan Orang Tua / Wali Murid
                    </li>
                </ul>
                <h7><strong>Catatan:</strong></h7>
                <ul style="font-size: 0.9rem">
                    <li>
                        Pengajuan 'Luar Kota' jika <u>sekolah tujuan</u> berada di <u>wilayah Kota Depok</u>, namun <u>sekolah asal</u> berada di <u>luar wilayah Kota Depok</u>.
                    </li>
                    <li>
                        Pengajuan tidak boleh lebih dari 1x. 
                        Pastikan data pengajuan Anda benar!
                    </li>
                    <li>
                        Pengajuan dapat diajukan kembali ketika 'status' pengajuan Anda <u>Ditolak</u>.
                    </li>
                    <li style="display: flex; align-items: flex-start; font-size: .875rem; gap: 1rem;">
                        <span>
                            Status: 
                            <span class="badge bg-info text-white">Diproses</span>
                            <span class="badge bg-success text-white">Diterima</span>
                            <span class="badge bg-danger text-white">Ditolak</span>
                        </span>
                    </li>
                </ul>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="display: flex; align-items: flex-start; font-size: .875rem; color: #dc3545; gap: .5em;">
                    <span style="flex-shrink: 0;">*</span>
                    <span>
                        Surat Rekomendasi Mutasi Siswa akan diterbitkan setelah 2-3 hari kerja.
                    </span>
                    </li>
                </ul>
            </div>
            <div class="card shadow-lg border-0 mb-4 mt-2">
                <div class="card-header text-white" style="background-color: rgba(53, 106, 86, 0.95)">
                    <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i> Riwayat Pengajuan Anda</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($history as $item)
                            <div class="col-12 mb-3">
                                <div class="card shadow-sm border rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <div class="icon fs-2 text-primary">
                                                    🎓
                                                </div>
                                            </div>
                                            <div>
                                                <div class="mt-1">
                                                    {{ $item->nama_siswa}}
                                                </div>
                                                <div class="mt-1">
                                                    {{ $item->nisn}}
                                                </div>
                                                <a href="{{ route('user.sbarudetails', ['tipe' => $item->tipe == 'dalam' ? 'dalam' : 'luar', 'id' => $item->id]) }}" class="fw-bold text-dark text-decoration-none">
                                                    {{ $item->nama_sekolah ?? '-' }}
                                                </a>
                                                
                                                    {{-- {{ $item->schoolTujuan->nama_sekolah ?? '-' }} --}}
                                                <div class="mt-1">
                                                    @if ($item->status == 'Diproses')
                                                        <span class="badge bg-info text-white">Diproses</span>
                                                    @elseif ($item->status == 'Diterima')
                                                        <span class="badge bg-success text-white">Diterima</span>
                                                    @elseif ($item->status == 'Ditolak')
                                                        <span class="badge bg-danger text-white">Ditolak</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mt-2 ms-auto text-end">
                                                <small class="d-block text-muted">
                                                    📝 Diajukan: {{ $item->created_at->format('d M Y (H:i)') }}
                                                </small>
                                                <small class="d-block text-muted">
                                                    🔄 Terakhir diperbarui: {{ $item->updated_at->format('d M Y (H:i)') }}
                                                </small>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center text-muted">Belum ada pengajuan siswa baru.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            

        </div>
        <!-- Bagian Deskripsi Kanan -->
        <div class="col-md-6">
            <div class="card p-4 bg-light custom-card mb-4">
                <h3 class="text-center"  style="color: #04295a"><strong>Formulir Mutasi Masuk</strong></h3>
                <p class="text-center text-muted">Lengkapi data berikut untuk mengajukan permohonan.</p>
                {{-- Dynamic Form --}}
                {{-- Tab Selector class="nav-link {{ $tipe == 'dalam' ? 'active' : '' }}" --}}
                <ul class="nav nav-underline custom-tabs" id="sbaruTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('user.sbaru.create', ['tipe' => 'dalam']) }}" 
                           class="nav-link {{ $tipe == 'dalam' ? 'active' : '' }}" 
                           id="dalam" role="tab">
                            Dalam Kota
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('user.sbaru.create', ['tipe' => 'luar']) }}" 
                           class="nav-link {{ $tipe == 'luar' ? 'active' : '' }}" 
                           id="luar" role="tab">
                            Luar Kota
                        </a>
                    </li>
                </ul>                
                {{-- @include('user.form_sbaru.form-jenjang-') --}}
                @if (!$adaPengajuan)
                    @include('user.form_sbaru.form-jenjang-' . $tipe)
                @else
                    <div class="alert alert-warning mt-3">
                        Anda tidak bisa mengajukan permohonan karena masih ada pengajuan yang sedang diproses.
                    </div>
                @endif
            
            </div>
        </div>
    </div>
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
            PAUD: [
                { value: 0, label: 'PAUD A' },
                { value: 1, label: 'PAUD B' }
            ],
            SD: ['1', '2', '3', '4', '5', '6'],
            SMP: ['7', '8', '9']
        };

        ['dalam', 'luar'].forEach(function(tipe) {
            $(`#jenjang_${tipe} input[type=radio]`).on('change', function() {
                const jenjang = $(this).val();
                let html = '<option value="">Pilih Kelas</option>';

                // Jika jenjang PAUD, kita ambil value dan labelnya
                if (jenjang === 'PAUD') {
                    kelasData.PAUD.forEach(function(kelas) {
                        html += `<option value="${kelas.value}">${kelas.label}</option>`;
                    });
                } else {
                    // Untuk jenjang selain PAUD (SD, SMP)
                    (kelasData[jenjang] || []).forEach(function(kelas) {
                        html += `<option value="${kelas}">${kelas}</option>`;
                    });
                }

                $(`#kelas_${tipe}`).html(html);
            });
        });
    });
</script>
@endsection
