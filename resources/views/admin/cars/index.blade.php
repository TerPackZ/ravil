@extends('layouts.app', ['title' => 'Админка - автомобили'])

@section('content')
    <section class="section">
        <div class="container">
            @include('admin.partials.nav')
            <div class="section-head">
                <h1>Управление автомобилями</h1>
                <a class="button" href="{{ route('admin.cars.create') }}">Добавить авто</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Автомобиль</th>
                            <th>Год</th>
                            <th>Цена</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td>{{ $car->display_name }}</td>
                                <td>{{ $car->year }}</td>
                                <td>{{ number_format($car->price, 0, '.', ' ') }} ₽</td>
                                <td class="actions">
                                    <a href="{{ route('admin.cars.edit', $car) }}">Редактировать</a>
                                    <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" data-confirm="Удалить этот автомобиль?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrap">{{ $cars->links() }}</div>
        </div>
    </section>
@endsection
