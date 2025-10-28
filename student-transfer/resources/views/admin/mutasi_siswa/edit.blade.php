@extends('main-admin')
@section('title', 'Mutasi Siswa')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Formulir Ubah Data Mutasi Siswa</span></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Data Mutasi Siswa</h5>
                </div>
                <div class="card-body  ms-3 me-5 mt-2 mb-2">
                    <form action="{{route('admin.mutasi_siswa.update', ['tipe' => $tipe, 'id' => $mutasi_siswa->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <!-- Nama Siswa -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama_siswa">Nama Siswa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" placeholder="Masukkan nama_siswa anda..." value="{{ $mutasi_siswa->nama_siswa }}" autofocus/>
                                @error('nama_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- NISN -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nisn">NISN</label>
                            <div class="col-sm-10">
                                <input type="text" id="nisn" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="081234567890" value="{{ $mutasi_siswa->nisn }}" autofocus/>
                                @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Jenjang -->
                        <div class="row mb-3" id="jenjang">
                            <label class="col-sm-2 col-form-label">Jenjang</label>
                            <div class="col-sm-10 d-flex gap-3">
                                @foreach(['PAUD', 'SD', 'SMP'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenjang" id="jenjang_{{ strtolower($option) }}"
                                            value="{{ $option }}" {{ old('jenjang', $mutasi_siswa->jenjang) == $option ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jenjang_{{ strtolower($option) }}">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Kelas -->
                        <div class="row mb-3">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kelas" name="kelas">
                                    <option value="">Pilih Kelas</option>
                                </select>
                            </div>
                        </div>
                        <!-- Jenis Kelamin -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="kelamin">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="kelamin" id="kelamin" class="form-select">
                                        <option value="Laki-Laki" {{ $mutasi_siswa->kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ $mutasi_siswa->kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- No Telp -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="no_hp">No. HP/WA</label>
                            <div class="col-sm-10">
                                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ $mutasi_siswa->no_hp }}" autofocus/>
                                @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="email">E-mail</label>
                            <div class="col-sm-10">
                                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com" value="{{ $mutasi_siswa->email }}" autofocus/>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> 
                        <!-- Sekolah Asal -->
                        <div class="row mb-3">
                            <label for="school_slama_id" class="col-sm-2 col-form-label">Sekolah Asal</label>
                            <div class="col-sm-10">
                                <select class="form-control @error('school_slama_id') is-invalid @enderror" name="school_slama_id" autofocus>
                                    <option value="">Pilih Sekolah</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}" {{ $mutasi_siswa->school_slama_id == $school->id ? 'selected' : '' }}>
                                            {{ $school->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('school_slama_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- SR Sekolah Asal -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_slama">Surat Rekomendasi Mutasi dari Sekolah Lama</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_slama" name="surat_slama" class="form-control @error('surat_slama') is-invalid @enderror" value="{{$mutasi_siswa->surat_slama }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('surat_slama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (old('surat_slama') || $mutasi_siswa->surat_slama)
                                <p class="mt-2">File saat ini: <a href="{{asset($mutasi_siswa->surat_slama) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div>
                        <!-- Sekolah Tujuan -->
                        <div class="row mb-3">
                            <label for="school_sbaru_id" class="col-sm-2 col-form-label">Sekolah Tujuan</label>
                            <div class="col-sm-10">
                                <select class="form-control @error('school_sbaru_id') is-invalid @enderror" name="school_sbaru_id" autofocus>
                                    <option value="">Pilih Sekolah</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}" {{ $mutasi_siswa->school_sbaru_id == $school->id ? 'selected' : '' }}>
                                            {{ $school->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('school_sbaru_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- SR Sekolah Baru -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_sbaru">Surat Rekomendasi Mutasi dari Sekolah yang dituju</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_sbaru" name="surat_sbaru" class="form-control @error('surat_sbaru') is-invalid @enderror" value="{{$mutasi_siswa->surat_sbaru }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('surat_sbaru')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (old('surat_sbaru') || $mutasi_siswa->surat_sbaru)
                                <p class="mt-2">File saat ini: <a href="{{asset($mutasi_siswa->surat_sbaru) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div>
                        <hr class="my-5 mb-3" />
                        <h5 class="fw-bold">Tanggapan</h5>
                        <!-- Pesan -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="pesan">Pesan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('pesan') is-invalid @enderror" id="pesan" name="pesan" placeholder="Masukkan pesan anda..." value="{{ $mutasi_siswa->pesan }}" autofocus/>
                                @error('pesan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Output -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="output">Output</label>
                            <div class="col-sm-10">
                                <input type="file" id="output" name="output" class="form-control @error('output') is-invalid @enderror" value="{{($mutasi_siswa->output) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('output')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($mutasi_siswa->output)
                                <p class="mt-2">File saat ini: <a href="{{asset($mutasi_siswa->output) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Diterima" {{ $mutasi_siswa->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="Diproses" {{ $mutasi_siswa->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Ditindaklanjuti" {{ $mutasi_siswa->status == 'Ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                                        <option value="Selesai" {{ $mutasi_siswa->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-end align-items-end">
                            <div class="col-sm-10 text-end">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('admin/mutasi_siswa') }}" class="btn btn-outline-secondary">Kembali</a>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const kelasData = {
            PAUD: ['PAUD A', 'PAUD B'],
            SD: ['1', '2', '3', '4', '5', '6'],
            SMP: ['7', '8', '9']
        };

        function loadKelas(jenjang, selectedKelas = null) {
            let html = '<option value="">Pilih Kelas</option>';
            (kelasData[jenjang] || []).forEach(function (kelas) {
                let selected = (kelas == selectedKelas) ? 'selected' : '';
                html += `<option value="${kelas}" ${selected}>${kelas}</option>`;
            });
            $('#kelas').html(html);
        }

        // Saat radio jenjang diklik
        $('#jenjang input[type=radio]').on('change', function () {
            const jenjang = $(this).val();
            loadKelas(jenjang);
        });

        // Saat load pertama kali
        const selectedJenjang = $('input[name="jenjang"]:checked').val();
        const selectedKelas = `{{ old('kelas', $mutasi_siswa->kelas) }}`;
        if (selectedJenjang) {
            loadKelas(selectedJenjang, selectedKelas);
        }
    });
</script>
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const jenjangRadios = document.querySelectorAll('input[name="jenjang"]');
        const kelasSelect = document.getElementById("kelas");
        const kelasDariDB = "{{ $mutasi_siswa->kelas }}"; // Ambil data kelas dari DB
        const jenjangDariDB = "{{ $mutasi_siswa->jenjang }}"; // Ambil jenjang dari DB

        // Data kelas berdasarkan jenjang
        const kelasOptions = {
            "PAUD": ["TK A", "TK B"],
            "SD": ["Kelas 1", "Kelas 2", "Kelas 3", "Kelas 4", "Kelas 5", "Kelas 6"],
            "SMP": ["Kelas 7", "Kelas 8", "Kelas 9"]
        };

        // Fungsi update dropdown kelas
        function updateKelasOptions(jenjang) {
            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>'; // Reset

            if (kelasOptions[jenjang]) {
                kelasOptions[jenjang].forEach(kelas => {
                    const option = document.createElement("option");
                    option.value = kelas;
                    option.textContent = kelas;
                    if (kelas === kelasDariDB) {
                        option.selected = true; // Set nilai dari DB
                    }
                    kelasSelect.appendChild(option);
                });
            }
        }

        // Panggil fungsi jika jenjang dari DB ada
        if (jenjangDariDB) {
            updateKelasOptions(jenjangDariDB);
        }

        // Event listener saat jenjang berubah
        jenjangRadios.forEach(radio => {
            radio.addEventListener("change", function() {
                updateKelasOptions(this.value);
            });
        });
    });
</script> --}}

@endsection