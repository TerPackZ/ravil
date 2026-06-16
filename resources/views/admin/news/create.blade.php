@extends('layouts.admin', ['title' => 'Новая новость'])

@section('content')
    <div class="admin-page-head">
        <h1>Новая новость</h1>
        <a class="button button-ghost" href="{{ route('admin.news.index') }}">← К списку</a>
    </div>

    <div class="admin-form-wrap">
        <form class="stack-form auth-card" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.news.form')
            <button class="button" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
