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
                Menu dan Layanan akan membantu Anda melakukan mutasi dengan cara mudah. Tidak perlu bolak-balik ke sekolah-sekolah terkait. Cukup melalui website ini Anda dapat melakukan mutasi secara online.
            </p>
        </div>

        <div class="row mb-1 bg-custom">
            <div class="row mb-1">
                <!-- Show Entries -->
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
                </div>

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
                    <select id="filterStatus" class="form-select">
                        <option value="">-Status-</option>
                        <option value="Negeri">Negeri</option>
                        <option value="Swasta">Swasta</option>
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
            </div>
            {{-- <!-- Filter -->
                <div class="dropdown ms-2">
                    <button class="btn d-flex align-items-center dropdown-toggle" type="button" id="filterDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"
                        style="border-radius: 10px; height: 45px; background-color: rgba(255, 255, 255, 0.1); padding: 8px 12px;">
                        <i class="bi bi-funnel text-white me-2 bg-primary rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 35px; height: 35px; font-size: 1.35rem;"></i>
                        <span style="color: black;">Filter by Status</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" class="akreditasi-checkbox" value="A"> A
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" class="akreditasi-checkbox" value="B"> B
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" class="akreditasi-checkbox" value="C"> C
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" class="akreditasi-checkbox" value="D"> D
                            </label>
                        </li>
                        <li class="dropdown-item">
                            <button id="applyFilter" class="btn btn-primary btn-sm">Apply Filter</button>
                        </li>
                    </ul>
                </div> --}}
            {{-- </div> --}}

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle rounded-table">
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
                            <td>{{ $item->kuota }}</td>
                            <td class="text-center">
                                <a href="{{ url('detail/sekolah/' . $item->id) }}" class="btn btn-dark btn-sm">Detail
                                    <i class="bx bx-right-arrow-alt"></i>
                                </a>
                                <a href="{{ route('services') }}" class="btn btn-warning btn-sm">Daftar
                                    <i class="bx bx-right-arrow-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $schools->links('pagination::bootstrap-5') }}
            </div>
        </div>


        

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const filterJenjang = document.getElementById("filterJenjang");
        const filterStatus = document.getElementById("filterStatus"); // Perbaikan ID
        const filterKecamatan = document.getElementById("filterKecamatan");
        const filterKelurahan = document.getElementById("filterKelurahan");
        const tableBody = document.getElementById("tableBody");

        function filterTable() {
            const searchText = searchInput.value.toLowerCase();
            const jenjangFilter = filterJenjang.value.toLowerCase();
            const statusFilter = filterStatus.value.toLowerCase();
            const kecamatanFilter = filterKecamatan.value.toLowerCase();
            const kelurahanFilter = filterKelurahan.value.toLowerCase();

            Array.from(tableBody.getElementsByTagName("tr")).forEach(row => {
                const namaSekolah = row.cells[0].textContent.toLowerCase();
                const jenjang = row.cells[1].textContent.toLowerCase();
                const status = row.cells[2].textContent.toLowerCase();
                const kecamatan = row.cells[4].textContent.toLowerCase();
                const kelurahan = row.cells[5].textContent.toLowerCase();

                const matchSearch = namaSekolah.includes(searchText);
                const matchJenjang = jenjangFilter === "" || jenjang.includes(jenjangFilter);
                const matchStatus = statusFilter === "" || status.includes(statusFilter);
                const matchKecamatan = kecamatanFilter === "" || kecamatan.includes(kecamatanFilter);
                const matchKelurahan = kelurahanFilter === "" || kelurahan.includes(kelurahanFilter);

                row.style.display = matchSearch && matchJenjang && matchStatus && matchKecamatan && matchKelurahan ? "" : "none";
            });
        }

        searchInput.addEventListener("input", filterTable);
        filterJenjang.addEventListener("change", filterTable);
        filterStatus.addEventListener("change", filterTable);
        filterKecamatan.addEventListener("change", filterTable);
        filterKelurahan.addEventListener("change", filterTable);
    });
</script>

