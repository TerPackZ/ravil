@extends('layouts.app', ['title' => 'Вход'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Вход</h1>
                <div class="field @error('email') field-has-error @enderror">
                    <label class="field-label" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('password') field-has-error @enderror">
                    <label class="field-label" for="password">Пароль</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    @error('password')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <label class="checkbox">
                    <input type="checkbox" name="remember">
                    <span>Запомнить меня</span>
                </label>
                <button class="button" type="submit">Войти</button>
                <p><a class="text-link" href="{{ route('password.request') }}">Забыли пароль?</a></p>
                <p>Нет аккаунта? <a class="text-link" href="{{ route('register') }}">Зарегистрироваться</a></p>
            </form>
        </div>
    </section>
@endsection
