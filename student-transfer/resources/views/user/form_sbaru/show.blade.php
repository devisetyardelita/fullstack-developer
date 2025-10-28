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
            <div class="tab-content" id="schoolTabContent">
                <!-- Detail -->
                <div class="tab-pane fade show active" id="detail" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-person me-2"></i>Nama Siswa</strong></td>
                                        <td>{{': ' . $sbaru->nama_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-building me-2"></i>Nama Sekolah Asal</strong></td>
                                        <td>{{': ' . $schoolAsal }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-building me-2"></i>Nama Sekolah Tujuan</strong></td>
                                        <td>{{': ' . $sbaru->schoolTujuan->nama_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-star me-2"></i>NSIN</strong></td>
                                        <td>{{': ' . $sbaru->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-mortarboard me-2"></i>Jenjang</strong></td>
                                        <td>{{': ' . $sbaru->jenjang }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-stack me-2"></i>Kelas</strong></td>
                                        <td>{{': ' . $sbaru->kelas }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td style="width: 40%;"><strong><i class="bi bi-geo-alt me-2"></i>Alamat</strong></td>
                                        <td>{{': ' . $sbaru->alamat_ortu }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-envelope me-2"></i>Email</strong></td>
                                        <td>{{': ' . $sbaru->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-telephone me-2"></i>Nomor Telepon</strong></td>
                                        <td>{{': ' . $sbaru->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-chat-text me-2"></i>Pesan</strong></td>
                                        <td>{{': ' . $sbaru->pesan }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-file-text me-2"></i>Output</strong></td>
                                        <td>
                                            :
                                            @if ($sbaru->output)
                                                <a href="{{ asset($sbaru->output) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-arrow-down-circle"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-muted" >Belum ada balasan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="bi bi-check-circle me-2"></i>Status</strong></td>
                                        <td>
                                            :
                                            @if ($sbaru->status == 'Diterima')
                                                <span class="badge bg-success text-white">Diterima</span>
                                            @elseif ($sbaru->status == 'Diproses')
                                                <span class="badge bg-info text-white">Diproses</span>
                                            @elseif ($sbaru->status == 'Ditolak')
                                                <span class="badge bg-danger text-dark">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
@endsection
