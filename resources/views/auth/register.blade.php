@extends('layouts.app', ['title' => 'Регистрация'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Регистрация</h1>
                <input type="text" name="name" placeholder="Имя" value="{{ old('name') }}" required>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input type="text" name="phone" placeholder="Телефон" value="{{ old('phone') }}">
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="password" name="password_confirmation" placeholder="Подтверждение пароля" required>
                <button class="button" type="submit">Создать аккаунт</button>
                <p>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
            </form>
        </div>
    </section>
@endsection
