<form action="{{ route('user.slama.store') }}" method="POST" enctype="multipart/form-data">
    @csrf    
    @php $tipe = 'dalam'; @endphp
    <input type="hidden" name="tipe" value="{{ $tipe }}">
    <input type="hidden" name="status" value="Diproses">
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
    <div class="form-group mb-3">
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

                        
    <h5 style="color: #0174BE"><strong>Data Sekolah Tujuan</strong></h5>
    <!-- Nama Sekolah -->
    <div class="form-group mb-3">
        <label for="school_slama_id" class="fw-bold mb-1">Sekolah Asal</label>
        <select class="form-control rounded-pill @error('school_slama_id') is-invalid @enderror" name="school_slama_id">
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
        <select class="form-control rounded-pill @error('school_sbaru_id') is-invalid @enderror" name="school_sbaru_id">
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

    <h5 style="color: #0174BE"><strong>Berkas Persyaratan</strong></h5>
    <!-- Surat Permohonan Orang Tua-->
    <div class="form-group mb-3">
        <label for="surat_permohonan" class="fw-bold mb-1">Surat Permohonan Orang Tua / Wali* Murid</label>
        <input type="file" id="surat_permohonan" name="surat_permohonan" class="form-control rounded-pill @error('surat_permohonan') is-invalid @enderror" />
        <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
          @error('surat_permohonan')
        <div class="invalid-feedback">{{ $message }}</div>
         @enderror
    </div>
    <!-- Surat Pernyataan Orang Tua-->
    <div class="form-group mb-3">
        <label for="surat_pernyataan" class="fw-bold mb-1">Surat Pernyataan Orang Tua / Wali* Murid</label>
        <input type="file" id="surat_pernyataan" name="surat_pernyataan" class="form-control rounded-pill @error('surat_pernyataan') is-invalid @enderror" />
        <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
          @error('surat_pernyataan')
        <div class="invalid-feedback">{{ $message }}</div>
         @enderror
    </div>
    <!-- Surat Tujuan-->
    <div class="form-group mb-3">
        <label for="surat_sbaru" class="fw-bold mb-1">Surat Rekomendasi Mutasi Sekolah Tujuan</label>
        <input type="file" id="surat_sbaru" name="surat_sbaru" class="form-control rounded-pill @error('surat_sbaru') is-invalid @enderror" />
        <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
          @error('surat_sbaru')
        <div class="invalid-feedback">{{ $message }}</div>
         @enderror
    </div>

    <!-- Tombol Submit -->
    <div class="d-flex gap-2 mt-3 mb-2">
        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill text-center" style="background-color: #0174BE">Simpan</button>
        <a href="{{ route('services') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill">Kembali</a>
    </div>
</form>