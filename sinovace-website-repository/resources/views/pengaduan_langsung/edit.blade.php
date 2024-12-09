@extends('main-admin')
@section('title', 'Pengaduan Langsung')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Ubah Data Pengaduan Langsung</span></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-2">Data Pengaduan Langsung</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/pengaduan_langsung/edit/' . $pengaduan_langsung->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama anda..." value="{{ $pengaduan_langsung->nama }}" autofocus/>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="no_hp">No. HP/WA</label>
                            <div class="col-sm-10">
                                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ $pengaduan_langsung->no_hp }}" autofocus/>
                                @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="email">E-mail</label>
                            <div class="col-sm-10">
                                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com" value="{{ $pengaduan_langsung->email }}" autofocus/>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_permohonan_pengajuan">Surat Permohonan Pengajuan</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_permohonan_pengajuan" name="surat_permohonan_pengajuan" class="form-control @error('surat_permohonan_pengajuan') is-invalid @enderror" value="{{($pengaduan_langsung->surat_permohonan_pengajuan) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('surat_permohonan_pengajuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($pengaduan_langsung->surat_permohonan_pengajuan)
                                <p class="mt-2">File saat ini: <a href="{{asset($pengaduan_langsung->surat_permohonan_pengajuan) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="ktp">KTP</label>
                            <div class="col-sm-10">
                                <input type="file" id="ktp" name="ktp" class="form-control @error('ktp') is-invalid @enderror" value="{{($pengaduan_langsung->ktp) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($pengaduan_langsung->ktp)
                                <p class="mt-2">File saat ini: <a href="{{asset($pengaduan_langsung->ktp) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="bukti_pengaduan">Bukti Pengaduan</label>
                            <div class="col-sm-10">
                                <input type="file" id="bukti_pengaduan" name="bukti_pengaduan" class="form-control @error('bukti_pengaduan') is-invalid @enderror" value="{{($pengaduan_langsung->bukti_pengaduan) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('bukti_pengaduan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($pengaduan_langsung->bukti_pengaduan)
                                <p class="mt-2">File saat ini: <a href="{{asset($pengaduan_langsung->bukti_pengaduan) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Diterima" {{ $pengaduan_langsung->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="Diproses" {{ $pengaduan_langsung->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Ditindaklanjuti" {{ $pengaduan_langsung->status == 'Ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                                        <option value="Selesai" {{ $pengaduan_langsung->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('admin/pengaduan_langsung') }}" class="btn btn-outline-secondary">Kembali</a>

                            </div>
                        </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection