@extends('layouts.front')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">

<style>
/* ─── Tokens ─────────────────────────────────── */
:root {
    --blue:        #1455b3;
    --blue2:       #1e88e5;
    --blue3:       #0288d1;
    --dark:        #09193a;
    --mid:         #1c3560;
    --muted:       #6b8cba;
    --bg:          #eef4fd;
    --white:       #ffffff;
    --border:      #d4e4f7;
    --grad:        linear-gradient(135deg, #1455b3 0%, #0288d1 60%, #00b4d8 100%);
    --grad-soft:   linear-gradient(135deg, #ddeeff 0%, #eaf4ff 100%);
    --shadow-sm:   0 2px 12px rgba(20,85,179,.08);
    --shadow-md:   0 8px 32px rgba(20,85,179,.13);
    --radius:      16px;
    --radius-sm:   10px;
    --font-head:   'Sora', sans-serif;
    --font-body:   'DM Sans', sans-serif;
    --ease:        .25s cubic-bezier(.4,0,.2,1);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--font-body); background: var(--bg); color: var(--dark); }

/* ─── Page shell ──────────────────────────────── */
.fp-wrap {
    max-width: 860px;
    margin: 0 auto;
    padding: 100px 20px 64px;
}

/* ─── Alert ───────────────────────────────────── */
.fp-alert {
    display: flex; align-items: center; gap: 10px;
    background: #e8f5e9; border: 1px solid #a5d6a7;
    color: #2e7d32; border-radius: var(--radius-sm);
    padding: 12px 18px; font-size: .9rem; font-weight: 500;
    margin-bottom: 24px;
    animation: fadeUp .4s ease both;
}

/* ─── Forum card ──────────────────────────────── */
.fc {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    margin-bottom: 28px;
    animation: fadeUp .45s ease both;
}

/* header strip */
.fc-header {
    background: var(--grad);
    padding: 28px 32px 24px;
    position: relative;
    overflow: hidden;
}
.fc-header::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.12) 1px, transparent 1px);
    background-size: 26px 26px;
    pointer-events: none;
}

.fc-kat {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.3);
    color: #fff; font-size: .7rem; font-weight: 700;
    letter-spacing: .1em; text-transform: uppercase;
    padding: 5px 12px; border-radius: 99px;
    margin-bottom: 14px;
}

.fc-title {
    font-family: var(--font-head);
    font-size: clamp(1.3rem, 3vw, 1.85rem);
    font-weight: 800; line-height: 1.2; color: #fff;
    margin-bottom: 16px; letter-spacing: -.02em;
}

.fc-meta {
    display: flex; flex-wrap: wrap; gap: 16px;
}
.fc-meta-item {
    display: flex; align-items: center; gap: 6px;
    font-size: .8rem; color: rgba(255,255,255,.78);
}
.fc-meta-item i { font-size: .8rem; }

/* author avatar in header */
.fc-avatar {
    width: 30px; height: 30px; border-radius: 50%;
    background: rgba(255,255,255,.25);
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem; font-weight: 700; color: #fff;
    border: 1.5px solid rgba(255,255,255,.4);
    flex-shrink: 0;
}

/* body */
.fc-body { padding: 28px 32px; }

/* photo */
.fc-photo {
    margin-bottom: 24px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    position: relative;
    cursor: pointer;
    box-shadow: var(--shadow-sm);
}
.fc-photo img {
    width: 100%; max-height: 400px; object-fit: cover; display: block;
    transition: transform .5s ease;
}
.fc-photo:hover img { transform: scale(1.02); }
.fc-photo-caption {
    position: absolute; bottom: 0; left: 0; right: 0;
    padding: 10px 14px;
    background: linear-gradient(to top, rgba(9,25,58,.55), transparent);
    color: rgba(255,255,255,.85); font-size: .75rem;
    display: flex; align-items: center; gap: 6px;
}

/* content text */
.fc-content {
    font-size: .97rem; line-height: 1.8; color: var(--mid);
}

