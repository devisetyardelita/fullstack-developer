@extends('main-user-regist')

@section('title', 'Detail Pengajuan')

@section('content')
<div class="container my-5">
    <!-- Header -->
    {{-- <h2 class="text-center mb-5 text-black fw-bold">Profil Pengguna</h2> --}}

    <!-- Card Informasi Pengguna -->
    <div class="card shadow-lg border-0 mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i> Informasi Pengajuan</h5>
        </div>
        <div class="card-body">
            {{-- <ul class="nav nav-underline custom-tabs" id="schoolTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab">
                        Detail
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="map-tab" data-bs-toggle="tab" data-bs-target="#map" type="button" role="tab">
                        Peta
                    </button>
                </li>
            </ul> --}}
            
            <div class="tab-content" id="schoolTabContent">
                <!-- Detail -->
                <div class="tab-pane fade show active" id="detail" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-person me-2"></i>Nama Siswa</strong></td>
                                        <td>{{': ' . $mutasi_siswa->nama_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-building me-2"></i>Nama Sekolah Asal</strong></td>
                                        <td>{{': ' . $mutasi_siswa->schoolAsal->nama_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-building me-2"></i>Nama Sekolah Tujuan</strong></td>
                                        <td>{{': ' . $schoolTujuan }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-star me-2"></i>NSIN</strong></td>
                                        <td>{{': ' . $mutasi_siswa->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-mortarboard me-2"></i>Jenjang</strong></td>
                                        <td>{{': ' . $mutasi_siswa->jenjang }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-stack me-2"></i>Kelas</strong></td>
                                        <td>{{': ' . $mutasi_siswa->kelas }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    {{-- <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-geo-alt me-2"></i>Alamat</strong></td>
                                        <td>{{': ' . $mutasi_siswa->alamat_ortu }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td><strong><i class="bi bi-envelope me-2"></i>Email</strong></td>
                                        <td>{{': ' . $mutasi_siswa->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-telephone me-2"></i>Nomor Telepon</strong></td>
                                        <td>{{': ' . $mutasi_siswa->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-file-text me-2"></i>Output</strong></td>
                                        <td>
                                            :
                                            @if ($mutasi_siswa->output)
                                                <a href="{{ asset($mutasi_siswa->output) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-arrow-down-circle"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-muted">Belum ada balasan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-chat-dots me-2"></i>Pesan</strong></td>
                                        <td>{{': ' . $mutasi_siswa->pesan }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-check-circle me-2"></i>Status</strong></td>
                                        <td>
                                            :
                                            @if ($mutasi_siswa->status == 'Diterima')
                                                <span class="badge bg-success text-white">Diterima</span>
                                            @elseif ($mutasi_siswa->status == 'Diproses')
                                                <span class="badge bg-info text-white">Sedang Diproses</span>
                                            @elseif ($mutasi_siswa->status == 'Selesai')
                                                <span class="badge bg-secondary text-white">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        
                {{-- <!-- Peta -->
                <div class="tab-pane fade" id="map" role="tabpanel">
                    <div id="map-container" style="height: 400px; width: 100%;">
                        <!-- Peta akan ditampilkan di sini -->
                    </div>
                </div> --}}
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
{{-- <script>
    // Inisialisasi Leaflet Map
    document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map-container').setView([{{ $schools->latitude }}, {{ $schools->longitude }}], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([{{ $schools->latitude }}, {{ $schools->longitude }}]).addTo(map)
            .bindPopup("{{ $schools->nama_sekolah }}")
            .openPopup();
    });
</script> --}}
@endsection
