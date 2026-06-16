@extends('layouts.app', ['title' => 'Профиль'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="section-head">
                    <h1>Редактирование профиля</h1>
                    <a class="text-link" href="{{ route('dashboard') }}">← В кабинет</a>
                </div>
                <div class="field @error('name') field-has-error @enderror">
                    <label class="field-label" for="name">Имя</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('email') field-has-error @enderror">
                    <label class="field-label" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                    @error('email')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('phone') field-has-error @enderror">
                    <label class="field-label" for="phone">Телефон</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+7 (900) 123-45-67">
                    @error('phone')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <button class="button" type="submit">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
