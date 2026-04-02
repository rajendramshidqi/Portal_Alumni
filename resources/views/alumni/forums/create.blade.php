@extends('layoust.admin')


@section('content')
<section class="site-section" id="create-forum-section"
style="background: linear-gradient(135deg, #a8a4f1, #6ec1e4);">">
<div class="container">
    <div class="text-center mb-4">
        {{-- Logo forum (pakai ikon SVG sederhana) --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-2" width="64" height="64"
            fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 0a5 5 0 0 1 5 5v6a5 5 0 0 1-10 0V5a5 5 0 0 1 5-5zm0 1a4 4 0 0 0-4 4v6a4 4 0 0 0 8 0V5a4 4 0 0 0-4-4z" />
            <path d="M8 3a2 2 0 0 1 2 2v2a2 2 0 0 1-4 0V5a2 2 0 0 1 2-2z" />
        </svg>

        <h2 class="section-title mb-4">Buat Forum Diskusi Baru</h2>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white p-5 rounded shadow-sm">
                <form method="POST" action="{{ route('forum.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Forum</label>
                        <input type="text" name="judul" class="form-control"
                            placeholder="Tulis judul forum..." required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori_forum_id" class="form-label">Kategori Forum</label>
                        <select name="kategori_forum_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori_forums as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi Forum</label>
                        <textarea name="isi" rows="5" class="form-control" placeholder="Tuliskan isi diskusi..." required></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-1"></i> Kirim Forum
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
