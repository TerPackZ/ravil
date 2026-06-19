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
                        @include('news.partials.card', ['news' => $news])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
