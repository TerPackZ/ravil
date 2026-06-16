@extends('layouts.app', ['title' => 'Админка'])

@section('content')
    <section class="section">
        <div class="container">
            @include('admin.partials.nav')
            <div class="section-head">
                <h1>Панель управления</h1>
            </div>

            <div class="info-grid stats-grid">
                <div class="info-card stat-card">
                    <h3>Автомобили</h3>
                    <p class="stat-value">{{ $stats['cars'] }}</p>
                </div>
                <div class="info-card stat-card">
                    <h3>Клиенты</h3>
                    <p class="stat-value">{{ $stats['users'] }}</p>
                </div>
                <div class="info-card stat-card">
                    <h3>Новые заявки</h3>
                    <p class="stat-value">{{ $stats['applications_new'] }}</p>
                </div>
                <div class="info-card stat-card">
                    <h3>Новые тест-драйвы</h3>
                    <p class="stat-value">{{ $stats['test_drives_new'] }}</p>
                </div>
                <div class="info-card stat-card">
                    <h3>Сообщения</h3>
                    <p class="stat-value">{{ $stats['contact_messages'] }}</p>
                </div>
                <div class="info-card stat-card">
                    <h3>Избранное</h3>
                    <p class="stat-value">{{ $stats['favorites'] }}</p>
                </div>
            </div>

            <div class="dashboard-columns">
                <div class="panel">
                    <h2>Последние заявки</h2>
                    @forelse($recentApplications as $application)
                        <div class="list-row">
                            <div>
                                <strong>{{ $application->car->display_name }}</strong>
                                <p class="record-meta">{{ $application->user->name }}</p>
                            </div>
                            <span class="badge badge-{{ $application->status->value }}">{{ $application->status->label() }}</span>
                        </div>
                    @empty
                        <p>Заявок пока нет.</p>
                    @endforelse
                    <a href="{{ route('admin.applications.index') }}">Все заявки →</a>
                </div>

                <div class="panel">
                    <h2>Последние тест-драйвы</h2>
                    @forelse($recentTestDrives as $testDrive)
                        <div class="list-row">
                            <div>
                                <strong>{{ $testDrive->car->display_name }}</strong>
                                <p class="record-meta">{{ $testDrive->scheduled_for->format('d.m.Y H:i') }}</p>
                            </div>
                            <span class="badge badge-{{ $testDrive->status->value }}">{{ $testDrive->status->label() }}</span>
                        </div>
                    @empty
                        <p>Записей пока нет.</p>
                    @endforelse
                </div>
            </div>

            <div class="panel">
                <h2>Популярные автомобили</h2>
                @forelse($popularCars as $car)
                    <div class="list-row">
                        <strong>{{ $car->display_name }}</strong>
                        <span>{{ $car->applications_count }} заявок</span>
                    </div>
                @empty
                    <p>Данных пока нет.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
