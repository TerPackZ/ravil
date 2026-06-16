@extends('layouts.app', ['title' => $car->display_name])

@section('content')
    <section class="section">
        <div class="container details-grid">
            <div>
                <img class="details-image" src="{{ $car->image }}" alt="{{ $car->display_name }}">
                @include('cars.partials.credit-calculator', ['car' => $car])
            </div>
            <div class="details-card">
                <p class="eyebrow">{{ $car->brand }}</p>
                <h1>{{ $car->display_name }}</h1>
                <p class="price">{{ number_format($car->price, 0, '.', ' ') }} ₽</p>
                <div class="spec-grid">
                    <span>Год: {{ $car->year }}</span>
                    <span>Пробег: {{ number_format($car->mileage ?? 0, 0, '.', ' ') }} км</span>
                    <span>Двигатель: {{ $car->engine }}</span>
                    <span>КПП: {{ $car->transmission }}</span>
                    <span>Цвет: {{ $car->color }}</span>
                </div>
                <p>{{ $car->description }}</p>

                @include('cars.partials.actions', ['car' => $car])

                @auth
                    @if($hasActiveApplication)
                        <div class="alert success">У вас уже есть активная заявка на этот автомобиль. Статус можно посмотреть в <a href="{{ route('dashboard') }}">личном кабинете</a>.</div>
                    @else
                        <form class="stack-form" method="POST" action="{{ route('cars.apply', $car) }}">
                            @csrf
                            <textarea name="message" rows="4" placeholder="Комментарий к заявке"></textarea>
                            <button class="button" type="submit">Оформить заявку</button>
                        </form>
                    @endif

                    @if($hasActiveTestDrive ?? false)
                        <div class="alert success">У вас уже есть активная запись на тест-драйв. Подробности — в <a href="{{ route('dashboard') }}">личном кабинете</a>.</div>
                    @else
                        <form class="stack-form" method="POST" action="{{ route('test-drives.store') }}">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="datetime-local" name="scheduled_for" required>
                            <textarea name="comment" rows="3" placeholder="Пожелания к тест-драйву"></textarea>
                            <button class="button button-ghost" type="submit">Записаться на тест-драйв</button>
                        </form>
                    @endif
                @else
                    <p>Чтобы оформить заявку или тест-драйв, <a href="{{ route('login') }}">войдите в аккаунт</a>.</p>
                @endauth
            </div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container">
            <div class="section-head">
                <h2>Похожие предложения</h2>
            </div>
            <div class="card-grid">
                @foreach($relatedCars as $relatedCar)
                    <article class="car-card">
                        <img src="{{ $relatedCar->image }}" alt="{{ $relatedCar->display_name }}">
                        <div class="car-card-body">
                            <h3>{{ $relatedCar->display_name }}</h3>
                            <p>{{ number_format($relatedCar->price, 0, '.', ' ') }} ₽</p>
                            @include('cars.partials.actions', ['car' => $relatedCar])
                            <a class="button button-block" href="{{ route('cars.show', $relatedCar->slug) }}">Подробнее</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
