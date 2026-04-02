@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Informasi Loker</h1>

    <form action="{{ route('admin.informasi_loker.update', $informasi_loker->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori_loker_id" class="form-control" required>
                @foreach($kategori_lokers as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ $informasi_loker->kategori_loker_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control"
                   value="{{ $informasi_loker->judul }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control"
                   value="{{ $informasi_loker->lokasi }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gaji</label>
            <input type="text" name="gaji" class="form-control"
                   value="{{ $informasi_loker->gaji }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Persyaratan</label>
            <textarea name="persyaratan" rows="4"
                      class="form-control" required>{{ $informasi_loker->persyaratan }}</textarea>
        </div>

        {{-- 📸 FOTO LAMA --}}
        @if($informasi_loker->foto)
            <div class="mb-3">
                <label class="form-label">Foto Saat Ini</label><br>
                <img src="{{ asset('storage/'.$informasi_loker->foto) }}"
                     class="img-thumbnail mb-2"
                     style="max-height:200px;">
            </div>
        @endif

        {{-- 🔁 GANTI FOTO --}}
        <div class="mb-3">
            <label class="form-label">Ganti Foto (opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            <small class="text-muted">
                Kosongkan jika tidak ingin mengganti foto
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.informasi_loker.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
