@extends('layouts.front')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<style>
    :root {
        --blue:       #1565c0;
        --blue2:      #1e88e5;
        --blue3:      #0288d1;
        --blue-dark:  #0d2f6e;
        --cyan:       #00b4d8;
        --white:      #ffffff;
        --bg:         #eef4fd;
        --card-bg:    #ffffff;
        --border:     #c5d8f5;
        --muted:      #6b8cba;
        --dark:       #0d1b3e;
        --mid:        #1e3a5f;
        --success:    #00897b;
        --grad:       linear-gradient(135deg, #1565c0 0%, #0288d1 60%, #00b4d8 100%);
        --grad-soft:  linear-gradient(135deg, #ddeeff 0%, #e8f5ff 100%);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'DM Sans', sans-serif;
        background: var(--bg);
        color: var(--dark);
    }

    /* ═══════════════════════════════
       HERO
    ═══════════════════════════════ */
    .hero {
        position: relative;
        min-height: 62vh;
        background-image: url('{{ asset("alumni/images/bg3.jpg") }}');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(13,47,110,.82) 0%, rgba(2,136,209,.55) 100%);
    }

    /* animated mesh blobs */
    .hero-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: .18;
        animation: blobFloat 8s ease-in-out infinite alternate;
    }
    .hero-blob-1 { width: 380px; height: 380px; background: #00b4d8; top: -80px; right: 10%; animation-delay: 0s; }
    .hero-blob-2 { width: 260px; height: 260px; background: #1e88e5; bottom: -40px; left: 15%; animation-delay: 3s; }

    @keyframes blobFloat {
        from { transform: translateY(0) scale(1); }
        to   { transform: translateY(-30px) scale(1.08); }
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 24px 60px;
        text-align: center;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.25);
        backdrop-filter: blur(8px);
        color: #90caf9;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 50px;
        margin-bottom: 20px;
    }

    .hero-eyebrow span { width: 6px; height: 6px; border-radius: 50%; background: #00b4d8; }

    .hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 14px;
        letter-spacing: -.02em;
    }

    .hero h1 em {
        font-style: normal;
        background: linear-gradient(90deg, #90caf9, #00e5ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-sub {
        color: rgba(255,255,255,.72);
        font-size: 1.05rem;
        margin-bottom: 36px;
    }

    /* ── Search bar ── */
    .search-wrapper {
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 16px;
        padding: 6px 6px 6px 6px;
        max-width: 860px;
        margin: 0 auto;
        box-shadow: 0 20px 60px rgba(13,47,110,.28);
        gap: 0;
    }

    .search-item {
        flex: 1;
        position: relative;
    }

    .search-item + .search-item {
        border-left: 1px solid var(--border);
    }

    .search-item input,
    .search-item select {
        width: 100%;
        border: none;
        outline: none;
        padding: 13px 16px;
        background: transparent;
        font-family: 'DM Sans', sans-serif;
        font-size: .93rem;
        color: var(--dark);
    }

    .search-item select { cursor: pointer; }
    .search-item input::placeholder { color: var(--muted); }

    .search-btn {
        background: var(--grad);
        color: white;
        border: none;
        padding: 13px 22px;
        border-radius: 12px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: .9rem;
        cursor: pointer;
        transition: opacity .2s, transform .2s;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 16px rgba(21,101,192,.35);
        flex-shrink: 0;
    }

    .search-btn:hover { opacity: .88; transform: translateY(-1px); }

    /* ── Hero stats strip ── */
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 36px;
    }

    .hero-stat { text-align: center; }

    .hero-stat-num {
        font-family: 'Sora', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }

    .hero-stat-label {
        font-size: .75rem;
        color: rgba(255,255,255,.6);
        margin-top: 4px;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .hero-stat-sep { width: 1px; background: rgba(255,255,255,.2); align-self: stretch; }

    /* scroll mouse */
    .mouse-wrap {
        position: absolute;
        bottom: 22px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
    }

    .mouse-icon {
        width: 24px; height: 38px;
        border: 2px solid rgba(255,255,255,.5);
        border-radius: 12px;
        position: relative;
        margin: 0 auto;
    }

    .mouse-wheel {
        width: 3px; height: 7px;
        background: #fff;
        position: absolute;
        top: 6px; left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
        animation: scrollWheel 1.6s ease-in-out infinite;
    }

    @keyframes scrollWheel {
        0%   { opacity: 1; top: 6px; }
        100% { opacity: 0; top: 18px; }
    }

    /* ═══════════════════════════════
       ANALYTICS BAR (below hero)
    ═══════════════════════════════ */
    .analytics-bar {
        background: var(--white);
        border-bottom: 1px solid var(--border);
        box-shadow: 0 2px 16px rgba(21,101,192,.06);
    }

    .analytics-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
    }

    .analytics-panel {
        padding: 24px 20px;
        position: relative;
    }

    .analytics-panel + .analytics-panel {
        border-left: 1px solid var(--border);
    }

    .analytics-panel-title {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .analytics-panel-title .pill {
        background: var(--grad-soft);
        color: var(--blue);
        font-size: .65rem;
        padding: 2px 8px;
        border-radius: 50px;
        border: 1px solid var(--border);
    }

    .chart-canvas-wrap {
        position: relative;
        height: 120px;
    }

    /* ═══════════════════════════════
       MAIN CONTENT
    ═══════════════════════════════ */
    .main-wrap {
        max-width: 1200px;
        margin: 36px auto;
        padding: 0 24px;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 28px;
    }

    /* ── Section header ── */
    .section-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .section-title {
        font-family: 'Sora', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
    }

    .section-count {
        font-size: .82rem;
        color: var(--muted);
        font-weight: 500;
    }

    /* ── Job cards grid ── */
    .jobs-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .job-card {
        background: var(--card-bg);
        border-radius: 14px;
        border: 1px solid var(--border);
        overflow: hidden;
        transition: transform .22s, box-shadow .22s, border-color .22s;
        display: flex;
        flex-direction: column;
    }

    .job-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(21,101,192,.13);
        border-color: var(--blue2);
    }

    .job-card-img {
        width: 100%;
        height: 148px;
        object-fit: cover;
        display: block;
    }

    .job-card-img-placeholder {
        height: 148px;
        background: linear-gradient(135deg, #c5d8f5 0%, #ddeeff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
    }

    .job-card-body {
        padding: 14px 16px 16px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .job-badge {
        display: inline-block;
        background: linear-gradient(90deg, #1565c0, #0288d1);
        color: #fff;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 4px;
        margin-bottom: 9px;
        align-self: flex-start;
    }

    .job-title {
        font-family: 'Sora', sans-serif;
        font-size: .96rem;
        font-weight: 700;
        line-height: 1.35;
        color: var(--dark);
        margin-bottom: 8px;
    }

    .job-meta {
        font-size: .78rem;
        color: var(--muted);
        display: flex;
        flex-direction: column;
        gap: 4px;
        margin-bottom: 12px;
    }

    .job-meta span { display: flex; align-items: center; gap: 5px; }

    .job-meta .salary { color: var(--success); font-weight: 600; }

    .job-btn {
        margin-top: auto;
        display: block;
        text-align: center;
        padding: 9px 14px;
        border-radius: 8px;
        font-size: .84rem;
        font-weight: 600;
        text-decoration: none;
        transition: .2s;
    }

    .job-btn-primary {
        background: var(--grad);
        color: #fff;
        box-shadow: 0 3px 12px rgba(21,101,192,.25);
    }

    .job-btn-primary:hover { opacity: .88; }

    .job-btn-outline {
        background: transparent;
        color: var(--blue);
        border: 1.5px solid var(--blue);
    }

    .job-btn-outline:hover { background: var(--grad-soft); }

    /* empty state */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: var(--muted);
    }

    .empty-state .empty-icon { font-size: 3rem; margin-bottom: 12px; }

    /* pagination */
    .pagination-wrap { margin-top: 28px; }

    /* ── SIDEBAR ── */
    .sidebar {}

    .sidebar-box {
        background: var(--card-bg);
        border-radius: 14px;
        border: 1px solid var(--border);
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 2px 12px rgba(21,101,192,.06);
    }

    .sidebar-hd {
        background: linear-gradient(90deg, #1565c0 0%, #0288d1 100%);
        color: #fff;
        padding: 13px 18px;
        font-family: 'Sora', sans-serif;
        font-size: .92rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sidebar-hd .hd-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: rgba(255,255,255,.55);
    }

    .sidebar-chart-wrap { padding: 16px 18px 18px; }

    /* custom chart legend */
    .chart-legend-list {
        display: flex;
        flex-direction: column;
        gap: 7px;
        margin-top: 12px;
    }

    .legend-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: .78rem;
        color: var(--mid);
    }

    .legend-swatch {
        width: 10px; height: 10px;
        border-radius: 2px;
        flex-shrink: 0;
    }

    .legend-label { flex: 1; }
    .legend-val { font-weight: 700; color: var(--blue); }

    /* stat cells */
    .stats-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1px;
        background: var(--border);
    }

    .stat-cell {
        background: var(--white);
        padding: 16px;
        text-align: center;
    }

    .stat-num {
        font-family: 'Sora', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--blue);
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: .68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--muted);
    }

    /* kategori list */
    .kat-list { padding: 6px 0; }

    .kat-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 18px;
        border-bottom: 1px solid var(--border);
        text-decoration: none;
        color: var(--dark);
        font-size: .86rem;
        font-weight: 600;
        transition: background .18s;
    }

    .kat-item:last-child { border-bottom: none; }
    .kat-item:hover { background: #ddeeff; color: var(--blue); }

    .kat-count {
        background: var(--grad-soft);
        color: var(--blue);
        font-size: .7rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 50px;
        border: 1px solid var(--border);
    }

    /* ── Responsive ── */
    @media (max-width: 960px) {
        .main-wrap { grid-template-columns: 1fr; }
        .sidebar { display: none; }
        .analytics-inner { grid-template-columns: 1fr; }
        .analytics-panel + .analytics-panel { border-left: none; border-top: 1px solid var(--border); }
    }

    @media (max-width: 600px) {
        .jobs-grid { grid-template-columns: 1fr; }
        .hero-stats { gap: 20px; }
        .search-wrapper { flex-direction: column; border-radius: 12px; }
        .search-item + .search-item { border-left: none; border-top: 1px solid var(--border); }
    }
</style>

{{-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ --}}
<section class="hero" id="home-section">
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>

    <div class="hero-inner">
        <div class="hero-eyebrow"><span></span> Portal Karir Alumni</div>

        <h1>Temukan <em>Karir Impian</em><br>untuk Alumni</h1>
        <p class="hero-sub">Ratusan lowongan terbaru dari perusahaan terpercaya — khusus untuk kamu</p>

        <form action="{{ route('lowongan.index') }}" method="GET">
            <div class="search-wrapper">
                <div class="search-item">
                    <input type="text" name="keyword" placeholder="🔍  Nama pekerjaan atau gaji…"
                        value="{{ request('keyword') }}">
                </div>
                <div class="search-item">
                    <select name="lokasi">
                        <option value="">📍  Semua Lokasi</option>
                        @foreach ($lokasiList as $lokasi)
                            <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>
                                {{ $lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="search-item">
                    <select name="kategori">
                        <option value="">🏷️  Semua Kategori</option>
                        @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="search-btn">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                    Cari
                </button>
            </div>
        </form>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-num">{{ $informasi_lokers->total() }}+</div>
                <div class="hero-stat-label">Lowongan Aktif</div>
            </div>
            <div class="hero-stat-sep"></div>
            <div class="hero-stat">
                <div class="hero-stat-num">{{ $kategoriList->count() }}</div>
                <div class="hero-stat-label">Kategori</div>
            </div>
            <div class="hero-stat-sep"></div>
            <div class="hero-stat">
                <div class="hero-stat-num">{{ count($lokasiList) }}</div>
                <div class="hero-stat-label">Kota</div>
            </div>
        </div>
    </div>

    <a href="#loker-section" class="mouse-wrap smoothscroll">
        <div class="mouse-icon"><div class="mouse-wheel"></div></div>
    </a>
</section>

{{-- ══════════════════════════════════════════════
     ANALYTICS BAR  (3 chart mini di bawah hero)
══════════════════════════════════════════════ --}}

@php
// ── Data chart ──────────────────────────────────────
// 1. Tren posting 7 hari
$trendDays = [];
foreach (range(6, 0) as $d) {
    $trendDays[] = [
        'day'   => now()->subDays($d)->locale('id')->isoFormat('dd'),
        'count' => rand(2, 18),   // ganti: Loker::whereDate('created_at', now()->subDays($d))->count()
    ];
}

// 2. Loker per kategori
$katData = $informasi_lokers->getCollection()
    ->groupBy('kategori_id')
    ->map(fn($g) => ['label' => $g->first()->kategori->nama ?? 'Lainnya', 'count' => $g->count()])
    ->values();

// 3. Loker per lokasi (top 6)
$lokasiData = $informasi_lokers->getCollection()
    ->groupBy('lokasi')
    ->map(fn($g, $k) => ['label' => $k ?: 'Lainnya', 'count' => $g->count()])
    ->sortByDesc('count')
    ->take(6)
    ->values();
@endphp




<div class="main-wrap" id="loker-section">

    {{-- FEED LOKER --}}
    <div>
        <div class="section-header">
            <div class="section-title">Informasi Lowongan Kerja</div>
            <div class="section-count">{{ $informasi_lokers->total() }} lowongan ditemukan</div>
        </div>

        <div class="jobs-grid">
            @forelse ($informasi_lokers as $loker)
            <div class="job-card">

                @if ($loker->foto)
                    <img src="{{ asset('storage/' . $loker->foto) }}" class="job-card-img" alt="{{ $loker->judul }}">
                @else
                    <div class="job-card-img-placeholder">💼</div>
                @endif

                <div class="job-card-body">
                    <span class="job-badge">{{ $loker->kategori->nama }}</span>

                    <div class="job-title">{{ Str::limit($loker->judul, 48) }}</div>

                    <div class="job-meta">
                        <span class="salary">
                            💰 {{ $loker->gaji ?? 'Gaji dirahasiakan' }}
                        </span>
                        <span>
                            📍 {{ $loker->lokasi }}
                        </span>
                        <span>
                            📋 {{ Str::limit($loker->persyaratan, 55) }}
                        </span>
                    </div>

                    @auth
                        <a href="{{ route('loker.show', $loker->id) }}" class="job-btn job-btn-primary">
                            Lihat Detail →
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="job-btn job-btn-outline"
                           onclick="return confirm('Anda harus login terlebih dahulu. Lanjut ke login?')">
                            Lihat Detail
                        </a>
                    @endauth
                </div>
            </div>

            @empty
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <p>Belum ada informasi lowongan kerja.</p>
            </div>
            @endforelse
        </div>

        <div class="pagination-wrap">
            {{ $informasi_lokers->links() }}
        </div>
    </div>

    
</div>

{{-- ══════════════════════════════════════════════
     CHART.JS SCRIPTS
══════════════════════════════════════════════ --}}


@endsection