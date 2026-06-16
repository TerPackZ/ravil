@extends('layouts.app', ['title' => 'Новости'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="page-header">
                <h1>Новости и акции</h1>
                <p class="page-subtitle">Актуальные предложения, события и полезные материалы от команды NewCar.</p>
            </div>

            <div class="news-grid">
                @forelse($newsItems as $news)
                    <article class="news-card">
                        <img src="{{ $news->image }}" alt="{{ $news->title }}" loading="lazy">
                        <div class="news-card-body">
                            <span>{{ $news->published_at->format('d.m.Y') }}</span>
                            <h3>{{ $news->title }}</h3>
                            <p>{{ $news->excerpt }}</p>
                            <a class="text-link" href="{{ route('news.show', $news->slug) }}">Читать</a>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <p>Новостей пока нет. Загляните позже или свяжитесь с нами напрямую.</p>
                        <a class="button button-ghost" href="{{ route('contacts.index') }}">Контакты</a>
                    </div>
                @endforelse
            </div>

            <div class="pagination-wrap">
                {{ $newsItems->links() }}
            </div>
        </div>
    </section>
@endsection
