@extends('layout')
@section('content')

<div class="table-responsive container">
    <div class="row mx-auto p-2">
        <div class="col-1">
            <p></p>
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action text-center active " id="list-home-list" data-bs-toggle="list" href="#" role="tab" aria-controls="list">2017</a>
                <a class="list-group-item list-group-item-action text-center" id="list-profile-list" data-bs-toggle="list" href="#" role="tab" aria-controls="list">2018</a>
                <a class="list-group-item list-group-item-action text-center" id="list-messages-list" data-bs-toggle="list" href="#" role="tab" aria-controls="list">2019</a>
                <a class="list-group-item list-group-item-action text-center" id="list-settings-list" data-bs-toggle="list" href="#" role="tab" aria-controls="list">2020</a>
                <a class="list-group-item list-group-item-action text-center" id="list-settings-list" data-bs-toggle="list" href="#" role="tab" aria-controls="list">2021</a>
            </div>
        </div>
        <div class="col-11">
            <table class="table table-bordered table-hover table-sm caption-top">
                <caption>САЛЬДИРОВАННЫЙ ФИНАНСОВЫЙ РЕЗУЛЬТАТ</caption>
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
    </div>
</div>

@endsection
