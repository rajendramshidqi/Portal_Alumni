@extends('layouts.alumni1')

@section('content')
    <div class="page-wrapper">
        <div class="container py-5">


            {{-- HEADER SECTION --}}
            <div class="page-header mb-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="header-icon-wrapper mb-3">
                            <div class="header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 0a5 5 0 0 1 5 5v6a5 5 0 0 1-10 0V5a5 5 0 0 1 5-5zm0 1a4 4 0 0 0-4 4v6a4 4 0 0 0 8 0V5a4 4 0 0 0-4-4z" />
                                    <path d="M8 3a2 2 0 0 1 2 2v2a2 2 0 0 1-4 0V5a2 2 0 0 1 2-2z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="page-title mb-2">Forum Diskusi</h1>
                                <p class="page-subtitle mb-0">Kelola dan bagikan topik diskusi dengan komunitas alumni</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="stats-badge">
                            <i class="fas fa-comments me-2"></i>
                            <span class="fw-bold">{{ $forums->count() }}</span> Forum Aktif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="custom-alert alert-success mb-4">
                    <div class="alert-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="alert-content">
                        <h6 class="alert-title mb-1">Berhasil!</h6>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- ALERT ERROR --}}
            @if ($errors->any())
                <div class="custom-alert alert-danger mb-4">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="alert-content">
                        <h6 class="alert-title mb-2">Terdapat Kesalahan</h6>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- MAIN CONTENT --}}
            <div class="row g-4">
                {{-- FORM SECTION --}}
                <div class="col-lg-5">
                    <div class="card-professional sticky-top" style="top: 20px;">
                        <div class="card-header-pro">
                            <h5 class="card-title-pro mb-0">
                                <i class="fas fa-plus-circle me-2"></i>Buat Diskusi Baru
                            </h5>
                        </div>
                        <div class="card-body-pro">
                            <form method="POST" action="{{ route('forum.store') }}" class="form-professional"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group-pro mb-4">
                                    <label class="form-label-pro">
                                        <i class="fas fa-heading text-primary me-2"></i>Judul Forum
                                    </label>
                                    <input type="text" name="judul" class="form-input-pro"
                                        placeholder="Masukkan judul yang deskriptif" required>
                                </div>

                                <div class="form-group-pro mb-4">
                                    <label class="form-label-pro">
                                        <i class="fas fa-layer-group text-primary me-2"></i>Kategori
                                    </label>
                                    <select name="kategori_forum_id" class="form-select-pro" required>
                                        <option value="" selected disabled>Pilih kategori forum</option>
                                        @foreach ($kategori_forums as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group-pro mb-4">
                                    <label class="form-label-pro">
                                        <i class="fas fa-file-alt text-primary me-2"></i>Konten Diskusi
                                    </label>
                                    <textarea name="isi" rows="5" class="form-textarea-pro"
                                        placeholder="Jelaskan topik diskusi Anda secara detail..." required></textarea>
                                    <small class="form-hint">Minimal 20 karakter</small>
                                </div>
                                <div class="form-group-pro mb-4">
                                    <label class="form-label-pro">
                                        <i class="fas fa-image text-primary me-2"></i>Foto (Opsional)
                                    </label>

                                    <input type="file" name="foto" class="form-input-pro" id="fotoInput">
                                </div>

                                <!-- PREVIEW -->
                                <div class="mb-3 text-center">
                                    <img id="previewFoto" style="max-height:200px; display:none;" class="rounded shadow">
                                </div>
                                <button type="submit" class="btn-submit-pro w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Publikasikan Forum
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- FORUM LIST SECTION --}}
                <div class="col-lg-7">
                    <div class="section-header-pro mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="section-title-pro mb-0">
                                <i class="fas fa-list-ul me-2"></i>Forum Anda
                            </h5>
                            <span class="badge-count">{{ $forums->count() }} Forum</span>
                        </div>
                    </div>

                    @if ($forums->count() > 0)
                        <div class="forum-grid">
                            @foreach ($forums as $forum)
                                <a href="{{ route('forum.show', $forum->id) }}" class="forum-card-pro">
                                    <div class="forum-card-header">
                                        <div class="forum-badge-category">
                                            <i class="fas fa-tag me-1"></i>{{ $forum->kategori->nama }}
                                        </div>
                                        <div class="forum-timestamp">
                                            <i class="far fa-calendar me-1"></i>{{ $forum->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <h6 class="forum-card-title">{{ $forum->judul }}</h6>
                                    <p class="forum-card-excerpt">{{ Str::limit($forum->isi, 100) }}</p>
                                    <div class="forum-card-footer">
                                        <div class="forum-meta-info">
                                            <span><i
                                                    class="far fa-clock me-1"></i>{{ $forum->created_at->format('H:i') }}</span>
                                        </div>
                                        <div class="forum-action-icon">
                                            <i class="fas fa-arrow-right"></i>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state-pro">
                            <div class="empty-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h6 class="empty-title">Belum Ada Forum</h6>
                            <p class="empty-text">Mulai berbagi pemikiran Anda dengan membuat forum diskusi pertama.</p>
                        </div>
                    @endif

                    <div class="text-center mt-5 pt-4 border-top">
                        <a href="{{ route('welcome') }}" class="btn-back-pro">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <style>
        :root {
            --color-primary: #1e40af;
            --color-primary-light: #3b82f6;
            --color-primary-dark: #1e3a8a;
            --color-secondary: #64748b;
            --color-success: #10b981;
            --color-danger: #ef4444;
            --color-warning: #f59e0b;
            --color-info: #3b82f6;
            --color-bg-light: #f8fafc;
            --color-bg-blue: #eff6ff;
            --color-border: #e2e8f0;
            --color-text-primary: #0f172a;
            --color-text-secondary: #64748b;
            --shadow-sm: 0 2px 4px rgba(15, 23, 42, 0.04);
            --shadow-md: 0 4px 12px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 10px 24px rgba(15, 23, 42, 0.12);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        .page-wrapper {
            background: linear-gradient(to bottom, #eff6ff 0%, #f8fafc 100%);
            min-height: 100vh;
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            background: white;
            padding: 12px 20px;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            margin: 0;
        }

        .breadcrumb-custom .breadcrumb-item {
            font-size: 0.875rem;
            color: var(--color-text-secondary);
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: var(--color-primary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb-custom .breadcrumb-item a:hover {
            color: var(--color-primary-light);
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--color-text-primary);
            font-weight: 500;
        }

        /* Page Header */
        .page-header {
            background: white;
            padding: 32px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--color-border);
        }

        .header-icon-wrapper {
            display: flex;
            align-items: start;
            gap: 16px;
        }

        .header-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 8px 16px rgba(30, 64, 175, 0.2);
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--color-text-primary);
            margin: 0;
            line-height: 1.2;
        }

        .page-subtitle {
            font-size: 0.9375rem;
            color: var(--color-text-secondary);
            line-height: 1.5;
        }

        .stats-badge {
            background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));
            color: white;
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-size: 0.9375rem;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25);
        }

        /* Custom Alerts */
        .custom-alert {
            display: flex;
            gap: 16px;
            padding: 20px;
            border-radius: var(--radius-md);
            border: none;
            box-shadow: var(--shadow-md);
        }

        .custom-alert.alert-success {
            background: linear-gradient(to right, #f0fdf4, #dcfce7);
            border-left: 4px solid var(--color-success);
        }

        .custom-alert.alert-danger {
            background: linear-gradient(to right, #fef2f2, #fee2e2);
            border-left: 4px solid var(--color-danger);
        }

        .alert-icon {
            font-size: 1.5rem;
        }

        .alert-success .alert-icon {
            color: var(--color-success);
        }

        .alert-danger .alert-icon {
            color: var(--color-danger);
        }

        .alert-title {
            font-weight: 600;
            color: var(--color-text-primary);
            font-size: 0.9375rem;
        }

        .alert-content p,
        .alert-content li {
            color: var(--color-text-secondary);
            font-size: 0.875rem;
        }

        /* Professional Card */
        .card-professional {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--color-border);
            overflow: hidden;
        }

        .card-header-pro {
            background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));
            padding: 20px 24px;
            border-bottom: none;
        }

        .card-title-pro {
            color: white;
            font-weight: 600;
            font-size: 1.125rem;
        }

        .card-body-pro {
            padding: 28px 24px;
        }

        /* Professional Form */
        .form-group-pro {
            position: relative;
        }

        .form-label-pro {
            display: block;
            font-weight: 600;
            color: var(--color-text-primary);
            margin-bottom: 8px;
            font-size: 0.875rem;
        }

        .form-input-pro,
        .form-select-pro,
        .form-textarea-pro {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--color-border);
            border-radius: var(--radius-sm);
            font-size: 0.9375rem;
            color: var(--color-text-primary);
            background: white;
            transition: all 0.2s ease;
        }

        .form-input-pro:focus,
        .form-select-pro:focus,
        .form-textarea-pro:focus {
            outline: none;
            border-color: var(--color-primary-light);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea-pro {
            resize: vertical;
            font-family: inherit;
            line-height: 1.6;
        }

        .form-hint {
            display: block;
            margin-top: 6px;
            font-size: 0.8125rem;
            color: var(--color-text-secondary);
        }

        .btn-submit-pro {
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25);
        }

        .btn-submit-pro:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.35);
        }

        /* Section Header */
        .section-header-pro {
            padding-bottom: 16px;
            border-bottom: 2px solid var(--color-border);
        }

        .section-title-pro {
            font-weight: 700;
            color: var(--color-text-primary);
            font-size: 1.125rem;
        }

        .badge-count {
            background: var(--color-bg-blue);
            color: var(--color-primary);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8125rem;
            font-weight: 600;
        }

        /* Forum Grid */
        .forum-grid {
            display: grid;
            gap: 20px;
        }

        .forum-card-pro {
            background: white;
            border: 2px solid var(--color-border);
            border-radius: var(--radius-md);
            padding: 20px;
            text-decoration: none;
            display: block;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .forum-card-pro::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(to bottom, var(--color-primary), var(--color-primary-light));
            border-radius: var(--radius-md) 0 0 var(--radius-md);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .forum-card-pro:hover {
            border-color: var(--color-primary-light);
            box-shadow: var(--shadow-lg);
            transform: translateX(4px);
        }

        .forum-card-pro:hover::before {
            transform: scaleY(1);
        }

        .forum-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .forum-badge-category {
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            color: white;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .forum-timestamp {
            color: var(--color-text-secondary);
            font-size: 0.8125rem;
        }

        .forum-card-title {
            color: var(--color-text-primary);
            font-weight: 600;
            font-size: 1.0625rem;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .forum-card-excerpt {
            color: var(--color-text-secondary);
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .forum-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid var(--color-border);
        }

        .forum-meta-info {
            color: var(--color-text-secondary);
            font-size: 0.8125rem;
        }

        .forum-action-icon {
            color: var(--color-primary);
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .forum-card-pro:hover .forum-action-icon {
            transform: translateX(4px);
        }

        /* Empty State */
        .empty-state-pro {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: var(--radius-lg);
            border: 2px dashed var(--color-border);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: var(--color-bg-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--color-primary);
            font-size: 2rem;
        }

        .empty-title {
            font-weight: 600;
            color: var(--color-text-primary);
            margin-bottom: 8px;
            font-size: 1.125rem;
        }

        .empty-text {
            color: var(--color-text-secondary);
            font-size: 0.9375rem;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Back Button */
        .btn-back-pro {
            display: inline-flex;
            align-items: center;
            padding: 12px 32px;
            background: white;
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            border-radius: var(--radius-sm);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9375rem;
        }

        .btn-back-pro:hover {
            background: var(--color-primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .card-professional {
                position: relative !important;
                top: 0 !important;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .header-icon {
                width: 56px;
                height: 56px;
            }

            .page-header {
                padding: 24px 20px;
            }

            .stats-badge {
                width: 100%;
                text-align: center;
                margin-top: 16px;
            }
        }
    </style>
@endsection
