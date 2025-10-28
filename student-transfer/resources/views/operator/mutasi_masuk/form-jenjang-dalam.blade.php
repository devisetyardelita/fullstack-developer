<form action="{{ route('operator.sbaru.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @php $tipe = 'dalam'; @endphp
    <input type="hidden" name="tipe" value="{{ $tipe }}">
    <!-- Nama Siswa -->
    <h5 style="color: #0174BE"><strong>Data Siswa</strong></h5>
    <div class="row mt-3 mb-3">
        <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Siswa</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" placeholder="Masukkan nama anda..." value="{{ old('nama_siswa') }}" autofocus/>
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
            <select class="form-control" id="kelas_{{ $tipe }}" name="kelas">
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
    <!-- Tempat Lahir -->
    <div class="row mb-3">
        <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir anda..." value="{{ old('tempat_lahir') }}" autofocus/>
            @error('tempat_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Tanggal Lahir -->
    <div class="row mb-3">
        <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-10">
            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan tempat lahir anda..." value="{{ old('tgl_lahir') }}" autofocus/>
            @error('tgl_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <h5 style="color: #0174BE"><strong>Data Wali Murid</strong></h5>
    <!-- Nama Orang Tua/Wali Murid -->
    <div class="row mb-3">
        <label for="nama_ortu" class="col-sm-2 col-form-label">Nama Orang Tua/Wali*</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('nama_ortu') is-invalid @enderror" id="nama_ortu" name="nama_ortu" placeholder="Masukkan nama orang tua/wali anda..." value="{{ old('nama_ortu') }}" autofocus/>
            @error('nama_ortu')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Alamat Orang Tua/Wali Murid -->
    <div class="row mb-3">
        <label for="alamat_ortu" class="col-sm-2 col-form-label">Alamat Orang Tua/Wali Murid (Terbaru)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" name="alamat_ortu" placeholder="Masukkan alamat orang tua/wali anda..." value="{{ old('alamat_ortu') }}" autofocus/>
            @error('alamat_ortu')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Kelurahan -->
    <div class="row mb-3">
        <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan" placeholder="Masukkan kelurahan anda..." value="{{ old('kelurahan') }}" autofocus/>
            @error('kelurahan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Kecamatan -->
    <div class="row mb-3">
        <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" placeholder="Masukkan kecamatan anda..." value="{{ old('kecamatan') }}" autofocus/>
            @error('kecamatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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
    <!-- Sekolah Tujuan -->
    <div class="row mb-3">
        <label for="school_sbaru_id" class="col-sm-2 col-form-label">Sekolah Tujuan</label>
        <div class="col-sm-10">
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
    </div>
    <!-- Permohonan Wali -->
    <div class="row mb-3">
        <label for="surat_permohonan" class="col-sm-2 col-form-label">Surat Permohonan Wali Murid</label>
        <div class="col-sm-10">
            <input type="file" id="surat_permohonan" name="surat_permohonan" class="form-control @error('surat_permohonan') is-invalid @enderror" />
            <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
            @error('surat_permohonan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Pernyataan Wali -->
    {{-- <div class="row mb-3">
        <label for="surat_pernyataan" class="col-sm-2 col-form-label">Surat Pernyataan Wali Murid</label>
        <div class="col-sm-10">
            <input type="file" id="surat_pernyataan" name="surat_pernyataan" class="form-control @error('surat_pernyataan') is-invalid @enderror" />
            <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
            @error('surat_pernyataan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div> --}}
    <!-- Alasan Mutasi -->
    <div class="row mb-3">
        <label for="alasan" class="col-sm-2 col-form-label">Alasan Mutasi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" placeholder="Masukkan alasan anda..." value="{{ old('alasan') }}" autofocus/>
            @error('alasan')
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
                    <option value="Diproses" {{ old('status', 'Diterima') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Diterima" {{ old('status', 'Diterima') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="Ditolak" {{ old('status', 'Diterima') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                
            </div>
        </div>
    </div>
    <div class="row justify-content-end align-items-end">
        <div class="col-sm-10 text-end">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('operator.sbaru') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</form>