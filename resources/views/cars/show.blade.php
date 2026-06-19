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
                <p class="details-description">{{ $car->description }}</p>

                @include('cars.partials.actions', ['car' => $car])

                @auth
                    <div class="detail-forms">
                        @if($hasActiveApplication)
                            <div class="alert success">У вас уже есть активная заявка на этот автомобиль. Статус можно посмотреть в <a class="text-link" href="{{ route('dashboard') }}">личном кабинете</a>.</div>
                        @else
                            <form class="stack-form stack-form-inset" method="POST" action="{{ route('cars.apply', $car) }}">
                                @csrf
                                <div class="field @error('message') field-has-error @enderror">
                                    <label class="field-label" for="application-message">Комментарий к заявке</label>
                                    <textarea id="application-message" name="message" rows="4" placeholder="Например: интересует trade-in или кредит">{{ old('message') }}</textarea>
                                    @error('message')<span class="field-error-text">{{ $message }}</span>@enderror
                                </div>
                                <button class="button" type="submit">Оформить заявку</button>
                            </form>
                        @endif

                        @if($hasActiveTestDrive ?? false)
                            <div class="alert success">У вас уже есть активная запись на тест-драйв. Подробности — в <a class="text-link" href="{{ route('dashboard') }}">личном кабинете</a>.</div>
                        @else
                            <form class="stack-form stack-form-inset" method="POST" action="{{ route('test-drives.store') }}">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                <div class="field @error('scheduled_for') field-has-error @enderror">
                                    <label class="field-label" for="scheduled_for">Дата и время тест-драйва</label>
                                    <input id="scheduled_for" type="datetime-local" name="scheduled_for" value="{{ old('scheduled_for') }}" min="{{ now()->addHour()->format('Y-m-d\TH:i') }}" max="{{ now()->addMonths(3)->format('Y-m-d\TH:i') }}" required>
                                    @error('scheduled_for')<span class="field-error-text">{{ $message }}</span>@enderror
                                </div>
                                <div class="field @error('comment') field-has-error @enderror">
                                    <label class="field-label" for="test-drive-comment">Пожелания</label>
                                    <textarea id="test-drive-comment" name="comment" rows="3" placeholder="Удобное время, вопросы по комплектации">{{ old('comment') }}</textarea>
                                    @error('comment')<span class="field-error-text">{{ $message }}</span>@enderror
                                </div>
                                <button class="button button-ghost" type="submit">Записаться на тест-драйв</button>
                            </form>
                        @endif
                    </div>
                @else
                    <div class="guest-cta">
                        Чтобы оформить заявку или тест-драйв, <a href="{{ route('login') }}">войдите в аккаунт</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>.
                    </div>
                @endauth
            </div>
        </div>
    </section>

    @if($relatedCars->isNotEmpty())
        <section class="section section-muted">
            <div class="container">
                <div class="section-head">
                    <h2>Похожие предложения</h2>
                </div>
                <div class="card-grid">
                    @foreach($relatedCars as $relatedCar)
                        @include('cars.partials.card', ['car' => $relatedCar, 'showDescription' => false])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
