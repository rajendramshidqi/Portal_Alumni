@extends('layouts.app')

@section('content')
<style>
    .auth-bg {
        min-height: 150vh;
        background:
            linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
            url('alumni/images/wisda.jpg') center / cover no-repeat;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.85);
        border-radius: 12px;
    }
</style>

<div class="auth-bg d-flex align-items-center justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card auth-card shadow border-0">
            <div class="card-body p-4">
                <h4 class="text-center mb-4 fw-bold">Register</h4>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary">
                            Register
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <small>
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Login</a>
                        </small>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
