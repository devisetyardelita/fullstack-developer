@extends('main-admin')
@section('title', 'Pengaduan Tidak Langsung')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Detail Data Layanan Pengaduan Tidak Langsung</h4>

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
                            {{': ' . $pengaduan_tidak_langsung->nama }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Nomor Handphone/WhatsApp<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $pengaduan_tidak_langsung->no_hp }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>E-mail<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $pengaduan_tidak_langsung->email }}
                        </div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Data Diri</h5>
                </div>
                <div class="card-body" style="margin-left: 1.5rem;">
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Bukti Pengaduan</label>
                        </div>
                        <div class="col-md-8">
                            @if($pengaduan_tidak_langsung->bukti_pengaduan)
                            <span>:</span>
                            <a href="{{ asset($pengaduan_tidak_langsung->bukti_pengaduan) }}" target="_blank">Lihat File</a>
                            @else
                                <span>:</span>
                                <span>File tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Detail Pengaduan<i style="color:red">*</i></label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $pengaduan_tidak_langsung->detail_pengaduan }}
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-md-4">
                            <label>Status</label>
                        </div>
                        <div class="col-md-8">
                            {{': ' . $pengaduan_tidak_langsung->status }}
                        </div>
                    </div>
                </div>
                <div class="divider d-flex justify-content-end align-items-end">
                    <a href="{{ url('admin/pengaduan_tidak_langsung') }}" class="btn btn-outline-secondary me-4">Kembali</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection