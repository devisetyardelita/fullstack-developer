@extends('auth.layout')
@section('title', 'Login')
@section('content')
<div class="content">
    <div class="mt-5">
        @if ($errors->any())
        <div class="col-12">
          @foreach ($errors->all() as $error)
          <div class="alert alert-danger">{{ $error }}</div>
          @endforeach
        </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
<!-- Content --> 
<div class="container-xxl vh-100 d-flex align-items-center justify-content-center">
    <div class="authentication-wrapper authentication-basic container-p-y w-75 h-20"> <!-- Mengatur tinggi kontainer -->
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card m-0"> <!-- Menghapus margin pada card -->
                <div class="card-body d-flex p-0"> <!-- Menghapus padding pada card-body -->
                    <!-- Kolom Kiri -->
                    <div class="col-md-6 d-flex flex-column justify-content-center text-center border-end" style="overflow: hidden;">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-0" style="flex-grow: 1;">
                            <img src="{{ asset('build/assets/MERDEKA.png') }}" alt='Banner' class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" />
                        </div>
                        <!-- /Logo -->
                    </div>
                    <!-- /Kolom Kiri -->

                    <!-- Kolom Kanan -->
                    <div class="col-md-6 d-flex flex-column justify-content-center p-4"> <!-- Menambahkan padding pada kolom kanan -->
                        <form id="formAuthentication" class="mb-3" action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <h4 class="mb-2">Selamat Datang! 👋</h4>
                            <p class="mb-3">Silahkan masukkan email dan password Anda</p>
                            <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Masukkan email"
                                autofocus
                            />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                {{-- <a href="auth-forgot-password-basic.html">
                                <small class="text-primary">Lupa Password?</small>
                                </a> --}}
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                            </div>
                            <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Log in</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Belum punya akun?</span>
                            <a href="{{ url('admin/registration') }}">
                            <span class="text-primary">Daftar Sekarang</span>
                            </a>
                        </p>
                    </div>
                    <!-- /Kolom Kanan -->
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
<!-- / Content -->

</div>
@endsection