@extends('layouts.app', ['title' => 'Регистрация'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Регистрация</h1>
                <div class="field @error('name') field-has-error @enderror">
                    <label class="field-label" for="name">Имя</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name">
                    @error('name')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('email') field-has-error @enderror">
                    <label class="field-label" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('phone') field-has-error @enderror">
                    <label class="field-label" for="phone">Телефон</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="+7 (900) 123-45-67" autocomplete="tel">
                    @error('phone')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('password') field-has-error @enderror">
                    <label class="field-label" for="password">Пароль</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    @error('password')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label class="field-label" for="password_confirmation">Подтверждение пароля</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
                <button class="button" type="submit">Создать аккаунт</button>
                <p>Уже есть аккаунт? <a class="text-link" href="{{ route('login') }}">Войти</a></p>
            </form>
        </div>
    </section>
@endsection
