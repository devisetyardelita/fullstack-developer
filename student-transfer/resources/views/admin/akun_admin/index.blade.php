@extends('main-admin')
@section('title', 'Akun Admin')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="mb-4">Akun</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-0">
                        <h4>Daftar Admin</h4>
                        <a href="{{ url('admin/registration') }}" class="btn rounded-pill btn-sm btn-primary">
                          <i class="bx bx-plus"></i> Tambah Akun
                        </a>
                      </div>                      
                      <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Nama</th>
                              <th>Email</th>
                            </tr>
                          </thead>
                          <tbody id="tbody">                         
                            @foreach($akun_admin as $item)
                              <tr>
                                <td>{{ $loop->iteration + $akun_admin->firstItem() - 1 }}</td>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->email}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="mt-2">
                        {{ $akun_admin->links() }}
                      </div>
                    </div>
                  </div>
                  <!--/ Bordered Table -->
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>

@endsection
