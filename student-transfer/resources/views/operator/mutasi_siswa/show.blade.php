@extends('main-admin')
@section('title', 'Mutasi Siswa')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Detail Data Layanan Mutasi Siswa</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Data Diri</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi_siswa->nama }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nomor Handphone/WhatsApp<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi_siswa->no_hp }}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-4">
                            <label>E-mail<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi_siswa->email }}
                        </div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center justify-content-between mt-0">
                    <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Berkas Persyaratan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Surat Rekomendasi Mutasi dari Sekolah Lama</label>
                        </div>
                        <div class="col-md-8">
                            @if($mutasi_siswa->surat_lama)
                            <span>:</span>
                            <a href="{{ asset($mutasi_siswa->surat_lama) }}" target="_blank">Lihat File</a>
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
                            @if($mutasi_siswa->surat_tujuan)
                            <span>:</span>
                            <a href="{{ asset($mutasi_siswa->surat_tujuan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center justify-content-between mt-0">
                    <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Tanggapan</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Output</label>
                        </div>
                        <div class="col-md-8">
                            @if($mutasi_siswa->output)
                            <span>:</span>
                            <a href="{{ asset($mutasi_siswa->output) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tersedia</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Status</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $mutasi_siswa->status }}
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