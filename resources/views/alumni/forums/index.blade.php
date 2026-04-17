@extends('layouts.front')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --blue:        #1455b3;
    --blue2:       #1e88e5;
    --blue3:       #0288d1;
    --dark:        #09193a;
    --mid:         #1c3560;
    --muted:       #6b8cba;
    --bg:          #f0f4f9;
    --white:       #ffffff;
    --border:      rgba(197,216,245,.7);
    --border2:     #d0e2f7;
    --grad:        linear-gradient(135deg, #1455b3 0%, #0288d1 60%, #00b4d8 100%);
    --grad-soft:   linear-gradient(135deg, #ddeeff 0%, #eaf4ff 100%);
    --shadow-card: 0 2px 16px rgba(20,85,179,.08);
    --shadow-hover:0 8px 32px rgba(20,85,179,.16);
    --radius:      12px;
    --radius-sm:   8px;
    --sidebar-w:   220px;
    --right-w:     260px;
    --topbar-h:    56px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--dark); }

/* ══ TOPBAR ══ */
.topbar {
    position: fixed; top: 0; left: 0; right: 0; z-index: 300;
    height: var(--topbar-h); background: var(--white);
    border-bottom: 1px solid var(--border2);
    display: flex; align-items: center; padding: 0 20px; gap: 12px;
    box-shadow: 0 1px 8px rgba(20,85,179,.06);
}

.brand {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1rem; font-weight: 800;
    background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text; white-space: nowrap; letter-spacing: -.02em;
    flex-shrink: 0; width: calc(var(--sidebar-w) - 20px);
}

.topbar-search { flex: 1; max-width: 440px; position: relative; }

.topbar-search input {
    width: 100%; height: 34px; padding: 0 36px 0 14px;
    border: 1.5px solid var(--border2); border-radius: 50px; background: #f8fafd;
    font-family: 'Inter', sans-serif; font-size: .82rem; color: var(--dark);
    outline: none; transition: border-color .2s, box-shadow .2s;
}

.topbar-search input:focus { border-color: var(--blue2); background: var(--white); box-shadow: 0 0 0 3px rgba(30,136,229,.1); }
.topbar-search input::placeholder { color: var(--muted); }
.topbar-search .si { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--muted); pointer-events: none; }

.topbar-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }
.topbar-nav { display: flex; gap: 2px; align-items: center; }

.tnl {
    font-size: .76rem; font-weight: 600; color: var(--mid); text-decoration: none;
    padding: 5px 10px; border-radius: 50px; border: 1px solid transparent; transition: all .18s; white-space: nowrap;
}
.tnl:hover { color: var(--blue); background: rgba(20,85,179,.05); border-color: var(--border2); }
.tnl.active { color: var(--blue); background: rgba(20,85,179,.08); border-color: var(--border2); }

.btn-create {
    background: var(--grad); color: #fff; border: none; padding: 7px 16px; border-radius: 50px;
    font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: .76rem;
    cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 5px;
    box-shadow: 0 3px 12px rgba(20,85,179,.28); transition: opacity .2s, transform .18s; white-space: nowrap;
}
.btn-create:hover { opacity: .9; transform: translateY(-1px); }

/* ══ GRID LAYOUT — kunci: semua sidebar pakai sticky, bukan fixed ══ */
.page-shell {
    padding-top: var(--topbar-h);
    display: grid;
    grid-template-columns: var(--sidebar-w) 1fr var(--right-w);
    align-items: start;       /* penting: tiap kolom mulai dari atas */
    min-height: 100vh;
}

/* ══ LEFT SIDEBAR ══ */
.left-sidebar {
    position: sticky;
    top: var(--topbar-h);
    max-height: calc(100vh - var(--topbar-h));
    overflow-y: auto;
    background: var(--white);
    border-right: 1px solid var(--border2);
    padding: 14px 10px;
    display: flex; flex-direction: column; gap: 2px;
    scrollbar-width: none;
    /* TIDAK pakai height:100vh atau min-height yang memaksa sidebar memanjang ke bawah */
}
.left-sidebar::-webkit-scrollbar { display: none; }

