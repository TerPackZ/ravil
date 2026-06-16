<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NewCar' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header">
        <div class="container nav">
            <a href="{{ route('home') }}" class="logo">NewCar</a>
            <button class="nav-toggle" type="button" data-nav-toggle aria-label="Открыть меню">Меню</button>
            <nav class="nav-menu" data-nav-menu>
                <a href="{{ route('cars.index') }}">Каталог</a>
                <a href="{{ route('cars.compare') }}">
                    Сравнение
                    @if(($compareCount ?? 0) > 0)
                        <span class="nav-badge">{{ $compareCount }}</span>
                    @endif
                </a>
                <a href="{{ route('about') }}">О компании</a>
                <a href="{{ route('news.index') }}">Новости</a>
                <a href="{{ route('contacts.index') }}">Контакты</a>
                @auth
                    <a href="{{ route('dashboard') }}">Кабинет</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.index') }}">Админка</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="button button-ghost" type="submit">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Вход</a>
                    <a class="button" href="{{ route('register') }}">Регистрация</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="container">
                <div class="alert success">{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="container">
                <div class="alert error">{{ session('error') }}</div>
            </div>
        @endif
        @if($errors->any())
            <div class="container">
                <div class="alert error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <h3>NewCar</h3>
                <p>Современный автосалон с проверенными автомобилями, прозрачными условиями и удобным сервисом.</p>
            </div>
            <div>
                <h3>Контакты</h3>
                <p>г. Омск, ул. Автомобильная, 10</p>
                <p>+7 (900) 123-45-67</p>
                <p>info@newcar.local</p>
            </div>
            <div>
                <h3>Режим работы</h3>
                <p>Пн-Вс: 09:00 - 20:00</p>
            </div>
        </div>
    </footer>
</body>
</html>
