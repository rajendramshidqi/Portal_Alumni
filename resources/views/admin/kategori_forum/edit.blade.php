@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Kategori Forum</h1>

    <form action="{{ route('admin.kategori_forum.update', $kategori_forum->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" value="{{ $kategori_forum->nama }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.kategori_forum.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
