@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Informasi Loker</h1>

    <form action="{{ route('admin.informasi_loker.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori_loker_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori_lokers as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gaji</label>
            <input type="text" name="gaji" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Persyaratan</label>
            <textarea name="persyaratan" class="form-control" rows="4" required></textarea>
        </div>

        {{-- 🔽 INPUT FOTO LOKER --}}
        <div class="mb-3">
            <label class="form-label">Foto Loker</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            <small class="text-muted">
                Format: JPG / PNG, Max 2MB
            </small>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.informasi_loker.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
