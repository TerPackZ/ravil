<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ ($title ?? 'Админка') . ' — NewCar' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <a class="skip-link" href="#admin-content">Перейти к содержимому</a>
    <button class="admin-sidebar-backdrop" type="button" data-admin-sidebar-backdrop aria-label="Закрыть меню"></button>
    <aside class="admin-sidebar" data-admin-sidebar id="admin-sidebar">
        <a href="{{ route('admin.index') }}" class="admin-brand">NewCar</a>
        <p class="admin-brand-sub">Панель управления</p>

        @include('admin.partials.nav')

        <div class="admin-sidebar-footer">
            <a class="admin-sidebar-link" href="{{ route('home') }}">← На сайт</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="button button-ghost button-block button-sm" type="submit">Выйти</button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <button class="admin-sidebar-toggle" type="button" data-admin-sidebar-toggle aria-label="Меню админки" aria-expanded="false" aria-controls="admin-sidebar">☰</button>
            <div class="admin-topbar-meta">
                <span class="admin-user">{{ auth()->user()->name }}</span>
            </div>
        </header>

        <main class="admin-content" id="admin-content">
            <div class="flash-container flash-container-admin">
                @include('partials.flash')
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
