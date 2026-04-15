@extends('layouts.admin')

@section('content')

<style>
    .card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transition: 0.3s;
    }

    .card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }

    .stat-card {
        padding: 20px;
        border-radius: 16px;
        color: #fff;
    }

    .bg-gradient-1 {
        background: linear-gradient(135deg, #06b6d4, #3b82f6);
    }

    .bg-gradient-2 {
        background: linear-gradient(135deg, #22c55e, #4ade80);
    }

    .bg-gradient-3 {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
    }

    .list-modern li {
        border: none;
        border-bottom: 1px solid #eee;
    }

    .list-modern li:last-child {
        border-bottom: none;
    }
</style>

<div class="container-fluid">

    <!-- ALERT -->
    @if ($komentarKasar > 0)
        <div class="alert alert-danger shadow-sm rounded-3">
            ⚠️ Ada <b>{{ $komentarKasar }}</b> komentar kasar!
        </div>
    @endif

    <!-- STATISTIK -->
    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card-modern stat-card bg-gradient-1 text-center">
                <h2>{{ $jumlahForum }}</h2>
                <p>Total Forum</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card-modern stat-card bg-gradient-2 text-center">
                <h2>{{ $jumlahLoker }}</h2>
                <p>Total Loker</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card-modern stat-card bg-gradient-3 text-center">
                <h2>{{ $jumlahKomentar }}</h2>
                <p>Total Komentar</p>
            </div>
        </div>

    </div>

    <!-- GRAFIK -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card-modern p-4">
                <h5 class="mb-3">📊 Grafik Aktivitas</h5>
                <canvas id="chartBulanan"></canvas>
            </div>
        </div>
    </div>

    <!-- AKTIVITAS -->
    <div class="row mt-4">

        <div class="col-md-6 mb-3">
            <div class="card-modern p-3">
                <h5>Komentar Terbaru</h5>
                <ul class="list-group list-modern">
                    @foreach ($komentarTerbaru as $k)
                        <li class="list-group-item">
                            {{ $k->isi }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card-modern p-3">
                <h5>Forum Terbaru</h5>

                @foreach ($forumTerbaru as $f)
                    <div class="mb-2 p-2 rounded" style="background:#f9fafb;">
                        <strong>{{ $f->judul }}</strong><br>
                        <small class="text-muted">
                            {{ $f->created_at->diffForHumans() }}
                        </small>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const forumData = @json(array_values($forumBulanan->toArray()));
    const komentarData = @json(array_values($komentarBulanan->toArray()));

    new Chart(document.getElementById('chartBulanan'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [
                {
                    label: 'Forum',
                    data: forumData,
                    borderColor: '#3b82f6',
                    tension: 0.4
                },
                {
                    label: 'Komentar',
                    data: komentarData,
                    borderColor: '#f59e0b',
                    tension: 0.4
                }
            ]
        }
    });
</script>

@endsection