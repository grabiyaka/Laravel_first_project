<!DOCTYPE html>
<html lang="en">
<head>
    <base href="http://localhost/laravel/example-app/public/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>page</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <nav>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('main.index') }}">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('contact.index') }}">Контакты</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('about.index') }}">Абаут</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('post.index') }}">Не главная</a>
                </li>

                @can('view', auth()->user())
                 <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.post.index') }}">Admin Panel</a>
                </li>
                @endcan
                <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
                <!-- <ul>
                    <li><a href="{{ route('main.index') }}">Главная</a></li>
                    <li><a href="{{ route('contact.index') }}">Контакты</a></li>
                    <li><a href="{{ route('about.index') }}">Абаут</a></li>
                    <li><a href="{{ route('post.index') }}">Не главная</a></li>
                </ul> -->
            </nav>
        </div>
    </div>
    @yield('content')
</body>
</html>