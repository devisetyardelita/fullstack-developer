@extends('main-admin')
@section('title', 'Service')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3 class="fw-bold mb-3" style="color: white">Daftar Layanan</h3>
        <a href="{{ route('services.create') }}" class="btn rounded-pill btn-secondary mx-1 mb-2">Tambah Layanan</a>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Layanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>              
                        <tbody id="tbody">
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $service->name }}</td>
                                <td>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    <!-- Tombol untuk membuka modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $service->id }}">
                                        <i class="bx bx-trash me-1"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal Hapus -->
                            <div class="modal fade" id="deleteModal{{ $service->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus layanan <strong>{{ $service->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="d-flex justify-content-end mt-2">
                    {{ $services->links('pagination::bootstrap-5') }}
                </div> --}}
            </div>
        </div>   
    </div>
</div>
@endsection
