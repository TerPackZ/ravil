@extends('layouts.app', ['title' => 'Добавить новость'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            @include('admin.partials.nav')
            <form class="auth-card" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                @csrf
                <h1>Новая новость</h1>
                @include('admin.news.form')
                <button class="button" type="submit">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
