@extends('layouts.front')

@section('title', 'Detail Lowongan Kerja')

@section('content')

<div class="pg">
    <div class="wrap">

        {{-- TOPBAR --}}
        <div class="topbar">
            <a href="{{ url()->previous() }}" class="btn-back">
                <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                <span>Kembali ke daftar loker</span>
            </a>
        </div>

        {{-- CARD UTAMA --}}
        <div class="card">

            {{-- HEADER --}}
            <div class="hdr">
                <div class="hdr-title">{{ $loker->judul }}</div>
                <div class="badges">
                    <span class="badge badge-cat">
                        <svg viewBox="0 0 24 24"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/></svg>
                        {{ $loker->kategori->nama }}
                    </span>
                    <span class="badge badge-loc">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $loker->lokasi }}
                    </span>
                </div>
            </div>

            <div class="body">

                {{-- DESKRIPSI --}}
                <div>
                    <div class="sec">
                        <span class="sec-lbl">Deskripsi pekerjaan</span>
                        <div class="sec-line"></div>
                    </div>
                    <div class="desc-box">
                        <div class="desc-text">
                            {!! e($loker->deskripsi ?? 'Deskripsi belum tersedia') !!}
                        </div>
                    </div>
                </div>

                {{-- INFO GRID --}}
                <div>
                    <div class="sec">
                        <span class="sec-lbl">Informasi lowongan</span>
                        <div class="sec-line"></div>
                    </div>
                    <div class="info-grid">
                        <div class="ibox">
                            <div class="ibox-lbl">
                                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                Tanggal posting
                            </div>
                            <div class="ibox-val">{{ $loker->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="ibox">
                            <div class="ibox-lbl">
                                <svg viewBox="0 0 24 24"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/></svg>
                                Kategori
                            </div>
                            <div class="ibox-val">{{ $loker->kategori->nama }}</div>
                        </div>
                    </div>
                </div>

                {{-- CATATAN FITUR BELUM TERSEDIA --}}
                <div class="soon-box">
                    <div class="soon-icon">
                        <svg viewBox="0 0 24 24" width="20" height="20"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div>
                        <div class="soon-title">Fitur lamaran segera hadir</div>
                        <div class="soon-sub">Tombol melamar, batas waktu, dan detail lokasi akan tersedia setelah fitur ini selesai dikembangkan.</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

.pg {
    background: #f0f6ff;
    min-height: 100vh;
    padding: 2rem 1rem;
    display: flex;
    justify-content: center;
}

.wrap {
    width: 100%;
    max-width: 720px;
}

/* ── TOPBAR ── */
.topbar {
    display: flex;
    align-items: center;
    margin-bottom: 1.2rem;
}

.btn-back {
    display: flex;
    align-items: center;
    gap: 7px;
    background: #fff;
    border: 0.5px solid #cfe2ff;
    border-radius: 12px;
    padding: 9px 16px;
    font-size: 13px;
    font-weight: 500;
    color: #2563eb;
    cursor: pointer;
    text-decoration: none;
    transition: all .15s;
}
.btn-back:hover { background: #e8f1ff; color: #2563eb; }
.btn-back svg {
    width: 15px;
    height: 15px;
    stroke: #2563eb;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

/* ── CARD ── */
.card {
    background: #fff;
    border-radius: 24px;
    border: 0.5px solid #cfe2ff;
    overflow: hidden;
    box-shadow: none;
}

/* ── HEADER ── */
.hdr {
    background: #e8f1ff;
    padding: 2rem;
    border-bottom: 0.5px solid #cfe2ff;
}
.hdr-title {
    font-size: 20px;
    font-weight: 500;
    color: #0c3586;
    margin-bottom: 1rem;
    line-height: 1.4;
}
.badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}
.badge-cat {
    background: #d4e6ff;
    color: #0c3586;
    border: 0.5px solid #b8d3f4;
}
.badge-loc {
    background: #dbeafe;
    color: #185fa5;
    border: 0.5px solid #90c4f8;
}
.badge svg {
    width: 12px;
    height: 12px;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
.badge-cat svg { stroke: #0c3586; }
.badge-loc svg { stroke: #185fa5; }

/* ── BODY ── */
.body {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* ── SECTION LABEL ── */
.sec {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: .8rem;
}
.sec-line {
    flex: 1;
    height: 0.5px;
    background: #daeaff;
}
.sec-lbl {
    font-size: 11px;
    font-weight: 500;
    color: #6b97d4;
    text-transform: uppercase;
    letter-spacing: .7px;
    white-space: nowrap;
}

/* ── DESKRIPSI ── */
.desc-box {
    background: #f8fbff;
    border-radius: 14px;
    border: 0.5px solid #cfe2ff;
    padding: 1.25rem 1.5rem;
}
.desc-text {
    font-size: 14px;
    color: #1e3a8a;
    line-height: 1.8;
    white-space: pre-line;
    text-align: justify;
}

/* ── INFO GRID ── */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.ibox {
    background: #f0f6ff;
    border-radius: 12px;
    border: 0.5px solid #cfe2ff;
    padding: 14px 16px;
    transition: all .2s;
}
.ibox:hover { background: #e8f1ff; }
.ibox-lbl {
    font-size: 11px;
    color: #6b97d4;
    font-weight: 500;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.ibox-lbl svg {
    width: 12px;
    height: 12px;
    stroke: #6b97d4;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
.ibox-val {
    font-size: 14px;
    font-weight: 500;
    color: #0c3586;
}

/* ── SOON BOX ── */
.soon-box {
    background: #f0f6ff;
    border-radius: 14px;
    border: 0.5px solid #cfe2ff;
    padding: 1.1rem 1.4rem;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}
.soon-icon {
    flex-shrink: 0;
    margin-top: 1px;
}
.soon-icon svg {
    stroke: #6b97d4;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
.soon-title {
    font-size: 13px;
    font-weight: 500;
    color: #0c3586;
    margin-bottom: 3px;
}
.soon-sub {
    font-size: 12px;
    color: #6b97d4;
    line-height: 1.6;
}

/* ── RESPONSIVE ── */
@media (max-width: 500px) {
    .info-grid { grid-template-columns: 1fr; }
    .hdr-title { font-size: 17px; }
    .pg { padding: 1.5rem .75rem; }
    .btn-back span { display: none; }
    .hdr, .body { padding: 1.25rem; }
}
</style>

@endsection