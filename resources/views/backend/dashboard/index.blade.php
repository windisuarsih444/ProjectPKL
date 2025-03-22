@extends('backend.app')
@section('content')
<style>
    .scrollable-container {
        max-height: 90vh;
        overflow-y: auto;
        padding-right: 10px;
    }

    /* Animasi Loading */
    .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #f8f9fa; /* Warna latar belakang loading screen */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        animation: fadeOut 1s ease-in-out forwards;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }

    /* Welcome Section */
    .welcome-section {
        text-align: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, #2c3e50, #34495e); /* Warna gelap elegan */
        color: white; /* Teks putih */
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); /* Bayangan lebih halus */
    }

    .welcome-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        animation: floatUpAndDown 3s ease-in-out infinite; /* Animasi teks */
    }

    .welcome-section p {
        font-size: 1.2rem;
        margin-bottom: 20px;
        animation: fadeInScale 2s ease-in-out infinite; /* Animasi deskripsi */
    }

    .welcome-section .btn-explore {
        padding: 10px 20px;
        font-size: 1rem;
        color: white; /* Teks tombol putih */
        background: #1abc9c; /* Warna tombol hijau tosca */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        animation: pulseButton 1.5s ease-in-out infinite; /* Animasi tombol */
    }

    .welcome-section .btn-explore:hover {
        background: #16a085; /* Efek hover tombol */
        transform: scale(1.05);
    }

    /* Efek Hover pada Kartu Statistik */
    .card-stats {
        background: #ecf0f1; /* Warna latar kartu abu-abu muda */
        border: 1px solid #bdc3c7; /* Border tipis */
        transition: all 0.3s ease-in-out;
    }

    .card-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        background: #ffffff; /* Latar belakang lebih terang saat hover */
    }

    .card-stats .icon-big i {
        font-size: 3rem;
        color: #34495e; /* Warna ikon sesuai tema */
    }

    .card-stats .numbers p {
        color: #7f8c8d; /* Warna kategori abu-abu gelap */
        font-size: 0.9rem;
    }

    .card-stats .numbers h4 {
        color: #34495e; /* Warna angka hitam gelap */
        font-size: 1.5rem;
    }

    /* Chart Header */
    .chart-header {
        background: #ffffff; /* Latar belakang header cerah */
        color: #34495e; /* Teks header gelap */
        border-bottom: 2px solid #ecf0f1; /* Garis bawah tipis */
        padding: 15px;
        font-weight: bold;
        border-radius: 10px 10px 0 0; /* Sudut atas melengkung */
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 350px; /* Tinggi diperbesar */
        width: 100%;
        margin-top: 20px;
        opacity: 0;
        animation: fadeInUp 1s ease-in-out forwards;
        background: #ffffff; /* Latar grafik putih */
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Bayangan lebih tajam */
    }

    /* Animasi Floating untuk Judul */
    @keyframes floatUpAndDown {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Animasi Fade dan Scale untuk Deskripsi */
    @keyframes fadeInScale {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.05);
        }
    }

    /* Animasi Pulse untuk Tombol */
    @keyframes pulseButton {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 0 10px rgba(26, 188, 156, 0.5);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(26, 188, 156, 0.8);
        }
    }

    /* Animasi Transisi pada Grafik */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Loading Screen -->
<div class="loading-screen">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="container-fluid mt-4 scrollable-container">
    <div class="page-inner">
        <div class="col-md-12">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1>Selamat Datang di Dashboard!</h1>
                <p>Ini adalah pusat kontrol Anda untuk memantau statistik dan analisis data secara real-time.</p>
                <button class="btn-explore">Jelajahi Sekarang</button>
            </div>

            <!-- Card Statistik -->
            <div class="card">
                <div class="card-body">
                    <h3 class="fw-bold mb-3" style="color: #34495e;">Dashboard</h3>
                    <div class="row">
                        <!-- Card Statistik -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Visitors</p>
                                                <h4 class="card-title">1,294</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Subscribers</p>
                                                <h4 class="card-title">1303</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Sales</p>
                                                <h4 class="card-title">$ 1,345</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Order</p>
                                                <h4 class="card-title">576</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="col-md-6">
                            <div class="chart-header">
                                <div class="card-title">Bar Chart</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-md-6">
                            <div class="chart-header">
                                <div class="card-title">Pie Chart</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@php
    $students = DB::table('students')->count();
    $teachers = DB::table('teacher')->count();
    $subjects = DB::table('mapel')->count();
    $grades = [
        'A' => DB::table('nilai')->whereBetween('nilai', [80, 100])->count(),
        'B' => DB::table('nilai')->whereBetween('nilai', [70, 79])->count(),
        'C' => DB::table('nilai')->whereBetween('nilai', [60, 69])->count(),
        'D' => DB::table('nilai')->whereBetween('nilai', [50, 59])->count(),
        'E' => DB::table('nilai')->where('nilai', '<', 50)->count(),
    ];
@endphp

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Remove loading screen after content is loaded
    document.addEventListener("DOMContentLoaded", function () {
        const loadingScreen = document.querySelector('.loading-screen');
        loadingScreen.style.display = 'none';
    });

    // Pie Chart
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Students', 'Teachers', 'Mata Pelajaran'],
            datasets: [{
                data: [{{ $students }}, {{ $teachers }}, {{ $subjects }}],
                backgroundColor: ['#1abc9c', '#3498db', '#9b59b6'], // Warna pie chart sesuai tema
                borderColor: '#ffffff', // Garis tepi putih
                borderWidth: 2 // Ketebalan garis tepi
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#34495e', // Warna teks legenda
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuad'
            }
        }
    });

    // Bar Chart
    var ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['A', 'B', 'C', 'D', 'E'],
            datasets: [{
                label: 'Jumlah Nilai',
                data: [{{ $grades['A'] }}, {{ $grades['B'] }}, {{ $grades['C'] }}, {{ $grades['D'] }}, {{ $grades['E'] }}],
                backgroundColor: ['#1abc9c', '#3498db', '#9b59b6', '#e74c3c', '#f1c40f'], // Warna bar chart sesuai tema
                borderColor: '#ffffff', // Garis tepi putih
                borderWidth: 2 // Ketebalan garis tepi
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        color: '#ecf0f1' // Warna garis grid sumbu X
                    },
                    ticks: {
                        color: '#34495e', // Warna teks sumbu X
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#ecf0f1' // Warna garis grid sumbu Y
                    },
                    ticks: {
                        color: '#34495e', // Warna teks sumbu Y
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#34495e', // Warna teks legenda
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuad'
            }
        }
    });
</script>
@endsection