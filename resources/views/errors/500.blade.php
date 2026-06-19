@extends('layouts.app', ['title' => 'Ошибка сервера'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="empty-state">
                <h1>500 — что-то пошло не так</h1>
                <p>На сервере произошла ошибка. Попробуйте обновить страницу или вернуться позже.</p>
                <div class="page-cta page-cta-center">
                    <a class="button" href="{{ route('home') }}">На главную</a>
                    <a class="button button-ghost" href="{{ route('contacts.index') }}">Связаться с нами</a>
                </div>
            </div>
        </div>
    </section>
@endsection
