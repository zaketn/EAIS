<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ЕАИС</title>

    @vite([
    'resources/css/Plugins/bootstrap.min.css'
    ])
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light mb-4" style="background-color: #e3f2fd;">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">ЕАИС</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('tables') }}">Таблицы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('statistics') }}">Статистика</a>
                </li>
            </ul>
        </div>
        <div class="navbar-nav me-auto mb-2 mb-lg-0">
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarScrollingDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ \Illuminate\Support\Facades\Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="#">Профиль</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Выйти</button>
                        </form>
                    </ul>
                </li>
            @endif
        </div>
    </div>
</nav>

@yield('content')

@vite(['resources/js/app.js',])

</body>
</html>

