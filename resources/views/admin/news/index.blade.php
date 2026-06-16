@extends('layouts.admin', ['title' => 'Новости'])

@section('content')
    <div class="admin-page-head">
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
                @forelse($newsItems as $news)
                    <tr>
                        <td>{{ $news->title }}</td>
                        <td>{{ $news->published_at->format('d.m.Y') }}</td>
                        <td class="table-actions">
                            <a href="{{ route('news.show', $news->slug) }}" target="_blank" rel="noopener noreferrer">На сайте<span class="sr-only"> (откроется в новой вкладке)</span></a>
                            <a href="{{ route('admin.news.edit', $news) }}">Редактировать</a>
                            <form method="POST" action="{{ route('admin.news.destroy', $news) }}" data-confirm="Удалить эту новость?">
                                @csrf
                                @method('DELETE')
                                <button class="button button-ghost button-sm" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Новостей пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $newsItems->links() }}</div>
@endsection
