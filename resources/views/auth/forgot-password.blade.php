@extends('layouts.app', ['title' => 'Восстановление пароля'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('password.email') }}">
                @csrf
                <h1>Восстановление пароля</h1>
                <p class="hero-text">Укажите email — мы отправим ссылку для сброса пароля.</p>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <button class="button" type="submit">Отправить ссылку</button>
                <p><a href="{{ route('login') }}">Вернуться ко входу</a></p>
            </form>
        </div>
    </section>
@endsection
