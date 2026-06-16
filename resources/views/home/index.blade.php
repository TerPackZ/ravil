@extends('layouts.app', ['title' => 'NewCar - автосалон'])

@section('content')
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <p class="eyebrow">Автосалон нового формата</p>
                <h1>Подберем автомобиль, который хочется купить с первого взгляда</h1>
                <p class="hero-text">Новые и проверенные автомобили, выгодные программы кредитования, тест-драйвы и сопровождение сделки в одном месте.</p>
                <div class="hero-actions">
                    <a class="button" href="{{ route('cars.index') }}">Перейти в каталог</a>
                    <a class="button button-ghost" href="{{ route('contacts.index') }}">Связаться с нами</a>
                </div>
            </div>
            <div class="hero-card">
                <h2>Почему выбирают NewCar</h2>
                <ul class="feature-list">
                    <li>Актуальный каталог с фильтрами, поиском и сравнением</li>
                    <li>Кредитный калькулятор и избранные автомобили</li>
                    <li>Быстрое оформление заявки и запись на тест-драйв</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>Популярные автомобили</h2>
                <a href="{{ route('cars.index') }}">Смотреть весь каталог</a>
            </div>
            <div class="card-grid">
                @foreach($featuredCars as $car)
                    <article class="car-card">
                        <img src="{{ $car->image }}" alt="{{ $car->display_name }}">
                        <div class="car-card-body">
                            <div class="car-card-top">
                                <div>
                                    <h3>{{ $car->display_name }}</h3>
                                    <p>{{ $car->year }} • {{ $car->transmission }}</p>
                                </div>
                                <strong>{{ number_format($car->price, 0, '.', ' ') }} ₽</strong>
                            </div>
                            <p>{{ \Illuminate\Support\Str::limit($car->description, 110) }}</p>
                            @include('cars.partials.actions', ['car' => $car])
                            <a class="button button-block" href="{{ route('cars.show', $car->slug) }}">Подробнее</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container">
            <div class="section-head">
                <h2>Новости и акции</h2>
                <a href="{{ route('news.index') }}">Все новости</a>
            </div>
            <div class="news-grid">
                @foreach($latestNews as $news)
                    <article class="news-card">
                        <img src="{{ $news->image }}" alt="{{ $news->title }}">
                        <div class="news-card-body">
                            <span>{{ $news->published_at->format('d.m.Y') }}</span>
                            <h3>{{ $news->title }}</h3>
                            <p>{{ $news->excerpt }}</p>
                            <a href="{{ route('news.show', $news->slug) }}">Читать</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