.slabel { font-size: .6rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--muted); padding: 10px 8px 5px; }

.nav-item {
    display: flex; align-items: center; gap: 8px; padding: 8px 10px; border-radius: 7px;
    text-decoration: none; font-size: .81rem; font-weight: 500; color: var(--mid);
    transition: background .15s, color .15s; position: relative;
}
.nav-item:hover { background: rgba(20,85,179,.05); color: var(--blue); }
.nav-item.active { background: rgba(20,85,179,.09); color: var(--blue); font-weight: 600; }
.nav-item.active::before { content: ''; position: absolute; left: 0; top: 22%; bottom: 22%; width: 2.5px; border-radius: 0 3px 3px 0; background: var(--blue2); }
.nav-item svg { flex-shrink: 0; }

.nav-badge { margin-left: auto; background: #eaf4ff; color: var(--blue); border: 1px solid var(--border2); font-size: .6rem; font-weight: 700; padding: 1px 6px; border-radius: 50px; }

.sdiv { height: 1px; background: var(--border2); margin: 6px 4px; }

.scat {
    display: flex; align-items: center; gap: 7px; padding: 6px 10px; border-radius: 7px;
    text-decoration: none; font-size: .78rem; font-weight: 500; color: var(--mid);
    transition: background .15s, color .15s;
}
.scat:hover { background: rgba(20,85,179,.05); color: var(--blue); }
.scat.active { color: var(--blue); font-weight: 600; }
.scat-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--border2); flex-shrink: 0; }
.scat.active .scat-dot { background: var(--blue2); }
.scat-count { margin-left: auto; font-size: .65rem; color: var(--muted); }

/* ══ MAIN ══ */
.main-content { padding: 22px 20px; min-width: 0; }

.hero-banner {
    border-radius: var(--radius); background: var(--grad);
    padding: 26px 28px; margin-bottom: 18px; position: relative; overflow: hidden;
    animation: fadeUp .4s ease both;
}
.hero-banner::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(0,180,216,.22) 0%, transparent 70%); pointer-events: none; }
.hero-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.45rem; font-weight: 800; color: #fff; letter-spacing: -.02em; margin-bottom: 5px; position: relative; }
.hero-desc { font-size: .82rem; color: rgba(255,255,255,.75); line-height: 1.6; position: relative; }

.topic-tabs { display: flex; gap: 5px; margin-bottom: 16px; flex-wrap: wrap; }
.ttab { font-size: .7rem; font-weight: 600; padding: 5px 12px; border-radius: 50px; border: 1.5px solid var(--border2); background: var(--white); color: var(--mid); text-decoration: none; transition: all .18s; white-space: nowrap; }
.ttab:hover { color: var(--blue); border-color: var(--blue2); }
.ttab.active { color: #fff; background: var(--blue); border-color: var(--blue); }

.sec-hd { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
.sec-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: .88rem; font-weight: 700; color: var(--dark); }
.sec-all { font-size: .72rem; font-weight: 600; color: var(--blue2); text-decoration: none; }
.sec-all:hover { opacity: .75; }

.featured-card {
    background: var(--white); border: 1px solid var(--border2); border-radius: var(--radius);
    overflow: hidden; box-shadow: var(--shadow-card); text-decoration: none; color: inherit;
    display: block; margin-bottom: 20px; transition: box-shadow .22s, transform .22s; animation: fadeUp .4s ease both;
}
.featured-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-2px); }

.fc-img { position: relative; overflow: hidden; }
.fc-img img { width: 100%; height: 240px; object-fit: cover; display: block; transition: transform .5s; }
.featured-card:hover .fc-img img { transform: scale(1.03); }
.fc-img-ph { height: 240px; background: var(--grad); display: flex; align-items: center; justify-content: center; font-size: 3.5rem; }
.fc-img::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 70px; background: linear-gradient(to top, rgba(9,25,58,.3), transparent); }

.fc-body { padding: 18px 20px 20px; }
.fc-meta { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }

