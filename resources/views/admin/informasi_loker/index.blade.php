@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">💼 Informasi Lowongan</h3>
            <small class="text-muted">Kelola data lowongan pekerjaan alumni</small>
        </div>

        <a href="{{ route('admin.informasi_loker.create') }}"
            class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success shadow-sm rounded-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    {{-- TABLE HEADER --}}
                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th class="ps-4">Foto</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Gaji</th>
                            <th>Persyaratan</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($informasi_lokers as $loker)
                            <tr class="hover-row">

                                {{-- FOTO --}}
                                <td class="ps-4">
                                    @if ($loker->foto)
                                        <img src="{{ asset('storage/' . $loker->foto) }}"
                                            class="rounded-3 shadow-sm"
                                            style="width:65px; height:65px; object-fit:cover;">
                                    @else
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                            style="width:65px; height:65px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>

                                {{-- JUDUL --}}
                                <td>
                                    <div class="fw-semibold">{{ $loker->judul }}</div>
                                </td>

                                {{-- KATEGORI --}}
                                <td>
                                    <span class="badge bg-info-subtle text-info fw-semibold px-3 py-2 rounded-pill">
                                        {{ $loker->kategori->nama ?? '-' }}
                                    </span>
                                </td>

                                {{-- LOKASI --}}
                                <td>
                                    <i class="bi bi-geo-alt text-danger me-1"></i>
                                    {{ $loker->lokasi }}
                                </td>

                                {{-- GAJI --}}
                                <td>
                                    @if (!empty($loker->gaji))
                                        <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2 rounded-pill">
                                            Rp {{ number_format((int) $loker->gaji, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- PERSYARATAN --}}
                                <td style="max-width: 250px;">
                                    <small class="text-muted">
                                        {{ Str::limit(strip_tags($loker->persyaratan), 80) }}
                                    </small>
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center pe-4">
                                    <a href="{{ route('admin.informasi_loker.edit', $loker->id) }}"
                                        class="btn btn-sm btn-warning rounded-pill px-3 me-1 shadow-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.informasi_loker.destroy', $loker->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-briefcase fs-1 mb-2 d-block"></i>
                                        Belum ada lowongan pekerjaan
                                    </div>

                                    <a href="{{ route('admin.informasi_loker.create') }}"
                                        class="btn btn-outline-primary mt-3 rounded-pill px-4">
                                        Tambah Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

{{-- STYLE TAMBAHAN --}}
<style>
.hover-row:hover {
    background-color: #f8fafc;
    transition: 0.2s;
}
</style>

@endsection