@extends('layouts.main')
@section('content')

    <div class="container">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/stats">Сальд. результат и кол-во работников</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/graph_financial_stability">Фин. устройчивость и платежеспособность</a>
            </li>
        </ul>

        <div>
            <p></p>
            <h5 class="text-center">САЛЬДИРОВАННЫЙ ФИНАНСОВЫЙ РЕЗУЛЬТАТ В СООТНОШЕНИИ С КОЛИЧЕСТВОМ РАБОТНИКОВ 2017 ГОД</h5>
            <canvas id="2017"></canvas>
            <h5 class="text-center">САЛЬДИРОВАННЫЙ ФИНАНСОВЫЙ РЕЗУЛЬТАТ В СООТНОШЕНИИ С КОЛИЧЕСТВОМ РАБОТНИКОВ 2018 ГОД</h5>
            <canvas id="2018"></canvas>
            <h5 class="text-center">САЛЬДИРОВАННЫЙ ФИНАНСОВЫЙ РЕЗУЛЬТАТ В СООТНОШЕНИИ С КОЛИЧЕСТВОМ РАБОТНИКОВ 2019 ГОД</h5>
            <canvas id="2019"></canvas>
            <h5 class="text-center">САЛЬДИРОВАННЫЙ ФИНАНСОВЫЙ РЕЗУЛЬТАТ В СООТНОШЕНИИ С КОЛИЧЕСТВОМ РАБОТНИКОВ 2021 ГОД</h5>
            <canvas id="2021"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('2017');
            const data = {
                labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
                datasets: [
                    {
                        label: 'Сальдированный финансовый результат',
                        data: [2200179, 1388770, 242011],
                        borderWidth: 1
                    },
                    {
                        label: 'Средняя численность работников',
                        data: [11986, 5314, 1567],
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
                        label: 'Сальдированный финансовый результат',
                        data: [3257334, 2090763, 38929],
                        borderWidth: 1
                    },
                    {
                        label: 'Средняя численность работников',
                        data: [11819.8, 5548.1, 1535.4],
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
                        label: 'Сальдированный финансовый результат',
                        data: [3117020, 1961319, 292248],
                        borderWidth: 1
                    },
                    {
                        label: 'Средняя численность работников',
                        data: [11340, 5362, 1388],
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

            const ctx3 = document.getElementById('2021');
            const data3 = {
                labels: ['Малые предприятия', 'Микропредприятия', 'Средние предприятия'],
                datasets: [
                    {
                        label: 'Сальдированный финансовый результат',
                        data: [5242415, 2933327, 886826],
                        borderWidth: 1
                    },
                    {
                        label: 'Средняя численность работников',
                        data: [10652, 5262, 5262],
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
        </script>
    </div>
@endsection
