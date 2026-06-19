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
                    @include('news.partials.card', ['news' => $news])
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
