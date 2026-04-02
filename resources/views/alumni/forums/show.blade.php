@extends('layouts.front')
@section('content')

<br><br><br><br>

<div class="container py-4">

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle-fill me-1"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- DETAIL FORUM --}}
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-header text-white"
             style="background: linear-gradient(135deg,#0d47a1,#1976d2);">
            <h4 class="fw-bold mb-1">{{ $forum->judul }}</h4>
            <small>
                <i class="bi bi-folder"></i> {{ $forum->kategori->nama }} |
                <i class="bi bi-person"></i> {{ $forum->user->name }} |
                <i class="bi bi-clock"></i> {{ $forum->created_at->diffForHumans() }}
            </small>
        </div>

        <div class="card-body bg-light">

            {{-- 🔥 FOTO --}}
            @if ($forum->foto)
                <div class="mb-3 position-relative overflow-hidden rounded shadow-sm">
                    <img src="{{ asset('storage/' . $forum->foto) }}"
                        class="img-fluid w-100 forum-img"
                        style="max-height:350px; object-fit:cover; cursor:pointer;">
                    
                    <div class="position-absolute bottom-0 start-0 w-100 p-2 text-white"
                         style="background: linear-gradient(to top, rgba(0,0,0,0.5), transparent); font-size:12px;">
                        📷 Foto Forum
                    </div>
                </div>
            @endif

            {{-- ISI --}}
            {!! nl2br(e($forum->isi)) !!}
        </div>
    </div>

    {{-- FORM KOMENTAR --}}
    @auth
    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <h5 class="fw-bold mb-3">
                <i class="bi bi-chat-dots-fill"></i> Tambah Komentar
            </h5>

            <form action="{{ route('forum.komentar.store',$forum->id) }}" method="POST">
                @csrf
                <textarea name="isi" class="form-control mb-3" rows="4"
                    placeholder="Tulis komentar...">{{ old('isi') }}</textarea>

                <button class="btn btn-primary fw-bold">
                    <i class="bi bi-send-fill"></i> Kirim
                </button>
            </form>
        </div>
    </div>
    @endauth

    {{-- DAFTAR KOMENTAR --}}
    <div class="card shadow-lg border-0">
        <div class="card-header bg-light">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-chat-square-text-fill"></i>
                Komentar ({{ $komentar->count() }})
            </h5>
        </div>

        <div class="card-body">

            @forelse($komentar as $komen)
            <div class="border rounded p-3 mb-3 bg-white shadow-sm">

                {{-- HEADER --}}
                <strong>{{ $komen->user->name }}</strong>

                @if($komen->user->status !== 'active')
                    <span class="badge bg-warning text-dark ms-1">Banned</span>
                @endif

                <br>
                <small class="text-muted">
                    <i class="bi bi-clock"></i>
                    {{ $komen->created_at->diffForHumans() }}
                </small>

                {{-- ISI --}}
                @if($komen->trashed())
                    <p class="fst-italic text-muted mt-2">
                        <i class="bi bi-trash-fill"></i>
                        Komentar telah dihapus oleh moderator.
                    </p>
                @else
                    <p class="mt-2">{{ $komen->isi }}</p>

                    {{-- LIKE --}}
                    <div class="mb-2">
                        @auth
                        <form action="{{ route('komentar.like',$komen->id) }}"
                              method="POST" style="display:inline-block;">
                            @csrf
                            <button class="btn btn-sm
                                {{ $komen->isLikedBy(auth()->user())
                                    ? 'btn-primary'
                                    : 'btn-outline-primary' }}">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                {{ $komen->likes->count() }}
                            </button>
                        </form>
                        @else
                            <span class="text-muted">
                                👍 {{ $komen->likes->count() }}
                            </span>
                        @endauth
                    </div>
                @endif

                {{-- AKSI USER --}}
                @auth
                    @if(auth()->id() === $komen->users_id && !$komen->trashed())
                        <a href="{{ route('forum.komentar.edit',$komen->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('forum.komentar.destroy',$komen->id) }}"
                              method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    @endif
                @endauth

                {{-- MODERATOR --}}
                @auth
                    @if(auth()->user()->hasRole('moderator') && !$komen->trashed())
                        <div class="mt-3 pt-2 border-top">
                            <small class="fw-bold text-primary">Aksi Moderator</small>
                            <br>

                            <form action="{{ route('moderator.komentar.destroy',$komen->id) }}"
                                  method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm mt-1">
                                    Hapus
                                </button>
                            </form>

                            @if($komen->user->status === 'active')
                                <form action="{{ route('moderator.user.ban',$komen->user->id) }}"
                                      method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-warning btn-sm mt-1">
                                        Ban User
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('moderator.user.unban',$komen->user->id) }}"
                                      method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-success btn-sm mt-1">
                                        Unban
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endauth

            </div>
            @empty
                <p class="text-center text-muted">
                    Belum ada komentar.
                </p>
            @endforelse

        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>

{{-- STYLE --}}
<style>
.forum-img {
    transition: 0.3s;
}
.forum-img:hover {
    transform: scale(1.03);
}
</style>

{{-- SCRIPT --}}
<script>
document.querySelectorAll('.forum-img').forEach(img => {
    img.addEventListener('click', function () {
        window.open(this.src, '_blank');
    });
});
</script>

@endsection