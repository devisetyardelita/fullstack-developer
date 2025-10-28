@extends('main-admin')
@section('title', 'Mutasi Siswa Masuk')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Detail Data Layanan Mutasi Siswa Masuk</h4>
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
                            switch ($sbaru->status) {
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
                        <span class="badge {{ $badgeClass }}">{{ $sbaru->status }}</span>
                    </div>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nama Siswa</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->nama_siswa }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>NISN</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->nisn }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Jenjang</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->jenjang }}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-4">
                            <label>Kelas</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->kelas }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Jenis Kelamin</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->kelamin }}
                        </div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center justify-content-between mt-0">
                    <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Data Orang Tua</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nama Orang Tua</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->nama_ortu }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Alamat (terbaru)</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->alamat_ortu }}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-4">
                            <label>No. Telp</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->no_hp }}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->email }}
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
                            {{ ': ' . ($schoolAsal ?? '-') }}
                        </div>
                    </div>                  
                    <div class="form-group row mb-2">
                        <div class="col-md-4">
                            <label>Sekolah Tujuan</label>
                        </div>
                        <div class="col-md-8">
                            {{ ': ' . ($sbaru->schoolTujuan->nama_sekolah ?? '-') }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Permohonan Wali Murid</label>
                        </div>
                        <div class="col-md-8">
                            @if($sbaru->surat_permohonan)
                            <span>:</span>
                            <a href="{{ asset($sbaru->surat_permohonan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File Tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Penyataan Wali Murid</label>
                        </div>
                        <div class="col-md-8">
                            @if($sbaru->surat_pernyataan)
                            <span>:</span>
                            <a href="{{ asset($sbaru->surat_pernyataan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File Tidak tersedia</span>
                            @endif
                        </div>
                    </div> --}}
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Alasan</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $sbaru->alasan }}
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
                            {{': ' . $sbaru->pesan }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Output</label>
                        </div>
                        <div class="col-md-8">
                            @if($sbaru->output)
                            <span>:</span>
                            <a href="{{ asset($sbaru->output) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider d-flex justify-content-end align-items-end">
                    <a href="{{ url('admin/mutasi_masuk') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection