@extends('layouts.front')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════════════
   VARIABLES & RESET
═══════════════════════════════════════════════════ */
:root {
    --blue:        #1455b3;
    --blue2:       #1e88e5;
    --blue3:       #0288d1;
    --cyan:        #00b4d8;
    --dark:        #09193a;
    --mid:         #1c3560;
    --muted:       #6b8cba;
    --bg:          #e8f1fd;
    --white:       #ffffff;
    --surface:     rgba(255,255,255,.72);
    --surface2:    rgba(255,255,255,.9);
    --border:      rgba(197,216,245,.8);
    --border2:     #c5d8f5;
    --grad:        linear-gradient(135deg, #1455b3 0%, #0288d1 60%, #00b4d8 100%);
    --grad-soft:   linear-gradient(135deg, #ddeeff 0%, #eaf4ff 100%);
    --shadow-card: 0 4px 24px rgba(20,85,179,.10);
    --shadow-hover: 0 12px 40px rgba(20,85,179,.18);
    --radius:      14px;
    --radius-sm:   8px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--dark);
    min-height: 100vh;
}

body::before {
    content: '';
    position: fixed; inset: 0;
    background:
        radial-gradient(ellipse 80% 60% at 20% 10%, rgba(30,136,229,.12) 0%, transparent 60%),
        radial-gradient(ellipse 60% 50% at 80% 80%, rgba(0,180,216,.09) 0%, transparent 60%),
        linear-gradient(160deg, #ddeeff 0%, #f0f7ff 50%, #e8f2ff 100%);
    z-index: -1;
    pointer-events: none;
}

/* ═══════════════════════════════════════════════════
   TOPBAR
═══════════════════════════════════════════════════ */
.topbar {
    position: sticky;
    top: 0;
    z-index: 200;
    background: rgba(255,255,255,.78);
    backdrop-filter: blur(18px) saturate(180%);
    -webkit-backdrop-filter: blur(18px) saturate(180%);
    border-bottom: 1px solid var(--border);
    box-shadow: 0 1px 20px rgba(20,85,179,.07);
}

.topbar-inner {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 24px;
    height: 64px;
    display: flex;
    align-items: center;
    gap: 20px;
}

.brand {
    font-family: 'Sora', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    background: var(--grad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    white-space: nowrap;
    letter-spacing: -.03em;
    flex-shrink: 0;
}

.brand-sep {
    width: 1px;
    height: 24px;
    background: var(--border2);
    flex-shrink: 0;
}

/* ── NAV LINKS (BARU) ── */
.topbar-nav {
    display: flex;
    align-items: center;
    gap: 4px;
    flex-shrink: 0;
}

.nav-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: 'DM Sans', sans-serif;
    font-size: .82rem;
    font-weight: 600;
    color: var(--mid);
    text-decoration: none;
    padding: 7px 13px;
    border-radius: 50px;
    border: 1.5px solid transparent;
    transition: color .2s, background .2s, border-color .2s;
    white-space: nowrap;
}

.nav-link:hover {
    color: var(--blue);
    background: rgba(20,85,179,.06);
    border-color: var(--border2);
}

.nav-link.active {
    color: var(--blue);
    background: rgba(20,85,179,.08);
    border-color: var(--border2);
}

.nav-link svg { flex-shrink: 0; }

.nav-sep {
    width: 1px;
    height: 24px;
    background: var(--border2);
    flex-shrink: 0;
}
/* ── END NAV LINKS ── */

.search-field {
    flex: 1;
    position: relative;
    max-width: 480px;
}

.search-field input {
    width: 100%;
    padding: 10px 42px 10px 16px;
    border: 1.5px solid var(--border2);
    border-radius: 50px;
    background: rgba(255,255,255,.85);
    font-family: 'DM Sans', sans-serif;
    font-size: .9rem;
    color: var(--dark);
    outline: none;
    transition: border-color .2s, box-shadow .2s, background .2s;
}

.search-field input:focus {
    border-color: var(--blue2);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(30,136,229,.1);
}

.search-field input::placeholder { color: var(--muted); }

.search-field .si {
    position: absolute;
    right: 14px; top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    pointer-events: none;
    transition: color .2s;
}

.search-field input:focus ~ .si { color: var(--blue2); }

.topbar-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-left: auto;
}

.btn-search {
    background: var(--grad);
    color: #fff;
    border: none;
    padding: 9px 20px;
    border-radius: 50px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    font-size: .875rem;
    cursor: pointer;
    transition: opacity .2s, transform .2s, box-shadow .2s;
    box-shadow: 0 3px 14px rgba(20,85,179,.28);
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
}

.btn-search:hover {
    opacity: .9;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(20,85,179,.35);
}

/* ═══════════════════════════════════════════════════
   CATEGORY NAV
═══════════════════════════════════════════════════ */
.cat-nav {
    background: linear-gradient(90deg, #09193a 0%, #1455b3 55%, #0288d1 100%);
    overflow-x: auto;
    scrollbar-width: none;
}
.cat-nav::-webkit-scrollbar { display: none; }

.cat-nav-inner {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
}

.cat-nav a {
    color: rgba(255,255,255,.62);
    text-decoration: none;
    font-size: .78rem;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    padding: 12px 18px;
    display: block;
    white-space: nowrap;
    position: relative;
    transition: color .18s, background .18s;
}

.cat-nav a::after {
    content: '';
    position: absolute;
    bottom: 0; left: 50%; right: 50%;
    height: 2px;
    background: #fff;
    transition: left .2s, right .2s;
    border-radius: 2px 2px 0 0;
}

.cat-nav a:hover,
.cat-nav a.active {
    color: #fff;
    background: rgba(255,255,255,.1);
}

.cat-nav a:hover::after,
.cat-nav a.active::after {
    left: 12px;
    right: 12px;
}

/* ═══════════════════════════════════════════════════
   PAGE LAYOUT
═══════════════════════════════════════════════════ */
.page-wrap {
    max-width: 1240px;
    margin: 32px auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 1fr 316px;
    gap: 28px;
    align-items: start;
}

/* ═══════════════════════════════════════════════════
   EMPTY STATE
═══════════════════════════════════════════════════ */
.empty-state {
    background: var(--surface2);
    border: 1.5px dashed var(--border2);
    border-radius: var(--radius);
    padding: 56px 32px;
    text-align: center;
    animation: fadeUp .4s ease both;
    margin-bottom: 24px;
}

.empty-icon {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: var(--grad-soft);
    border: 1.5px solid var(--border2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: var(--blue2);
}

.empty-state h3 {
    font-family: 'Sora', sans-serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 8px;
    letter-spacing: -.02em;
}

.empty-state h3 em {
    font-style: normal;
    background: var(--grad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.empty-state p {
    color: var(--muted);
    font-size: .9rem;
    line-height: 1.6;
    max-width: 360px;
    margin: 0 auto 24px;
}

.btn-back {
    display: inline-block;
    background: var(--grad);
    color: #fff;
    padding: 9px 22px;
    border-radius: 50px;
    font-size: .875rem;
    font-weight: 600;
    text-decoration: none;
    transition: opacity .2s, transform .2s;
    box-shadow: 0 3px 14px rgba(20,85,179,.28);
}

.btn-back:hover {
    opacity: .88;
    transform: translateY(-1px);
}

/* ═══════════════════════════════════════════════════
   HERO STORY
═══════════════════════════════════════════════════ */
.main-story {
    border-radius: var(--radius);
    overflow: hidden;
    background: var(--surface2);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-card);
    margin-bottom: 24px;
    transition: transform .28s cubic-bezier(.34,1.56,.64,1), box-shadow .28s;
    display: block;
    text-decoration: none;
    color: inherit;
    animation: fadeUp .5s ease both;
}

.main-story:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.ms-img { position: relative; overflow: hidden; }

.ms-img img {
    width: 100%; height: 360px;
    object-fit: cover; display: block;
    transition: transform .5s ease;
}

.main-story:hover .ms-img img { transform: scale(1.03); }

.ms-img-ph {
    height: 360px;
    background: var(--grad);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
}

.ms-img::after {
    content: '';
    position: absolute; bottom: 0; left: 0; right: 0;
    height: 110px;
    background: linear-gradient(to top, rgba(9,25,58,.42), transparent);
    pointer-events: none;
}

.ms-body { padding: 22px 24px 24px; }

.story-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.tag {
    background: var(--grad);
    color: #fff;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 50px;
    display: inline-block;
}

.time-chip {
    font-size: .77rem;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 4px;
}

.main-story h2 {
    font-family: 'Sora', sans-serif;
    font-size: 1.72rem;
    font-weight: 700;
    line-height: 1.24;
    color: var(--dark);
    margin-bottom: 10px;
    letter-spacing: -.02em;
    transition: color .2s;
}

.main-story:hover h2 { color: var(--blue2); }

.ms-excerpt {
    color: var(--mid);
    font-size: .94rem;
    line-height: 1.65;
    opacity: .88;
}

.story-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 18px;
    padding-top: 16px;
    border-top: 1px solid var(--border);
}

.author { display: flex; align-items: center; gap: 9px; }

.avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: var(--grad);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .75rem;
    font-weight: 700;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(20,85,179,.25);
}

.author-name {
    font-size: .84rem;
    font-weight: 600;
    color: var(--mid);
}

.meta-chip {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: .79rem;
    color: var(--muted);
    background: var(--grad-soft);
    border: 1px solid var(--border2);
    padding: 4px 10px;
    border-radius: 50px;
}

/* ═══════════════════════════════════════════════════
   DIVIDER LABEL
═══════════════════════════════════════════════════ */
.divider-label {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.divider-label span {
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--muted);
    white-space: nowrap;
}

.divider-label::before,
.divider-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border2), transparent);
}

