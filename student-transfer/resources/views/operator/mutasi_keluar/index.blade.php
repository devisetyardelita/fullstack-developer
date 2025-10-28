@extends('main-operator')
@section('title', 'Mutasi Keluar')
@section('content')
<div class="content">
  <div class="container-xxl flex-grow-1 container-p-y">
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
      <h3 class="fw-bold mb-3">Data Layanan Mutasi Siswa Keluar</h3>
        <!-- Search and Filter Container -->
        <div class="d-flex align-items-center">
          <!-- Search -->
          <div class="navbar-nav align-items-left me-2" style="width: 75%;"> <!-- Atur lebar search -->
            <form action="{{ route('operator.slama') }}" method="GET">
              {{-- style="background-color: rgba(0, 0, 0, 0.1);" --}}
              <div class="nav-item divider d-flex align-items-center" style="border-radius: 20px;height: 40px;background-color: rgb(255, 255, 255, 0.1);">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <button type="submit" class="d-inline-block bg-primary rounded-circle border-0" aria-label="Search" style="padding: 0.5rem;">
                    <i class="bx bx-search fs-4 lh-0 text-white"></i>
                  </button>
                </div>
                <input
                  type="text"
                  id="search" 
                  name="search"
                  class="form-control border-0 text-white text-sm"
                  placeholder="Search..."
                  aria-label="Search..."
                  autocomplete="off"
                  style="background-color: rgba(0, 0, 0, 0);"
                />
              </div>
            </form>
          </div>
          <!-- /Search -->

          <!-- Filter -->
          <div class="navbar-nav align-items-left" style="width: 25%">
            <div class="nav-item divider d-flex align-items-center" style="border-radius: 20px;height: 40px;background-color: rgb(255, 255, 255, 0.1);">
              <button class="btn d-flex align-items-center" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px; padding: 0; margin: 0; width: 100%;">
                <i class="bx bx-filter-alt fs-4 lh-0 text-white me-2 bg-primary rounded-circle" style="padding: 0.6rem;"></i>
                <span style="margin: 0; padding: 0;color: rgba(255, 255, 255, 0.5)">Filter by Status</span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                <li>
                  <label class="dropdown-item">
                    <input type="checkbox" class="status-checkbox" value="Diterima"> Diterima
                  </label>
                </li>
                <li>
                  <label class="dropdown-item">
                    <input type="checkbox" class="status-checkbox" value="Diproses"> Diproses
                  </label>
                </li>
                <li>
                  <label class="dropdown-item">
                    <input type="checkbox" class="status-checkbox" value="Ditolak"> Ditolak
                  </label>
                </li>
                <li class="dropdown-item">
                  <button id="applyFilter" class="btn btn-primary btn-sm">Apply Filter</button>
                </li>
              </ul>
            </div>
          </div>
          <!-- /Filter -->
        </div>
        <!-- /Search and Filter Container -->
        <!-- Bordered Table -->
        <div class="divider d-flex justify-content-center align-items-center mt-0">
          <div class="d-flex align-items-center me-2">
            <label for="entriesPerPage" class="text-white me-2">Entries per page:</label>
            <select name="entries_per_page" id="entriesPerPage" class="form-select" style="width: 70px; height: 35px" onchange="this.form.submit()">
              <option value="10" {{ $entriesPerPage == 10 ? 'selected' : '' }}>10</option>
              <option value="25" {{ $entriesPerPage == 25 ? 'selected' : '' }}>25</option>
              <option value="50" {{ $entriesPerPage == 50 ? 'selected' : '' }}>50</option>
            </select>
            <input type="hidden" name="search" value="{{ $search }}"> <!-- Include the search value -->
          </div>
        </form>
          <a href="{{ url('operator/mutasi_keluar/excel') }}" class="btn rounded-pill btn-primary mx-1">Excel</a>
          <a href="{{ url('operator/mutasi_keluar/pdf') }}" class="btn rounded-pill btn-secondary mx-1">PDF</a>
          <a href="{{ route('operator.slama.create') }}" class="btn rounded-pill btn-primary mx-1">
            <i class="bx bx-plus"></i>Tambah Data
          </a>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <ul class="nav nav-tabs d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    @foreach($range as $kelas)
                        <li class="nav-item">
                            <a class="nav-link {{ request('kelas_filter', $range[0]) == $kelas ? 'active' : '' }}"
                               href="?kelas_filter={{ $kelas }}">
                                Kelas {{ $kelas }}
                            </a>
                        </li>
                    @endforeach
                </div>
            
              </ul>
                {{-- Kuota kelas aktif --}}
                {{-- <div class="text-end px-3">
                  @php
                  $kelasAktif = (int) request('kelas_filter', $range[0]);
                  $kuota = $kuotaKelas[$kelasAktif]->kuota ?? 0;
                  $terpakai = $slama->where('kelas', $kelasAktif)->where('status', 'Diterima')->count();
                  $sisa = $kuota - $terpakai;
      
                  // Kondisi warna badge
                  $badgeColor = $sisa <= 5 ? 'bg-danger' : 'bg-warning text-white';
                  @endphp
          
                  <span class="badge {{ $badgeColor }}">
                      Sisa Kuota Kelas {{ $kelasAktif }}: {{ $sisa }} siswa
                  </span>
                </div> --}}
              @if($slama->isEmpty())
                <div class="empty-message">
                    <p>Tidak ada data mutasi untuk sekolah Anda.</p>
                </div>
              @else
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        <a href="{{ route('operator.slama', ['sort_by' => 'id', 'sort_order' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                            No.
                            @if ($sortBy == 'id')
                                @if ($sortOrder == 'asc')
                                    <i class="bx bx-sort-up"></i> <!-- Tanda panah naik -->
                                @else
                                    <i class="bx bx-sort-down"></i> <!-- Tanda panah turun -->
                                @endif
                            @endif
                        </a>
                      </th>
                      <th>
                          <a href="{{ route('operator.slama', ['sort_by' => 'nama_siswa', 'sort_order' => $sortBy == 'nama_siswa' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                              Nama Siswa
                              @if ($sortBy == 'nama_siswa')
                                  @if ($sortOrder == 'asc')
                                      <i class="bx bx-sort-up"></i>
                                  @else
                                      <i class="bx bx-sort-down"></i>
                                  @endif
                              @endif
                          </a>
                      </th>
                      <th>
                          <a href="{{ route('operator.slama', ['sort_by' => 'school_sbaru_id', 'sort_order' => $sortBy == 'school_sbaru_id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                              Sekolah Tujuan
                              @if ($sortBy == 'school_sbaru_id')
                                  @if ($sortOrder == 'asc')
                                      <i class="bx bx-sort-up"></i>
                                  @else
                                      <i class="bx bx-sort-down"></i>
                                  @endif
                              @endif
                          </a>
                      </th>
                      <th>Status</th>
                      <th>
                          <a href="{{ route('operator.slama', ['sort_by' => 'created_at', 'sort_order' => $sortBy == 'created_at' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                              Pengajuan
                              @if ($sortBy == 'created_at')
                                  @if ($sortOrder == 'asc')
                                      <i class="bx bx-sort-up"></i>
                                  @else
                                      <i class="bx bx-sort-down"></i>
                                  @endif
                              @endif
                          </a>
                      </th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="tbody">                         
                    @foreach($slamaFinal as $item)
                      <tr >
                        <td>{{ $loop->iteration + $slama->firstItem() - 1 }}</td>
                        <td>{{ $item['nama_siswa'] }}</td>
                        <td>{{ $item['nama_sekolah']}}</td>
                        <td>
                          @php
                              $badgeClass = '';
                              switch ($item['status']) {
                                  case 'Diterima':
                                      $badgeClass = 'bg-label-success'; // Hijau untuk aktif
                                      break;
                                  case 'Diproses':
                                      $badgeClass = 'bg-label-info'; // Kuning untuk pending
                                      break;
                                  case 'Ditolak':
                                      $badgeClass = 'bg-label-danger'; // Merah untuk non-aktif
                                      break;
                                  default:
                                      $badgeClass = 'bg-label-success'; // Warna default
                                      break;
                              }
                          @endphp
                          <span class="badge {{ $badgeClass }} me-1">{{ $item['status'] }}</span>
                        </td>
                        <td>{{ $item['created_at'] }}</td>
                        <td>
                          <!-- Tombol aksi dropdown untuk setiap baris -->
                          <div class="dropdown">
                            <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton{{ $item['id'] }}" data-bs-toggle="dropdown" aria-expanded="false">
                              :
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item['id'] }}">
                              <li><a class="dropdown-item" href="{{ route('operator.slama.edit', ['tipe' => $item['tipe'], 'id' => $item['id']]) }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                              </a></li>
                              <li>
                                <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item['id'] }}">
                                  <i class="bx bx-trash me-1"></i> Hapus
                                </button>
                              </li>
                              <li><a class="dropdown-item" href="{{ route('operator.slama.show', ['tipe' => $item['tipe'] == 'dalam' ? 'dalam' : 'luar', 'id' => $item['id']]) }}">
                                <i class="bx bx-right-arrow-alt"></i> Detail
                              </a></li>
                            </ul>
                          </div>
          
                          <!-- Modal untuk hapus -->
                          <div class="modal fade" id="deleteModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item['id'] }}" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content text-center p-4">
                                <!-- Ikon dengan margin bawah -->
                                <i class="bi bi-exclamation-circle-fill text-danger" style="font-size: 85px; margin-top: -15px;margin-bottom: -10px"></i>
                                <!-- Teks Konfirmasi -->
                                <p class="mt-0 mb-3">Apakah Anda yakin ingin menghapus data ini?</p>
                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-center gap-3 mb-2">
                                  <button type="button" class="btn btn-secondary bg-primary" data-bs-dismiss="modal">Batal</button>
                                  <form action="{{ route('operator.slama.destroy', ['jenis' => $item['jenis'], 'id' => $item['id']]) }}" method="POST" class="d-inline">
                                      @method('delete')
                                      @csrf
                                      <button type="submit" class="btn btn-danger">Hapus</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>
            <div class="d-flex justify-content-end mt-2">
              {{ $slama->links('pagination::bootstrap-5') }}
            </div>
          </div>
        </div>
        <!--/ Bordered Table -->
  </div>
