@extends('backend.app')
@section('content')
<div class="container">
    <div class="page-inner">

    <!-- Welcome Section -->
    <div class="text-center my-4 p-4 rounded shadow-sm bg-black text-white animate__animated animate__bounceIn floating" id="welcome">
        <h2 class="fw-bold">Selamat Datang di Aplikasi Windi!</h2>
        <p class="mt-2">Aplikasi ini dirancang untuk mempermudah pembelajaran guna memenuhi standar Program PKL Politeknik Negeri Lampung 2025. Pantau statistik, kelola pengguna, dan tingkatkan efisiensi dengan fitur-fitur yang telah kami sediakan.</p>
    </div>

    <!-- Tambahkan CDN Animate.css di bagian head jika belum ada -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        /* Efek floating */
        .floating {
            animation: floating 3s infinite ease-in-out;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }
        /* Hover efek */
        #welcome:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }
        /* Efek hover pada card */
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease-in-out;
        }
    </style>

    <!-- Card -->
    <h3 class="fw-bold mb-3">Card</h3>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Data User</p>
                                <h4 class="card-title">1,294</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-warning card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Data Students</p>
                                <h4 class="card-title">1303</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-success card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Data Teachers</p>
                                <h4 class="card-title">$ 1,345</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-danger card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Profile</p>
                                <h4 class="card-title">576</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <nav aria-label="Page navigation example">
</nav>
@endsection
