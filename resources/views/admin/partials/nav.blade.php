<nav class="admin-nav">
    <a href="{{ route('admin.index') }}" @class(['is-active' => request()->routeIs('admin.index')])>Обзор</a>
    <a href="{{ route('admin.cars.index') }}" @class(['is-active' => request()->routeIs('admin.cars.*')])>Автомобили</a>
    <a href="{{ route('admin.users.index') }}" @class(['is-active' => request()->routeIs('admin.users.*')])>Пользователи</a>
    <a href="{{ route('admin.news.index') }}" @class(['is-active' => request()->routeIs('admin.news.*')])>Новости</a>
    <a href="{{ route('admin.applications.index') }}" @class(['is-active' => request()->routeIs('admin.applications.*', 'admin.test-drives.*')])>
        Заявки
        @php
            $pendingCount = ($pendingApplications ?? 0) + ($pendingTestDrives ?? 0);
        @endphp
        @if($pendingCount > 0)
            <span class="nav-badge">{{ $pendingCount }}</span>
        @endif
    </a>
</nav>
