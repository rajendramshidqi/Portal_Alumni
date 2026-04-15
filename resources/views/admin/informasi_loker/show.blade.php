@extends('layouts.front')

@section('title', 'Detail Lowongan Kerja')

@section('content')

    <div class="pg">
        <div class="wrap">

            {{-- TOPBAR --}}
            <div class="topbar">
                <a href="{{ url()->previous() }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            <div class="card">

                {{-- HERO IMAGE --}}
                <div class="hero">
                    @if ($loker->foto)
                        <img src="{{ asset('storage/' . $loker->foto) }}" alt="foto loker">
                    @else
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085" alt="default">
                    @endif
                </div>

                {{-- HEADER --}}
                <div class="job-header">
                    <div class="job-top">

                        <div>
                            <h1 class="job-title">{{ $loker->judul }}</h1>



                            <div>

                                <div class="post-time">
                                    Diposting {{ $loker->created_at->diffForHumans() }}
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                {{-- BODY --}}
                <div class="body">

                    {{-- INFO --}}
                    <div class="info-modern">
                        <div class="info-item">
                            <div class="info-icon">📅</div>
                            <div>
                                <div class="info-label">Tanggal Posting</div>
                                <div class="info-value">
                                    {{ $loker->created_at->format('d F Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">📁</div>
                            <div>
                                <div class="info-label">Kategori</div>
                                <div class="info-value">
                                    {{ $loker->kategori->nama }}
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">📍</div>
                            <div>
                                <div class="info-label">Lokasi</div>
                                <div class="info-value">
                                    {{ $loker->lokasi }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div>
                        <div class="section-title">Deskripsi pekerjaan</div>

                        <div class="desc-box">
                            {!! nl2br(e($loker->deskripsi ?? 'Deskripsi belum tersedia')) !!}
                        </div>
                    </div>




                </div>
            </div>
            <div class="back-wrapper">
                <a href="{{ url()->previous() ?? route('lowongan.index') }}" class="btn-back-pro">
                    <span class="icon">
                        <svg viewBox="0 0 24 24">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                    </span>
                    <span class="text">Kembali ke daftar</span>
                </a>
            </div>
        </div>
    </div>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* PAGE */
        .pg {
            background: #f1f5f9;
            min-height: 100vh;
            padding: 40px 15px;
            display: flex;
            justify-content: center;
        }

        .wrap {
            width: 100%;
            max-width: 800px;
        }

        /* TOPBAR */
        .topbar {
            margin-bottom: 15px;
        }

        .btn-back {
            font-size: 13px;
            text-decoration: none;
            color: #2563eb;
            font-weight: 500;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        /* HERO */
        .hero img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        /* HEADER */
        .job-header {
            padding: 25px;
        }

        .job-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .job-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }

        /* COMPANY */
        .job-company {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .company-icon {
            width: 38px;
            height: 38px;
            background: #e0edff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .company-name {
            font-weight: 600;
            color: #1e3a8a;
        }

        .post-time {
            font-size: 12px;
            color: #64748b;
        }

        /* BUTTON */
        .btn-save {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
        }

        /* BODY */
        .body {
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        /* INFO */
        .info-modern {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .info-item {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .info-icon {
            width: 36px;
            height: 36px;
            background: #eef4ff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-label {
            font-size: 11px;
            color: #64748b;
        }

        .info-value {
            font-weight: 600;
        }

        /* SECTION */
        .section-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: #0f172a;
        }

        /* DESC */
        .desc-box {
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
            line-height: 1.7;
            color: #334155;
        }

        /* INFO BOX */
        .info-box {
            background: #eef4ff;
            padding: 15px;
            border-radius: 12px;
        }

        .info-box-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        /* WRAPPER */
        .back-wrapper {
            margin-bottom: 18px;
        }

        /* BUTTON */
        .btn-back-pro {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            border-radius: 14px;
            background: white;
            border: 1px solid #e2e8f0;
            color: #2563eb;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        /* ICON */
        .btn-back-pro .icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: #eff6ff;
            transition: all 0.25s ease;
        }

        .btn-back-pro svg {
            width: 16px;
            height: 16px;
            stroke: #2563eb;
            fill: none;
            stroke-width: 2.5;
        }

        /* HOVER EFFECT */
        .btn-back-pro:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        }

        .btn-back-pro:hover svg {
            stroke: white;
        }

        .btn-back-pro:hover .icon {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-2px);
        }

        /* ACTIVE CLICK */
        .btn-back-pro:active {
            transform: scale(0.97);
        }
    </style>

@endsection
