@extends('main-admin')
@section('title', 'Mutasi Siswa')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Detail Data Layanan Mutasi Siswa</h4>
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
                            switch ($mutasi->status) {
                                case 'Diterima':
                                    $badgeClass = 'bg-label-success'; // Hijau untuk diterima
                                    break;
                                case 'Sedang Diproses':
                                    $badgeClass = 'bg-label-info'; // Biru untuk diproses
                                    break;
                                case 'Ditindaklanjuti':
                                    $badgeClass = 'bg-label-warning'; // Kuning untuk ditindaklanjuti
                                    break;
                                case 'Selesai':
                                    $badgeClass = 'bg-label-secondary'; // Abu-abu untuk selesai
                                    break;
                                default:
                                    $badgeClass = 'bg-label-dark'; // Warna default
                                    break;
                            }
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $mutasi->status }}</span>
                    </div>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nama Siswa</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi->nama_siswa }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>NISN</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi->nisn }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Jenjang</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi->jenjang }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Kelas</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi->kelas }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Jenis Kelamin</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi->kelamin }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nomor Telepon</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi->no_hp }}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-4">
                            <label>E-mail</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi->email }}
                        </div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center justify-content-between mt-0">
                    <h5 class="mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Berkas Persyaratan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">                    
                    <div class="form-group row mb-2">
                        <div class="col-md-4">
                            <label>Sekolah Asal</label>
                        </div>
                        <div class="col-md-8">
                            {{ ': ' . ($schoolAsal ?? '-') }}
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
                    <div class="form-group row mb-2">
                        <div class="col-md-4">
                            <label>Surat Rekomendasi Mutasi dari Sekolah Asal</label>
                        </div>
                        <div class="col-md-8">
                            @if($mutasi->surat_slama)
                            <span>:</span>
                            <a href="{{ asset($mutasi->surat_slama) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tersedia</span>
                            @endif
                        </div>
                    </div> 
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Rekomendasi Mutasi dari Sekolah yang dituju</label>
                        </div>
                        <div class="col-md-8">
                            @if($mutasi->surat_sbaru)
                            <span>:</span>
                            <a href="{{ asset($mutasi->surat_sbaru) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center justify-content-between mt-0">
                    <h5 class="mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Tanggapan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Pesan</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi->pesan }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Output</label>
                        </div>
                        <div class="col-md-8">
                            @if($mutasi->output)
                            <span>:</span>
                            <a href="{{ asset($mutasi->output) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider d-flex justify-content-end align-items-end">
                    <a href="{{ url('admin/mutasi_siswa') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection