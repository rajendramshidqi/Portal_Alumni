@extends('layouts.front')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
/* ─── Root ─── */
.mod-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 2rem 2rem 3rem;
    max-width: 1280px;
    margin: 0 auto;
}

/* ─── Header bar ─── */
.mod-topbar {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1.75rem;
    flex-wrap: wrap;
    gap: 12px;
}
.mod-title-group {}
.mod-title-group h1 {
    font-size: 20px;
    font-weight: 600;
    color: #111;
    margin: 0 0 2px;
    letter-spacing: -0.02em;
}
.mod-title-group .mod-sub {
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #bbb;
}
.mod-topbar-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}
.mod-date-pill {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 500;
    color: #555;
    background: #f4f4f1;
    border: 0.5px solid #e0e0d8;
    border-radius: 8px;
    padding: 6px 14px;
}
.mod-date-pill svg { width: 14px; height: 14px; stroke: #999; }
.btn-new-report {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    font-family: inherit;
    background: #111;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 7px 16px;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s;
}
.btn-new-report:hover { background: #333; color: #fff; }
.btn-new-report svg { width: 13px; height: 13px; stroke: #fff; }

/* ─── Stats row ─── */
.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 2rem;
}
.stat-card {
    background: #f5f5f1;
    border-radius: 10px;
    padding: 1rem 1.25rem 1rem;
    display: flex;
    flex-direction: column;
    gap: 6px;
    position: relative;
    overflow: hidden;
}
.stat-card .stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.stat-card .stat-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.stat-card .stat-delta {
    font-size: 11px;
    font-weight: 500;
    padding: 2px 8px;
    border-radius: 20px;
}
.delta-neutral { background: #e8e8e5; color: #666; }
.delta-danger  { background: #FCEBEB; color: #A32D2D; }
.delta-success { background: #EAF3DE; color: #3B6D11; }
.stat-card .stat-val {
    font-size: 30px;
    font-weight: 600;
    color: #111;
    line-height: 1;
    letter-spacing: -0.03em;
}
.stat-card .stat-lbl {
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: #aaa;
}

/* ─── Two-column layout ─── */
.mod-body {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 20px;
    align-items: start;
}
@media (max-width: 900px) {
    .mod-body { grid-template-columns: 1fr; }
}

/* ─── Section header ─── */
.section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
}
.section-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    color: #aaa;
}
.view-all-link {
    font-size: 11px;
    font-weight: 500;
    color: #185FA5;
    text-decoration: none;
    letter-spacing: 0.04em;
}
.view-all-link:hover { text-decoration: underline; }

/* ─── Forum cards ─── */
.forum-list { display: flex; flex-direction: column; gap: 10px; }
.forum-card {
    background: #fff;
    border: 0.5px solid #e2e2dc;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 8px;
    transition: border-color 0.15s, box-shadow 0.15s;
}
.forum-card:hover { border-color: #c8c8c0; }

.forum-card-top { display: flex; align-items: center; justify-content: space-between; }
.pending-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 3px 10px;
    border-radius: 20px;
    background: #FAEEDA;
    color: #854F0B;
}
.pending-badge .dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    background: #EF9F27;
    flex-shrink: 0;
}
.forum-time { font-size: 11px; color: #c0bfb8; }

.forum-title {
    font-size: 14px;
    font-weight: 500;
    color: #111;
    line-height: 1.45;
}
.forum-meta {
    font-size: 12px;
    color: #aaa;
    display: flex;
    align-items: center;
    gap: 6px;
}
.forum-meta-avatar {
    width: 20px; height: 20px;
    border-radius: 50%;
    background: #E6F1FB;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    font-weight: 600;
    color: #185FA5;
    flex-shrink: 0;
}
.forum-meta-category {
    background: #f4f4f1;
    border-radius: 5px;
    padding: 1px 7px;
    font-size: 11px;
    color: #888;
}

.action-row { display: flex; gap: 8px; }
.btn-approve {
    flex: 1;
    padding: 8px 0;
    border-radius: 8px;
    border: 0.5px solid #C0DD97;
    background: #EAF3DE;
    color: #3B6D11;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s, border-color 0.15s;
    font-family: inherit;
    letter-spacing: 0.02em;
}
.btn-approve:hover { background: #C0DD97; border-color: #97C459; }
.btn-reject {
    flex: 1;
    padding: 8px 0;
    border-radius: 8px;
    border: 0.5px solid #F7C1C1;
    background: #FCEBEB;
    color: #A32D2D;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s, border-color 0.15s;
    font-family: inherit;
    letter-spacing: 0.02em;
}
.btn-reject:hover { background: #F7C1C1; border-color: #F09595; }

/* ─── Right panel: komentar kasar ─── */
.comment-panel {
    background: #fff;
    border: 0.5px solid #e2e2dc;
    border-radius: 12px;
    overflow: hidden;
}
.comment-panel-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px;
    border-bottom: 0.5px solid #f0efea;
}
.comment-panel-head .section-label { margin: 0; }
.alert-icon {
    width: 28px; height: 28px;
    border-radius: 7px;
    background: #FCEBEB;
    display: flex;
    align-items: center;
    justify-content: center;
}
.alert-icon svg { width: 14px; height: 14px; stroke: #A32D2D; }

.comment-list { display: flex; flex-direction: column; }
.comment-item {
    padding: 12px 16px;
    border-bottom: 0.5px solid #f5f5f1;
    display: flex;
    flex-direction: column;
    gap: 7px;
    transition: background 0.12s;
}
.comment-item:last-child { border-bottom: none; }
.comment-item:hover { background: #fafaf8; }

.comment-header {
    display: flex;
    align-items: center;
    gap: 9px;
}
.avatar {
    width: 30px; height: 30px;
    border-radius: 50%;
    background: #FAECE7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 600;
    color: #993C1D;
    flex-shrink: 0;
}
.comment-author { font-size: 13px; font-weight: 500; color: #111; }
.comment-forum-link { font-size: 11px; color: #aaa; }
.comment-forum-link a { color: #185FA5; text-decoration: none; }
.comment-forum-link a:hover { text-decoration: underline; }
.flag-badge {
    margin-left: auto;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 2px 8px;
    border-radius: 10px;
    background: #FCEBEB;
    color: #A32D2D;
    white-space: nowrap;
    flex-shrink: 0;
}
.comment-body {
    font-size: 12px;
    color: #666;
    line-height: 1.55;
    padding-left: 39px;
}
.comment-body a { color: inherit; text-decoration: none; }

/* ─── Empty states ─── */
.empty-state {
    text-align: center;
    padding: 2.5rem 1.5rem;
    color: #bbb;
    font-size: 13px;
    border: 0.5px dashed #ddd;
    border-radius: 12px;
}
.empty-comment {
    padding: 2rem;
    text-align: center;
    font-size: 12px;
    color: #bbb;
    font-style: italic;
}
</style>

<section class="site-section bg-light">
    <div class="container">
        <div class="mod-page">

            {{-- ── Top bar ── --}}
            <div class="mod-topbar">
                <div class="mod-title-group">
                    <p class="mod-sub">Digital Content Curation Dashboard</p>
                    <h1>Panel Moderator</h1>
                </div>
                <div class="mod-topbar-actions">
                    <div class="mod-date-pill">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        {{ strtoupper(now()->format('F Y')) }}
                    </div>
                  
                </div>
            </div>

            {{-- ── Stats ── --}}
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon" style="background:#E6F1FB;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#185FA5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                            </svg>
                        </div>
                        <span class="stat-delta delta-neutral">+12 today</span>
                    </div>
                    <div class="stat-val">{{ $forums->count() }}</div>
                    <div class="stat-lbl">Menunggu Persetujuan</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon" style="background:#FCEBEB;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A32D2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                            </svg>
                        </div>
                        <span class="stat-delta delta-danger">High Priority</span>
                    </div>
                    <div class="stat-val" style="color:#A32D2D;">{{ $komentarKasarSemua->count() }}</div>
                    <div class="stat-lbl">Komentar Kasar</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon" style="background:#EAF3DE;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3B6D11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <span class="stat-delta delta-success">86% goal</span>
                    </div>
                    <div class="stat-val" style="color:#3B6D11;">{{ number_format($disetujuiBulanIni) }}</div>
                    <div class="stat-lbl">Disetujui Bulan Ini</div>
                </div>
            </div>

            {{-- ── Two-column body ── --}}
            <div class="mod-body">

                {{-- Left: Forum pending --}}
                <div>
                    <div class="section-head">
                        <span class="section-label">Forum menunggu persetujuan</span>
                        <a href="#" class="view-all-link">View all queue →</a>
                    </div>

                    @if ($forums->count() > 0)
                        <div class="forum-list">
                            @foreach ($forums as $forum)
                                @php
                                    $authorInitials = collect(explode(' ', $forum->user->name))
                                        ->map(fn($w) => strtoupper($w[0] ?? ''))
                                        ->take(2)->implode('');
                                @endphp
                                <div class="forum-card">
                                    <div class="forum-card-top">
                                        <span class="pending-badge">
                                            <span class="dot"></span>Pending
                                        </span>
                                        <span class="forum-time">{{ $forum->created_at->diffForHumans() }}</span>
                                    </div>

                                    <div class="forum-title">{{ $forum->judul }}</div>

                                    <div class="forum-meta">
                                        <div class="forum-meta-avatar">{{ $authorInitials }}</div>
                                        Oleh: {{ $forum->user->name }}
                                        <span style="color:#ddd;">·</span>
                                        <span class="forum-meta-category">{{ $forum->kategori->nama }}</span>
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
                </div>

                {{-- Right: Komentar kasar panel --}}
                <div>
                    <div class="comment-panel">
                        <div class="comment-panel-head">
                            <span class="section-label">Komentar kasar</span>
                            <div class="alert-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                                </svg>
                            </div>
                        </div>

                        @if ($komentarKasarSemua->count() > 0)
                            <div class="comment-list">
                                @foreach ($komentarKasarSemua as $komentar)
                                    @php
                                        $initials = collect(explode(' ', $komentar->user->name))
                                            ->map(fn($w) => strtoupper($w[0] ?? ''))
                                            ->take(2)->implode('');
                                    @endphp
                                    <div class="comment-item">
                                        <div class="comment-header">
                                            <div class="avatar">{{ $initials }}</div>
                                            <div>
                                                <div class="comment-author">{{ $komentar->user->name }}</div>
                                                <div class="comment-forum-link">
                                                    pada
                                                    <a href="{{ route('forum.show', $komentar->forum->id) }}">
                                                        {{ Str::limit($komentar->forum->judul, 30) }}
                                                    </a>
                                                </div>
                                            </div>
                                            <span class="flag-badge">Kasar</span>
                                        </div>
                                        <div class="comment-body">
                                            <a href="{{ route('forum.show', $komentar->forum->id) }}#komentar-{{ $komentar->id }}">
                                                "{{ Str::limit($komentar->isi, 110) }}"
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-comment">Tidak ada komentar kasar.</div>
                        @endif
                    </div>
                </div>

            </div>{{-- end mod-body --}}

        </div>
    </div>
</section>

@endsection