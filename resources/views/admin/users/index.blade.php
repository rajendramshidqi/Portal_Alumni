@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold mb-0 text-dark">👥 Manajemen User</h3>
            <p class="text-muted small">Kelola hak akses dan status pengguna sistem secara terpusat.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="d-inline-flex gap-2">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="form-control ps-5 border-0 shadow-sm" placeholder="Cari user..." style="border-radius: 12px;">
                </div>
               
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-primary border-4">
                <small class="text-muted fw-bold text-uppercase">Total User</small>
                <h4 class="fw-bold mb-0">{{ $users->total() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-success border-4">
                <small class="text-muted fw-bold text-uppercase">User Aktif</small>
                <h4 class="fw-bold mb-0 text-success">--</h4> </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-0">
            <h6 class="mb-0 fw-bold"><i class="fas fa-list me-2 text-primary"></i> Daftar Pengguna</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="bg-light-smooth">
                        <tr class="text-muted small">
                            <th class="ps-4">NO</th>
                            <th>PENGGUNA</th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>STATUS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                        <tr>
                            <td class="ps-4 fw-light text-muted">
                                {{ $users->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-box bg-gradient-primary me-3">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                                        <small class="text-muted" style="font-size: 11px;">Dibuat: {{ $user->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-secondary">{{ $user->email }}</span></td>
                            <td>
                                <span class="badge-role {{ $user->role == 'admin' ? 'role-admin' : 'role-user' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                @if ($user->status == 'banned')
                                    <span class="status-dot dot-danger"></span> <small class="text-danger fw-semibold">Banned</small>
                                @else
                                    <span class="status-dot dot-success"></span> <small class="text-success fw-semibold">Aktif</small>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-action btn-edit me-2" title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-action btn-delete" title="Hapus User">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="opacity-25 mb-3">
                                <p class="text-muted">Ups! Belum ada data pengguna yang ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Menampilkan {{ $users->count() }} dari {{ $users->total() }} data</small>
                <div>
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Global Background */
    body { background-color: #f8f9fc; }

    /* Custom Avatar */
    .avatar-box {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        background: linear-gradient(45deg, #4e73df, #224abe);
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.2);
    }

    /* Badge Custom Styles */
    .badge-role {
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .role-admin { background: #eef2ff; color: #4e73df; }
    .role-user { background: #f4f7f6; color: #6c757d; }

    /* Status Dot Indicator */
    .status-dot {
        height: 8px;
        width: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
    .dot-success { background-color: #2ecc71; box-shadow: 0 0 8px #2ecc71; }
    .dot-danger { background-color: #e74c3c; box-shadow: 0 0 8px #e74c3c; }

    /* Search Bar Wrapper */
    .search-wrapper { position: relative; }
    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
    }

    /* Table & Row Hover */
    .bg-light-smooth { background-color: #fcfcfd; border-bottom: 1px solid #eee; }
    table tbody tr { transition: all 0.2s ease; border-bottom: 1px solid #f1f1f1; }
    table tbody tr:hover { background-color: #fbfcfe !important; transform: translateX(5px); }

    /* Modern Action Buttons */
    .btn-action {
        width: 35px;
        height: 35px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: none;
        transition: 0.3s;
    }
    .btn-edit { background: #fff4e5; color: #ff9800; }
    .btn-edit:hover { background: #ff9800; color: white; }
    .btn-delete { background: #ffe5e5; color: #f44336; }
    .btn-delete:hover { background: #f44336; color: white; }

    /* Card Hover */
    .card { border-radius: 15px !important; }
</style>
@endsection