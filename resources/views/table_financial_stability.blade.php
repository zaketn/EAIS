@extends('layout_navbar')
@section('content')

    <div class="container">
        <p></p>

        <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action text-center active " id="list-home-list"
               data-bs-toggle="list" href="#" role="tab" aria-controls="list">2017</a>
            <a class="list-group-item list-group-item-action text-center" id="list-profile-list"
               data-bs-toggle="list" href="#" role="tab" aria-controls="list">2018</a>
            <a class="list-group-item list-group-item-action text-center" id="list-messages-list"
               data-bs-toggle="list" href="#" role="tab" aria-controls="list">2019</a>
            <a class="list-group-item list-group-item-action text-center" id="list-settings-list"
               data-bs-toggle="list" href="#" role="tab" aria-controls="list">2020</a>
            <a class="list-group-item list-group-item-action text-center" id="list-settings-list"
               data-bs-toggle="list" href="#" role="tab" aria-controls="list">2021</a>
        </div>

        <table class="table table-bordered table-hover table-sm caption-top">
            <caption class="text-center fw-bold">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ ПО ВИДАМ ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ</caption>
            <thead>
            <tr class="table-info">
                <th>#</th>
                <th>Колонка</th>
                <th>Колонка</th>
                <th>Колонка</th>
                <th>Колонка</th>
                <th>Колонка</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <th scope="row">Строка</th>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
            </tr>
            <tr>
                <th scope="row">Строка</th>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
            </tr>
            <tr>
                <th scope="row">Строка</th>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
                <td>Значение</td>
            </tr>
            </tbody>
        </table>

    </div>

@endsection