/* ─── Section heading ─────────────────────────── */
.sec-head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 20px;
}
.sec-head-title {
    font-family: var(--font-head);
    font-size: 1rem; font-weight: 700; color: var(--dark);
}
.sec-head-count {
    background: var(--grad); color: #fff;
    font-size: .7rem; font-weight: 700;
    padding: 3px 9px; border-radius: 99px;
}
.sec-head-line {
    flex: 1; height: 1px; background: var(--border);
}

/* ─── Comment form ────────────────────────────── */
.cf {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px 28px;
    margin-bottom: 28px;
    box-shadow: var(--shadow-sm);
    animation: fadeUp .5s ease .05s both;
}

.cf textarea {
    width: 100%;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 13px 16px;
    font-family: var(--font-body);
    font-size: .92rem;
    color: var(--dark);
    background: var(--bg);
    resize: vertical;
    min-height: 100px;
    outline: none;
    transition: border-color var(--ease), box-shadow var(--ease), background var(--ease);
    margin-bottom: 14px;
    display: block;
}
.cf textarea:focus {
    border-color: var(--blue2);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(30,136,229,.1);
}
.cf textarea::placeholder { color: var(--muted); }

.btn-send {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--grad); color: #fff;
    font-family: var(--font-body); font-weight: 700; font-size: .88rem;
    padding: 11px 24px; border-radius: 99px; border: none;
    cursor: pointer; box-shadow: 0 4px 16px rgba(20,85,179,.28);
    transition: opacity var(--ease), transform var(--ease);
}
.btn-send:hover { opacity: .9; transform: translateY(-1px); }

/* ─── Login nudge ─────────────────────────────── */
.login-nudge {
    background: var(--grad-soft);
    border: 1.5px dashed var(--border);
    border-radius: var(--radius);
    padding: 24px; text-align: center;
    margin-bottom: 28px;
    animation: fadeUp .5s ease .05s both;
}
.login-nudge p { font-size: .9rem; color: var(--muted); margin-bottom: 12px; }
.btn-login-nudge {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--grad); color: #fff;
    font-weight: 700; font-size: .85rem;
    padding: 10px 22px; border-radius: 99px;
    text-decoration: none; box-shadow: 0 4px 14px rgba(20,85,179,.28);
    transition: opacity var(--ease), transform var(--ease);
}
.btn-login-nudge:hover { opacity: .9; transform: translateY(-1px); color: #fff; }

/* ─── Comment list ────────────────────────────── */
.comment-list { display: flex; flex-direction: column; gap: 14px; }

.comment-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 18px 22px;
    box-shadow: var(--shadow-sm);
    transition: box-shadow var(--ease), border-color var(--ease);
    animation: fadeUp .4s ease both;
}
.comment-card:hover { box-shadow: var(--shadow-md); border-color: #b8d3f0; }

.comment-top {
    display: flex; align-items: center; gap: 10px; margin-bottom: 10px;
}
.c-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--grad); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: .75rem; font-weight: 700; flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(20,85,179,.2);
}
.c-name {
    font-family: var(--font-head);
    font-size: .88rem; font-weight: 700; color: var(--dark);
}
.c-time { font-size: .75rem; color: var(--muted); }
.badge-banned {
    font-size: .65rem; font-weight: 700; padding: 2px 8px;
    border-radius: 99px; background: #fff3e0;
    color: #e65100; border: 1px solid #ffcc80;
    margin-left: 4px;
}

.c-deleted {
    display: flex; align-items: center; gap: 8px;
    font-size: .87rem; color: var(--muted);
    font-style: italic; padding: 4px 0;
}

.c-body { font-size: .93rem; color: var(--mid); line-height: 1.7; margin-bottom: 12px; }

/* actions row */
.c-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

.btn-like {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: .8rem; font-weight: 600;
    padding: 6px 14px; border-radius: 99px;
    border: 1.5px solid var(--border);
    background: var(--white); color: var(--muted);
    cursor: pointer; transition: all var(--ease);
}
.btn-like:hover, .btn-like.active {
    background: var(--grad); color: #fff; border-color: transparent;
    box-shadow: 0 3px 12px rgba(20,85,179,.25);
}

