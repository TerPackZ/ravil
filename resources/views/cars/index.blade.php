@extends('layouts.app', ['title' => 'Каталог автомобилей'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="section-head">
                <h1>Каталог автомобилей</h1>
                <p>Подберите автомобиль по ключевым параметрам.</p>
            </div>

            <form class="filters" method="GET" action="{{ route('cars.index') }}">
                <input type="search" name="search" placeholder="Поиск по марке, модели..." value="{{ $filters['search'] ?? '' }}">
                <select name="brand">
                    <option value="">Марка</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}" @selected(($filters['brand'] ?? '') === $brand)>{{ $brand }}</option>
                    @endforeach
                </select>
                <select name="year">
                    <option value="">Год</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" @selected((string)($filters['year'] ?? '') === (string)$year)>{{ $year }}</option>
                    @endforeach
                </select>
                <select name="transmission">
                    <option value="">КПП</option>
                    @foreach($transmissions as $transmission)
                        <option value="{{ $transmission }}" @selected(($filters['transmission'] ?? '') === $transmission)>{{ $transmission }}</option>
                    @endforeach
                </select>
                <input type="number" name="price_from" placeholder="Цена от" value="{{ $filters['price_from'] ?? '' }}">
                <input type="number" name="price_to" placeholder="Цена до" value="{{ $filters['price_to'] ?? '' }}">
                <input type="number" name="mileage_to" placeholder="Пробег до, км" value="{{ $filters['mileage_to'] ?? '' }}">
                <select name="sort">
                    <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Сначала новые</option>
                    <option value="price_asc" @selected(($filters['sort'] ?? '') === 'price_asc')>Цена: по возрастанию</option>
                    <option value="price_desc" @selected(($filters['sort'] ?? '') === 'price_desc')>Цена: по убыванию</option>
                    <option value="year_desc" @selected(($filters['sort'] ?? '') === 'year_desc')>Год: новее</option>
                    <option value="year_asc" @selected(($filters['sort'] ?? '') === 'year_asc')>Год: старше</option>
                </select>
                <button class="button" type="submit">Применить</button>
            </form>

            <div class="card-grid">
                @forelse($cars as $car)
                    <article class="car-card">
                        <img src="{{ $car->image }}" alt="{{ $car->display_name }}">
                        <div class="car-card-body">
                            <div class="car-card-top">
                                <div>
                                    <h3>{{ $car->display_name }}</h3>
                                    <p>{{ $car->year }} • {{ $car->engine }}</p>
                                </div>
                                <strong>{{ number_format($car->price, 0, '.', ' ') }} ₽</strong>
                            </div>
                            <p>{{ \Illuminate\Support\Str::limit($car->description, 110) }}</p>
                            @include('cars.partials.actions', ['car' => $car])
                            <a class="button button-block" href="{{ route('cars.show', $car->slug) }}">Открыть карточку</a>
                        </div>
                    </article>
                @empty
                    <p>По заданным фильтрам автомобили не найдены.</p>
                @endforelse
            </div>

            <div class="pagination-wrap">
                {{ $cars->links() }}
            </div>
        </div>
    </section>
@endsection
