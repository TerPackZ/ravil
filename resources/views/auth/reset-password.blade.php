@extends('layouts.app', ['title' => 'Новый пароль'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <h1>Новый пароль</h1>
                <div class="field @error('email') field-has-error @enderror">
                    <label class="field-label" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autocomplete="email">
                    @error('email')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('password') field-has-error @enderror">
                    <label class="field-label" for="password">Новый пароль</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    @error('password')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label class="field-label" for="password_confirmation">Подтверждение пароля</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
                <button class="button" type="submit">Сохранить пароль</button>
            </form>
        </div>
    </section>
@endsection