<!-- Order Statistics -->
<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
            <h5 class="m-0 me-2">Mutasi Siswa</h5>
            <small class="text-muted">(Masuk/Keluar)</small>
        </div>
        </div>
        <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">{{ $totalMutasi ?? 0 }}</h2>
            <span>Total Mutasi</span>
            </div>
            <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">
            <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"
                ><i class="bx bx-mobile-alt"></i
                ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                <h6 class="mb-0">Mutasi Masuk</h6>
                <small class="text-muted">PAUD, SD, SMP</small>
                </div>
                <div class="user-progress">
                <small class="fw-semibold">82.5k</small>
                </div>
            </div>
            </li>
            <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                <h6 class="mb-0">Fashion</h6>
                <small class="text-muted">T-shirt, Jeans, Shoes</small>
                </div>
                <div class="user-progress">
                <small class="fw-semibold">23.8k</small>
                </div>
            </div>
            </li>
            <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                <h6 class="mb-0">Decor</h6>
                <small class="text-muted">Fine Art, Dining</small>
                </div>
                <div class="user-progress">
                <small class="fw-semibold">849k</small>
                </div>
            </div>
            </li>
            <li class="d-flex">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-secondary"
                ><i class="bx bx-football"></i
                ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                <h6 class="mb-0">Sports</h6>
                <small class="text-muted">Football, Cricket Kit</small>
                </div>
                <div class="user-progress">
                <small class="fw-semibold">99</small>
                </div>
            </div>
            </li>
        </ul>
        </div>
    </div>
    </div>
    <!--/ Order Statistics -->

<!-- Kolom 1: Total Mutasi + Grafik -->
<div class="col-md-4">
    <div class="card h-100">
        <div class="card-header text-center">
            <h5 class="fw-bold mb-0">Total Mutasi</h5>
            <small>(Masuk/Keluar)</small>
        </div>
        <div class="card-body text-center">
            <h2 class="fw-bold">{{ $totalMutasi ?? 0 }}</h2>
            <canvas id="grafikTotalMutasi"></canvas>
        </div>
    </div>
</div>

