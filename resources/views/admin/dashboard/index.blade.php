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
        <div class="col">
            <canvas id="userChart" width="400" height="200"></canvas>
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
                label: 'Users Created per Week',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        precision: 0, // Set precision to 0 to display integer values only
                        beginAtZero: true // Start y-axis at 0
                    }
                }]
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
