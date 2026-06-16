@extends('layouts.app', ['title' => 'Новый пароль'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <h1>Новый пароль</h1>
                <input type="email" name="email" placeholder="Email" value="{{ old('email', $email) }}" required>
                <input type="password" name="password" placeholder="Новый пароль" required>
                <input type="password" name="password_confirmation" placeholder="Подтверждение пароля" required>
                <button class="button" type="submit">Сохранить пароль</button>
            </form>
        </div>
    </section>
@endsection
