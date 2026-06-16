@extends('layouts.app', ['title' => 'Админка - новости'])

@section('content')
    <section class="section">
        <div class="container">
            @include('admin.partials.nav')
            <div class="section-head">
                <h1>Новости</h1>
                <a class="button" href="{{ route('admin.news.create') }}">Добавить новость</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Дата</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($newsItems as $news)
                            <tr>
                                <td>{{ $news->title }}</td>
                                <td>{{ $news->published_at->format('d.m.Y') }}</td>
                                <td class="actions">
                                    <a href="{{ route('admin.news.edit', $news) }}">Редактировать</a>
                                    <form method="POST" action="{{ route('admin.news.destroy', $news) }}" data-confirm="Удалить эту новость?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrap">{{ $newsItems->links() }}</div>
        </div>
    </section>
@endsection
