@extends('layouts.admin', ['title' => 'Редактировать новость'])

@section('content')
    <div class="admin-page-head">
        <h1>Редактирование новости</h1>
        <a class="button button-ghost" href="{{ route('admin.news.index') }}">← К списку</a>
    </div>

    <div class="admin-form-wrap">
        <form class="stack-form auth-card" method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.news.form')
            <button class="button" type="submit">Обновить</button>
        </form>
    </div>
@endsection
