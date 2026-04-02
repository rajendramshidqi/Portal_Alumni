@extends('layouts.front')

@section('content')
<section class="site-section bg-light" id="pending-forum-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center" data-aos="fade">
                <h2 class="section-title mb-3">Forum Menunggu Persetujuan</h2>
                <p>Moderator dapat menyetujui atau menolak forum yang diajukan oleh alumni.</p>
            </div>
        </div>

        <div class="row">
        @forelse ($forums as $forum)
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="unit-4 p-4 bg-white rounded shadow-sm h-100">
                    <h5>{{ $forum->judul }}</h5>
                    <p>Kategori: {{ $forum->kategori->nama }}</p>
                    <p>Oleh: {{ $forum->user->name }}</p>

                    {{-- Tombol Approve dan Reject Forum --}}
                    <form method="POST" action="{{ route('moderator.forums.approve', $forum->id) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm mt-2">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('moderator.forums.reject', $forum->id) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm mt-2">Reject</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Tidak ada forum yang menunggu persetujuan.</p>
            </div>
        @endforelse
        </div>

        {{-- Komentar Kasar Semua Forum --}}
        <div class="row mt-5">
            <div class="col-12">
                <h4>Komentar Kasar dari Semua Forum</h4>
                @if ($komentarKasarSemua->count() > 0)
                    <ul class="list-group">
                        @foreach ($komentarKasarSemua as $komentar)
                            <li class="list-group-item">
                                <strong>{{ $komentar->user->name }}</strong> pada forum 
                                <a href="{{ route('forum.show', $komentar->forum->id) }}">
                                    {{ $komentar->forum->judul }}
                                </a>:
                                <a href="{{ route('forum.show', $komentar->forum->id) }}#komentar-{{ $komentar->id }}">
                                    {{ $komentar->isi }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted"><em>Tidak ada komentar kasar.</em></p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
