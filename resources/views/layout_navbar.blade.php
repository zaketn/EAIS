<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ЕАИС</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;" >
    <div class="container-fluid">
        <a class="navbar-brand">ЕАИС</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Главная</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Список таблиц
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/table_sald">САЛЬДИРОВАННЫЙ ФИНАНСОВЫЙ РЕЗУЛЬТАТ</a></li>
                        <li><a class="dropdown-item" href="/table_number_workers">ЧИСЛЕННОСТЬ РАБОТНИКОВ ПРЕДПРИЯТИЙ</a></li>
                        <li><a class="dropdown-item" href="/table_financial_stability">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ</a></li>
                        <li><a class="dropdown-item" href="/table_main_financial">ОСНОВНЫЕ ФИНАНСОВЫЕ ПОКАЗАТЕЛИ ПО ВИДАМ ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Список графиков
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/graph_sald">САЛЬДИРОВАННЫЙ ФИНАНСОВЫЙ РЕЗУЛЬТАТ</a></li>
                        <li><a class="dropdown-item" href="/graph_number_workers">ЧИСЛЕННОСТЬ РАБОТНИКОВ ПРЕДПРИЯТИЙ</a></li>
                        <li><a class="dropdown-item" href="/graph_financial_stability">ПЛАТЕЖЕСПОСОБНОСТЬ И ФИНАНСОВАЯ УСТОЙЧИВОСТЬ ПРЕДПРИЯТИЙ</a></li>
                        <li><a class="dropdown-item" href="/graph_main_financial">ОСНОВНЫЕ ФИНАНСОВЫЕ ПОКАЗАТЕЛИ ПО ВИДАМ ЭКОНОМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                <button class="btn btn-outline-success" type="submit">Поиск</button>
            </form>
        </div>
    </div>
</nav>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
