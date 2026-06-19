@php
    $showDescription = $showDescription ?? true;
@endphp
<article class="car-card">
    <a class="car-card-image-link" href="{{ route('cars.show', $car->slug) }}" tabindex="-1" aria-hidden="true">
        <img src="{{ $car->image }}" alt="{{ $car->display_name }}" loading="lazy">
    </a>
    <div class="car-card-body">
        <div class="car-card-top">
            <div>
                <h3><a class="car-card-title" href="{{ route('cars.show', $car->slug) }}">{{ $car->display_name }}</a></h3>
                <p class="car-card-meta">{{ $car->year }} • {{ $car->engine ?: '—' }} • {{ $car->transmission ?: '—' }}</p>
            </div>
            <span class="price price-sm">{{ number_format($car->price, 0, '.', ' ') }} ₽</span>
        </div>
        @if($showDescription)
            <p>{{ \Illuminate\Support\Str::limit($car->description, 110) }}</p>
        @endif
        @include('cars.partials.actions', ['car' => $car])
        <a class="button button-block" href="{{ route('cars.show', $car->slug) }}">Подробнее</a>
    </div>
</article>
