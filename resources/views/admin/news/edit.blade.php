@extends('layouts.app', ['title' => 'Редактировать новость'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            @include('admin.partials.nav')
            <form class="auth-card" method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h1>Редактирование новости</h1>
                @include('admin.news.form')
                <button class="button" type="submit">Обновить</button>
            </form>
        </div>
    </section>
@endsection
