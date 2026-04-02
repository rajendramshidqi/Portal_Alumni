@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Daftar Informasi Loker</h2>
            <a href="{{ route('admin.informasi_loker.create') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Loker
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Gaji</th>
                        <th>Persyaratan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($informasi_lokers as $loker)
                        <tr>
                            {{-- FOTO --}}
                            <td>
                                @if ($loker->foto)
                                    <img src="{{ asset('storage/' . $loker->foto) }}" class="rounded shadow-sm"
                                        style="width:70px; height:70px; object-fit:cover;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>{{ $loker->judul }}</td>
                            <td>{{ $loker->kategori->nama ?? '-' }}</td>
                            <td>{{ $loker->lokasi }}</td>

                            <td>
                                @if (!empty($loker->gaji))
                                    Rp {{ number_format((int) $loker->gaji, 0, ',', '.') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>{{ Str::limit(strip_tags($loker->persyaratan), 100) }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.informasi_loker.edit', $loker->id) }}"
                                    class="btn btn-outline-warning btn-sm me-1 shadow-sm">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>

                                <form action="{{ route('admin.informasi_loker.destroy', $loker->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada lowongan pekerjaan yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
