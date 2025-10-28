@extends('main-admin')
@section('title', 'Service')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h1>Tambah Layanan Baru</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Layanan</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama layanan" required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Deskripsi Layanan (Opsional)</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Deskripsi singkat tentang layanan"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
