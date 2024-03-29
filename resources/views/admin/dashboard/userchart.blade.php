@extends('admin.layouts.dashboard')

@section('content')
    <div class="container">
        <canvas id="userChart" width="400" height="200"></canvas>
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