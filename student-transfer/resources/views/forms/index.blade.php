@extends('main-admin')
@section('title', 'Pengajuan')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3 class="fw-bold mb-3" style="color: white">Daftar Pengajuan</h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Layanan</th>
                                <th>Nama Pengaju</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Document</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>              
                        <tbody id="tbody">
                            @foreach($form as $form)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $form->service->name }}</td> 
                                <td>{{ $form->full_name }}</td>
                                <td>{{ $form->email }}</td>
                                <td>{{ $form->phone }}</td>
                                <td>
                                    @if($form->document)
                                        <a href="{{ asset($form->document) }}" target="_blank">Lihat File</a>
                                    @else
                                        <span>Dokumen tidak tersedia</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <a href="{{ route('form.edit', $form->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    <!-- Tombol untuk membuka modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $form->id }}">
                                        <i class="bx bx-trash me-1"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal Hapus -->
                            <div class="modal fade" id="deleteModal{{ $form->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus layanan <strong>{{ $form->full_name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('form.destroy', $form->id) }}" method="POST">
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
                    {{ $form->links('pagination::bootstrap-5') }}
                </div> --}}
            </div>
        </div>   
    </div>
</div>
@endsection
