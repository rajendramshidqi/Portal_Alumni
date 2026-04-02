@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Edit Komentar</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('forum.komentar.update', $komentar->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
      <label for="isi">Isi Komentar</label>
      <textarea name="isi" id="isi" class="form-control" rows="4" required>{{ old('isi', $komentar->isi) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('forum.show', $komentar->forum_id) }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
