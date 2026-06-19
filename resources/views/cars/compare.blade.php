@extends('layouts.app', ['title' => 'Сравнение автомобилей'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="page-header page-header-with-action">
                <div>
                    <h1>Сравнение автомобилей</h1>
                    <p class="page-subtitle">
                        @if($cars->isNotEmpty())
                            Выбрано {{ $cars->count() }} из 3 автомобилей
                        @else
                            Добавьте до 3 автомобилей из каталога
                        @endif
                    </p>
                </div>
                @if($cars->isNotEmpty())
                    <form method="POST" action="{{ route('cars.compare.clear') }}" data-confirm="Очистить список сравнения?">
                        @csrf
                        @method('DELETE')
                        <button class="button button-ghost" type="submit">Очистить</button>
                    </form>
                @endif
            </div>

            @if($cars->isEmpty())
                <div class="empty-state">
                    <p>Добавьте автомобили из каталога, чтобы сравнить цену, год, пробег и комплектацию.</p>
                    <a class="button" href="{{ route('cars.index') }}">Перейти в каталог</a>
                </div>
            @else
                <div class="table-wrap compare-table">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Параметр</th>
                                @foreach($cars as $car)
                                    <th scope="col">
                                        <a class="text-link" href="{{ route('cars.show', $car->slug) }}">{{ $car->display_name }}</a>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach([
                                'Цена' => fn ($car) => number_format($car->price, 0, '.', ' ').' ₽',
                                'Год' => fn ($car) => $car->year,
                                'Пробег' => fn ($car) => number_format($car->mileage ?? 0, 0, '.', ' ').' км',
                                'Двигатель' => fn ($car) => $car->engine ?? '—',
                                'КПП' => fn ($car) => $car->transmission ?? '—',
                                'Цвет' => fn ($car) => $car->color ?? '—',
                            ] as $label => $value)
                                <tr>
                                    <th scope="row">{{ $label }}</th>
                                    @foreach($cars as $car)
                                        <td>{{ $value($car) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="compare-actions">
                    @foreach($cars as $car)
                        <article class="panel compare-card">
                            <img src="{{ $car->image }}" alt="{{ $car->display_name }}" loading="lazy">
                            <h3>{{ $car->display_name }}</h3>
                            <p class="price price-sm">{{ number_format($car->price, 0, '.', ' ') }} ₽</p>
                            <p class="record-meta">{{ $car->year }} • {{ $car->engine ?? '—' }} • {{ $car->transmission ?? '—' }}</p>
                            @include('cars.partials.actions', ['car' => $car])
                            <a class="button button-block" href="{{ route('cars.show', $car->slug) }}">Подробнее</a>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