<!-- Kolom 2: Data Mutasi Masuk -->
<div class="col-md-4">
    <div class="card h-100">
        <div class="card-header text-center">
            <h5 class="fw-bold mb-0">Mutasi Masuk</h5>
        </div>
        <div class="card-body">
            @foreach(['PAUD', 'SD', 'SMP'] as $jenjang)
                @php
                    $mutasi = $totalsbaru->firstWhere('jenjang', $jenjang);
                    $total = $mutasi ? $mutasi->total : 0;
                    $warna = ['PAUD' => 'bg-lightred', 'SD' => 'bg-mediumred', 'SMP' => 'bg-darkred'];
                @endphp
                <div class="card {{ $warna[$jenjang] }} text-white mb-3">
                    <div class="card-body text-center">
                        <h6 class="mb-0">{{ $jenjang }}</h6>
                        <h5 class="fw-bold mb-0">{{ $total }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Kolom 3: Data Mutasi Keluar -->
<div class="col-md-4">
    <div class="card h-100">
        <div class="card-header text-center">
            <h5 class="fw-bold mb-0">Mutasi Keluar</h5>
        </div>
        <div class="card-body">
            @foreach(['PAUD', 'SD', 'SMP'] as $jenjang)
                @php
                    $mutasi = $totalslama->firstWhere('jenjang', $jenjang);
                    $total = $mutasi ? $mutasi->total : 0;
                    $warna = ['PAUD' => 'bg-lightblue', 'SD' => 'bg-mediumblue', 'SMP' => 'bg-darkblue'];
                @endphp
                <div class="card {{ $warna[$jenjang] }} text-white mb-3">
                    <div class="card-body text-center">
                        <h6 class="mb-0">{{ $jenjang }}</h6>
                        <h5 class="fw-bold mb-0">{{ $total }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection

<section>
    <div class="row d-flex">
        <div class="col-md-8">
            <div class="row mb-4">
            <div class="row">
                <!-- Kolom 1: Total Mutasi -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="m-0 me-2">Mutasi Siswa</h5>
                            <small class="text-muted">(Masuk/Keluar)</small>
                        </div>
                        <div class="card-body text-center">
                            <h2 class="mb-2">{{ $totalMutasi ?? 0 }}</h2>
                            <span>Total Mutasi</span>
                            <div id="orderStatisticsChart"></div>
                        </div>
                    </div>
                </div>
            
                <!-- Kolom 2: Mutasi Masuk, Keluar, dan Lapor Mutasi -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <!-- Mutasi Masuk -->
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-log-in"></i></span>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Mutasi Masuk</h6>
                                        <small class="fw-semibold">{{ $totalMasuk ?? 0 }}</small>
                                    </div>
                                </li>
                                
                                <!-- Mutasi Keluar -->
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-log-out"></i></span>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Mutasi Keluar</h6>
                                        <small class="fw-semibold">{{ $totalKeluar ?? 0 }}</small>
                                    </div>
                                </li>
            
                                <!-- Lapor Mutasi -->
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-building"></i></span>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Lapor Mutasi</h6>
                                        <small class="fw-semibold">{{ $totalLapor ?? 0 }}</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            
                <!-- Kolom 3: Rincian Per Jenjang -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                @foreach(['PAUD', 'SD', 'SMP'] as $jenjang)
                                    @php
                                        $mutasiMasuk = $totalsbaru->firstWhere('jenjang', $jenjang);
                                        $mutasiKeluar = $totalslama->firstWhere('jenjang', $jenjang);
                                        $totalMasukJenjang = $mutasiMasuk ? $mutasiMasuk->total : 0;
                                        $totalKeluarJenjang = $mutasiKeluar ? $mutasiKeluar->total : 0;
                                    @endphp
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-building"></i></span>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-0">{{ $jenjang }}</h6>
                                            <small class="text-muted">Masuk: {{ $totalMasukJenjang }} | Keluar: {{ $totalKeluarJenjang }}</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                <h5 class="card-header m-0 me-2 pb-3">Grafik Mutasi</h5>
                                <div class="px-2">
                                    <canvas id="mutasiChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <span class="d-flex flex-column align-items-center">
                                        <h6 class="fw-bold mb-0">Total Mutasi</h6>
                                        <small>(masuk/keluar)</small>
                                    </span>                                
                                    <ul class="list-group">
                                        @foreach(['PAUD', 'SD', 'SMP'] as $jenjang)
                                            @php
                                                $masuk = $totalsbaru->firstWhere('jenjang', $jenjang);
                                                $keluar = $totalslama->firstWhere('jenjang', $jenjang);
                                                $totalMasuk = $masuk ? $masuk->total : 0;
                                                $totalKeluar = $keluar ? $keluar->total : 0;
                                            @endphp
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>{{ $jenjang }}</span>
                                                <span class="fw-bold">{{ $totalMasuk }} / {{ $totalKeluar }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="col-md-4 col-lg-4 order-2 mb-4">
            <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between p-3">
                <h5 class="card-title m-0 me-2"><i class="bx bx-bell me-2"></i>Notifications</h5>
                <a href="{{ route('admin.notifications') }}" class="btn btn-sm btn-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @forelse ($notifications->sortByDesc('created_at') as $notification) 
                        <li class="d-flex mb-1 pb-1 notification-item {{ $notification->read_at ? 'read' : '' }}">
                            <div class="avatar flex-shrink-0 ms-2">
                                <!-- Icon -->
                                <div class="icon text-primary me-1">
                                    @if (isset($notification->data['icon']))
                                        {!! $notification->data['icon'] !!}
                                    @else
                                        📄 <!-- Default Icon -->
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between">
                                <div class="me-1">
                                    <small class="text-muted d-block mb-1">
                                        {{ $notification->data['category'] ?? 'Notification' }}
                                    </small>
                                    <p class="mb-0">{{ $notification->data['message'] }}</p>
                                </div>
                                <span class="text-muted small ms-auto">
                                    {{ $notification->created_at->format('d M Y (H:i)') }}
                                </span> <!-- Format: Tanggal (Jam) -->
                            </div>
                        </li>
                    @empty
                        <p class="text-muted">Belum ada notifikasi.</p>
                    @endforelse
                </ul>
            </div>
            </div>
        </div>
        <!--/ Notifications -->
    </div>
</section>


@extends('main-user')

@section('title', 'Profil - Disdik Depok')

@section('content')
<div class="container my-5">
    <!-- Header -->
    <h2 class="text-center mb-5 text-white fw-bold">Profil Pengguna</h2>

    <!-- Card Informasi Pengguna -->
    <div class="card shadow-lg border-0 mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i> Informasi Pengguna</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-3">
                        <strong><i class="bi bi-person me-2"></i>Nama Lengkap:</strong>
                        {{ Auth::user()->name }}
                    </p>
                    <p class="mb-3">
                        <strong><i class="bi bi-envelope me-2"></i>Email:</strong>
                        {{ Auth::user()->email }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-3">
                        <strong><i class="bi bi-check-circle me-2"></i>Status Pengguna:</strong>
                        <span class="badge bg-success">Aktif</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Status Mutasi Keluar -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i> Riwayat Pengajuan</h5>
        </div>
        <div class="card-body">
            {{-- Mutasi Keluar --}}
            @if ($slama->isEmpty())
                <div class="alert alert-warning text-center">
                    Anda belum mengajukan Mutasi Keluar.
                </div>
            @else
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Mutasi Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slama as $item)
                            <tr>
                                <td>{{ $item->nama_siswa }}</td>
                                <td>
                                    @if ($item->status == 'Not Started')
                                        <span class="badge bg-warning text-dark">Belum Dimulai</span>
                                    @elseif ($item->status == 'In Progress')
                                        <span class="badge bg-info text-white">Sedang Diproses</span>
                                    @elseif ($item->status == 'Done')
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->output)
                                        <a href="{{ Storage::url($item->output) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-arrow-down-circle"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">Belum ada balasan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- Mutasi Masuk --}}
            @if ($sbaru->isEmpty())
            <div class="alert alert-warning text-center">
                Anda belum mengajukan Mutasi Masuk.
            </div>
            @else
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Mutasi Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sbaru as $item)
                            <tr>
                                <td>{{ $item->nama_siswa }}</td>
                                <td>
                                    @if ($item->status == 'Not Started')
                                        <span class="badge bg-warning text-dark">Belum Dimulai</span>
                                    @elseif ($item->status == 'In Progress')
                                        <span class="badge bg-info text-white">Sedang Diproses</span>
                                    @elseif ($item->status == 'Done')
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->output)
                                        <a href="{{ Storage::url($item->output) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-arrow-down-circle"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">Belum ada balasan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            
            {{-- Mutasi Siswa --}}
            @if ($mutasi_siswa->isEmpty())
            <div class="alert alert-warning text-center">
                Anda belum mengajukan mutasi siswa.
            </div>
            @else
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Mutasi Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mutasi_siswa as $item)
                            <tr>
                                <td>{{ $item->nama_siswa }}</td>
                                <td>
                                    @if ($item->status == 'Not Started')
                                        <span class="badge bg-warning text-dark">Belum Dimulai</span>
                                    @elseif ($item->status == 'In Progress')
                                        <span class="badge bg-info text-white">Sedang Diproses</span>
                                    @elseif ($item->status == 'Done')
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->output)
                                        <a href="{{ Storage::url($item->output) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-arrow-down-circle"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">Belum ada balasan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


        </div>
    </div>
</div>


<ul style="list-style: none; padding: 0; margin: 0;">
    <li style="display: flex; align-items: flex-start; font-size: .875rem; color: #dc3545; gap: .5em;">
      <span style="flex-shrink: 0;">*</span>
      <span>
        Surat Rekomendasi Mutasi Siswa akan diterbitkan setelah 2-3 hari kerja. Pengambilan dapat dilakukan secara online maupun offline (GD. Dibaleka 2 Lt.4)
      </span>
    </li>
</ul>
  
@endsection

