@extends('layouts.front') 

@section('title', 'Detail Lowongan Kerja')

@section('content')

<br>
<br>
<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        
        <div class="card-header py-4 px-4" style="background: linear-gradient(135deg, #0d47a1 0%, #1976d2 50%, #42a5f5 100%);">
            <h1 class="mb-0 text-white fw-bold" style="font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
                <i class="bi bi-briefcase-fill me-3"></i>{{ $loker->judul }}
            </h1>
        </div>

       
        <div class="card-body p-5" style="background: linear-gradient(to bottom, #e3f2fd 0%, #bbdefb 100%);">
            
           
            <div class="mb-4 d-flex flex-wrap gap-2">
                <span class="badge shadow-sm px-3 py-2" style="background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%); font-size: 1rem; border-radius: 10px;">
                    <i class="bi bi-tags-fill me-2"></i><strong>{{ $loker->kategori->nama }}</strong>
                </span>
                <span class="badge shadow-sm px-3 py-2" style="background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%); font-size: 1rem; border-radius: 10px;">
                    <i class="bi bi-geo-alt-fill me-2"></i><strong>{{ $loker->lokasi }}</strong>
                </span>
            </div>

           
            <hr style="border-top: 2px solid #90caf9; opacity: 1;">

           
            <div class="description-section p-4 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 100%);">
                <h5 class="mb-4 fw-bold" style="color: #0d47a1; font-size: 1.4rem; border-left: 5px solid #1976d2; padding-left: 15px;">
                    <i class="bi bi-file-text-fill me-2"></i>Deskripsi Pekerjaan
                </h5>
                <div class="description-content p-3 rounded-3" style="background: white; border-left: 3px solid #42a5f5;">
                    <p class="mb-0" style="white-space: pre-line; line-height: 1.8; color: #1a237e; font-size: 1.05rem; text-align: justify;">
                        {!! e($loker->deskripsi ?? 'Deskripsi belum tersedia') !!}
                    </p>
                </div>
            </div>

          
            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <div class="info-box p-3 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 100%); border-left: 4px solid #1976d2;">
                        <h6 class="fw-bold mb-2" style="color: #0d47a1;">
                            <i class="bi bi-calendar-check-fill me-2 text-primary"></i>Tanggal Posting
                        </h6>
                        <p class="mb-0" style="color: #546e7a; font-weight: 500;">
                            {{ $loker->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-box p-3 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 100%); border-left: 4px solid #42a5f5;">
                        <h6 class="fw-bold mb-2" style="color: #0d47a1;">
                            <i class="bi bi-building-fill me-2 text-primary"></i>Kategori
                        </h6>
                        <p class="mb-0" style="color: #546e7a; font-weight: 500;">
                            {{ $loker->kategori->nama }}
                        </p>
                    </div>
                </div>
            </div>

         
          
        </div>
    </div>

    
  
</div>

<style>
    body {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 50%, #90caf9 100%);
        min-height: 100vh;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(13, 71, 161, 0.25) !important;
    }

    .btn {
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(13, 71, 161, 0.35) !important;
    }

    .badge {
        transition: transform 0.3s ease;
        letter-spacing: 0.5px;
    }

    .badge:hover {
        transform: scale(1.05);
    }

    .info-box {
        transition: all 0.3s ease;
    }

    .info-box:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(13, 71, 161, 0.2) !important;
    }

    .icon-circle {
        transition: transform 0.3s ease;
    }

    .icon-circle:hover {
        transform: scale(1.1) rotate(5deg);
    }

    .description-content {
        box-shadow: 0 2px 8px rgba(13, 71, 161, 0.1);
    }

    h1, h5, h6 {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    hr {
        margin: 1.5rem 0;
    }

    @media (max-width: 768px) {
        .flex-grow-1 {
            width: 100%;
        }
    }
</style>

@endsection