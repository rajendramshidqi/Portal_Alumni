@extends('layouts.front')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* ─── Tokens ──────────────────────────────── */
        :root {
            --blue: #1e6fff;
            --blue-dark: #1458d6;
            --blue-light: #e8f1ff;
            --blue-mid: #c2d9ff;
            --ink: #0f1d35;
            --ink-soft: #546180;
            --border: #dce8fb;
            --surface: #f5f8ff;
            --white: #ffffff;
            --radius: 14px;
            --radius-lg: 20px;
            --shadow-xs: 0 2px 8px rgba(30, 111, 255, .08);
            --shadow-sm: 0 4px 20px rgba(30, 111, 255, .12);
            --shadow-md: 0 10px 40px rgba(30, 111, 255, .15);
            --font: 'Plus Jakarta Sans', sans-serif;
            --ease: .28s cubic-bezier(.4, 0, .2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font);
            color: var(--ink);
            background: var(--white);
        }

        img {
            display: block;
            max-width: 100%;
        }

        a {
            text-decoration: none;
        }

        /* ─── Shared ──────────────────────────────── */
        .tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--blue);
            background: var(--blue-light);
            padding: 5px 13px;
            border-radius: 99px;
            border: 1px solid var(--blue-mid);
        }

        .tag::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--blue);
        }

        .sec-title {
            font-size: clamp(1.7rem, 3.5vw, 2.4rem);
            font-weight: 800;
            line-height: 1.15;
            color: var(--ink);
        }

        .sec-title span {
            color: var(--blue);
        }

        .sec-sub {
            font-size: .95rem;
            color: var(--ink-soft);
            line-height: 1.75;
        }

        /* ══════════════════════════════════════════
           HERO
        ══════════════════════════════════════════ */
        .hero {
            position: relative;
            background: linear-gradient(160deg, #1458d6 0%, #1e6fff 55%, #4a9dff 100%);
            padding: 100px 0 0;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, rgba(255, 255, 255, .13) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
        }

        .hero-eyebrow {
            font-size: .73rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .65);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .hero-eyebrow::before {
            content: '';
            width: 26px;
            height: 2px;
            background: rgba(255, 255, 255, .45);
            display: block;
        }

        .hero-heading {
            font-size: clamp(2.4rem, 5.5vw, 4rem);
            font-weight: 800;
            line-height: 1.1;
            color: #fff;
            margin-bottom: 20px;
        }

        .hero-heading em {
            font-style: normal;
            background: linear-gradient(90deg, #fff 0%, #a8d4ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1rem;
            color: rgba(255, 255, 255, .75);
            line-height: 1.75;
            max-width: 460px;
            margin-bottom: 36px;
        }

        .hero-btns {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-white {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--blue);
            font-weight: 700;
            font-size: .88rem;
            padding: 13px 26px;
            border-radius: 99px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, .12);
            transition: var(--ease);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(0, 0, 0, .18);
            color: var(--blue-dark);
        }

        .btn-outline-white {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .12);
            color: #fff;
            font-weight: 600;
            font-size: .88rem;
            padding: 13px 26px;
            border-radius: 99px;
            border: 1.5px solid rgba(255, 255, 255, .35);
            backdrop-filter: blur(8px);
            transition: var(--ease);
        }

        .btn-outline-white:hover {
            background: rgba(255, 255, 255, .22);
            color: #fff;
        }

        .hero-img-col {
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .hero-img-wrap {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        .hero-img-wrap img {
            width: 100%;
            border-radius: 24px 24px 0 0;
            box-shadow: 0 -8px 60px rgba(0, 0, 0, .2);
        }

        .hero-wave {
            position: relative;
            z-index: 1;
            line-height: 0;
            margin-top: -2px;
        }

        .hero-wave svg {
            display: block;
            width: 100%;
            height: 64px;
        }


        /* ══════════════════════════════════════════
           ABOUT
        ══════════════════════════════════════════ */
        .about-section {
            padding: 96px 0 80px;
            background: var(--white);
        }

        .about-img-wrap {
            position: relative;
        }

        .about-img-wrap img {
            border-radius: var(--radius-lg);
            width: 100%;
            box-shadow: var(--shadow-md);
        }

        .about-img-wrap::before {
            content: '';
            position: absolute;
            inset: -12px -12px auto auto;
            width: 130px;
            height: 130px;
            border-top: 3px solid var(--blue-mid);
            border-right: 3px solid var(--blue-mid);
            border-radius: 0 var(--radius-lg) 0 0;
            pointer-events: none;
        }

        .feature-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 28px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            font-size: .92rem;
            color: var(--ink-soft);
            line-height: 1.55;
        }

        .fi-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            background: var(--blue-light);
            color: var(--blue);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
        }


        /* ══════════════════════════════════════════
           LOKER
        ══════════════════════════════════════════ */
        .loker-section {
            padding: 88px 0 96px;
            background: var(--surface);
        }

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-bottom: 44px;
        }

        .filter-pill {
            font-size: .8rem;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 99px;
            border: 1.5px solid var(--border);
            background: var(--white);
            color: var(--ink-soft);
            cursor: pointer;
            transition: var(--ease);
        }

        .filter-pill:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        .filter-pill.active {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
        }

        .job-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
            transition: var(--ease);
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--blue-mid);
        }

        .job-thumb {
            height: 152px;
            overflow: hidden;
            background: var(--blue-light);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .job-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s;
        }

        .job-card:hover .job-thumb img {
            transform: scale(1.05);
        }

        .job-thumb-icon {
            font-size: 2.4rem;
            color: var(--blue-mid);
        }

        .job-cat-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            background: rgba(255, 255, 255, .92);
            color: var(--blue);
            padding: 4px 10px;
            border-radius: 99px;
            border: 1px solid var(--blue-mid);
        }

        .job-body {
            padding: 1.1rem 1.2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .job-open {
            font-size: .7rem;
            font-weight: 700;
            color: #22c55e;
            letter-spacing: .06em;
        }

        .job-title {
            font-size: .97rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.35;
        }

        .job-row {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .8rem;
            color: var(--ink-soft);
        }

        .job-row i {
            color: var(--blue);
            font-size: .8rem;
        }

        .job-foot {
            padding: .9rem 1.2rem 1.2rem;
        }

        .btn-detail {
            display: block;
            width: 100%;
            padding: .7rem;
            text-align: center;
            border-radius: var(--radius);
            font-size: .83rem;
            font-weight: 700;
            background: var(--blue);
            color: #fff;
            transition: var(--ease);
        }

        .btn-detail:hover {
            background: var(--blue-dark);
            color: #fff;
        }

        .btn-detail.ghost {
            background: var(--white);
            border: 1.5px solid var(--blue);
            color: var(--blue);
        }

        .btn-detail.ghost:hover {
            background: var(--blue-light);
        }

        .see-all-wrap {
            text-align: center;
            margin-top: 48px;
        }

        .btn-see-all {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: .88rem;
            font-weight: 700;
            color: var(--blue);
            background: var(--white);
            border: 1.5px solid var(--blue-mid);
            padding: 12px 28px;
            border-radius: 99px;
            box-shadow: var(--shadow-xs);
            transition: var(--ease);
        }

        .btn-see-all:hover {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
        }

        .btn-see-all i {
            transition: transform var(--ease);
        }

        .btn-see-all:hover i {
            transform: translateX(4px);
        }


        /* ══════════════════════════════════════════
           FORUM
        ══════════════════════════════════════════ */
        .forum-section {
            padding: 88px 0 96px;
            background: var(--white);
            border-top: 1px solid var(--border);
        }

        .forum-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
            transition: var(--ease);
        }

        .forum-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--blue-mid);
        }

        .forum-thumb {
            height: 170px;
            overflow: hidden;
            background: var(--blue-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .forum-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s;
        }

        .forum-card:hover .forum-thumb img {
            transform: scale(1.05);
        }

        .forum-thumb-icon {
            font-size: 2.6rem;
            color: var(--blue-mid);
        }

        .forum-body {
            padding: 1.2rem 1.3rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .forum-kat {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--blue);
        }

        .forum-title {
            font-size: .97rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.35;
        }

        .forum-author {
            font-size: .78rem;
            color: var(--ink-soft);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .forum-excerpt {
            font-size: .83rem;
            color: var(--ink-soft);
            line-height: 1.65;
            flex: 1;
        }

        .forum-foot {
            padding: .9rem 1.3rem 1.3rem;
        }

        .btn-forum {
            display: block;
            width: 100%;
            padding: .7rem;
            text-align: center;
            border-radius: var(--radius);
            font-size: .83rem;
            font-weight: 700;
            border: 1.5px solid var(--blue);
            color: var(--blue);
            background: var(--white);
            transition: var(--ease);
        }

        .btn-forum:hover {
            background: var(--blue);
            color: #fff;
        }

        .btn-forum.muted {
            border-color: var(--border);
            color: var(--ink-soft);
        }

        .btn-forum.muted:hover {
            background: var(--surface);
            color: var(--ink);
        }

        /* ── Responsive ─────────── */
        @media (max-width: 991px) {
            .about-img-wrap::before {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .hero {
                padding-top: 80px;
            }

            .hero-btns {
                flex-direction: column;
            }
        }
    </style>


    <div class="site-wrap">

        {{-- Mobile Menu --}}
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        {{-- ══ HERO ══ --}}
        <section class="hero" id="home-section">
            <div class="container hero-inner">
                <div class="row align-items-end g-0">

                    <div class="col-lg-6 pb-5 pb-lg-0" data-aos="fade-up">
                        <p class="hero-eyebrow">Platform Alumni Digital</p>
                        <h1 class="hero-heading">
                            Halo,<br>
                            <em>Selamat Datang</em><br>
                            Alumni!
                        </h1>
                        <p class="hero-desc">
                            Tetap terhubung dengan sekolah dan sesama alumni. Temukan peluang karir, forum diskusi, serta
                            komunitas yang terus berkembang.
                        </p>
                        <div class="hero-btns">
                            <a href="#about-section" class="btn-white smoothscroll">
                                <i class="bi bi-arrow-down-circle-fill"></i> Jelajahi
                            </a>

                            @guest
                                <a href="{{ route('login') }}" class="btn-outline-white">
                                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                                </a>
                            @endguest

                            @auth

                            @endauth
                        </div>
                    </div>

                    <div class="col-lg-6 hero-img-col d-none d-lg-flex" data-aos="fade-up" data-aos-delay="120">
                        <div class="hero-img-wrap">
                            <img src="{{ asset('alumni/images/wisuda.jpg') }}" alt="Alumni">
                        </div>
                    </div>

                </div>
            </div>

            <div class="hero-wave">
                <svg viewBox="0 0 1440 64" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M0,32 C360,64 1080,0 1440,32 L1440,64 L0,64 Z" fill="#ffffff" />
                </svg>
            </div>
        </section>


        {{-- ══ ABOUT ══ --}}
        <section class="about-section" id="about-section">
            <div class="container">
                <div class="row align-items-center g-5">

                    <div class="col-lg-5" data-aos="fade-right">
                        <div class="about-img-wrap">
                            <img src="{{ asset('alumni/images/cartooon.png') }}" alt="About">
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-left">
                        <span class="tag mb-3">Tentang Kami</span>
                        <h2 class="sec-title mb-3">
                            Jembatan antara<br><span>alumni & sekolah</span>
                        </h2>
                        <p class="sec-sub mb-2">
                            Website ini dibangun khusus untuk menghubungkan para alumni dengan sekolah dan sesama alumni.
                            Di sini Anda dapat mengakses forum diskusi serta informasi lowongan kerja terbaru.
                        </p>
                        <p class="sec-sub">
                            Dengan platform ini, diharapkan hubungan antar alumni tetap terjaga dan berkembang dalam
                            lingkungan digital yang dinamis.
                        </p>

                        <ul class="feature-list">
                            <li class="feature-item">
                                <div class="fi-icon"><i class="bi bi-people-fill"></i></div>
                                <span>Mempererat hubungan antar alumni dan sekolah dalam satu platform</span>
                            </li>
                            <li class="feature-item">
                                <div class="fi-icon"><i class="bi bi-chat-dots-fill"></i></div>
                                <span>Menyediakan forum diskusi yang aktif dan positif</span>
                            </li>
                            <li class="feature-item">
                                <div class="fi-icon"><i class="bi bi-briefcase-fill"></i></div>
                                <span>Memberikan informasi lowongan kerja terkini</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>


        {{-- ══ LOKER ══ --}}
        <section class="loker-section" id="portfolio-section">
            <div class="container">

                <div class="row justify-content-center mb-5">
                    <div class="col-lg-6 text-center" data-aos="fade-up">
                        <span class="tag mb-3">Karir</span>
                        <h2 class="sec-title mb-2">Lowongan Kerja <span>Terbaru</span></h2>
                        <p class="sec-sub">Temukan peluang karir yang sesuai dengan latar belakang dan minatmu.</p>
                    </div>
                </div>


                <div class="row g-4">
                    @forelse ($informasi_lokers as $loker)
                        <div class="col-sm-6 col-md-4 col-lg-3 kategori-{{ $loker->kategori_id }}" data-aos="fade-up">
                            <div class="job-card">

                                <div class="job-thumb">
                                    @if ($loker->foto)
                                        <img src="{{ asset('storage/' . $loker->foto) }}" alt="{{ $loker->judul }}">
                                    @else
                                        <div class="job-thumb-icon"><i class="bi bi-briefcase-fill"></i></div>
                                    @endif
                                    <span class="job-cat-badge">{{ $loker->kategori->nama ?? 'Umum' }}</span>
                                </div>

                                <div class="job-body">
                                    <span class="job-open">● Dibutuhkan</span>
                                    <p class="job-title">{{ Str::limit($loker->judul, 45) }}</p>
                                    <div class="job-row">
                                        <i class="bi bi-building"></i>
                                        <span>{{ $loker->perusahaan ?? $loker->kategori->nama }}</span>
                                    </div>
                                    @if ($loker->persyaratan)
                                        <div class="job-row">
                                            <i class="bi bi-mortarboard"></i>
                                            <span>{{ Str::limit($loker->persyaratan, 35) }}</span>
                                        </div>
                                    @endif
                                    <div class="job-row">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>{{ $loker->lokasi }}</span>
                                    </div>
                                </div>

                                <div class="job-foot">
                                    @auth
                                        <a href="{{ route('loker.show', $loker->id) }}" class="btn-detail">
                                            Lihat Detail
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn-detail ghost">
                                            Login untuk Detail
                                        </a>
                                    @endauth
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" style="color:var(--ink-soft);">
                            <i class="bi bi-inbox"
                                style="font-size:2.2rem;display:block;margin-bottom:10px;opacity:.35;"></i>
                            Belum ada lowongan kerja saat ini.
                        </div>
                    @endforelse
                </div>

                <div class="see-all-wrap">
                    <a href="{{ route('lowongan.index') }}" class="btn-see-all">
                        Lihat Semua Lowongan <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>
        </section>


        {{-- ══ FORUM ══ --}}
        <section class="forum-section" id="approved-forum-section">
            <div class="container">

                <div class="row justify-content-center mb-5">
                    <div class="col-lg-6 text-center" data-aos="fade-up">
                        <span class="tag mb-3">Diskusi</span>
                        <h2 class="sec-title mb-2">Forum Diskusi <span>Terbaru</span></h2>
                        <p class="sec-sub">Bergabung dan bagikan pengalaman bersama sesama alumni.</p>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse ($forums as $forum)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up">
                            <div class="forum-card">

                                <div class="forum-thumb">
                                    @if ($forum->foto)
                                        <img src="{{ asset('storage/' . $forum->foto) }}" alt="{{ $forum->judul }}">
                                    @else
                                        <div class="forum-thumb-icon"><i class="bi bi-chat-dots-fill"></i></div>
                                    @endif
                                </div>

                                <div class="forum-body">
                                    <p class="forum-kat"><i class="bi bi-tag-fill me-1"></i>{{ $forum->kategori->nama }}
                                    </p>
                                    <p class="forum-title">{{ $forum->judul }}</p>
                                    <p class="forum-author">
                                        <i class="bi bi-person-circle"></i> {{ $forum->user->name }}
                                    </p>
                                    <p class="forum-excerpt">{{ Str::limit(strip_tags($forum->isi), 110) }}</p>
                                </div>

                                <div class="forum-foot">
                                    @auth
                                        <a href="{{ route('forum.show', $forum->id) }}" class="btn-forum">
                                            Baca Selengkapnya
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn-forum muted"
                                            onclick="return confirm('Anda harus login terlebih dahulu untuk membaca forum. Lanjut ke halaman login?')">
                                            Login untuk Baca
                                        </a>
                                    @endauth
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" style="color:var(--ink-soft);">
                            <i class="bi bi-chat-square-dots"
                                style="font-size:2.2rem;display:block;margin-bottom:10px;opacity:.35;"></i>
                            Tidak ada forum yang tersedia saat ini.
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

    </div>
@endsection
