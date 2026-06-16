@extends('layouts.app', ['title' => 'Сравнение автомобилей'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="section-head">
                <h1>Сравнение автомобилей</h1>
                @if($cars->isNotEmpty())
                    <form method="POST" action="{{ route('cars.compare.clear') }}" data-confirm="Очистить список сравнения?">
                        @csrf
                        @method('DELETE')
                        <button class="button button-ghost" type="submit">Очистить</button>
                    </form>
                @endif
            </div>

            @if($cars->isEmpty())
                <div class="panel">
                    <p>Добавьте до 3 автомобилей из каталога, чтобы сравнить характеристики.</p>
                    <a class="button" href="{{ route('cars.index') }}">Перейти в каталог</a>
                </div>
            @else
                <div class="table-wrap compare-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Параметр</th>
                                @foreach($cars as $car)
                                    <th>
                                        <a href="{{ route('cars.show', $car->slug) }}">{{ $car->display_name }}</a>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Цена</td>
                                @foreach($cars as $car)
                                    <td>{{ number_format($car->price, 0, '.', ' ') }} ₽</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Год</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->year }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Пробег</td>
                                @foreach($cars as $car)
                                    <td>{{ number_format($car->mileage ?? 0, 0, '.', ' ') }} км</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Двигатель</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->engine ?? '—' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>КПП</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->transmission ?? '—' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Цвет</td>
                                @foreach($cars as $car)
                                    <td>{{ $car->color ?? '—' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Описание</td>
                                @foreach($cars as $car)
                                    <td>{{ \Illuminate\Support\Str::limit($car->description, 120) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="compare-actions">
                    @foreach($cars as $car)
                        <div class="stack-form compare-card">
                            <img src="{{ $car->image }}" alt="{{ $car->display_name }}">
                            <h3>{{ $car->display_name }}</h3>
                            @include('cars.partials.actions', ['car' => $car])
                            <a class="button button-block" href="{{ route('cars.show', $car->slug) }}">Открыть карточку</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
