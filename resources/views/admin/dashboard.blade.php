@extends('layouts.admin', ['title' => 'Обзор'])

@section('content')
    <div class="admin-page-head">
        <h1>Панель управления</h1>
    </div>

    <div class="info-grid stats-grid">
        <a class="info-card stat-card" href="{{ route('admin.cars.index') }}">
            <h3>Автомобили</h3>
            <p class="stat-value">{{ $stats['cars'] }}</p>
        </a>
        <a class="info-card stat-card" href="{{ route('admin.users.index') }}">
            <h3>Клиенты</h3>
            <p class="stat-value">{{ $stats['users'] }}</p>
        </a>
        <a class="info-card stat-card" href="{{ route('admin.applications.index', ['application_status' => 'new']) }}">
            <h3>Новые заявки</h3>
            <p class="stat-value">{{ $stats['applications_new'] }}</p>
        </a>
        <a class="info-card stat-card" href="{{ route('admin.applications.index', ['test_drive_status' => 'new']) }}">
            <h3>Новые тест-драйвы</h3>
            <p class="stat-value">{{ $stats['test_drives_new'] }}</p>
        </a>
        <a class="info-card stat-card" href="{{ route('admin.applications.index') }}#messages">
            <h3>Сообщения</h3>
            <p class="stat-value">{{ $stats['contact_messages'] }}</p>
        </a>
        <div class="info-card stat-card stat-card-static" aria-label="Избранное: {{ $stats['favorites'] }} добавлений">
            <h3>Избранное</h3>
            <p class="stat-value">{{ $stats['favorites'] }}</p>
            <p class="record-meta">Всего добавлений клиентами</p>
        </div>
    </div>

    <div class="dashboard-columns admin-panels-duo">
        <div class="panel">
            <h2>Последние заявки</h2>
            @forelse($recentApplications as $application)
                <div class="list-row">
                    <a class="list-row-link" href="{{ route('admin.applications.index') }}">
                        <strong>{{ $application->car->display_name }}</strong>
                        <p class="record-meta">{{ $application->user->name }}</p>
                    </a>
                    <span class="badge badge-{{ $application->status->value }}">{{ $application->status->label() }}</span>
                </div>
            @empty
                @include('admin.partials.empty', ['message' => 'Заявок пока нет.'])
            @endforelse
            <a class="panel-link" href="{{ route('admin.applications.index') }}">Все заявки →</a>
        </div>

        <div class="panel">
            <h2>Последние тест-драйвы</h2>
            @forelse($recentTestDrives as $testDrive)
                <div class="list-row">
                    <a class="list-row-link" href="{{ route('admin.applications.index') }}">
                        <strong>{{ $testDrive->car->display_name }}</strong>
                        <p class="record-meta">{{ $testDrive->scheduled_for->format('d.m.Y H:i') }}</p>
                    </a>
                    <span class="badge badge-{{ $testDrive->status->value }}">{{ $testDrive->status->label() }}</span>
                </div>
            @empty
                @include('admin.partials.empty', ['message' => 'Записей пока нет.'])
            @endforelse
            <a class="panel-link" href="{{ route('admin.applications.index') }}">Все записи →</a>
        </div>
    </div>

    <div class="panel">
        <h2>Популярные автомобили</h2>
        @forelse($popularCars as $car)
            <div class="list-row">
                <a class="list-row-link" href="{{ route('admin.cars.edit', $car) }}">
                    <strong>{{ $car->display_name }}</strong>
                </a>
                <span class="list-row-meta">{{ $car->applications_count }} заявок</span>
            </div>
        @empty
            @include('admin.partials.empty', ['message' => 'Данных пока нет.'])
        @endforelse
    </div>
@endsection
