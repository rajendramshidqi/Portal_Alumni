@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('alumni/images/wisda.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
    }

    .login-card label,
    .login-card h4 {
        color: #fff;
    }

    .login-card input {
        background: rgba(255,255,255,0.8);
    }
</style>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card login-card p-4">
            <h4 class="text-center mb-4 fw-bold">Login Alumni</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf

    
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required>

                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label text-white" for="remember">
                        Remember Me
                    </label>
                </div>

        
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-pill">
                        Login
                    </button>
                </div>

               
                @if (Route::has('password.request'))
                    <div class="text-center mt-3">
                        <a class="text-white text-decoration-none" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
