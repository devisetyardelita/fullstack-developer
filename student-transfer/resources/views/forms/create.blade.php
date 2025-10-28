@extends('main-user')

@section('title', 'Formulir Layanan')

@section('content')
<div class="container mt-5">
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <div class="row">
    <div class="card p-4 bg-light mb-4">
        <h1 class="text-center">Formulir Layanan</h1>
        <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="full_name" class="form-label">Nama Lengkap</label>
                <input type="text" name="full_name" id="full_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">No HP</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="service_id" class="form-label">Pilih Layanan</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    <option value="" disabled selected>Pilih layanan...</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="document" class="form-label">Unggah Dokumen (PDF)</label>
                <input type="file" name="document" id="document" class="form-control" required>
            </div>
            <!-- Tombol Submit -->
            <div class="d-flex">
              <button type="submit" class="btn btn-primary mb-2 me-2">Simpan</button>
              <a href="{{ route('home2') }}" class="btn btn-outline-secondary mb-2">Kembali</a>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
