<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NewCar — автосалон с каталогом автомобилей, кредитным калькулятором и онлайн-записью на тест-драйв.">
    <title>{{ isset($title) ? $title . ' — NewCar' : 'NewCar' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#main-content">Перейти к содержимому</a>
    <header class="site-header">
        <div class="container nav">
            <a href="{{ route('home') }}" class="logo">NewCar</a>
            <button class="nav-toggle" type="button" data-nav-toggle aria-label="Открыть меню" aria-expanded="false" aria-controls="site-nav">Меню</button>
            <nav class="nav-menu" id="site-nav" data-nav-menu>
                <a href="{{ route('cars.index') }}" @class(['is-active' => request()->routeIs('cars.index', 'cars.show')])>Каталог</a>
                <a href="{{ route('cars.compare') }}" @class(['is-active' => request()->routeIs('cars.compare')]) aria-label="Сравнение автомобилей{{ ($compareCount ?? 0) > 0 ? ', выбрано '.$compareCount : '' }}">
                    Сравнение
                    @if(($compareCount ?? 0) > 0)
                        <span class="nav-badge" aria-hidden="true">{{ $compareCount }}</span>
                    @endif
                </a>
                <a href="{{ route('about') }}" @class(['is-active' => request()->routeIs('about')])>О компании</a>
                <a href="{{ route('news.index') }}" @class(['is-active' => request()->routeIs('news.*')])>Новости</a>
                <a href="{{ route('contacts.index') }}" @class(['is-active' => request()->routeIs('contacts.*')])>Контакты</a>
                @auth
                    <a href="{{ route('dashboard') }}" @class(['is-active' => request()->routeIs('dashboard', 'profile.*')])>Кабинет</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.index') }}" @class(['is-active' => request()->routeIs('admin.*')])>Админка</a>
                    @endif
                    <form class="nav-logout" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="button button-ghost button-sm" type="submit">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" @class(['is-active' => request()->routeIs('login')])>Вход</a>
                    <a class="button button-sm" href="{{ route('register') }}">Регистрация</a>
                @endauth
            </nav>
        </div>
    </header>

    <main id="main-content">
        <div class="container">
            @include('partials.flash')
        </div>
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
