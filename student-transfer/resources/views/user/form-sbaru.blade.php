@extends('main-user')

@section('title', 'Sekolah Tujuan')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Bagian Deskripsi Kiri -->
        <div class="col-md-6">
            <div class="text-white">
                <h2>Si-Mutasi Siswa Masuk</h2>
                <p>
                    Layanan ini merupakan proses pendaftaran siswa yang ingin mutasi ke sekolah tujuan.
                    Pada proses ini, orang tua atau siswa akan mendapatkan Surat Rekomendasi Mutasi dari Sekolah yang dituju yang menyatakan bahwa siswa yang mendaftar diterima pindah ke sekolah
                    tersebut.
                </p>
            </div>
            <div style="border: 1px solid #0174BE; background-color: #E0F0FF; padding: 20px; border-radius: 8px;">
                <h5><strong>PERSYARATAN</strong></h5>
                <ul>
                    <li>
                        Surat Permohonan Orang Tua / Wali* Murid
                    </li>
                    <li>
                        Surat Pernyataan Orang Tua / Wali* Murid
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
                        @forelse ($sbaru as $item)
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
                                                <a href="{{ route('user.sbarudetails', $item->id) }}" class="fw-bold text-dark text-decoration-none">
                                                    {{ $item->schoolTujuan->nama_sekolah ?? '-' }}
                                                </a>
                                                <div class="mt-1">
                                                    @if ($item->status == 'Diterima')
                                                        <span class="badge bg-success text-white">Diterima</span>
                                                    @elseif ($item->status == 'Sedang Diproses')
                                                        <span class="badge bg-info text-white">Sedang Diproses</span>
                                                    @elseif ($item->status == 'Ditindaklanjuti')
                                                        <span class="badge bg-warning text-dark">Ditindaklanjuti</span>
                                                    @elseif ($item->status == 'Selesai')
                                                        <span class="badge bg-secondary text-white">Selesai</span>
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



        <!-- Bagian Form Kanan -->
        <div class="col-md-6">
            <div class="card p-4 bg-light custom-card mb-4">
                <h3 class="text-center"  style="color: #04295a"><strong>Si-Mutasi Siswa</strong></h3>
                <p class="text-center text-muted">Lengkapi data berikut untuk mengajukan permohonan.</p>
                    <ul class="nav nav-underline custom-tabs" id="sbaruTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="dalam" data-bs-toggle="tab" data-bs-target="#dalam" type="button" role="tab">
                                Dalam Kota
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="luar" data-bs-toggle="tab" data-bs-target="#luar" type="button" role="tab">
                                Luar Kota
                            </button>
                        </li>
                    </ul>
                <div class="tab-content mt-3" id="sbaruTabContent">
                    <!-- Detail -->
                    <div class="tab-pane fade show active" id="dalam" role="tabpanel">
                        <div class="row">
                            <!-- Formulir -->
                            <form action="{{ route('user.sbaru.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php $tipe = 'dalam'; @endphp
                                <input type="hidden" name="tipe" value="{{ $tipe }}">
                                <h5 style="color: #0174BE"><strong>Data Siswa</strong></h5>
                                <!-- Nama Siswa -->
                                <div class="form-group mb-3">
                                    <label for="nama_siswa" class="fw-bold mb-1">Nama Siswa</label>
                                    <input type="text" class="form-control rounded-pill @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" placeholder="Masukkan nama anda..." value="{{ old('nama_siswa') }}" autofocus/>
                                    @error('nama_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- NISN -->
                                <div class="form-group mb-3">
                                    <label for="nisn" class="fw-bold mb-1">NISN</label>
                                    <input type="text" class="form-control rounded-pill @error('nisn') is-invalid @enderror" id="nisn" name="nisn" placeholder="Masukkan nisn anda..." value="{{ old('nisn') }}" autofocus/>
                                    @error('nisn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Jenjang -->
                                <div class="form-group mb-3">
                                    <label for="jenjang" class="fw-bold mb-1">Jenjang</label>
                                    <div class="d-flex gap-3" id="jenjang_{{ $tipe }}">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenjang" id="paud_{{ $tipe }}" value="PAUD" {{ old('jenjang') == 'PAUD' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="paud_{{ $tipe }}">PAUD</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenjang" id="sd_{{ $tipe }}" value="SD" {{ old('jenjang') == 'SD' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sd_{{ $tipe }}">SD</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenjang" id="smp_{{ $tipe }}" value="SMP" {{ old('jenjang') == 'SMP' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="smp_{{ $tipe }}">SMP</label>
                                        </div>
                                    </div>
                                    @error('jenjang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Kelas -->
                                <div class="form-group mb-3" id="kelas-group">
                                    <label for="kelas" class="fw-bold mb-1">Kelas</label>
                                    <select class="form-control rounded-pill" id="kelas_{{ $tipe }}" name="kelas">
                                        <option value="">Pilih Kelas</option>
                                        <!-- Kelas akan muncul berdasarkan jenjang yang dipilih -->
                                    </select>
                                </div>
                                <!-- Jenis Kelamin -->
                                <div class="form-group mb-3">
                                    <label for="kelamin" class="fw-bold mb-1">Jenis Kelamin</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kelamin" id="laki" value="Laki-Laki" {{ old('kelamin') == 'Laki-Laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="laki">Laki-Laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kelamin" id="perempuan" value="Perempuan" {{ old('kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Tempat Lahir -->
                                <div class="form-group mb-3">
                                    <label for="tempat_lahir" class="fw-bold mb-1">Tempat Lahir</label>
                                    <input type="text" class="form-control rounded-pill @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir anda..." value="{{ old('tempat_lahir') }}" autofocus/>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Tanggal Lahir -->
                                <div class="form-group mb-3">
                                    <label for="tgl_lahir" class="fw-bold mb-1">Tanggal Lahir</label>
                                    <input type="date" class="form-control rounded-pill @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" autofocus/>
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 style="color: #0174BE"><strong>Data Orang Tua/Wali *</strong></h5>
                                <!-- Nama Orang Tua/Wali * -->
                                <div class="form-group mb-3">
                                    <label for="nama_ortu" class="fw-bold mb-1">Nama Orang Tua/Wali *</label>
                                    <input type="text" class="form-control rounded-pill @error('nama_ortu') is-invalid @enderror" id="nama_ortu" name="nama_ortu" placeholder="Masukkan nama orang tua/ wali murid anda..." value="{{ old('nama_ortu') }}" autofocus/>
                                    @error('nama_ortu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Alamat (terbaru) * -->
                                <div class="form-group mb-3">
                                    <label for="alamat_ortu" class="fw-bold mb-1">Alamat <span style="color: red;font-weight: normal;">(*terbaru)</span></label>
                                    <input type="text" class="form-control rounded-pill @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" name="alamat_ortu" placeholder="Alamat..." value="{{ old('alamat_ortu') }}" autofocus/>
                                    @error('alamat_ortu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Nomor Telepon -->
                                <div class="form-group mb-3">
                                    <label for="no_hp" class="fw-bold mb-1">Nomor Telepon</label>
                                    <input type="text" class="form-control rounded-pill @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" placeholder="Nomor Telepon/ WhatsApp Aktif..." value="{{ old('no_hp') }}" autofocus/>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <label for="email" class="fw-bold mb-1">Email</label>
                                    <input type="text" class="form-control rounded-pill @error('email') is-invalid @enderror" id="email" name="email" placeholder="Alamat Email Aktif..." value="{{ old('email') }}" autofocus/>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 style="color: #0174BE"><strong>Data Sekolah</strong></h5>
                                <!-- Nama Sekolah -->
                                <div class="form-group mb-3">
                                    <label for="school_slama_id" class="fw-bold mb-1">Sekolah Asal</label>
                                    <select class="form-control @error('school_slama_id') is-invalid @enderror" name="school_slama_id">
                                        <option value="">Pilih Sekolah</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}">{{ $school->nama_sekolah }}</option>
                                        @endforeach
                                    </select>
                                    @error('school_slama_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>   
                                <!-- Nama Sekolah -->
                                <div class="form-group mb-3">
                                    <label for="school_sbaru_id" class="fw-bold mb-1">Sekolah Tujuan</label>
                                    <select class="form-control @error('school_sbaru_id') is-invalid @enderror" name="school_sbaru_id">
                                        <option value="">Pilih Sekolah</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}">{{ $school->nama_sekolah }}</option>
                                        @endforeach
                                    </select>
                                    @error('school_sbaru_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>                 
                                <!-- Kelurahan -->
                                <div class="form-group mb-3">
                                    <label for="kelurahan" class="fw-bold mb-1">Kelurahan</label>
                                    <input type="text" class="form-control rounded-pill @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan" placeholder="Pilih Kelurahan..." value="{{ old('kelurahan') }}" autofocus/>
                                    @error('kelurahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Kecamatan -->
                                <div class="form-group mb-3">
                                    <label for="kecamatan" class="fw-bold mb-1">Kecamatan</label>
                                    <input type="text" class="form-control rounded-pill @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" placeholder="Pilih Kecamatan..." value="{{ old('kecamatan') }}" autofocus/>
                                    @error('kecamatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Alasan Pindah Sekolah -->
                                <div class="form-group mb-3">
                                    <label for="alasan" class="fw-bold mb-1">Alasan </label>
                                    <input type="text" class="form-control rounded-pill @error('alasan') is-invalid @enderror" id="alasan" name="alasan" placeholder="Alasan Pindah Sekolah..." value="{{ old('alasan') }}" autofocus/>
                                    @error('alasan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tombol Submit -->
                                <div class="d-flex gap-2 mt-3 mb-2">
                                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill text-center" style="background-color: #0174BE">Simpan</button>
                                    <a href="{{ route('services') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Peta -->
                    <div class="tab-pane fade" id="luar" role="tabpanel">
                        <div id="row">
                           <!-- Formulir -->
                           <form action="{{ route('user.sbaru.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php $tipe = 'luar'; @endphp
                                <input type="hidden" name="tipe" value="{{ $tipe }}">
                                <h5 style="color: #0174BE"><strong>Data Siswa</strong></h5>
                                <!-- Nama Siswa -->
                                <div class="form-group mb-3">
                                    <label for="nama_siswa" class="fw-bold mb-1">Nama Siswa</label>
                                    <input type="text" class="form-control rounded-pill @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" placeholder="Masukkan nama anda..." value="{{ old('nama_siswa') }}" autofocus/>
                                    @error('nama_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- NISN -->
                                <div class="form-group mb-3">
                                    <label for="nisn" class="fw-bold mb-1">NISN</label>
                                    <input type="text" class="form-control rounded-pill @error('nisn') is-invalid @enderror" id="nisn" name="nisn" placeholder="Masukkan nisn anda..." value="{{ old('nisn') }}" autofocus/>
                                    @error('nisn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Jenjang -->
                                <div class="form-group mb-3">
                                    <label for="jenjang" class="fw-bold mb-1">Jenjang</label>
                                    <div class="d-flex gap-3" id="jenjang_{{ $tipe }}">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenjang" id="paud_{{ $tipe }}" value="PAUD" {{ old('jenjang') == 'PAUD' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="paud_{{ $tipe }}">PAUD</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenjang" id="sd_{{ $tipe }}" value="SD" {{ old('jenjang') == 'SD' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sd_{{ $tipe }}">SD</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenjang" id="smp_{{ $tipe }}" value="SMP" {{ old('jenjang') == 'SMP' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="smp_{{ $tipe }}">SMP</label>
                                        </div>
                                    </div>
                                    @error('jenjang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Kelas -->
                                <div class="form-group mb-3" id="kelas-group">
                                    <label for="kelas" class="fw-bold mb-1">Kelas</label>
                                    <select class="form-control rounded-pill" id="kelas_{{ $tipe }}" name="kelas">
                                        <option value="">Pilih Kelas</option>
                                        <!-- Kelas akan muncul berdasarkan jenjang yang dipilih -->
                                    </select>
                                </div>
                                <!-- Jenis Kelamin -->
                                <div class="form-group mb-3">
                                    <label for="kelamin" class="fw-bold mb-1">Jenis Kelamin</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kelamin" id="laki" value="Laki-Laki" {{ old('kelamin') == 'Laki-Laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="laki">Laki-Laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kelamin" id="perempuan" value="Perempuan" {{ old('kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                    @error('kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Tempat Lahir -->
                                <div class="form-group mb-3">
                                    <label for="tempat_lahir" class="fw-bold mb-1">Tempat Lahir</label>
                                    <input type="text" class="form-control rounded-pill @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir anda..." value="{{ old('tempat_lahir') }}" autofocus/>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Tanggal Lahir -->
                                <div class="form-group mb-3">
                                    <label for="tgl_lahir" class="fw-bold mb-1">Tanggal Lahir</label>
                                    <input type="date" class="form-control rounded-pill @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" autofocus/>
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 style="color: #0174BE"><strong>Data Orang Tua/Wali *</strong></h5>
                                <!-- Nama Orang Tua/Wali * -->
                                <div class="form-group mb-3">
                                    <label for="nama_ortu" class="fw-bold mb-1">Nama Orang Tua/Wali *</label>
                                    <input type="text" class="form-control rounded-pill @error('nama_ortu') is-invalid @enderror" id="nama_ortu" name="nama_ortu" placeholder="Masukkan nama orang tua/ wali murid anda..." value="{{ old('nama_ortu') }}" autofocus/>
                                    @error('nama_ortu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Alamat (terbaru) * -->
                                <div class="form-group mb-3">
                                    <label for="alamat_ortu" class="fw-bold mb-1">Alamat <span style="color: red;font-weight: normal;">(*terbaru)</span></label>
                                    <input type="text" class="form-control rounded-pill @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" name="alamat_ortu" placeholder="Alamat..." value="{{ old('alamat_ortu') }}" autofocus/>
                                    @error('alamat_ortu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Nomor Telepon -->
                                <div class="form-group mb-3">
                                    <label for="no_hp" class="fw-bold mb-1">Nomor Telepon</label>
                                    <input type="text" class="form-control rounded-pill @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" placeholder="Nomor Telepon/ WhatsApp Aktif..." value="{{ old('no_hp') }}" autofocus/>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <label for="email" class="fw-bold mb-1">Email</label>
                                    <input type="text" class="form-control rounded-pill @error('email') is-invalid @enderror" id="email" name="email" placeholder="Alamat Email Aktif..." value="{{ old('email') }}" autofocus/>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 style="color: #0174BE"><strong>Data Sekolah</strong></h5>
                                <!-- Nama Sekolah -->
                                <div class="form-group mb-3">
                                    <label for="school_slama_id" class="fw-bold mb-1">Sekolah Asal</label>
                                    <select class="form-control @error('school_slama_id') is-invalid @enderror" name="school_slama_id">
                                        <option value="">Pilih Sekolah</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}">{{ $school->nama_sekolah }}</option>
                                        @endforeach
                                    </select>
                                    @error('school_slama_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>   
                                <!-- Nama Sekolah -->
                                <div class="form-group mb-3">
                                    <label for="school_sbaru_id" class="fw-bold mb-1">Sekolah Tujuan</label>
                                    <input type="text" class="form-control rounded-pill @error('school_sbaru_id') is-invalid @enderror" id="school_sbaru_id" name="school_sbaru_id" placeholder="Masukkan nama sekolah tujuan Anda..." value="{{ old('school_sbaru_id') }}" autofocus/>
                                    @error('school_sbaru_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Alasan Pindah Sekolah -->
                                <div class="form-group mb-3">
                                    <label for="alasan" class="fw-bold mb-1">Alasan </label>
                                    <input type="text" class="form-control rounded-pill @error('alasan') is-invalid @enderror" id="alasan" name="alasan" placeholder="Alasan Pindah Sekolah..." value="{{ old('alasan') }}" autofocus/>
                                    @error('alasan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 style="color: #0174BE"><strong>Berkas Persyaratan</strong></h5>
                                <!-- Surat Tujuan-->
                                <div class="form-group mb-3">
                                    <label for="output" class="fw-bold mb-1">Surat Rekomendasi Mutasi Sekolah Tujuan</label>
                                    <input type="file" id="output" name="output" class="form-control rounded-pill @error('output') is-invalid @enderror" />
                                    <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                    @error('output')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tombol Submit -->
                                <div class="d-flex gap-2 mt-3 mb-2">
                                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill text-center" style="background-color: #0174BE">Simpan</button>
                                    <a href="{{ route('services') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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


{{-- <script>
    // Ketika halaman dimuat atau jenjang dipilih
    document.addEventListener('DOMContentLoaded', function () {
        // Menyembunyikan kelas group pertama
        updateKelasOptions();

        // Menambahkan event listener pada perubahan radio button
        document.querySelectorAll('input[name="jenjang"]').forEach(function (radio) {
            radio.addEventListener('change', updateKelasOptions);
        });

        function updateKelasOptions() {
            const jenjang = document.querySelector('input[name="jenjang"]:checked');
            const kelasSelect = document.getElementById('kelas');
            let options = '';

            if (jenjang) {
                if (jenjang.value === 'SD') {
                    // Pilihan kelas untuk SD (1-6)
                    options += `<option value="">Pilih Kelas</option>`; // Menambahkan pilihan default
                    for (let i = 1; i <= 6; i++) {
                        options += `<option value="Kelas ${i}">Kelas ${i}</option>`;
                    }
                } else if (jenjang.value === 'SMP') {
                    // Pilihan kelas untuk SMP (7-9)
                    options += `<option value="">Pilih Kelas</option>`; // Menambahkan pilihan default
                    for (let i = 7; i <= 9; i++) {
                        options += `<option value="Kelas ${i}">Kelas ${i}</option>`;
                    }
                } else {
                    options += `<option value="-">-</option>`;
                }
            }
            
            kelasSelect.innerHTML = options;
            document.getElementById('kelas-group').style.display = options ? 'block' : 'none';
        }
    });
</script> --}}

{{-- <script>
    function loadMutasi(type, element) {
        // Tambahkan class active di tab yang diklik
        document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
        element.classList.add('active');

        // Tampilkan loading indikator
        document.getElementById('mutasi-content').innerHTML = '<div class="text-center"><i class="bi bi-arrow-repeat"></i> Memuat...</div>';

        // Fetch data dari route
        fetch(`profil/load/${type}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('mutasi-content').innerHTML = data;
            })
            .catch(error => {
                document.getElementById('mutasi-content').innerHTML = '<div class="alert alert-danger">Gagal memuat data.</div>';
                console.error('Error:', error);
            });
    }
</script> --}}
@endsection
