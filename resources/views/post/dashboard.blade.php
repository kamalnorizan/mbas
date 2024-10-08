@extends('falcon.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div>
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
            // paksi x
            //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: {{ json_encode($x) }},
            datasets: [{
                label: 'Bilangan Posting',
                // data: [12, 19, 3, 5, 2, 3], // paksi Y
                data: {{ json_encode($y) }}, // paksi Y
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
            }
        });
        </script>
    </div>
</div>
@endsection
