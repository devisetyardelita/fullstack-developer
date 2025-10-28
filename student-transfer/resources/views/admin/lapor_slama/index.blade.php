@extends('main-admin')
@section('title', 'Mutasi Keluar')
@section('content')
<div class="content">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4">Data Layanan Mutasi Siswa Keluar</h4>
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
      {{-- <h3 class="fw-bold mb-3" style="color: white">Data Layanan Mutasi Siswa Keluar</h3> --}}
        <!-- Search and Filter Container -->
        <div class="d-flex align-items-center">
          <!-- Search -->
          <div class="navbar-nav align-items-left me-2" style="width: 75%;"> <!-- Atur lebar search -->
            <form action="{{ route('admin.slama') }}" method="GET">
              {{-- style="background-color: rgba(0, 0, 0, 0.1);" --}}
              <div class="nav-item divider d-flex align-items-center" style="border-radius: 20px;height: 40px;background-color: rgb(255, 255, 255, 0.1); box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <button type="submit" class="d-inline-block bg-primary rounded-circle border-0" aria-label="Search" style="padding: 0.5rem;">
                    <i class="bx bx-search fs-4 lh-0 text-white"></i>
                  </button>
                </div>
                <input
                  type="text"
                  id="search" 
                  name="search"
                  class="form-control border-0  text-sm"
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
            <div class="nav-item divider d-flex align-items-center" style="border-radius: 20px;height: 40px;background-color: rgb(255, 255, 255, 0.1); box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
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
            <label for="entriesPerPage" class="text-black me-2">Entries per page:</label>
            <select name="entries_per_page" id="entriesPerPage" class="form-select" style="width: 70px; height: 35px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);" onchange="this.form.submit()">
              <option value="10" {{ $entriesPerPage == 10 ? 'selected' : '' }}>10</option>
              <option value="25" {{ $entriesPerPage == 25 ? 'selected' : '' }}>25</option>
              <option value="50" {{ $entriesPerPage == 50 ? 'selected' : '' }}>50</option>
            </select>
            <input type="hidden" name="search" value="{{ $search }}"> <!-- Include the search value -->
          </div>
        </form>
          <a href="{{ url('admin/mutasi_keluar/excel') }}" class="btn rounded-pill btn-primary mx-1 shadow-sm">Excel</a>
          <a href="{{ url('admin/mutasi_keluar/pdf') }}" class="btn rounded-pill btn-secondary mx-1 shadow-md">PDF</a>
          {{-- <a href="{{ route('admin.slama.create') }}" class="btn rounded-pill btn-primary mx-1">
            <i class="bx bx-plus"></i>Tambah Data
          </a> --}}
        </div>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <ul class="nav nav-tabs d-flex justify-content-between align-items-center">
                <div class="d-flex">
                  @foreach($data as $jenjang)
                  <li class="nav-item">
                      <a class="nav-link {{ $jenjangFilter == $jenjang ? 'active' : '' }}"
                         href="?jenjang_filter={{ $jenjang }}">
                          {{ $jenjang }}
                      </a>
                  </li>
                @endforeach
                </div>
              </ul>
              @if($slama->isEmpty())
                <div class="empty-message">
                    <p>Tidak ada data mutasi untuk sekolah Anda.</p>
                </div>
              @else
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        <a href="{{ route('admin.slama', ['sort_by' => 'id', 'sort_order' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
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
                        <a href="{{ route('admin.slama', ['sort_by' => 'jenjang', 'sort_order' => $sortBy == 'jenjang' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                            Jenjang
                            @if ($sortBy == 'jenjang')
                                @if ($sortOrder == 'asc')
                                    <i class="bx bx-sort-up"></i>
                                @else
                                    <i class="bx bx-sort-down"></i>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.slama', ['sort_by' => 'nama_siswa', 'sort_order' => $sortBy == 'nama_siswa' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
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
                        <a href="{{ route('admin.slama', ['sort_by' => 'kelas', 'sort_order' => $sortBy == 'kelas' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                            Kelas
                            @if ($sortBy == 'kelas')
                                @if ($sortOrder == 'asc')
                                    <i class="bx bx-sort-up"></i>
                                @else
                                    <i class="bx bx-sort-down"></i>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.slama', ['sort_by' => 'school_slama_id', 'sort_order' => $sortBy == 'school_slama_id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                            Sekolah Asal
                            @if ($sortBy == 'school_slama_id')
                                @if ($sortOrder == 'asc')
                                    <i class="bx bx-sort-up"></i>
                                @else
                                    <i class="bx bx-sort-down"></i>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>Status</th>
                    <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="tbody">                         
                    @foreach($slama as $item)
                      <tr>
                        <td>{{ $loop->iteration + $slama->firstItem() - 1 }}</td>
                        <td><strong>{{ $item->jenjang }}</strong></td>
                        <td>{{ $item->nama_siswa }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->schoolAsal->nama_sekolah ?? '-' }}</td>
                        <td>
                          @php
                              $badgeClass = '';
                              switch ($item->status) {
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
                          <span class="badge {{ $badgeClass }} me-1">{{ $item->status }}</span>
                        </td>
                        <td>
                          <a href="{{ route('admin.slama.show', ['tipe' => $item->tipe == 'dalam' ? 'dalam' : 'luar', 'id' => $item->id]) }}" class="btn btn-dark btn-sm">Detail
                              <i class="bx bx-right-arrow-alt"></i>
                          </a>
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
<script>
  $(document).ready(function(){
    $('#applyFilter').on('click', function(){
      var selectedStatuses = [];

      // Get all selected checkboxes
      $('.status-checkbox:checked').each(function(){
        selectedStatuses.push($(this).val());
      });

      $.ajax({
        url: "{{ route('admin.slama.filter') }}", // Adjust the route to match your filter route
        type: "GET",
        data: { statuses: selectedStatuses },
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
                <td>${filteredStatuses[i].sbaru}</td>
                <td>
                  <span class="badge ${badgeClass} me-1">${filteredStatuses[i].status}</span>
                </td>
                <td>
                  <a href="/admin/slama/show/${filteredStatuses[i].id}" class="btn btn-dark btn-sm">Detail
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
