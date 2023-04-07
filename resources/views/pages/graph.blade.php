@extends('../app')
@push('css')
    <link rel="stylesheet" href={{asset('css/graph.css')}}>
@endpush
@section('content')
    <div class="container">
        <div class="rox">
            <div class="col-lg col-md-12">
                <div class="graphContainer">
                    <canvas class="graph " id="graphAvg"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="graphContainer">
                    <canvas class="graph" id="graph0"></canvas>
                </div>
                <div class="graphContainer">
                    <canvas class="graph" id="graph1"></canvas>
                </div>
                <div class="graphContainer">
                    <canvas class="graph" id="graph2"></canvas>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="graphContainer">
                    <canvas class="graph" id="graph3"></canvas>
                </div>
                <div class="graphContainer">
                    <canvas class="graph" id="graph4"></canvas>
                </div>
                <div class="graphContainer">
                    <canvas class="graph" id="graph5"></canvas>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="graphContainer">
                    <canvas class="graph" id="graph6"></canvas>
                </div>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        var weatherData = @json($weatherData); // convert the data from php -> js
        </script>
        <script src={{asset('js/chart.js')}}></script>
@endsection
