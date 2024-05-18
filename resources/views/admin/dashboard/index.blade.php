@extends('admin.layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Product Stock Pie Chart</h1>
        <div>{!! $chart->container() !!}</div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    {!! $chart->script() !!}
@endsection
