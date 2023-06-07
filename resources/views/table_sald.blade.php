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
            <caption class="text-center fw-bold">САЛЬДИРОВАННЫЙ ФИНАНСОВЫЙ РЕЗУЛЬТАТ ПО ВИДАМ ЭКОНОМИЧЕСКОЙ
                ДЕЯТЕЛЬНОСТИ
            </caption>

            <tbody>

                <thead>
                    <tr class='table-info'>
                        <th rowspan="3"></th>
                        <th colspan="4">Малые предприятия</th>
                        <th colspan="2" rowspan="2">Средние предприятия</th>
                    </tr>
                    <tr class='table-info'>
                        <th colspan="2">Всего</th>
                        <th colspan="2">В том числе микропредприятия</th>
                    </tr>
                    <tr class='table-info'>
                        <th>всего, млн руб.</th>
                        <th>в процентах к предыдущему году</th>
                        <th>всего, млн руб.</th>
                        <th>в процентах к предыдущему году</th>
                        <th>всего, млн руб.</th>
                        <th>в процентах к предыдущему году</th>
                    </tr>
                </thead>

            <?php
            $host = '127.0.0.1';
            $db = 'laravel';
            $user = 'root';
            $password = '';
            $port = 3306;
            $charset = 'utf8mb4';
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $db = new mysqli($host, $user, $password, $db, $port);
            $db->set_charset($charset);
            $db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
            $rows_count = $db->query("SELECT COUNT(*) FROM table_rows")->fetch_assoc();
            $id_row_to_rows_count = 1;



            /*echo "<thead><tr class='table-info'><th></th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE parent_column_id = 1");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th>";
            echo "<th></th><th></th><th></th>";
            $col_name = $db->query("SELECT name FROM table_columns WHERE parent_column_id = 8");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th><th></th><tr class='table-info'><th></th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE id = 2");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th><th></th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE id = 3");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th><th></th><th></th><th></th><tr class='table-info'><th></th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE id = 4");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE id = 5");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE id = 6");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE id = 7");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE id = 9");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th>";

            $col_name = $db->query("SELECT name FROM table_columns WHERE id = 10");
            $col = mysqli_fetch_array($col_name);
            echo "<th>" . htmlspecialchars($col['name']) . "</th>";

            echo "</tr></tr></tr></thead>";*/

            while ($id_row_to_rows_count != $rows_count["COUNT(*)"] + 1) {

                $rows_name = $db->query("SELECT name FROM table_rows WHERE table_id = 1 AND id = $id_row_to_rows_count")->fetch_assoc();
                echo "<tr><th scope='row'>" . $rows_name["name"] . "</th>";

                $result = $db->query("SELECT * FROM table_values WHERE table_id = 1 AND table_row_id = $id_row_to_rows_count");
                while ($row = mysqli_fetch_array($result)) {
                    echo "<td>" . htmlspecialchars($row['value']) . "</td>";

                }
                $id_row_to_rows_count++;
                echo "</tr>";
            }
            ?>


            </tbody>
        </table>

    </div>

@endsection
