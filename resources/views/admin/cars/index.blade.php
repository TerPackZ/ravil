@extends('layouts.admin', ['title' => 'Автомобили'])

@section('content')
    <div class="admin-page-head">
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
                @forelse($cars as $car)
                    <tr>
                        <td>
                            <strong>{{ $car->display_name }}</strong>
                            @if($car->is_featured)
                                <span class="badge badge-in_progress">На главной</span>
                            @endif
                        </td>
                        <td>{{ $car->year }}</td>
                        <td>{{ number_format($car->price, 0, '.', ' ') }} ₽</td>
                        <td class="table-actions">
                            <a href="{{ route('cars.show', $car->slug) }}" target="_blank" rel="noopener noreferrer">На сайте<span class="sr-only"> (откроется в новой вкладке)</span></a>
                            <a href="{{ route('admin.cars.edit', $car) }}">Редактировать</a>
                            <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" data-confirm="Удалить этот автомобиль?">
                                @csrf
                                @method('DELETE')
                                <button class="button button-ghost button-sm" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Автомобили не добавлены.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $cars->links() }}</div>
@endsection