/* ═══════════════════════════════════════════════════
   SMALL GRID
═══════════════════════════════════════════════════ */
.small-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 24px;
}

.small-card {
    background: var(--surface2);
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: 0 2px 12px rgba(20,85,179,.06);
    text-decoration: none;
    color: inherit;
    display: block;
    transition: transform .22s cubic-bezier(.34,1.56,.64,1), box-shadow .22s;
    animation: fadeUp .5s ease both;
}

.small-card:nth-child(1) { animation-delay: .05s; }
.small-card:nth-child(2) { animation-delay: .10s; }
.small-card:nth-child(3) { animation-delay: .15s; }
.small-card:nth-child(4) { animation-delay: .20s; }

.small-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(20,85,179,.14);
}

.sc-img { position: relative; overflow: hidden; }

.sc-img img {
    width: 100%; height: 130px;
    object-fit: cover; display: block;
    transition: transform .4s ease;
}

.small-card:hover .sc-img img { transform: scale(1.06); }

.sc-img-ph {
    height: 130px;
    background: linear-gradient(135deg, #c5d8f5 0%, #ddeeff 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}

.sc-body { padding: 12px 14px 14px; }
.sc-body .tag { margin-bottom: 7px; }

.sc-body h6 {
    font-family: 'Sora', sans-serif;
    font-size: .9rem;
    font-weight: 700;
    line-height: 1.35;
    color: var(--dark);
    margin-bottom: 6px;
    letter-spacing: -.01em;
    transition: color .18s;
}

.small-card:hover h6 { color: var(--blue2); }

/* ═══════════════════════════════════════════════════
   LIST ITEMS
═══════════════════════════════════════════════════ */
.list-wrap { display: flex; flex-direction: column; }

.list-item {
    display: flex;
    gap: 14px;
    padding: 13px 8px;
    border-bottom: 1px solid rgba(197,216,245,.55);
    text-decoration: none;
    color: inherit;
    border-radius: 8px;
    transition: background .18s;
}

.list-item:last-child { border-bottom: none; }
.list-item:hover { background: rgba(255,255,255,.65); }
.list-item:hover .list-title { color: var(--blue2); }

.list-thumb {
    width: 80px; height: 60px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    flex-shrink: 0;
}

.list-thumb-ph {
    width: 80px; height: 60px;
    background: linear-gradient(135deg, #c5d8f5, #ddeeff);
    border-radius: var(--radius-sm);
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}

.list-body { flex: 1; min-width: 0; }

.list-title {
    font-family: 'Sora', sans-serif;
    font-size: .89rem;
    font-weight: 600;
    line-height: 1.35;
    margin-bottom: 5px;
    transition: color .18s;
}

.list-meta {
    font-size: .73rem;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}

.lm-sep { opacity: .4; }

.pagination-wrap { margin-top: 28px; }

/* ═══════════════════════════════════════════════════
   SIDEBAR
═══════════════════════════════════════════════════ */
.sidebar { display: flex; flex-direction: column; gap: 20px; }

.sbox {
    background: var(--surface2);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    animation: fadeUp .4s ease both;
}

.sbox:nth-child(1) { animation-delay: .10s; }
.sbox:nth-child(2) { animation-delay: .16s; }
.sbox:nth-child(3) { animation-delay: .22s; }

.sbox-hd {
    background: var(--grad);
    color: #fff;
    padding: 12px 18px;
    display: flex;
    align-items: center;
    gap: 9px;
    font-family: 'Sora', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    letter-spacing: -.01em;
}

.hd-pip {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: rgba(255,255,255,.5);
    box-shadow: 0 0 0 2px rgba(255,255,255,.2);
}

/* Trending */
.tr-list { padding: 4px 0; }

.tr-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 11px 18px;
    border-bottom: 1px solid rgba(197,216,245,.45);
    text-decoration: none;
    color: var(--dark);
    transition: background .18s;
}

.tr-item:last-child { border-bottom: none; }

.tr-item:hover {
    background: linear-gradient(90deg, rgba(221,238,255,.6), rgba(240,247,255,.3));
}

.tr-item:hover .tr-title { color: var(--blue2); }

.tr-num {
    font-family: 'Sora', sans-serif;
    font-size: 1.35rem;
    font-weight: 800;
    color: var(--border2);
    line-height: 1;
    min-width: 26px;
    letter-spacing: -.04em;
    transition: color .18s;
}

.tr-item:hover .tr-num { color: var(--blue2); }

.tr-body { flex: 1; min-width: 0; }

.tr-title {
    font-size: .83rem;
    font-weight: 600;
    line-height: 1.35;
    margin-bottom: 3px;
    transition: color .18s;
}

.tr-meta { font-size: .71rem; color: var(--muted); }

/* Statistik */
.stats-2x2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--border2);
}

