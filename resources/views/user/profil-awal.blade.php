@extends('layouts.front')

@section('content')
<div class="bg-light-blue min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card border-0 shadow-elegant">

                    {{-- HEADER --}}
                    <div class="card-header bg-blue-gradient text-white text-center py-4 border-0">
                        <h3 class="mb-1 fw-bold">
                            <i class="fas fa-user-circle me-2"></i>Profil Alumni
                        </h3>
                        <p class="mb-0 opacity-90 small">Kelola akun dan keamanan Anda</p>
                    </div>

                    <div class="card-body p-4 p-md-5">

                        {{-- ALERT --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-modern border-0">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-modern border-0">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- INFORMASI AKUN --}}
                        <h5 class="fw-bold text-primary mb-3">
                            <i class="fas fa-id-card me-2"></i>Informasi Akun
                        </h5>

                        <div class="info-item">
                            <label>Nama Lengkap</label>
                            <p>{{ auth()->user()->name }}</p>
                        </div>

                        <div class="info-item">
                            <label>Email</label>
                            <p>{{ auth()->user()->email }}</p>
                        </div>

                        <div class="info-item">
                            <label>Password</label>
                            <p>••••••••••••</p>
                            <small class="text-muted">Password tersimpan dengan aman</small>
                        </div>

                        <hr class="my-4">

                        {{-- UBAH PASSWORD --}}
                        <h5 class="fw-bold text-primary mb-3">
                            <i class="fas fa-key me-2"></i>Ubah Password
                        </h5>

                        <form action="{{ route('alumni.update-password') }}" method="POST">
                            @csrf

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           minlength="8"
                                           required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password"
                                           name="password_confirmation"
                                           class="form-control"
                                           required>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-1"></i>
                                Gunakan minimal 8 karakter
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('welcome') }}" class="btn btn-outline-primary">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Simpan Password
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-light-blue {
    background: linear-gradient(135deg, #e0f2fe, #dbeafe);
}
.shadow-elegant {
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(37,99,235,.15);
}
.bg-blue-gradient {
    background: linear-gradient(135deg, #1e3a8a, #2563eb);
}
.info-item {
    margin-bottom: 20px;
}
.info-item label {
    font-size: .8rem;
    color: #64748b;
    text-transform: uppercase;
}
.info-item p {
    font-size: 1.1rem;
    font-weight: 600;
}
.alert-modern {
    border-radius: 12px;
}
</style>
@endsection
