@extends('layouts.app', ['title' => 'NewCar - автосалон'])

@section('content')
    <section class="hero">
        <div class="container">
            <div class="hero-top">
                <div class="hero-copy">
                    <p class="eyebrow">Автосалон нового формата</p>
                    <h1>Подберем автомобиль, который хочется купить с первого взгляда</h1>
                    <p class="hero-text">Новые и проверенные автомобили, выгодные программы кредитования, тест-драйвы и сопровождение сделки в одном месте.</p>

                    <div class="hero-metrics">
                        <div class="hero-metric">
                            <strong>{{ $carsCount }}</strong>
                            <span>авто в каталоге</span>
                        </div>
                        <div class="hero-metric">
                            <strong>10+</strong>
                            <span>лет на рынке</span>
                        </div>
                        <div class="hero-metric">
                            <strong>1 день</strong>
                            <span>до тест-драйва</span>
                        </div>
                    </div>

                    <div class="hero-actions">
                        <a class="button" href="{{ route('cars.index') }}">Перейти в каталог</a>
                        <a class="button button-ghost" href="{{ route('contacts.index') }}">Связаться с нами</a>
                    </div>
                </div>

                @if($heroCar)
                    <div class="hero-showcase">
                        <div class="hero-showcase-glow" aria-hidden="true"></div>
                        <img
                            class="hero-showcase-image"
                            src="{{ $heroCar->image }}"
                            alt="{{ $heroCar->display_name }}"
                            width="640"
                            height="480"
                            fetchpriority="high"
                        >
                        <div class="hero-showcase-card">
                            <p class="hero-showcase-label">Рекомендуем</p>
                            <h2>{{ $heroCar->display_name }}</h2>
                            <p class="hero-showcase-meta">{{ $heroCar->year }} • {{ $heroCar->engine }} • {{ $heroCar->transmission }}</p>
                            <p class="price price-sm">{{ number_format($heroCar->price, 0, '.', ' ') }} ₽</p>
                            <a class="button button-sm" href="{{ route('cars.show', $heroCar->slug) }}">Смотреть автомобиль</a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="hero-benefits">
                <article class="hero-benefit">
                    <span class="hero-benefit-icon" aria-hidden="true">01</span>
                    <div>
                        <h3>Актуальный каталог</h3>
                        <p>Фильтры, поиск, сравнение и избранное — всё для быстрого выбора.</p>
                    </div>
                </article>
                <article class="hero-benefit">
                    <span class="hero-benefit-icon" aria-hidden="true">02</span>
                    <div>
                        <h3>Кредит и trade-in</h3>
                        <p>Калькулятор платежа на карточке авто и помощь с оформлением сделки.</p>
                    </div>
                </article>
                <article class="hero-benefit">
                    <span class="hero-benefit-icon" aria-hidden="true">03</span>
                    <div>
                        <h3>Сервис под ключ</h3>
                        <p>Заявка, тест-драйв и сопровождение документов — онлайн и в салоне.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>Популярные автомобили</h2>
                <a class="text-link" href="{{ route('cars.index') }}">Смотреть весь каталог</a>
            </div>
            <div class="card-grid">
                @forelse($featuredCars as $car)
                    @include('cars.partials.card', ['car' => $car])
                @empty
                    <div class="empty-state">
                        <p>Каталог пока пуст. Скоро здесь появятся автомобили.</p>
                        <a class="button" href="{{ route('contacts.index') }}">Связаться с нами</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container">
            <div class="section-head">
                <h2>Новости и акции</h2>
                <a class="text-link" href="{{ route('news.index') }}">Все новости</a>
            </div>
            <div class="news-grid">
                @forelse($latestNews as $news)
                    @include('news.partials.card', ['news' => $news])
                @empty
                    <div class="empty-state">
                        <p>Новостей пока нет. Загляните позже.</p>
                        <a class="button button-ghost" href="{{ route('contacts.index') }}">Связаться с нами</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
