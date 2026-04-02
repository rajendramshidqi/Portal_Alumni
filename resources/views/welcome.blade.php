@extends('layouts.front')
@section('content')
    <div class="site-wrap" style="background: linear-gradient(135deg, #a8a4f1, #6ec1e4);">


        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>






        <div class="site-blocks-cover overlay" style="background-image: url('alumni/images/wisuda.jpg');" data-aos="fade"
            id="home-section">

            <div class="container">
                <div class="row align-items-center justify-content-center">


                    <div class="col-md-8 mt-lg-5 text-center">
                        <h1 class="text-uppercase" data-aos="fade-up">Hallo ALumni</h1>
                        <p class="mb-5 desc" data-aos="fade-up" data-aos-delay="100">Selamat Datang Di Website ini</p>

                    </div>

                </div>
            </div>

            <a href="#about-section" class="mouse smoothscroll">
                <span class="mouse-icon">
                    <span class="mouse-wheel"></span>
                </span>
            </a>
        </div>


        <div class="site-section cta-big-image" id="about-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center" data-aos="fade">
                        <h2 class="section-title mb-3">About Us</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                        <figure class="">
                            <img src="{{ asset('alumni/images/cartooon.png') }}" alt="Image" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
                        <div class="mb-4">
                            <h3 class="h3 mb-4 text-black">Tentang Kami</h3>
                            <p class="text-dark" style="text-align: justify;">
                                Website ini dibuat khusus untuk menghubungkan para alumni dengan sekolah dan sesama alumni.
                                Di sini
                                Alumni dapat mengakses forum diskusi, serta informasi lowongan kerja terbaru yang
                                bermanfaat untuk perkembangan karir Anda.
                                <br><br>
                                Dengan adanya platform ini, diharapkan hubungan antara alumni dan sesama alumni tetap
                                terjaga dan
                                terus berkembang dalam lingkungan digital yang dinamis.
                            </p>
                        </div>

                        <div class="mb-4">
                            <ul class="list-unstyled ul-check success text-dark">
                                <li>Mempererat hubungan antar alumni dan sekolah</li>
                                <li>Menyediakan forum diskusi yang aktif dan positif</li>
                                <li>Memberikan informasi lowongan kerja terkini</li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <section class="site-section" id="portfolio-section">
            <div class="container">

                {{-- FILTER KATEGORI --}}
                <div class="row justify-content-center mb-5" data-aos="fade-up">
                    <div id="filters" class="filters text-center button-group col-md-7">
                        <button class="btn btn-primary active" data-filter="*">All</button>
                        @foreach ($kategoriLoker as $kategori)
                            <button class="btn btn-primary" data-filter=".kategori-{{ $kategori->id }}">
                                {{ $kategori->nama }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- LIST LOKER --}}

                <div class="row g-4">
                    @forelse ($informasi_lokers as $loker)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="job-card h-100">

                                {{-- FOTO / LOGO --}}
                                <div class="job-logo">
                                    @if ($loker->foto)
                                        <img src="{{ asset('storage/' . $loker->foto) }}" alt="Logo {{ $loker->judul }}">
                                    @else
                                        <i class="bi bi-briefcase-fill job-logo-icon"></i>
                                    @endif
                                </div>

                                {{-- BODY --}}
                                <div class="job-body">
                                    <span class="job-status">Dibutuhkan</span>

                                    <h5 class="job-title">
                                        {{ Str::limit($loker->judul, 40) }}
                                    </h5>

                                    <div class="job-company">
                                        <i class="bi bi-building"></i>
                                        {{ $loker->perusahaan ?? $loker->kategori->nama }}
                                    </div>

                                    <div class="job-">
                                        <i class="bi bi-mortarboard"></i>
                                        {{ $loker->persyaratan }}
                                    </div>


                                    <div class="job-location">
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $loker->lokasi }}
                                    </div>
                                </div>

                                {{-- FOOTER --}}
                                <div class="job-footer">
                                    @auth
                                        <a href="{{ route('loker.show', $loker->id) }}" class="job-btn">
                                            Lihat Detail
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="job-btn outline">
                                            Login untuk Detail
                                        </a>
                                    @endauth
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted">
                            Belum ada lowongan kerja
                        </div>
                    @endforelse
                </div>
                <style>
                    .job-card {
                        background: #fff;
                        border-radius: 18px;
                        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
                        display: flex;
                        flex-direction: column;
                        height: 100%;
                        transition: .35s;
                    }

                    .job-card:hover {
                        transform: translateY(-6px);
                        box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
                    }

                    /* FOTO / LOGO */
                    .job-logo {
                        height: 160px;
                        /* ukuran sedang */
                        background: #f9fafb;
                        overflow: hidden;
                        /* ⬅️ kunci foto */
                        border-top-left-radius: 18px;
                        border-top-right-radius: 18px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .job-logo img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        /* pas penuh card */
                        display: block;
                    }

                    /* ICON JIKA TIDAK ADA FOTO */
                    .job-logo-icon {
                        font-size: 3rem;
                        color: #c7c9d1;
                    }

                    /* BODY */
                    .job-body {
                        padding: 1.2rem 1.3rem;
                        flex: 1;
                    }

                    .job-status {
                        font-size: .75rem;
                        color: #9ca3af;
                    }

                    .job-title {
                        font-size: 1.05rem;
                        font-weight: 700;
                        margin: .3rem 0 .6rem;
                    }

                    .job-company {
                        font-size: .85rem;
                        color: #374151;
                        margin-bottom: .5rem;
                    }

                    .job-company i {
                        margin-right: 4px;
                        color: #6366f1;
                    }

                    /* META */
                    .job-meta {
                        display: flex;
                        gap: 1rem;
                        font-size: .75rem;
                        color: #6b7280;
                        margin-bottom: .4rem;
                    }

                    .job-meta i {
                        margin-right: 4px;
                    }

                    /* LOCATION */
                    .job-location {
                        font-size: .8rem;
                        color: #6b7280;
                    }

                    .job-location i {
                        margin-right: 4px;
                    }

                    /* FOOTER */
                    .job-footer {
                        padding: 1rem 1.3rem 1.4rem;
                    }

                    .job-btn {
                        display: block;
                        width: 100%;
                        padding: .65rem;
                        text-align: center;
                        border-radius: 12px;
                        background: linear-gradient(135deg, #56eeff, #1a9ef5);
                        color: #fff;
                        font-size: .85rem;
                        font-weight: 600;
                        text-decoration: none;
                    }

                    .job-btn:hover {
                        opacity: .9;
                        color: #fff;
                    }

                    .job-btn.outline {
                        background: #fff;
                        border: 2px solid #6366f1;
                        color: #6366f1;
                    }
                </style>


            </div>
        </section>


        <div class="text-center mt-4">
            <a href="{{ route('lowongan.index') }}" class="btn btn-primary px-4">
                Lihat Semua Lowongan
            </a>
        </div>








        <section class="site-section" id="approved-forum-section">
            <div class="container">
                {{-- Judul --}}
                <div class="row mb-5">
                    <div class="col-12 text-center" data-aos="fade">
                        <h2 class="section-title mb-3">Forum Diskusi Terbaru</h2>
                    </div>
                </div>

                {{-- Daftar Forum --}}
                <div class="row">
                    @forelse ($forums as $forum)
                        <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up">
                            <div class="card h-100 border-0 shadow rounded-4 overflow-hidden">

                                {{-- 🔥 FOTO FORUM --}}
                                @if ($forum->foto)
                                    <img src="{{ asset('storage/' . $forum->foto) }}" class="card-img-top"
                                        style="height:200px; object-fit:cover;">
                                @else
                                    {{-- fallback kalau tidak ada foto --}}
                                    <div class="text-center pt-4">
                                        <i class="bi bi-chat-dots-fill text-primary" style="font-size: 3rem;"></i>
                                    </div>
                                @endif

                                {{-- Isi Card --}}
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-primary text-center">{{ $forum->judul }}</h5>

                                    <p class="text-muted mb-1 text-center">
                                        <i class="bi bi-tags"></i> <strong>{{ $forum->kategori->nama }}</strong>
                                    </p>

                                    <p class="text-muted mb-2 text-center">
                                        <i class="bi bi-person"></i> {{ $forum->user->name }}
                                    </p>

                                    <p class="card-text text-center">
                                        {{ Str::limit(strip_tags($forum->isi), 100) }}
                                    </p>

                                    {{-- Tombol --}}
                                    @auth
                                        <a href="{{ route('forum.show', $forum->id) }}"
                                            class="btn btn-outline-primary mt-auto w-100">
                                            Baca Selengkapnya
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline-secondary mt-auto w-100"
                                            onclick="return confirm('Anda harus login terlebih dahulu untuk membaca forum. Lanjut ke halaman login?')">
                                            Login untuk Baca
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Tidak ada forum yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

























    </div>
@endsection
