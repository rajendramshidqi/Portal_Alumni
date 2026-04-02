@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Kategori Loker</h2>

    <form method="POST" action="{{ route('admin.kategori_loker.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kategori_loker.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
