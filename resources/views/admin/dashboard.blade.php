@extends('layouts.admin')

@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Dashboard Admin</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- CARD STATISTIK -->
    <div class="row">

        <!-- FORUM -->
        <div class="col-md-6 col-lg-4">
            <div class="card card-hover shadow">
                <div class="box bg-cyan text-center p-4">
                    <h1 class="font-light text-white">
                        <i class="mdi mdi-forum"></i><br>
                        {{ $jumlahForum }}
                    </h1>
                    <h6 class="text-white mt-2">Total Forum</h6>
                </div>
            </div>
        </div>

        <!-- LOKER -->
        <div class="col-md-6 col-lg-4">
            <div class="card card-hover shadow">
                <div class="box bg-success text-center p-4">
                    <h1 class="font-light text-white">
                        <i class="mdi mdi-briefcase"></i><br>
                        {{ $jumlahLoker }}
                    </h1>
                    <h6 class="text-white mt-2">Total Lowongan Kerja</h6>
                </div>
            </div>
        </div>

        <!-- KOMENTAR -->
        <div class="col-md-6 col-lg-4">
            <div class="card card-hover shadow">
                <div class="box bg-warning text-center p-4">
                    <h1 class="font-light text-white">
                        <i class="mdi mdi-comment"></i><br>
                        {{ $jumlahKomentar }}
                    </h1>
                    <h6 class="text-white mt-2">Total Komentar</h6>
                </div>
            </div>
        </div>

    </div>

    <!-- OPTIONAL: INFO TAMBAHAN -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Selamat Datang 👋</h5>
                    <p class="card-text">
                        Ini adalah dashboard admin untuk memantau data forum, lowongan kerja, dan aktivitas komentar alumni.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection