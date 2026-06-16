@extends('layouts.app', ['title' => 'Личный кабинет'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="page-header">
                <h1>Личный кабинет</h1>
                <p class="page-subtitle">Здесь собраны ваши заявки, записи на тест-драйв и избранные автомобили.</p>
            </div>

            <div class="dashboard-layout">
                <div class="panel dashboard-profile">
                    <div class="dashboard-profile-head">
                        <div>
                            <h2>{{ $user->name }}</h2>
                            <p class="record-meta">{{ $user->email }}</p>
                            <p class="record-meta">{{ $user->phone ?: 'Телефон не указан' }}</p>
                        </div>
                        <a class="button button-ghost button-sm" href="{{ route('profile.edit') }}">Редактировать профиль</a>
                    </div>
                </div>

                <div class="dashboard-stats">
                    <div class="info-card">
                        <h3>Заявки</h3>
                        <p class="stat-value">{{ $user->applications->count() }}</p>
                    </div>
                    <div class="info-card">
                        <h3>Тест-драйвы</h3>
                        <p class="stat-value">{{ $user->testDrives->count() }}</p>
                    </div>
                    <div class="info-card">
                        <h3>Избранное</h3>
                        <p class="stat-value">{{ $user->favoriteCars->count() }}</p>
                    </div>
                </div>

                <div class="panel">
                    <div class="section-head">
                        <h2>Избранные автомобили</h2>
                        @if($user->favoriteCars->isNotEmpty())
                            <a class="text-link" href="{{ route('cars.index') }}">В каталог</a>
                        @endif
                    </div>
                    @if($user->favoriteCars->isEmpty())
                        <div class="empty-state">
                            <p>Добавляйте понравившиеся авто из каталога, нажимая «В избранное».</p>
                            <a class="button" href="{{ route('cars.index') }}">Перейти в каталог</a>
                        </div>
                    @else
                        <div class="card-grid card-grid-in-panel">
                            @foreach($user->favoriteCars as $car)
                                <article class="car-card">
                                    <img src="{{ $car->image }}" alt="{{ $car->display_name }}" loading="lazy">
                                    <div class="car-card-body">
                                        <h3>{{ $car->display_name }}</h3>
                                        <p class="price price-sm">{{ number_format($car->price, 0, '.', ' ') }} ₽</p>
                                        @include('cars.partials.actions', ['car' => $car])
                                        <a class="button button-block" href="{{ route('cars.show', $car->slug) }}">Открыть</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="dashboard-columns">
                    <div class="panel">
                        <h2>Мои заявки</h2>
                        @forelse($user->applications as $application)
                            <div class="list-row">
                                <a class="list-row-link" href="{{ route('cars.show', $application->car->slug) }}">
                                    <strong>{{ $application->car->display_name }}</strong>
                                    <p class="record-meta">{{ $application->created_at->format('d.m.Y H:i') }}</p>
                                </a>
                                <span class="badge badge-{{ $application->status->value }}">{{ $application->status->label() }}</span>
                            </div>
                        @empty
                            <p class="record-meta">Заявок пока нет. Выберите автомобиль в каталоге и оформите заявку.</p>
                        @endforelse
                    </div>
                    <div class="panel">
                        <h2>Записи на тест-драйв</h2>
                        @forelse($user->testDrives as $testDrive)
                            <div class="list-row">
                                <a class="list-row-link" href="{{ route('cars.show', $testDrive->car->slug) }}">
                                    <strong>{{ $testDrive->car->display_name }}</strong>
                                    <p class="record-meta">{{ $testDrive->scheduled_for->format('d.m.Y H:i') }}</p>
                                </a>
                                <span class="badge badge-{{ $testDrive->status->value }}">{{ $testDrive->status->label() }}</span>
                            </div>
                        @empty
                            <p class="record-meta">Записей пока нет. На странице автомобиля можно выбрать удобное время.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
