@extends('layouts.front')

@section('content')

<style>
.mod-wrap { padding: 2rem 1.5rem; font-family: 'Plus Jakarta Sans', sans-serif; }
.mod-header { margin-bottom: 2rem; }
.mod-header h1 { font-size: 22px; font-weight: 500; color: #1a1a1a; }
.mod-header p { font-size: 14px; color: #666; margin-top: 4px; }

.stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 2rem; }
.stat-card { background: #f5f5f2; border-radius: 8px; padding: 14px 16px; }
.stat-card .val { font-size: 26px; font-weight: 500; color: #1a1a1a; line-height: 1; }
.stat-card .lbl { font-size: 12px; color: #888; margin-top: 5px; }

.section-label { font-size: 11px; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase; color: #aaa; margin-bottom: 12px; }

.forum-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 14px; margin-bottom: 2.5rem; }
.forum-card { background: #fff; border: 0.5px solid #e0e0e0; border-radius: 12px; padding: 1.1rem 1.25rem; display: flex; flex-direction: column; gap: 10px; transition: border-color 0.15s; }
.forum-card:hover { border-color: #bbb; }

.pending-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 500; padding: 3px 9px; border-radius: 20px; background: #FAEEDA; color: #854F0B; }
.pending-badge .dot { width: 5px; height: 5px; border-radius: 50%; background: #EF9F27; }

.forum-title { font-size: 15px; font-weight: 500; color: #1a1a1a; line-height: 1.4; }
.forum-meta { font-size: 12px; color: #888; }

.action-row { display: flex; gap: 8px; margin-top: 4px; }
.btn-approve { flex: 1; padding: 7px 0; border-radius: 8px; border: none; background: #EAF3DE; color: #3B6D11; font-size: 13px; font-weight: 500; cursor: pointer; transition: background 0.15s; font-family: inherit; }
.btn-approve:hover { background: #C0DD97; }
.btn-reject { flex: 1; padding: 7px 0; border-radius: 8px; border: none; background: #FCEBEB; color: #A32D2D; font-size: 13px; font-weight: 500; cursor: pointer; transition: background 0.15s; font-family: inherit; }
.btn-reject:hover { background: #F7C1C1; }

.section-divider { border: none; border-top: 0.5px solid #e8e8e8; margin: 1.5rem 0; }

.comment-list { display: flex; flex-direction: column; gap: 10px; }
.comment-item { background: #fff; border: 0.5px solid #e0e0e0; border-left: 3px solid #E24B4A; border-radius: 0 8px 8px 0; padding: 12px 16px; display: flex; flex-direction: column; gap: 5px; }
.comment-header { display: flex; align-items: center; gap: 8px; }
.avatar { width: 28px; height: 28px; border-radius: 50%; background: #FAECE7; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 500; color: #993C1D; flex-shrink: 0; }
.comment-author { font-size: 13px; font-weight: 500; color: #1a1a1a; }
.comment-forum-link { font-size: 12px; color: #888; }
.comment-forum-link a { color: #185FA5; text-decoration: none; }
.comment-body { font-size: 13px; color: #555; line-height: 1.5; }
.flag-badge { margin-left: auto; font-size: 10px; font-weight: 500; padding: 2px 8px; border-radius: 10px; background: #FCEBEB; color: #A32D2D; white-space: nowrap; }

.empty-state { text-align: center; padding: 2.5rem; color: #999; font-size: 14px; border: 0.5px dashed #ddd; border-radius: 12px; }
</style>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<section class="site-section bg-light" id="pending-forum-section">
    <div class="container">
        <div class="mod-wrap">

            {{-- Header --}}
            <div class="mod-header">
                <h1>Panel Moderator</h1>
                <p>Kelola forum dan pantau konten yang membutuhkan perhatian</p>
            </div>

            {{-- Stats --}}
            <div class="stats-row">
                <div class="stat-card">
                    <div class="val">{{ $forums->count() }}</div>
                    <div class="lbl">Menunggu persetujuan</div>
                </div>
                <div class="stat-card">
                    <div class="val" style="color:#A32D2D;">{{ $komentarKasarSemua->count() }}</div>
                    <div class="lbl">Komentar kasar</div>
                </div>
                <div class="stat-card">
                    <div class="val" style="color:#3B6D11;">—</div>
                    <div class="lbl">Disetujui bulan ini</div>
                </div>
            </div>

            {{-- Forum Pending --}}
            <div class="section-label">Forum menunggu persetujuan</div>

            @if ($forums->count() > 0)
                <div class="forum-grid">
                    @foreach ($forums as $forum)
                        <div class="forum-card">
                            <div>
                                <span class="pending-badge">
                                    <span class="dot"></span>Pending
                                </span>
                            </div>
                            <div class="forum-title">{{ $forum->judul }}</div>
                            <div class="forum-meta">
                                Kategori: {{ $forum->kategori->nama }} &middot; Oleh: {{ $forum->user->name }}
                            </div>
                            <div class="action-row">
                                <form method="POST" action="{{ route('moderator.forums.approve', $forum->id) }}" style="flex:1;display:flex;">
                                    @csrf
                                    <button type="submit" class="btn-approve" style="width:100%;">Setujui</button>
                                </form>
                                <form method="POST" action="{{ route('moderator.forums.reject', $forum->id) }}" style="flex:1;display:flex;">
                                    @csrf
                                    <button type="submit" class="btn-reject" style="width:100%;">Tolak</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    Tidak ada forum yang menunggu persetujuan.
                </div>
            @endif

            <hr class="section-divider">

            {{-- Komentar Kasar --}}
            <div class="section-label" style="margin-bottom:14px;">Komentar kasar — semua forum</div>

            @if ($komentarKasarSemua->count() > 0)
                <div class="comment-list">
                    @foreach ($komentarKasarSemua as $komentar)
                        @php
                            $initials = collect(explode(' ', $komentar->user->name))
                                ->map(fn($w) => strtoupper($w[0] ?? ''))
                                ->take(2)
                                ->implode('');
                        @endphp
                        <div class="comment-item">
                            <div class="comment-header">
                                <div class="avatar">{{ $initials }}</div>
                                <div>
                                    <div class="comment-author">{{ $komentar->user->name }}</div>
                                    <div class="comment-forum-link">
                                        pada forum
                                        <a href="{{ route('forum.show', $komentar->forum->id) }}">
                                            {{ $komentar->forum->judul }}
                                        </a>
                                    </div>
                                </div>
                                <span class="flag-badge">Kasar</span>
                            </div>
                            <div class="comment-body">
                                <a href="{{ route('forum.show', $komentar->forum->id) }}#komentar-{{ $komentar->id }}"
                                   style="color:inherit;text-decoration:none;">
                                    "{{ Str::limit($komentar->isi, 120) }}"
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="color:#aaa;font-size:14px;font-style:italic;">Tidak ada komentar kasar.</p>
            @endif

        </div>
    </div>
</section>

@endsection