.stat-cell {
    background: var(--white);
    padding: 15px 12px;
    text-align: center;
    transition: background .18s;
}

.stat-cell:hover { background: #f0f7ff; }

.stat-n {
    font-family: 'Sora', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 4px;
    background: var(--grad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-l {
    font-size: .63rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: var(--muted);
}

/* Kategori */
.kat-list { padding: 4px 0; }

.kat-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 18px;
    border-bottom: 1px solid rgba(197,216,245,.45);
    text-decoration: none;
    color: var(--dark);
    font-size: .84rem;
    font-weight: 500;
    transition: background .18s, color .18s;
}

.kat-row:last-child { border-bottom: none; }

.kat-row:hover {
    background: rgba(221,238,255,.55);
    color: var(--blue);
}

.kat-badge {
    background: var(--grad-soft);
    color: var(--blue);
    border: 1px solid var(--border2);
    font-size: .67rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 50px;
}

/* ═══════════════════════════════════════════════════
   ANIMATIONS & RESPONSIVE
═══════════════════════════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 960px) {
    .page-wrap { grid-template-columns: 1fr; }
    .sidebar { display: none; }
}

@media (max-width: 700px) {
    .topbar-nav { display: none; }
    .nav-sep    { display: none; }
}

@media (max-width: 600px) {
    .small-grid { grid-template-columns: 1fr; }
    .main-story h2 { font-size: 1.38rem; }
    .brand, .brand-sep { display: none; }
    .ms-img img { height: 220px; }
}
</style>

{{-- ══ TOPBAR ══ --}}
<div class="topbar">
    <div class="topbar-inner">
        <div class="brand">Forum Alumni</div>
        <div class="brand-sep"></div>

        {{-- NAV LINKS (BARU) --}}
        <nav class="topbar-nav">
            <a href="{{ url('/') }}" class="nav-link">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
                Home
            </a>
            <a href="{{ route('forums.index') }}" class="nav-link {{ request()->routeIs('forums.*') ? 'active' : '' }}">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                Forum
            </a>
            <a href="{{ route('lowongan.index') }}" class="nav-link {{ request()->routeIs('lowongan.*') ? 'active' : '' }}">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2"/>
                    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                </svg>
                Loker
            </a>
        </nav>
        <div class="nav-sep"></div>
        {{-- END NAV LINKS --}}

        <form class="search-field" method="GET" action="{{ route('forums.index') }}" id="sf">
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Cari berita, topik, atau alumni…" autocomplete="off">
            <svg class="si" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
        </form>

        <div class="topbar-actions">
            <button class="btn-search" type="submit" form="sf">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                Cari
            </button>
        </div>
    </div>
</div>

{{-- ── Enter-to-search (BARU) ── --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var input = document.querySelector('#sf input[name="q"]');
        if (input) {
            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('sf').submit();
                }
            });
        }
    });
</script>

{{-- ══ CATEGORY NAV ══ --}}
<nav class="cat-nav">
    <div class="cat-nav-inner">
        <a href="{{ route('forums.index') }}" class="{{ !request('kategori') ? 'active' : '' }}">Semua</a>
        @foreach ($forums->pluck('kategori')->unique('id') as $k)
            <a href="{{ route('forums.index', ['kategori' => $k->id]) }}"
               class="{{ request('kategori') == $k->id ? 'active' : '' }}">
                {{ $k->nama }}
            </a>
        @endforeach
    </div>
</nav>

{{-- ══ MAIN ══ --}}
<div class="page-wrap">

    {{-- FEED --}}
    <div>
        @php
            $first     = $forums->first();
            $rest      = $forums->skip(1);
            $noResults = $forums->isEmpty() && request('q');
        @endphp

        {{-- Empty State --}}
        @if ($noResults)

            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.4">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                        <line x1="8" y1="11" x2="14" y2="11" stroke-width="1.2" opacity=".5"/>
                    </svg>
                </div>
                <h3>Tidak ada hasil untuk <em>"{{ request('q') }}"</em></h3>
                <p>Coba gunakan kata kunci yang lebih umum, atau periksa ejaan pencarian kamu.</p>
                <a href="{{ route('forums.index') }}" class="btn-back">← Kembali ke semua topik</a>
            </div>

        @else

            {{-- Hero Story --}}
            @if ($first)
                <a href="{{ route('forum.show', $first->id) }}" class="main-story">
                    <div class="ms-img">
                        @if ($first->foto)
                            <img src="{{ asset('storage/' . $first->foto) }}" alt="{{ $first->judul }}">
                        @else
                            <div class="ms-img-ph">📰</div>
                        @endif
                    </div>
                    <div class="ms-body">
                        <div class="story-meta">
                            <span class="tag">{{ $first->kategori->nama ?? 'Forum' }}</span>
                            <span class="time-chip">
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                                </svg>
                                {{ $first->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <h2>{{ $first->judul }}</h2>
                        <p class="ms-excerpt">{{ Str::limit($first->isi, 185) }}</p>
                        <div class="story-footer">
                            <div class="author">
                                <div class="avatar">{{ strtoupper(substr($first->user->name ?? 'A', 0, 1)) }}</div>
                                <span class="author-name">{{ $first->user->name ?? 'Anonim' }}</span>
                            </div>
                            <div class="meta-chip">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                </svg>
                                {{ $first->komentar->count() }} komentar
                            </div>
                        </div>
                    </div>
                </a>
            @endif

            {{-- Small Grid --}}
            @if ($rest->count() >= 2)
                <div class="divider-label"><span>Berita Terbaru</span></div>
                <div class="small-grid">
                    @foreach ($rest->take(4) as $f)
                        <a href="{{ route('forum.show', $f->id) }}" class="small-card">
                            <div class="sc-img">
                                @if ($f->foto)
                                    <img src="{{ asset('storage/' . $f->foto) }}" alt="{{ $f->judul }}">
                                @else
                                    <div class="sc-img-ph">📰</div>
                                @endif
                            </div>
                            <div class="sc-body">
                                <span class="tag">{{ $f->kategori->nama ?? '-' }}</span>
                                <h6>{{ Str::limit($f->judul, 65) }}</h6>
                                <span class="time-chip">
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                                    </svg>
                                    {{ $f->created_at->diffForHumans() }} · {{ $f->komentar->count() }} komentar
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- List --}}
            @if ($rest->count() > 4)
                <div class="divider-label"><span>Lebih Banyak</span></div>
                <div class="list-wrap">
                    @foreach ($rest->skip(4) as $f)
                        <a href="{{ route('forum.show', $f->id) }}" class="list-item">
                            @if ($f->foto)
                                <img src="{{ asset('storage/' . $f->foto) }}" class="list-thumb" alt="">
                            @else
                                <div class="list-thumb-ph">📰</div>
                            @endif
                            <div class="list-body">
                                <div class="list-title">{{ Str::limit($f->judul, 90) }}</div>
                                <div class="list-meta">
                                    <span class="tag" style="font-size:.61rem;padding:2px 7px;">{{ $f->kategori->nama ?? '-' }}</span>
                                    <span class="lm-sep">·</span>
                                    {{ $f->created_at->diffForHumans() }}
                                    <span class="lm-sep">·</span>
                                    {{ $f->komentar->count() }} komentar
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        @endif {{-- end noResults --}}

        <div class="pagination-wrap">{{ $forums->links() }}</div>
    </div>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        {{-- Trending --}}
        <div class="sbox">
            <div class="sbox-hd"><div class="hd-pip"></div> Trending Hari Ini</div>
            <div class="tr-list">
                @foreach ($forums->sortByDesc('search_count')->take(5) as $i => $f)
                    <a href="{{ route('forum.show', $f->id) }}" class="tr-item">
                        <div class="tr-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="tr-body">
                            <div class="tr-title">{{ Str::limit($f->judul, 52) }}</div>
                            <div class="tr-meta">{{ $f->kategori->nama ?? '-' }} · {{ $f->komentar->count() }} komentar</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Statistik --}}
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

        {{-- Kategori --}}
        <div class="sbox">
            <div class="sbox-hd"><div class="hd-pip"></div> Kategori</div>
            <div class="kat-list">
                @foreach ($forums->pluck('kategori')->unique('id') as $k)
                    <a href="{{ route('forums.index', ['kategori' => $k->id]) }}" class="kat-row">
                        🏷️ {{ $k->nama }}
                        <span class="kat-badge">{{ $forums->where('kategori_id', $k->id)->count() }}</span>
                    </a>
                @endforeach
            </div>
        </div>

    </aside>
</div>

@endsection