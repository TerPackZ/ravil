<a class="news-card-link" href="{{ route('news.show', $news->slug) }}">
    <article class="news-card">
        <img src="{{ $news->image }}" alt="{{ $news->title }}" loading="lazy">
        <div class="news-card-body">
            <time class="news-date" datetime="{{ $news->published_at->toDateString() }}">{{ $news->published_at->format('d.m.Y') }}</time>
            <h3>{{ $news->title }}</h3>
            <p>{{ $news->excerpt }}</p>
            <span class="news-card-cta">Читать →</span>
        </div>
    </article>
</a>
