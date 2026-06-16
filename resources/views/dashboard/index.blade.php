@extends('layouts.app', ['title' => 'Личный кабинет'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="section-head">
                <h1>Личный кабинет</h1>
                <a href="{{ route('profile.edit') }}">Редактировать профиль</a>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <h3>{{ $user->name }}</h3>
                    <p>{{ $user->email }}</p>
                    <p>{{ $user->phone }}</p>
                </div>
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
                <h2>Избранные автомобили</h2>
                @if($user->favoriteCars->isEmpty())
                    <p>Добавляйте понравившиеся авто из каталога, нажимая «В избранное».</p>
                @else
                    <div class="card-grid">
                        @foreach($user->favoriteCars as $car)
                            <article class="car-card">
                                <img src="{{ $car->image }}" alt="{{ $car->display_name }}">
                                <div class="car-card-body">
                                    <h3>{{ $car->display_name }}</h3>
                                    <p>{{ number_format($car->price, 0, '.', ' ') }} ₽</p>
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
                            <div>
                                <strong>{{ $application->car->display_name }}</strong>
                                <p class="record-meta">{{ $application->created_at->format('d.m.Y H:i') }}</p>
                            </div>
                            <span class="badge badge-{{ $application->status->value }}">{{ $application->status->label() }}</span>
                        </div>
                    @empty
                        <p>Заявок пока нет.</p>
                    @endforelse
                </div>
                <div class="panel">
                    <h2>Записи на тест-драйв</h2>
                    @forelse($user->testDrives as $testDrive)
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
        </div>
    </section>
@endsection