.btn-edit {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .78rem; font-weight: 600;
    padding: 5px 12px; border-radius: 99px;
    background: #fff8e1; color: #f57f17;
    border: 1px solid #ffe082; text-decoration: none;
    transition: background var(--ease);
}
.btn-edit:hover { background: #fff3cd; color: #e65100; }

.btn-del {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .78rem; font-weight: 600;
    padding: 5px 12px; border-radius: 99px;
    background: #ffebee; color: #c62828;
    border: 1px solid #ef9a9a; cursor: pointer;
    transition: background var(--ease);
}
.btn-del:hover { background: #fce4ec; }

/* moderator zone */
.mod-zone {
    margin-top: 12px; padding-top: 12px;
    border-top: 1px dashed var(--border);
    display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
}
.mod-label {
    font-size: .7rem; font-weight: 700; letter-spacing: .08em;
    text-transform: uppercase; color: var(--blue); margin-right: 2px;
}
.btn-ban {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .78rem; font-weight: 600;
    padding: 5px 12px; border-radius: 99px;
    background: #fff3e0; color: #e65100;
    border: 1px solid #ffcc80; cursor: pointer;
    transition: background var(--ease);
}
.btn-ban:hover { background: #ffe0b2; }
.btn-unban {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .78rem; font-weight: 600;
    padding: 5px 12px; border-radius: 99px;
    background: #e8f5e9; color: #2e7d32;
    border: 1px solid #a5d6a7; cursor: pointer;
    transition: background var(--ease);
}
.btn-unban:hover { background: #c8e6c9; }

/* empty comments */
.no-comments {
    text-align: center; padding: 40px 20px;
    color: var(--muted); font-size: .9rem;
}
.no-comments i { font-size: 2.2rem; display: block; margin-bottom: 10px; opacity: .3; }

/* back */
.btn-back {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--white); color: var(--mid);
    border: 1.5px solid var(--border);
    font-weight: 600; font-size: .87rem;
    padding: 10px 20px; border-radius: 99px;
    text-decoration: none; margin-top: 28px;
    transition: all var(--ease); box-shadow: var(--shadow-sm);
}
.btn-back:hover { background: var(--bg); color: var(--blue); border-color: var(--blue2); }

/* ─── Animation ───────────────────────────────── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: none; }
}

@media (max-width: 600px) {
    .fc-header { padding: 22px 20px 18px; }
    .fc-body    { padding: 20px; }
    .cf         { padding: 18px 20px; }
}
</style>

<div class="fp-wrap">

    {{-- Alert --}}
    @if (session('success'))
        <div class="fp-alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ══ FORUM CARD ══ --}}
    <div class="fc">

        {{-- Header --}}
        <div class="fc-header">
            <div class="fc-kat">
                <i class="bi bi-tag-fill"></i>
                {{ $forum->kategori->nama }}
            </div>
            <h1 class="fc-title">{{ $forum->judul }}</h1>
            <div class="fc-meta">
                <div class="fc-meta-item">
                    <div class="fc-avatar">{{ strtoupper(substr($forum->user->name, 0, 1)) }}</div>
                    {{ $forum->user->name }}
                </div>
                <div class="fc-meta-item">
                    <i class="bi bi-clock"></i>
                    {{ $forum->created_at->diffForHumans() }}
                </div>
                <div class="fc-meta-item">
                    <i class="bi bi-chat-dots"></i>
                    {{ $komentar->count() }} komentar
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="fc-body">

            @if ($forum->foto)
                <div class="fc-photo" onclick="window.open('{{ asset('storage/' . $forum->foto) }}','_blank')">
                    <img src="{{ asset('storage/' . $forum->foto) }}" alt="{{ $forum->judul }}">
                    <div class="fc-photo-caption">
                        <i class="bi bi-camera-fill"></i> Klik untuk memperbesar
                    </div>
                </div>
            @endif

            <div class="fc-content">
                {!! nl2br(e($forum->isi)) !!}
            </div>

        </div>
    </div>


    {{-- ══ COMMENT FORM ══ --}}
    @auth
        <div class="cf">
            <div class="sec-head" style="margin-bottom:16px;">
                <i class="bi bi-chat-dots-fill" style="color:var(--blue2);"></i>
                <span class="sec-head-title">Tulis Komentar</span>
            </div>
            <form action="{{ route('forum.komentar.store', $forum->id) }}" method="POST">
                @csrf
                <textarea name="isi" placeholder="Bagikan pendapat atau pertanyaan kamu…">{{ old('isi') }}</textarea>
                <button type="submit" class="btn-send">
                    <i class="bi bi-send-fill"></i> Kirim Komentar
                </button>
            </form>
        </div>
    @else
        <div class="login-nudge">
            <p>Masuk untuk ikut berdiskusi dan meninggalkan komentar.</p>
            <a href="{{ route('login') }}" class="btn-login-nudge">
                <i class="bi bi-box-arrow-in-right"></i> Login sekarang
            </a>
        </div>
    @endauth


    {{-- ══ COMMENT LIST ══ --}}
    <div class="sec-head">
        <i class="bi bi-chat-square-text-fill" style="color:var(--blue2);"></i>
        <span class="sec-head-title">Komentar</span>
        <span class="sec-head-count">{{ $komentar->count() }}</span>
        <div class="sec-head-line"></div>
    </div>

    <div class="comment-list">
        @forelse($komentar as $komen)
            <div class="comment-card">

                {{-- top --}}
                <div class="comment-top">
                    <div class="c-avatar">{{ strtoupper(substr($komen->user->name, 0, 1)) }}</div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                            <span class="c-name">{{ $komen->user->name }}</span>
                            @if($komen->user->status !== 'active')
                                <span class="badge-banned">Banned</span>
                            @endif
                        </div>
                        <div class="c-time">
                            <i class="bi bi-clock" style="font-size:.7rem;"></i>
                            {{ $komen->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                {{-- body / deleted --}}
                @if($komen->trashed())
                    <div class="c-deleted">
                        <i class="bi bi-trash-fill"></i>
                        Komentar telah dihapus oleh moderator.
                    </div>
                @else
                    <div class="c-body">{{ $komen->isi }}</div>

                    {{-- actions --}}
                    <div class="c-actions">

                        {{-- like --}}
                        @auth
                            <form action="{{ route('komentar.like', $komen->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn-like {{ $komen->isLikedBy(auth()->user()) ? 'active' : '' }}">
                                    <i class="bi bi-hand-thumbs-up-fill"></i>
                                    {{ $komen->likes->count() }}
                                </button>
                            </form>
                        @else
                            <span class="btn-like" style="cursor:default;">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                {{ $komen->likes->count() }}
                            </span>
                        @endauth

                        {{-- edit / hapus milik sendiri --}}
                        @auth
                            @if(auth()->id() === $komen->users_id)
                                <a href="{{ route('forum.komentar.edit', $komen->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <form action="{{ route('forum.komentar.destroy', $komen->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-del">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            @endif
                        @endauth

                    </div>

                    {{-- moderator zone --}}
                    @auth
                        @if(auth()->user()->hasRole('moderator'))
                            <div class="mod-zone">
                                <span class="mod-label">Moderator</span>
                                <form action="{{ route('moderator.komentar.destroy', $komen->id) }}"
                                      method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-del">
                                        <i class="bi bi-shield-x"></i> Hapus
                                    </button>
                                </form>
                                @if($komen->user->status === 'active')
                                    <form action="{{ route('moderator.user.ban', $komen->user->id) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-ban">
                                            <i class="bi bi-person-x-fill"></i> Ban User
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('moderator.user.unban', $komen->user->id) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-unban">
                                            <i class="bi bi-person-check-fill"></i> Unban
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @endauth

                @endif

            </div>
        @empty
            <div class="no-comments">
                <i class="bi bi-chat-square-dots"></i>
                Belum ada komentar. Jadilah yang pertama!
            </div>
        @endforelse
    </div>

    {{-- back --}}
    <a href="{{ route('welcome') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

</div>

@endsection