</div>
<style>
  .empty-message {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }
</style>
{{-- <script>
  document.getElementById('applyFilter').addEventListener('click', function() {
    const selectedStatus = Array.from(document.querySelectorAll('.status-checkbox:checked')).map(checkbox => checkbox.value);
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.set('status', selectedStatus.join(','));
    window.location.search = searchParams.toString();
  });
</script> --}}
<script>
  $(document).ready(function(){
    $('#applyFilter').on('click', function(){
      var selectedStatuses = [];

      // Get all selected checkboxes
      $('.status-checkbox:checked').each(function(){
        selectedStatuses.push($(this).val());
      });

      // ambil kelas_filter dari URL
      let kelasFilter = new URLSearchParams(window.location.search).get('kelas_filter');

      $.ajax({
        url: "{{ route('operator.slama.filter') }}",
        type: "GET",
        data: {
          statuses: selectedStatuses,
          kelas_filter: kelasFilter // tambahkan ini
        },
        success: function(data) {
          var filteredStatuses = data.statuses; // Get the response data
          var html = '';
          
          if (filteredStatuses.length > 0) {
            for (let i = 0; i < filteredStatuses.length; i++) {
              var badgeClass = '';
              switch (filteredStatuses[i].status) {
                case 'Diterima':
                  badgeClass = 'bg-label-success'; 
                  break;
                case 'Diproses':
                  badgeClass = 'bg-label-info'; 
                  break;
                case 'Ditolak':
                  badgeClass = 'bg-label-danger'; 
                  break;
                default:
                  badgeClass = 'bg-label-success';
              }

              html += `<tr>
                <td>${i + 1}</td>               
                <td>${filteredStatuses[i].jenjang}</td>
                <td>${filteredStatuses[i].nama_siswa}</td>
                <td>${filteredStatuses[i].kelas}</td>
                <td>${filteredStatuses[i].school_sbaru_id}</td>
                <td>
                  <span class="badge ${badgeClass} me-1">${filteredStatuses[i].status}</span>
                </td>
                <td>
                  <a href="/operator/mutasi_keluar/edit/${filteredStatuses[i].id}" class="btn btn-secondary btn-sm">
                    <i class="bx bx-edit-alt me-1"></i>
                  </a>
                  <form action="/operator/mutasi_keluar/delete/${filteredStatuses[i].id}" method="POST" class="d-inline">
                    @method("delete")
                    @csrf
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                      <i class="bx bx-trash me-1"></i>
                    </button>
                  </form>
                  <a href="/operator/mutasi_keluar/show/${filteredStatuses[i].id}" class="btn btn-dark btn-sm">Detail
                    <i class="bx bx-right-arrow-alt"></i>
                  </a>
                </td>
              </tr>`;
            }
          } else {
            html += '<tr><td colspan="5">Tidak Ada Data</td></tr>';
          }

          $("#tbody").html(html);
        }
      });
    });
  });
</script>


@endsection
