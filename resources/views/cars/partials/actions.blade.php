<div class="car-actions">
    @auth
        @if(in_array($car->id, $favoriteCarIds ?? [], true))
            <form method="POST" action="{{ route('favorites.destroy', $car) }}">
                @csrf
                @method('DELETE')
                <button class="button button-ghost button-sm" type="submit" aria-label="Убрать {{ $car->display_name }} из избранного">★ В избранном</button>
            </form>
        @else
            <form method="POST" action="{{ route('favorites.store', $car) }}">
                @csrf
                <button class="button button-ghost button-sm" type="submit" aria-label="Добавить {{ $car->display_name }} в избранное">☆ В избранное</button>
            </form>
        @endif
    @endauth

    @if(in_array($car->id, $compareCarIds ?? [], true))
        <form method="POST" action="{{ route('cars.compare.destroy', $car) }}">
            @csrf
            @method('DELETE')
            <button class="button button-ghost button-sm" type="submit">Убрать из сравнения</button>
        </form>
    @else
        <form method="POST" action="{{ route('cars.compare.store', $car) }}">
            @csrf
            <button class="button button-ghost button-sm" type="submit">Сравнить</button>
        </form>
    @endif
</div>
