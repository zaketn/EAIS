@extends('layout_navbar')
@section('content')

    <div class="container">
        <div>
            <p></p>
            <h5 class="text-center">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ ПО ВИДАМ ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ</h5>
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');

            const data ={
                labels: [
                    'January',
                    'February',
                    'March',
                    'April'
                ],
                datasets: [{
                    type: 'bar',
                    label: 'Bar Dataset',
                    data: [10, 20, 30, 40],
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                }, {
                    type: 'line',
                    label: 'Line Dataset',
                    data: [50, 50, 50, 50],
                    fill: false,
                    borderColor: 'rgb(54, 162, 235)'
                }]
            }

            new Chart(ctx, {
                type: 'scatter',
                data: data,
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
@endsection

