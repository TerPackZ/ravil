@extends('layouts.app', ['title' => 'Каталог автомобилей'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="page-header">
                <h1>Каталог автомобилей</h1>
                <p class="page-subtitle">Подберите автомобиль по ключевым параметрам.</p>
            </div>

            <form class="filters" method="GET" action="{{ route('cars.index') }}">
                <input type="search" name="search" placeholder="Поиск по марке, модели..." value="{{ $filters['search'] ?? '' }}" aria-label="Поиск">
                <select name="brand" aria-label="Марка">
                    <option value="">Марка</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}" @selected(($filters['brand'] ?? '') === $brand)>{{ $brand }}</option>
                    @endforeach
                </select>
                <select name="year" aria-label="Год">
                    <option value="">Год</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" @selected((string)($filters['year'] ?? '') === (string)$year)>{{ $year }}</option>
                    @endforeach
                </select>
                <select name="transmission" aria-label="КПП">
                    <option value="">КПП</option>
                    @foreach($transmissions as $transmission)
                        <option value="{{ $transmission }}" @selected(($filters['transmission'] ?? '') === $transmission)>{{ $transmission }}</option>
                    @endforeach
                </select>
                <input type="number" name="price_from" placeholder="Цена от" value="{{ $filters['price_from'] ?? '' }}" aria-label="Цена от">
                <div class="field @error('price_to') field-has-error @enderror">
                    <input type="number" name="price_to" placeholder="Цена до" value="{{ $filters['price_to'] ?? '' }}" aria-label="Цена до">
                    @error('price_to')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <input type="number" name="mileage_to" placeholder="Пробег до, км" value="{{ $filters['mileage_to'] ?? '' }}" aria-label="Пробег до">
                <select name="sort" aria-label="Сортировка">
                    <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Сначала новые</option>
                    <option value="price_asc" @selected(($filters['sort'] ?? '') === 'price_asc')>Цена: по возрастанию</option>
                    <option value="price_desc" @selected(($filters['sort'] ?? '') === 'price_desc')>Цена: по убыванию</option>
                    <option value="year_desc" @selected(($filters['sort'] ?? '') === 'year_desc')>Год: новее</option>
                    <option value="year_asc" @selected(($filters['sort'] ?? '') === 'year_asc')>Год: старше</option>
                </select>
                <div class="filters-actions">
                    <button class="button" type="submit">Применить</button>
                    @if($hasActiveFilters ?? false)
                        <a class="button button-ghost" href="{{ route('cars.index') }}">Сбросить</a>
                    @endif
                </div>
            </form>

            <div class="card-grid">
                @forelse($cars as $car)
                    @include('cars.partials.card', ['car' => $car])
                @empty
                    <div class="empty-state">
                        <p>По заданным фильтрам автомобили не найдены.</p>
                        <a class="button button-ghost" href="{{ route('cars.index') }}">Сбросить фильтры</a>
                    </div>
                @endforelse
            </div>

            <div class="pagination-wrap">
                {{ $cars->links() }}
            </div>
        </div>
    </section>
@endsection
