@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Kategori Loker</h2>

    <form method="POST" action="{{ route('admin.kategori_loker.update', $kategori_loker) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $kategori_loker->nama }}" class="form-control" required>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.kategori_loker.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
