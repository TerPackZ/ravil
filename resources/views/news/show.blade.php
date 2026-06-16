@extends('layouts.app', ['title' => $article->title])

@section('content')
    <section class="section">
        <div class="container article">
            <img class="article-image" src="{{ $article->image }}" alt="{{ $article->title }}">
            <p class="eyebrow">{{ $article->published_at->format('d.m.Y') }}</p>
            <h1>{{ $article->title }}</h1>
            <p class="article-lead">{{ $article->excerpt }}</p>
            <div class="article-content">
                <p>{{ $article->content }}</p>
            </div>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container">
            <div class="section-head">
                <h2>Другие новости</h2>
            </div>
            <div class="news-grid">
                @foreach($relatedNews as $news)
                    <article class="news-card">
                        <img src="{{ $news->image }}" alt="{{ $news->title }}">
                        <div class="news-card-body">
                            <h3>{{ $news->title }}</h3>
                            <a href="{{ route('news.show', $news->slug) }}">Читать</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
