@extends('layouts.app', ['title' => 'Восстановление пароля'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('password.email') }}">
                @csrf
                <h1>Восстановление пароля</h1>
                <p class="hero-text">Укажите email — мы отправим ссылку для сброса пароля.</p>
                <div class="field @error('email') field-has-error @enderror">
                    <label class="field-label" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <button class="button" type="submit">Отправить ссылку</button>
                <p><a class="text-link" href="{{ route('login') }}">Вернуться ко входу</a></p>
            </form>
        </div>
    </section>
@endsection
