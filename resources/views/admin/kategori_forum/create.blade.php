@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Kategori Forum</h1>

    <form action="{{ route('admin.kategori_forum.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.kategori_forum.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
