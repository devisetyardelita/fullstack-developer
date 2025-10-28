@extends('main-user')

@section('title', 'Sekolah')

@section('sekolah')
@php
    use Illuminate\Support\Facades\Auth;
@endphp

<div class="container mt-3 mb-5">
    <div class="row justify-content-center">
        <div class="text-white mb-0"> 
            <h3><strong>Sekolah</strong></h3>
            <p>
                Menu Sekolah akan membantu Anda melakukan survei sekolah dengan cara mudah dan cepat. Tidak perlu bolak-balik ke sekolah-sekolah terkait. Cukup melalui website ini Anda dapat melakukan pendaftaran mutasi secara online.
            </p>
        </div>

        <div class="row mb-1 bg-custom">
            {{-- <div class="row mb-1 justify-content-between"> --}}
            <div class="row mb-1">
                {{-- <!-- Show Entries -->
                <div class="d-flex align-items-center me-3">
                    <label for="entriesPerPage" class="text-black me-2">Show</label>
                    <select name="entries_per_page" id="entriesPerPage" class="form-select"
                        style="width: 70px; height: 35px" onchange="this.form.submit()">
                        <option value="10" {{ $entriesPerPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $entriesPerPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $entriesPerPage == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <input type="hidden" name="search" value="{{ $search }}">
                    <label for="entriesPerPage" class="text-black ms-2">Entries</label>
                </div> --}}
                <div class="col">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari sekolah...">
                </div>
                <div class="col">
                    <select id="filterJenjang" class="form-select">
                        <option value="">-Jenjang-</option>
                        <option value="PAUD">PAUD</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                    </select>
                </div>
                <div class="col">
                    <select id="filterAkreditasi" class="form-select">
                        <option value="">-Akreditasi-</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div class="col">
                    <select id="filterKecamatan" class="form-select">
                        <option value="">-Filter Kecamatan-</option>
                        <option value="Beji">Beji</option>
                        <option value="Bojongsari">Bojongsari</option>
                        <option value="Cilodong">Cilodong</option>
                        <option value="Cimanggis">Cimanggis</option>
                        <option value="Cinere">Cinere</option>
                        <option value="Cipayung">Cipayung</option>
                        <option value="Limo">Limo</option>
                        <option value="Pancoran Mas">Pancoran Mas</option>
                        <option value="Sawangan">Sawangan</option>
                        <option value="Sukmajaya">Sukmajaya</option>
                        <option value="Tapos">Tapos</option>
                    </select>
                </div>
                
                <div class="col">
                    <select id="filterKelurahan" class="form-select">
                        <option value="">-Filter Kelurahan-</option>
                        <option value="Abadijaya">Abadijaya</option>
                        <option value="Baktijaya">Baktijaya</option>
                        <option value="Bedahan">Bedahan</option>
                        <option value="Beji">Beji</option>
                        <option value="Beji Timur">Beji Timur</option>
                        <option value="Bojong Pondok Terong">Bojong Pondok Terong</option>
                        <option value="Bojongsari">Bojongsari</option>
                        <option value="Bojongsari Baru">Bojongsari Baru</option>
                        <option value="Cilangkap">Cilangkap</option>
                        <option value="Cilodong">Cilodong</option>
                        <option value="Cimpaeun">Cimpaeun</option>
                        <option value="Cinangka">Cinangka</option>
                        <option value="Cinere">Cinere</option>
                        <option value="Cipayung">Cipayung</option>
                        <option value="Cipayung Jaya">Cipayung Jaya</option>
                        <option value="Cisalak">Cisalak</option>
                        <option value="Cisalak Pasar">Cisalak Pasar</option>
                        <option value="Curug">Curug</option>
                        <option value="Depok">Depok</option>
                        <option value="Depok Jaya">Depok Jaya</option>
                        <option value="Duren Mekar">Duren Mekar</option>
                        <option value="Duren Seribu">Duren Seribu</option>
                        <option value="Gandul">Gandul</option>
                        <option value="Grogol">Grogol</option>
                        <option value="Harjamukti">Harjamukti</option>
                        <option value="Jatijajar">Jatijajar</option>
                        <option value="Jatimulya">Jatimulya</option>
                        <option value="Kalibaru">Kalibaru</option>
                        <option value="Kedaung">Kedaung</option>
                        <option value="Kemiri Muka">Kemiri Muka</option>
                        <option value="Krukut">Krukut</option>
                        <option value="Kukusan">Kukusan</option>
                        <option value="Leuwinanggung">Leuwinanggung</option>
                        <option value="Limo">Limo</option>
                        <option value="Mampang">Mampang</option>
                        <option value="Mekarjaya">Mekarjaya</option>
                        <option value="Mekarsari">Mekarsari</option>
                        <option value="Meruyung">Meruyung</option>
                        <option value="Pancoran Mas">Pancoran Mas</option>
                        <option value="Pangkalan Jati">Pangkalan Jati</option>
                        <option value="Pangkalan Jati Baru">Pangkalan Jati Baru</option>
                        <option value="Pasir Gunung Selatan">Pasir Gunung Selatan</option>
                        <option value="Pasir Putih">Pasir Putih</option>
                        <option value="Pengasinan">Pengasinan</option>
                        <option value="Pondok Cina">Pondok Cina</option>
                        <option value="Pondok Jaya">Pondok Jaya</option>
                        <option value="Pondok Petir">Pondok Petir</option>
                        <option value="Rangkapan Jaya">Rangkapan Jaya</option>
                        <option value="Rangkapan Jaya Baru">Rangkapan Jaya Baru</option>
                        <option value="Ratujaya">Ratujaya</option>
                        <option value="Sawangan">Sawangan</option>
                        <option value="Sawangan Baru">Sawangan Baru</option>
                        <option value="Serua">Serua</option>
                        <option value="Sukamaju">Sukamaju</option>
                        <option value="Sukamaju Baru">Sukamaju Baru</option>
                        <option value="Sukatani">Sukatani</option>
                        <option value="Sukmajaya">Sukmajaya</option>
                        <option value="Tanah Baru">Tanah Baru</option>
                        <option value="Tapos">Tapos</option>
                        <option value="Tirtajaya">Tirtajaya</option>
                        <option value="Tugu">Tugu</option>
                    </select>
                </div>
                {{-- <div class="col text end">
                </div> --}}
            </div>

            <!-- Tabel -->
            <table id="schoolTable" class="table table-striped3">
                <thead class="table-dark">
                    <tr>
                        <th>Sekolah</th>
                        <th>Jenjang</th>
                        <th>Status</th>
                        <th>Akreditasi</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Kuota</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($schools as $item)
                    <tr>
                        <td>{{ $item->nama_sekolah }}</td>
                        <td>{{ $item->jenjang }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            @php
                                $badgeClass = '';
                                switch ($item->akreditasi) {
                                    case 'A':
                                        $badgeClass = 'bg-success'; // Hijau untuk aktif
                                        break;
                                    case 'B':
                                        $badgeClass = 'bg-info'; // Kuning untuk pending
                                        break;
                                    case 'C':
                                        $badgeClass = 'bg-warning'; // Merah untuk non-aktif
                                        break;
                                    case 'D':
                                        $badgeClass = 'bg-secondary'; // Merah untuk non-aktif
                                        break;
                                    default:
                                        $badgeClass = 'bg-success'; // Warna default
                                        break;
                                }
                            @endphp
                            <span class="badge {{ $badgeClass }} me-1">{{ $item->akreditasi }}</span>
                        </td>
                        <td>{{ $item->kecamatan }}</td>
                        <td>{{ $item->kelurahan }}</td>
                        <td>
                            @foreach ($item->kuotaKelas as $kuota)
                                <div>{{ $kuota->kelas }}: {{ $kuota->sisa_kuota }}</div>
                            @endforeach
                        </td>
                        

                        {{-- <td id="sekolah-{{ $item->id }}">
                            <span class="kuota">{{ $item->kuota }}
                        </td> --}}
                        <td class="text-center">
                            <a href="{{ url('detail/sekolah/' . $item->id) }}" class="btn btn-dark btn-sm">Detail
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                            {{-- <a href="{{ route('services') }}" class="btn btn-warning btn-sm">Daftar
                                <i class="bx bx-right-arrow-alt"></i>
                            </a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
                <div class="d-flex justify-content-end">
                {{ $schools->links('pagination::bootstrap-5') }}
            </div>
            </div>

        </div>


        

    </div>
</div>

<!-- Style -->
<style>
    .bg-custom {
        background-color: white;
        padding: 5px;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-custom {
        background: rgba(0, 154, 222, 0.95); /* Kuning dan oranye terang */
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 50px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-custom:hover {
        background: #021C3F; /* Sedikit lebih gelap saat hover */
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .bi {
        font-size: 1.5rem;
    }

    /* Mengubah ukuran teks judul */
    h1.display-4 {
        font-size: 3rem;
        font-weight: bold;
    }

    .rounded-table {
        border-radius: 5px;
        overflow: hidden; /* Supaya border radius berpengaruh */
    }

    .rounded-table thead {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .rounded-table tbody {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }


    /* Mengubah jarak antar elemen */
    .row > div {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    section {
    background-attachment: fixed;
    background-size: cover;
    }
    .carousel-indicators .active {
    background-color: rgba(0, 154, 222, 0.95); /* Warna indikator aktif jadi merah */
    }
    /* .carousel-indicators, */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(1); /* Ubah warna jadi hitam */
    }
    .custom-card {
        background-color: rgba(255, 255, 255, 0.25); /* Warna putih transparan */
        border: none; /* Hilangin border biar lebih clean (opsional) */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Tambahin shadow biar lebih elegan */
        color: black;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const filterJenjang = document.getElementById("filterJenjang");
        const filterAkreditasi = document.getElementById("filterAkreditasi"); // Perbaikan ID
        const filterKecamatan = document.getElementById("filterKecamatan");
        const filterKelurahan = document.getElementById("filterKelurahan");
        const tableBody = document.getElementById("tableBody");

        function filterTable() {
            const searchText = searchInput.value.toLowerCase();
            const jenjangFilter = filterJenjang.value.toLowerCase();
            const akreditasiFilter = filterAkreditasi.value.toLowerCase();
            const kecamatanFilter = filterKecamatan.value.toLowerCase();
            const kelurahanFilter = filterKelurahan.value.toLowerCase();

            Array.from(tableBody.getElementsByTagName("tr")).forEach(row => {
                const namaSekolah = row.cells[0].textContent.toLowerCase();
                const jenjang = row.cells[1].textContent.toLowerCase();
                const akreditasi = row.cells[3].textContent.toLowerCase();
                const kecamatan = row.cells[4].textContent.toLowerCase();
                const kelurahan = row.cells[5].textContent.toLowerCase();

                const matchSearch = namaSekolah.includes(searchText);
                const matchJenjang = jenjangFilter === "" || jenjang.includes(jenjangFilter);
                const matchAkreditasi = akreditasiFilter === "" || akreditasi.includes(akreditasiFilter);
                const matchKecamatan = kecamatanFilter === "" || kecamatan.includes(kecamatanFilter);
                const matchKelurahan = kelurahanFilter === "" || kelurahan.includes(kelurahanFilter);

                row.style.display = matchSearch && matchJenjang && matchAkreditasi && matchKecamatan && matchKelurahan ? "" : "none";
            });
        }

        searchInput.addEventListener("input", filterTable);
        filterJenjang.addEventListener("change", filterTable);
        filterAkreditasi.addEventListener("change", filterTable);
        filterKecamatan.addEventListener("change", filterTable);
        filterKelurahan.addEventListener("change", filterTable);
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.2/echo.iife.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    // Konfigurasi Pusher
    Pusher.logToConsole = true;
    var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: "mt1",
        wsHost: "{{ env('PUSHER_HOST') }}",
        wsPort: "{{ env('PUSHER_PORT') }}",
        forceTLS: false,
        disableStats: true,
    });

    // Subscribe ke channel
    var channel = pusher.subscribe("kuota-schools");

    // Listen ke event
    channel.bind("App\\Events\\KuotaUpdated", function (data) {
        document.getElementById("kuota-" + data.schoolAsalId).innerText = data.schoolAsalKuota;
        document.getElementById("kuota-" + data.schoolTujuanId).innerText = data.schoolTujuanKuota;
    });
</script>

@endsection
