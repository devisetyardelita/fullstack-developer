@extends('main-operator')
@section('title', 'Mutasi Masuk')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Formulir Ubah Data Mutasi Siswa Masuk</span></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-2"><i class='bx bx-chevrons-right' style="font-size: 1.5rem;"></i>Data Mutasi Siswa Masuk</h5>
                </div>
                <div class="card-body ms-3 me-5 mt-2 mb-1">
                    <form action="{{ route('operator.sbaru.update', ['tipe' => $tipe, 'id' => $sbaru->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama_siswa">Nama Siswa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" placeholder="Masukkan nama_siswa anda..." value="{{ $sbaru->nama_siswa }}" autofocus/>
                                @error('nama_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nisn">NISN</label>
                            <div class="col-sm-10">
                                <input type="text" id="nisn" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="081234567890" value="{{ $sbaru->nisn }}" autofocus/>
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
                                            value="{{ $option }}" {{ old('jenjang', $sbaru->jenjang) == $option ? 'checked' : '' }}>
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
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="kelamin">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="kelamin" id="kelamin" class="form-select">
                                        <option value="Laki-Laki" {{ $sbaru->kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ $sbaru->kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="tempat_lahir">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="masukkan tempat lahir anda..." value="{{ $sbaru->tempat_lahir }}" autofocus/>
                                @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" placeholder="masukkan tanggal lahir anda..." value="{{ $sbaru->tgl_lahir }}" autofocus/>
                                @error('tgl_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama_ortu">Nama Orang Tua/Wali*</label>
                            <div class="col-sm-10">
                                <input type="text" id="nama_ortu" name="nama_ortu" class="form-control @error('nama_ortu') is-invalid @enderror" placeholder="masukkan nama orang tua/wali* anda..." value="{{ $sbaru->nama_ortu }}" autofocus/>
                                @error('nama_ortu')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alamat_ortu">Alamat Orang Tua/Wali*</label>
                            <div class="col-sm-10">
                                <input type="text" id="alamat_ortu" name="alamat_ortu" class="form-control @error('alamat_ortu') is-invalid @enderror" placeholder="masukkan alamat orang tua/wali* anda..." value="{{ $sbaru->alamat_ortu }}" autofocus/>
                                @error('alamat_ortu')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="no_hp">No Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081234567890" value="{{ $sbaru->no_hp }}" autofocus/>
                                @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="email">E-mail</label>
                            <div class="col-sm-10">
                                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com" value="{{ $sbaru->email }}" autofocus/>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-5 mb-3" />
                        <h5 class="fw-bold">Data Sekolah</h5>
                        <!-- Pesan -->
                        {{-- <!-- Sekolah Asal -->
                        <div class="row mb-3">
                            <label for="school_slama_id" class="col-sm-2 col-form-label">Sekolah Asal</label>
                            <div class="col-sm-10">
                                <select class="form-control @error('school_slama_id') is-invalid @enderror" name="school_slama_id" autofocus>
                                    <option value="">Pilih Sekolah</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}" {{ $sbaru->school_slama_id == $school->id ? 'selected' : '' }}>
                                            {{ $school->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('school_slama_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        <!-- Sekolah Asal -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Sekolah Asal</label>
                            <div class="col-sm-10">
                                @if($sbaru->tipe == 'dalam')
                                    <select class="form-control @error('school_slama_id') is-invalid @enderror" name="school_slama_id" autofocus>
                                        <option value="">Pilih Sekolah</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}" {{ $sbaru->school_slama_id == $school->id ? 'selected' : '' }}>
                                                {{ $school->nama_sekolah }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('school_slama_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="text" class="form-control @error('school_slama_name') is-invalid @enderror" name="school_slama_name" value="{{ old('school_slama_name', $sbaru->school_slama_name) }}" placeholder="Nama Sekolah Asal">
                                    @error('school_slama_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                        <option value="{{ $school->id }}" {{ $sbaru->school_sbaru_id == $school->id ? 'selected' : '' }}>
                                            {{ $school->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('school_sbaru_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_permohonan">Surat Permohonan dari Wali Murid</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_permohonan" name="surat_permohonan" class="form-control @error('surat_permohonan') is-invalid @enderror" value="{{$sbaru->surat_permohonan }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('surat_permohonan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (old('surat_permohonan') || $sbaru->surat_permohonan)
                                <p class="mt-2">File saat ini: <a href="{{asset($sbaru->surat_permohonan) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="surat_pernyataan">Surat Pernyataan dari Wali Murid</label>
                            <div class="col-sm-10">
                                <input type="file" id="surat_pernyataan" name="surat_pernyataan" class="form-control @error('surat_pernyataan') is-invalid @enderror" value="{{$sbaru->surat_pernyataan }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('surat_pernyataan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (old('surat_pernyataan') || $sbaru->surat_pernyataan)
                                <p class="mt-2">File saat ini: <a href="{{asset($sbaru->surat_pernyataan) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div> --}}
                        <!-- Alasan -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="alasan">Alasan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" placeholder="Masukkan alasan anda..." value="{{ $sbaru->alasan }}" autofocus/>
                                @error('alasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-5 mb-3" />
                        <h5 class="fw-bold">Tanggapan</h5>
                        <!-- Pesan -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="pesan">Pesan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('pesan') is-invalid @enderror" id="pesan" name="pesan" placeholder="Masukkan pesan anda..." value="{{ $sbaru->pesan }}" autofocus/>
                                @error('pesan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Output -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="output">Output</label>
                            <div class="col-sm-10">
                                <input type="file" id="output" name="output" class="form-control @error('output') is-invalid @enderror" value="{{($sbaru->output) }}" />
                                <small style="color:gray"><p>File: pdf, jpg, jpeg, png, doc, docx.</p></small>
                                @error('output')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($sbaru->output)
                                <p class="mt-2">File saat ini: <a href="{{asset($sbaru->output) }}" target="_blank">Lihat File</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Diterima" {{ $sbaru->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="Diproses" {{ $sbaru->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Ditolak" {{ $sbaru->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-end align-items-end">
                            <div class="col-sm-10  text-end">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ url('operator/mutasi_masuk') }}" class="btn btn-outline-secondary">Kembali</a>

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
        const selectedKelas = `{{ old('kelas', $sbaru->kelas) }}`;
        if (selectedJenjang) {
            loadKelas(selectedJenjang, selectedKelas);
        }
    });
</script>
@endsection