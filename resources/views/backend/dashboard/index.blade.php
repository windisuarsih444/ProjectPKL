@extends('backend.app')
@section('content')
<style>
    .scrollable-container {
        max-height: 90vh;
        overflow-y: auto;
        padding-right: 10px;
    }
    
</style>
<div class="container-fluid mt-4 scrollable-container">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
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
                                                <p class="card-category">Visitors</p>
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
                                                <p class="card-category">Subscribers</p>
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
                                                <p class="card-category">Sales</p>
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
                                                <p class="card-category">Order</p>
                                                <h4 class="card-title">576</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-header bg-primary text-white">
                                <div class="card-title">Bar Chart</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-header bg-danger text-white">
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
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Students', 'Teachers', 'Mata Pelajaran'],
            datasets: [{
                data: [{{ $students }}, {{ $teachers }}, {{ $subjects }}],
                backgroundColor: ['#FF5733', '#C70039', '#900C3F']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    var ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['A', 'B', 'C', 'D', 'E'],
            datasets: [{
                label: 'Jumlah Nilai',
                data: [{{ $grades['A'] }}, {{ $grades['B'] }}, {{ $grades['C'] }}, {{ $grades['D'] }}, {{ $grades['E'] }}],
                backgroundColor: ['#3498DB', '#2E86C1', '#1F618D', '#154360', '#0B3D91']
            }]
        },
    });
</script>
@endsection
