<form action="{{ route('admin.mutasi_siswa_luar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @php $tipe = 'dalam'; @endphp
    <input type="hidden" name="tipe" value="{{ $tipe }}">
    <h5 style="color: #0174BE"><strong>Data Siswa</strong></h5>
    <!-- Nama Siswa -->
    <div class="row mb-3">
        <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Siswa</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" placeholder="Masukkan nama_siswa anda..." value="{{ old('nama_siswa') }}" autofocus/>
            @error('nama_siswa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- NISN -->
    <div class="row mb-3">
        <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
        <div class="col-sm-10">
            <input type="text" id="nisn" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="0123456789" value="{{ old('nisn') }}" autofocus/>
            @error('nisn')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Jenjang -->
    <div class="row mb-3">
        <label for="jenjang" class="col-sm-2 col-form-label">Jenjang</label>
        <div class="col-sm-10">
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
    </div>
    <!-- Kelas -->
    <div class="row mb-3">
        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
        <div class="col-sm-10">
            <select class="form-control rounded-pill" id="kelas_{{ $tipe }}" name="kelas">
                <option value="">Pilih Kelas</option>
                <!-- Kelas akan muncul berdasarkan jenjang yang dipilih -->
            </select>
        </div>
    </div>
    <!-- Jenis Kelamin -->
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="kelamin">Jenis Kelamin</label>
        <div class="col-sm-10">
            <div class="form-group">
                <select name="kelamin" id="kelamin" class="form-select">
                    <option value="Laki-Laki" {{ old('kelamin', 'Laki-Laki') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('kelamin', 'Perempuan') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>
    </div>
    <!-- No Telp -->
    <div class="row mb-3">
        <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
        <div class="col-sm-10">
            <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ old('no_hp') }}" autofocus/>
            @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Email -->
    <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com" value="{{ old('email') }}" autofocus/>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <h5 style="color: #0174BE"><strong>Data Sekolah</strong></h5>
    <!-- Sekolah Asal -->
    <div class="row mb-3">
        <label for="school_slama_id" class="col-sm-2 col-form-label">Sekolah Asal</label>
        <div class="col-sm-10">
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
    </div>
    <!-- SR Sekolah Lama -->
    <div class="row mb-3">
        <label for="surat_slama" class="col-sm-2 col-form-label">Surat Rekomendasi Mutasi dari Sekolah Lama</label>
        <div class="col-sm-10">
            <input type="file" id="surat_slama" name="surat_slama" class="form-control @error('surat_slama') is-invalid @enderror" />
            <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
            @error('surat_slama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Sekolah Tujuan -->
    <div class="row mb-3">
        <label for="school_sbaru_name" class="col-sm-2 col-form-label">Sekolah Tujuan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('school_sbaru_name') is-invalid @enderror" id="school_sbaru_name" name="school_sbaru_name" placeholder="Masukkan Nama Sekolah Anda..." value="{{ old('school_sbaru_name') }}" autofocus/>
            @error('school_sbaru_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- SR Sekolah Baru -->
    <div class="row mb-3">
        <label for="surat_sbaru" class="col-sm-2 col-form-label">Surat Rekomendasi Mutasi dari Sekolah yang dituju</label>
        <div class="col-sm-10">
            <input type="file" id="surat_sbaru" name="surat_sbaru" class="form-control @error('surat_sbaru') is-invalid @enderror" />
            <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
            @error('surat_sbaru')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Status -->
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="status">Status</label>
        <div class="col-sm-10">
            <div class="form-group">
                <select name="status" id="status" class="form-select">
                    <option value="Diterima" {{ old('status', 'Diterima') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="Sedang Diproses" {{ old('status', 'Diterima') == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="Ditindaklanjuti" {{ old('status', 'Diterima') == 'Ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                    <option value="Selesai" {{ old('status', 'Diterima') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                
            </div>
        </div>
    </div>
    <div class="row justify-content-end align-items-end">
        <div class="col-sm-10 text-end">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.mutasi_siswa') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</form>