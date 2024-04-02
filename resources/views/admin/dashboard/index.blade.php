@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="status-text text-warning text-uppercase mb-1">Pending Accounts</div>
                            <div class="status-count h5 mb-0 font-weight-bold">{{ $pendingUsersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="status-text text-success text-uppercase mb-1">Verified Accounts</div>
                            <div class="status-count h5 mb-0 font-weight-bold">{{ $verifiedUsersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="status-text text-danger text-uppercase mb-1">Deactivated Accounts</div>
                            <div class="status-count h5 mb-0 font-weight-bold">{{ $deactivatedUsersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-slash fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Accounts</h6>
                </div>
                <div class="card-body">
                    <canvas id="userChart" width="300" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Stocks</h6>
                </div>
                <div class="card-body">
                    <div class="col d-flex justify-content-center">
                        <canvas id="stockChart" width="700" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                </div>
                <div class="card-body">
                    <div class="col d-flex justify-content-center">
                        <canvas id="quantitySoldChart" width="600" height="370"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('userChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Accounts Created per Week',
                data: {!! json_encode($data) !!},
                backgroundColor: '#e74a3b', 
                borderColor: '#e74a3b', 
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        precision: 0,
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx2 = document.getElementById('stockChart').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: {!! json_encode($pieLabels) !!},
            datasets: [{
                label: 'Stock',
                data: {!! json_encode($pieData) !!},
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc',
                    '#f6c23e',
                    '#e74a3b',
                    '#858796'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    fontColor: '#4e73df',
                    fontSize: 16
                }
            },
            tooltips: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                bodyFontColor: '#fff',
                titleFontColor: '#fff',
                borderColor: '#fff',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10
            }
        }
    });

    
    var ctx3 = document.getElementById('quantitySoldChart').getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: {!! json_encode($quantitySoldLabels) !!},
            datasets: [{
                label: 'Quantity Sold',
                data: {!! json_encode($quantitySoldData) !!},
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc',
                    '#f6c23e',
                    '#e74a3b',
                    '#858796'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    fontColor: '#4e73df',
                    fontSize: 16
                }
            },
            tooltips: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                bodyFontColor: '#fff',
                titleFontColor: '#fff',
                borderColor: '#fff',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10
            }
        }
    });
</script>
@endsection

<style>
    .status-text {
        font-weight: bold;
        font-size: 14px;
    }

    .status-count {
        font-size: 24px;
        margin-top: 5px;
        text-align: left;
    }
</style>
