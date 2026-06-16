@extends('layouts.app', ['title' => $article->title])

@section('content')
    <section class="section">
        <div class="container article">
            <img class="article-image" src="{{ $article->image }}" alt="{{ $article->title }}" loading="lazy">
            <p class="eyebrow">{{ $article->published_at->format('d.m.Y') }}</p>
            <h1>{{ $article->title }}</h1>
            <p class="article-lead">{{ $article->excerpt }}</p>
            <div class="article-content">
                @foreach(preg_split("/\r\n|\n|\r/", trim($article->content)) as $paragraph)
                    @if($paragraph !== '')
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    @if($relatedNews->isNotEmpty())
        <section class="section section-muted">
            <div class="container">
                <div class="section-head">
                    <h2>Другие новости</h2>
                    <a class="text-link" href="{{ route('news.index') }}">Все новости</a>
                </div>
                <div class="news-grid">
                    @foreach($relatedNews as $news)
                        <article class="news-card">
                            <img src="{{ $news->image }}" alt="{{ $news->title }}" loading="lazy">
                            <div class="news-card-body">
                                <span>{{ $news->published_at->format('d.m.Y') }}</span>
                                <h3>{{ $news->title }}</h3>
                                <p>{{ $news->excerpt }}</p>
                                <a class="text-link" href="{{ route('news.show', $news->slug) }}">Читать</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
