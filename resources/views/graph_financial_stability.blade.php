@extends('layouts.main')
@section('content')

    <div class="container">

        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/stats">Сальд. результат и кол-во работников</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/graph_financial_stability">Фин. устройчивость и платежеспособность</a>
            </li>
        </ul>

        <div>
            <p></p>
            <h5 class="text-center">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ ПО ВИДАМ
                ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ 2017 ГОД</h5>
            <canvas id="2017"></canvas>
            <h5 class="text-center">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ ПО ВИДАМ
                ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ 2018 ГОД</h5>
            <canvas id="2018"></canvas>
            <h5 class="text-center">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ ПО ВИДАМ
                ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ 2019 ГОД</h5>
            <canvas id="2019"></canvas>
            <h5 class="text-center">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ ПО ВИДАМ
                ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ 2020 ГОД</h5>
            <canvas id="2020"></canvas>
            <h5 class="text-center">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ ПО ВИДАМ
                ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ 2021 ГОД</h5>
            <canvas id="2021"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('2017');
            const data = {
                labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
                datasets: [
                    {
                        label: 'ПЛАТЕЖЕСПОСОБНОСТЬ',
                        data: [110, 105, 120],
                        borderWidth: 1
                    },
                    {
                        label: 'ФИНАНСОВАЯ УСТОЙЧИВОСТЬ',
                        data: [16359, 10932, 2643],
                        borderWidth: 1
                    },
                ]
            }
            new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx1 = document.getElementById('2018');
            const data1 = {
                labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
                datasets: [
                    {
                        label: 'ПЛАТЕЖЕСПОСОБНОСТЬ',
                        data: [138, 147, 126],
                        borderWidth: 1
                    },
                    {
                        label: 'ФИНАНСОВАЯ УСТОЙЧИВОСТЬ',
                        data: [43490, 37645, 2566],
                        borderWidth: 1
                    },
                ]
            }
            new Chart(ctx1, {
                type: 'line',
                data: data1,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx2 = document.getElementById('2019');
            const data2 = {
                labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
                datasets: [
                    {
                        label: 'ПЛАТЕЖЕСПОСОБНОСТЬ',
                        data: [137, 142, 119],
                        borderWidth: 1
                    },
                    {
                        label: 'ФИНАНСОВАЯ УСТОЙЧИВОСТЬ',
                        data: [16359, 10932, 2643],
                        borderWidth: 1
                    },
                ]
            }
            new Chart(ctx2, {
                type: 'line',
                data: data2,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx3 = document.getElementById('2020');
            const data3 = {
                labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
                datasets: [
                    {
                        label: 'ПЛАТЕЖЕСПОСОБНОСТЬ',
                        data: [124, 122, 129],
                        borderWidth: 1
                    },
                    {
                        label: 'ФИНАНСОВАЯ УСТОЙЧИВОСТЬ',
                        data: [90049, 83259, 3208],
                        borderWidth: 1
                    },
                ]
            }
            new Chart(ctx3, {
                type: 'line',
                data: data3,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx4 = document.getElementById('2021');
            const data4 = {
                labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
                datasets: [
                    {
                        label: 'ПЛАТЕЖЕСПОСОБНОСТЬ',
                        data: [134, 132, 134],
                        borderWidth: 1
                    },
                    {
                        label: 'ФИНАНСОВАЯ УСТОЙЧИВОСТЬ',
                        data: [90041, 82374, 3931],
                        borderWidth: 1
                    },
                ]
            }
            new Chart(ctx4, {
                type: 'line',
                data: data4,
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