.tag { background: rgba(20,85,179,.08); color: #0c447c; font-size: .6rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; padding: 2px 8px; border-radius: 50px; border: 1px solid rgba(20,85,179,.12); display: inline-block; }

.time-chip { font-size: .69rem; color: var(--muted); display: flex; align-items: center; gap: 3px; }

.fc-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.15rem; font-weight: 800; color: var(--dark); letter-spacing: -.02em; margin-bottom: 8px; line-height: 1.28; transition: color .18s; }
.featured-card:hover .fc-title { color: var(--blue2); }

.fc-excerpt { font-size: .82rem; color: var(--mid); line-height: 1.6; opacity: .88; margin-bottom: 14px; }

.fc-footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--border); padding-top: 12px; }
.author-row { display: flex; align-items: center; gap: 7px; }
.author-avatar { width: 28px; height: 28px; border-radius: 50%; background: var(--grad); color: #fff; display: flex; align-items: center; justify-content: center; font-size: .65rem; font-weight: 700; box-shadow: 0 2px 6px rgba(20,85,179,.22); }
.author-name { font-size: .78rem; font-weight: 600; color: var(--mid); }
.meta-pill { display: flex; align-items: center; gap: 4px; font-size: .71rem; color: var(--muted); background: rgba(197,216,245,.3); border: 1px solid var(--border2); padding: 3px 9px; border-radius: 50px; }

.topic-list { background: var(--white); border: 1px solid var(--border2); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-card); margin-bottom: 20px; }

.topic-item {
    display: flex; align-items: flex-start; gap: 12px; padding: 14px 18px;
    border-bottom: 1px solid rgba(197,216,245,.4); text-decoration: none; color: inherit;
    transition: background .15s; animation: fadeUp .4s ease both;
}
.topic-item:last-child { border-bottom: none; }
.topic-item:hover { background: #f7faff; }
.topic-item:nth-child(1){animation-delay:.04s} .topic-item:nth-child(2){animation-delay:.08s} .topic-item:nth-child(3){animation-delay:.12s} .topic-item:nth-child(n+4){animation-delay:.16s}

.vote-col { display: flex; flex-direction: column; align-items: center; gap: 1px; min-width: 32px; flex-shrink: 0; padding-top: 3px; }
.vote-num { font-family: 'Plus Jakarta Sans', sans-serif; font-size: .95rem; font-weight: 700; color: var(--blue2); line-height: 1; }
.vote-label { font-size: .57rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--muted); }

