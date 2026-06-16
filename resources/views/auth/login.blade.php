@extends('layouts.app', ['title' => 'Вход'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Вход</h1>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <label class="checkbox">
                    <input type="checkbox" name="remember">
                    <span>Запомнить меня</span>
                </label>
                <button class="button" type="submit">Войти</button>
                <p><a href="{{ route('password.request') }}">Забыли пароль?</a></p>
                <p>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
            </form>
        </div>
    </section>
@endsection
