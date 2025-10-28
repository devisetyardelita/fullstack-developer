@extends('main-operator')
@section('title', 'Mutasi Siswa Keluar')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Detail Data Layanan Mutasi Siswa Keluar</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4"> 
                    <div class="card-header d-flex align-items-center">
                        <div class="col-md-10">
                            <h5 class="fw-bold mb-0">
                                <i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i> Data Siswa
                            </h5>
                        </div>
                        <div class="col-md-2 text-end">
                            @php
                                $badgeClass = '';
                                switch ($slama->status) {
                                case 'Diterima':
                                    $badgeClass = 'bg-label-success'; // Hijau untuk aktif
                                    break;
                                case 'Diproses':
                                    $badgeClass = 'bg-label-info'; // Kuning untuk pending
                                    break;
                                case 'Ditolak':
                                    $badgeClass = 'bg-label-danger'; // Merah untuk non-aktif
                                    break;
                                default:
                                    $badgeClass = 'bg-label-success'; // Warna default
                                    break;
                            }
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $slama->status }}</span>
                        </div>
                    </div>
                    <div class="card-body" style="margin-left: 1.5rem;">
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Nama Siswa</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->nama_siswa }}
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>NISN</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->nisn }}
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Jenjang</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->jenjang }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4">
                                <label>Kelas</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->kelas }}
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Jenis Kelamin</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->kelamin }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4">
                                <label>Tempat Lahir</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->tempat_lahir }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4">
                                <label>Tanggal Lahir</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->tgl_lahir }}
                            </div>
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center justify-content-between mt-0">
                        <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Data Orang Tua</h5>
                    </div>
                    <div class="card-body" style="margin-left: 1.5rem;">
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Nama Orang Tuas</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->nama_ortu }}
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Alamat (terbaru)</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->alamat_ortu }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4">
                                <label>No. Telp</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->no_hp }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->email }}
                            </div>
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center justify-content-between mt-0">
                        <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Data Sekolah</h5>
                    </div>
                    <div class="card-body" style="margin-left: 1.5rem;">                    
                        <div class="form-group row mb-2">
                            <div class="col-md-4">
                                <label>Sekolah Asal</label>
                            </div>
                            <div class="col-md-8">
                                {{ ': ' . ($slama->schoolAsal->nama_sekolah ?? '-') }}
                            </div>
                        </div>                 
                        <div class="form-group row mb-2">
                            <div class="col-md-4">
                                <label>Sekolah Tujuan</label>
                            </div>
                            <div class="col-md-8">
                                {{ ': ' . ($schoolTujuan ?? '-') }}
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Surat Permohonan Wali Murid</label>
                            </div>
                            <div class="col-md-8">
                                @if($slama->surat_permohonan)
                                <span>:</span>
                                <a href="{{ asset($slama->surat_permohonan) }}" target="_blank">Lihat File</a>
                                @else
                                    <span>:</span>
                                    <span>File Tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Surat Penyataan Wali Murid</label>
                            </div>
                            <div class="col-md-8">
                                @if($slama->surat_pernyataan)
                                <span>:</span>
                                <a href="{{ asset($slama->surat_pernyataan) }}" target="_blank">Lihat File</a>
                                @else
                                    <span>:</span>
                                    <span>File Tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Surat Rekomendasi Mutasi dari Sekolah yang dituju</label>
                            </div>
                            <div class="col-md-8">
                                @if($slama->surat_sbaru)
                                <span>:</span>
                                <a href="{{ asset($slama->surat_sbaru) }}" target="_blank">Lihat File</a>
                                @else
                                    <span>:</span>
                                    <span>File Tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Alasan</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->alasan }}
                            </div>
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center justify-content-between mt-0">
                        <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Tanggapan</h5>
                    </div>                
                    <div class="card-body" style="margin-left: 1.5rem;">
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Pesan</label>
                            </div>
                            <div class="col-md-8">
                                {{': ' . $slama->pesan }}
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <div class="col-md-4">
                                <label>Output</label>
                            </div>
                            <div class="col-md-8">
                                @if($slama->output)
                                <span>:</span>
                                <a href="{{ asset($slama->output) }}" target="_blank">Lihat File</a>
                                @else
                                    <span>:</span>
                                    <span>File Tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="divider d-flex justify-content-end align-items-end">
                        <a href="{{ url('operator/mutasi_keluar') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection