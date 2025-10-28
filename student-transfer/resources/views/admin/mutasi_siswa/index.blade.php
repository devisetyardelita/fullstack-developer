@extends('main-admin')
@section('title', 'Mutasi Siswa')
@section('content')
<div class="content">
  <div class="container-xxl flex-grow-1 container-p-y">
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
      <h3 class="fw-bold mb-3" style="color: white">Data Layanan Mutasi Siswa</h3>
        <!-- Search and Filter Container -->
        <div class="d-flex align-items-center">
          <!-- Search -->
          <div class="navbar-nav align-items-left me-2" style="width: 75%;"> <!-- Atur lebar search -->
            <form action="{{ route('admin.mutasi_siswa') }}" method="GET">
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
                    <input type="checkbox" class="status-checkbox" value="Sedang Diproses"> Sedang Diproses
                  </label>
                </li>
                <li>
                  <label class="dropdown-item">
                    <input type="checkbox" class="status-checkbox" value="Ditindaklanjuti"> Ditindaklanjuti
                  </label>
                </li>
                <li>
                  <label class="dropdown-item">
                    <input type="checkbox" class="status-checkbox" value="Selesai"> Selesai
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
          <a href="{{ url('admin/mutasi_siswa/excel') }}" class="btn rounded-pill btn-primary mx-1">Excel</a>
          <a href="{{ url('admin/mutasi_siswa/pdf') }}" class="btn rounded-pill btn-secondary mx-1">PDF</a>
          <a href="{{ route('admin.mutasi_siswa.create') }}" class="btn rounded-pill btn-primary mx-1">
            <i class="bx bx-plus"></i>Tambah Data
          </a>
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
              @if($mutasi->isEmpty())
                <div class="empty-message">
                    <p>Tidak ada pengajuan pembaruan data mutasi.</p>
                </div>
              @else
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>
                      <a href="{{ route('admin.mutasi_siswa', ['sort_by' => 'id', 'sort_order' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
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
                      <a href="{{ route('admin.mutasi_siswa', ['sort_by' => 'nama_siswa', 'sort_order' => $sortBy == 'nama_siswa' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
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
                      <a href="{{ route('admin.mutasi_siswa', ['sort_by' => 'nisn', 'sort_order' => $sortBy == 'nisn' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                          NISN
                          @if ($sortBy == 'nisn')
                              @if ($sortOrder == 'asc')
                                  <i class="bx bx-sort-up"></i>
                              @else
                                  <i class="bx bx-sort-down"></i>
                              @endif
                          @endif
                      </a>
                    </th>
                    <th>
                      <a href="{{ route('admin.mutasi_siswa', ['sort_by' => 'kelas', 'sort_order' => $sortBy == 'kelas' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
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
                      <a href="{{ route('admin.mutasi_siswa', ['sort_by' => 'schoolAsal', 'sort_order' => $sortBy == 'schoolAsal' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                          Sekolah Asal
                          @if ($sortBy == 'schoolAsal')
                              @if ($sortOrder == 'asc')
                                  <i class="bx bx-sort-up"></i>
                              @else
                                  <i class="bx bx-sort-down"></i>
                              @endif
                          @endif
                      </a>
                    </th>
                    <th>
                      <a href="{{ route('admin.mutasi_siswa', ['sort_by' => 'school_sbaru_id', 'sort_order' => $sortBy == 'school_sbaru_id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
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
                        <a href="{{ route('admin.sbaru', ['sort_by' => 'created_at', 'sort_order' => $sortBy == 'created_at' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
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
                  @foreach($mutasi as $item)
                    <tr>
                      <td>{{ $loop->iteration + $mutasi->firstItem() - 1 }}</td>
                      <td>{{ $item['nama_siswa'] }}</td>
                      <td>{{ $item['nisn'] }}</td>
                      <td>{{ $item['kelas'] }}</td>
                      <td>{{ $item['asal_sekolah'] }}</td>
                      <td>{{ $item['tujuan_sekolah'] }}</td>
                      <td>
                        @php
                            $badgeClass = '';
                            switch ($item['status']) {
                                case 'Diterima':
                                    $badgeClass = 'bg-label-success'; // Hijau untuk aktif
                                    break;
                                case 'Sedang Diproses':
                                    $badgeClass = 'bg-label-info'; // Kuning untuk pending
                                    break;
                                case 'Ditindaklanjuti':
                                    $badgeClass = 'bg-label-warning'; // Merah untuk non-aktif
                                    break;
                                case 'Selesai':
                                    $badgeClass = 'bg-label-secondary'; // Merah untuk non-aktif
                                    break;
                                default:
                                    $badgeClass = 'bg-label-success'; // Warna default
                                    break;
                            }
                        @endphp
                        <span class="badge {{ $badgeClass }} me-1">{{ $item['status'] }}</span>
                      </td>
                      <td>{{ $item['created_at'] }}</td>
                      <td>                          <div class="dropdown">
                        <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton{{ $item['id'] }}" data-bs-toggle="dropdown" aria-expanded="false">
                          :
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item['id'] }}">
                          <li><a class="dropdown-item" href="{{ route('admin.mutasi_siswa.edit', ['tipe' => $item['tipe'], 'id' => $item['id']]) }}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                          </a></li>
                          <li>
                            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item['id'] }}">
                              <i class="bx bx-trash me-1"></i> Hapus
                            </button>
                          </li>
                          <li><a class="dropdown-item" href="{{ route('admin.mutasi_siswa.show', ['tipe' => $item['tipe'] == 'dalam' ? 'dalam' : 'luar', 'id' => $item['id']]) }}">
                            <i class="bx bx-right-arrow-alt"></i> Detail
                          </a></li>
                        </ul>
                      </div>
                        <!-- Modal Bootstrap -->
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
                                <form action="{{ route('admin.mutasi_siswa.destroy', ['jenis' => $item['jenis'], 'id' => $item['id']]) }}" method="POST" class="d-inline">
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
              {{ $mutasi->links('pagination::bootstrap-5') }}
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
        url: "{{ route('admin.mutasi_siswa.filter') }}", // Adjust the route to match your filter route
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
                case 'Sedang Diproses':
                  badgeClass = 'bg-label-info'; 
                  break;
                case 'Ditindaklanjuti':
                  badgeClass = 'bg-label-warning'; 
                  break;
                case 'Selesai':
                  badgeClass = 'bg-label-secondary'; 
                  break;
                default:
                  badgeClass = 'bg-label-success';
              }

              html += `<tr>
                <td>${i + 1}</td>
                <td>${filteredStatuses[i].jenjang}</td>
                <td>${filteredStatuses[i].nama_siswa}</td>
                <td>${filteredStatuses[i].nisn}</td>
                <td>${filteredStatuses[i].kelas}</td>
                <td>${filteredStatuses[i].schoolAsal}</td>
                <td>${filteredStatuses[i].schoolTujuan}</td>
                <td>
                  <span class="badge ${badgeClass} me-1">${filteredStatuses[i].status}</span>
                </td>
                <td>
                  <a href="/admin/mutasi_siswa/edit/${filteredStatuses[i].id}" class="btn btn-secondary btn-sm">
                    <i class="bx bx-edit-alt me-1"></i>
                  </a>
                  <form action="/admin/mutasi_siswa/delete/${filteredStatuses[i].id}" method="POST" class="d-inline">
                    @method("delete")
                    @csrf
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                      <i class="bx bx-trash me-1"></i>
                    </button>
                  </form>
                  <a href="/admin/mutasi_siswa/show/${filteredStatuses[i].id}" class="btn btn-dark btn-sm">Detail
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
