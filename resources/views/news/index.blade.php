@extends('layouts.app', ['title' => 'Новости'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="section-head">
                <h1>Новости и акции</h1>
            </div>
            <div class="news-grid">
                @foreach($newsItems as $news)
                    <article class="news-card">
                        <img src="{{ $news->image }}" alt="{{ $news->title }}">
                        <div class="news-card-body">
                            <span>{{ $news->published_at->format('d.m.Y') }}</span>
                            <h3>{{ $news->title }}</h3>
                            <p>{{ $news->excerpt }}</p>
                            <a href="{{ route('news.show', $news->slug) }}">Подробнее</a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="pagination-wrap">
                {{ $newsItems->links() }}
            </div>
        </div>
    </section>
@endsection