.topic-thumb { width: 64px; height: 48px; object-fit: cover; border-radius: var(--radius-sm); flex-shrink: 0; border: 1px solid var(--border2); }
.topic-thumb-ph { width: 64px; height: 48px; border-radius: var(--radius-sm); flex-shrink: 0; background: linear-gradient(135deg, #ddeeff, #c5d8f5); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; border: 1px solid var(--border2); }

.topic-body { flex: 1; min-width: 0; }
.topic-tags { margin-bottom: 4px; }
.topic-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: .84rem; font-weight: 700; line-height: 1.35; color: var(--dark); margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; transition: color .15s; }
.topic-item:hover .topic-title { color: var(--blue2); }
.topic-excerpt { font-size: .74rem; color: var(--muted); margin-bottom: 6px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.topic-meta { display: flex; align-items: center; gap: 8px; font-size: .67rem; color: var(--muted); flex-wrap: wrap; }
.topic-meta-item { display: flex; align-items: center; gap: 3px; }
.meta-sep { opacity: .4; }
.mini-avatar { width: 18px; height: 18px; border-radius: 50%; background: var(--grad); color: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: .55rem; font-weight: 700; }

.empty-state { background: var(--white); border: 1.5px dashed var(--border2); border-radius: var(--radius); padding: 48px 28px; text-align: center; animation: fadeUp .4s ease both; }
.empty-icon { width: 60px; height: 60px; border-radius: 50%; background: var(--grad-soft); border: 1.5px solid var(--border2); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; color: var(--blue2); }
.empty-state h3 { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.05rem; font-weight: 700; color: var(--dark); margin-bottom: 6px; }
.empty-state h3 em { font-style: normal; background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.empty-state p { color: var(--muted); font-size: .84rem; line-height: 1.6; max-width: 320px; margin: 0 auto 20px; }

.btn-back { display: inline-block; background: var(--grad); color: #fff; padding: 8px 20px; border-radius: 50px; font-size: .82rem; font-weight: 600; text-decoration: none; box-shadow: 0 3px 12px rgba(20,85,179,.28); transition: opacity .2s, transform .18s; }
.btn-back:hover { opacity: .88; transform: translateY(-1px); }

.pagination-wrap { margin-top: 20px; }

/* ══ RIGHT SIDEBAR ══ */
.right-sidebar {
    position: sticky;
    top: var(--topbar-h);
    max-height: calc(100vh - var(--topbar-h));
    overflow-y: auto;
    padding: 22px 16px 22px 4px;
    display: flex; flex-direction: column; gap: 16px;
    scrollbar-width: none;
}
.right-sidebar::-webkit-scrollbar { display: none; }

.sbox { background: var(--white); border-radius: var(--radius); border: 1px solid var(--border2); box-shadow: var(--shadow-card); overflow: hidden; animation: fadeUp .4s ease both; }
.sbox:nth-child(1){animation-delay:.08s} .sbox:nth-child(2){animation-delay:.14s} .sbox:nth-child(3){animation-delay:.20s}

.sbox-hd { background: var(--grad); color: #fff; padding: 10px 16px; display: flex; align-items: center; gap: 8px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: .82rem; font-weight: 700; }
.hd-pip { width: 6px; height: 6px; border-radius: 50%; background: rgba(255,255,255,.5); }

.tr-list { padding: 3px 0; }
.tr-item { display: flex; align-items: flex-start; gap: 10px; padding: 10px 14px; border-bottom: 1px solid rgba(197,216,245,.4); text-decoration: none; color: var(--dark); transition: background .15s; }
.tr-item:last-child { border-bottom: none; }
.tr-item:hover { background: #f7faff; }
.tr-item:hover .tr-title { color: var(--blue2); }

.tr-num { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.2rem; font-weight: 800; color: var(--border2); line-height: 1; min-width: 22px; letter-spacing: -.04em; transition: color .15s; }
.tr-item:hover .tr-num { color: var(--blue2); }
.tr-body { flex: 1; min-width: 0; }
.tr-title { font-size: .77rem; font-weight: 600; line-height: 1.35; margin-bottom: 2px; transition: color .15s; }
.tr-meta { font-size: .67rem; color: var(--muted); }

.stats-2x2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1px; background: var(--border2); }
.stat-cell { background: var(--white); padding: 12px 10px; text-align: center; transition: background .15s; }
.stat-cell:hover { background: #f0f7ff; }
.stat-n { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.35rem; font-weight: 800; line-height: 1; margin-bottom: 3px; background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.stat-l { font-size: .59rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); }

.kat-row { display: flex; align-items: center; justify-content: space-between; padding: 9px 14px; border-bottom: 1px solid rgba(197,216,245,.4); text-decoration: none; font-size: .79rem; font-weight: 500; color: var(--dark); transition: background .15s, color .15s; }
.kat-row:last-child { border-bottom: none; }
.kat-row:hover { background: rgba(221,238,255,.5); color: var(--blue); }
.kat-badge { background: var(--grad-soft); color: var(--blue); border: 1px solid var(--border2); font-size: .62rem; font-weight: 700; padding: 1px 7px; border-radius: 50px; }

@keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }

@media (max-width: 1100px) { .page-shell{grid-template-columns:var(--sidebar-w) 1fr} .right-sidebar{display:none} }
@media (max-width: 760px) { .page-shell{grid-template-columns:1fr} .left-sidebar{display:none} .main-content{padding:14px} .topbar-nav{display:none} }
</style>

{{-- ══ TOPBAR ══ --}}
<header class="topbar">
    <div class="brand">Forum Alumni</div>
    <form class="topbar-search" method="GET" action="{{ route('forums.index') }}" id="sf">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari topik, berita, alumni…" autocomplete="off">
        <svg class="si" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
    </form>
    <div class="topbar-right">
        <nav class="topbar-nav">
            <a href="{{ url('/') }}" class="tnl">Home</a>
            <a href="{{ route('forums.index') }}" class="tnl {{ request()->routeIs('forums.*') ? 'active' : '' }}">Forum</a>
            <a href="{{ route('lowongan.index') }}" class="tnl {{ request()->routeIs('lowongan.*') ? 'active' : '' }}">Loker</a>
        </nav>
        <a href="{{ route('alumni.forums.dashboard') }}" class="btn-create">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 5v14M5 12h14"/></svg>
            Buat Postingan
        </a>
    </div>
</header>
<script>
document.addEventListener('DOMContentLoaded',function(){var i=document.querySelector('#sf input[name="q"]');if(i)i.addEventListener('keydown',function(e){if(e.key==='Enter'){e.preventDefault();document.getElementById('sf').submit();}});});
</script>

{{-- ══ GRID SHELL ══ --}}
<div class="page-shell">

    {{-- LEFT SIDEBAR — sticky, tidak nabrak footer --}}
    <aside class="left-sidebar">
        <span class="slabel">Navigasi</span>
        <a href="{{ url('/') }}" class="nav-item">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/><path d="M9 21V12h6v9"/></svg>
            Home
        </a>
        <a href="{{ route('forums.index') }}" class="nav-item {{ !request('kategori') ? 'active' : '' }}">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            Semua Topik
            <span class="nav-badge">{{ $forums->total() }}</span>
        </a>
        <a href="{{ route('lowongan.index') }}" class="nav-item {{ request()->routeIs('lowongan.*') ? 'active' : '' }}">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
            Lowongan Kerja
        </a>
        <div class="sdiv"></div>
        <span class="slabel">Kategori</span>
        @foreach ($forums->pluck('kategori')->unique('id') as $k)
            <a href="{{ route('forums.index', ['kategori' => $k->id]) }}" class="scat {{ request('kategori') == $k->id ? 'active' : '' }}">
                <span class="scat-dot"></span>
                {{ $k->nama }}
                <span class="scat-count">{{ $forums->where('kategori_id', $k->id)->count() }}</span>
            </a>
        @endforeach
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        <div class="hero-banner">
            <div class="hero-title">Forum Alumni</div>
            <p class="hero-desc">Bagikan ide, diskusi topik menarik, dan terhubung dengan sesama alumni di sini.</p>
        </div>

        @php
            $first     = $forums->first();
            $rest      = $forums->skip(1);
            $noResults = $forums->isEmpty() && request('q');
        @endphp

        <div class="topic-tabs">
            <a href="{{ route('forums.index') }}" class="ttab {{ !request('kategori') ? 'active' : '' }}">Semua</a>
            @foreach ($forums->pluck('kategori')->unique('id') as $k)
                <a href="{{ route('forums.index', ['kategori' => $k->id]) }}" class="ttab {{ request('kategori') == $k->id ? 'active' : '' }}">{{ $k->nama }}</a>
            @endforeach
        </div>

        @if ($noResults)
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/><line x1="8" y1="11" x2="14" y2="11" stroke-width="1.2" opacity=".5"/></svg>
                </div>
                <h3>Tidak ada hasil untuk <em>"{{ request('q') }}"</em></h3>
                <p>Coba gunakan kata kunci yang lebih umum, atau periksa ejaan pencarian kamu.</p>
                <a href="{{ route('forums.index') }}" class="btn-back">← Kembali ke semua topik</a>
            </div>
        @else
            @if ($first)
                <div class="sec-hd"><span class="sec-title">Unggulan</span></div>
                <a href="{{ route('forum.show', $first->id) }}" class="featured-card">
                    <div class="fc-img">
                        @if ($first->foto)<img src="{{ asset('storage/' . $first->foto) }}" alt="{{ $first->judul }}">
                        @else<div class="fc-img-ph">📰</div>@endif
                    </div>
                    <div class="fc-body">
                        <div class="fc-meta">
                            <span class="tag">{{ $first->kategori->nama ?? 'Forum' }}</span>
                            <span class="time-chip">
                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                {{ $first->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="fc-title">{{ $first->judul }}</div>
                        <p class="fc-excerpt">{{ Str::limit($first->isi, 155) }}</p>
                        <div class="fc-footer">
                            <div class="author-row">
                                <div class="author-avatar">{{ strtoupper(substr($first->user->name ?? 'A', 0, 1)) }}</div>
                                <span class="author-name">{{ $first->user->name ?? 'Anonim' }}</span>
                            </div>
                            <div class="meta-pill">
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                {{ $first->komentar->count() }} komentar
                            </div>
                        </div>
                    </div>
                </a>
            @endif

            @if ($rest->count() > 0)
                <div class="sec-hd">
                    <span class="sec-title">Diskusi Terbaru</span>
                    <a href="{{ route('forums.index') }}" class="sec-all">Lihat semua →</a>
                </div>
                <div class="topic-list">
                    @foreach ($rest as $f)
                        <a href="{{ route('forum.show', $f->id) }}" class="topic-item">
                            <div class="vote-col">
                                <span class="vote-num">{{ $f->komentar->count() }}</span>
                                <span class="vote-label">reply</span>
                            </div>
                            @if ($f->foto)<img src="{{ asset('storage/' . $f->foto) }}" class="topic-thumb" alt="">
                            @else<div class="topic-thumb-ph">📰</div>@endif
                            <div class="topic-body">
                                <div class="topic-tags"><span class="tag">{{ $f->kategori->nama ?? '-' }}</span></div>
                                <div class="topic-title">{{ $f->judul }}</div>
                                <div class="topic-excerpt">{{ Str::limit($f->isi, 90) }}</div>
                                <div class="topic-meta">
                                    <span class="topic-meta-item">
                                        <span class="mini-avatar">{{ strtoupper(substr($f->user->name ?? 'A', 0, 1)) }}</span>
                                        {{ $f->user->name ?? 'Anonim' }}
                                    </span>
                                    <span class="meta-sep">·</span>
                                    <span class="topic-meta-item">
                                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                        {{ $f->created_at->diffForHumans() }}
                                    </span>
                                    <span class="meta-sep">·</span>
                                    <span class="topic-meta-item">
                                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                        {{ $f->komentar->count() }} komentar
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="pagination-wrap">{{ $forums->links() }}</div>
    </main>

    {{-- RIGHT SIDEBAR — sticky, tidak nabrak footer --}}
    <aside class="right-sidebar">

        <div class="sbox">
            <div class="sbox-hd"><div class="hd-pip"></div> Trending Hari Ini</div>
            <div class="tr-list">
                @foreach ($forums->sortByDesc('search_count')->take(5) as $i => $f)
                    <a href="{{ route('forum.show', $f->id) }}" class="tr-item">
                        <div class="tr-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="tr-body">
                            <div class="tr-title">{{ Str::limit($f->judul, 48) }}</div>
                            <div class="tr-meta">{{ $f->kategori->nama ?? '-' }} · {{ $f->komentar->count() }} komentar</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="sbox">
            <div class="sbox-hd"><div class="hd-pip"></div> Statistik Forum</div>
            <div class="stats-2x2">
                <div class="stat-cell">
                    <div class="stat-n">{{ $forums->count() }}</div>
                    <div class="stat-l">Artikel</div>
                </div>
                <div class="stat-cell">
                    <div class="stat-n">{{ $forums->sum(fn($f) => $f->komentar->count()) }}</div>
                    <div class="stat-l">Komentar</div>
                </div>
                <div class="stat-cell">
                    <div class="stat-n">{{ $forums->pluck('user_id')->unique()->count() }}</div>
                    <div class="stat-l">Penulis</div>
                </div>
                <div class="stat-cell">
                    <div class="stat-n">{{ $forums->pluck('kategori_id')->unique()->count() }}</div>
                    <div class="stat-l">Kategori</div>
                </div>
            </div>
        </div>

    

    </aside>

</div>

@endsection