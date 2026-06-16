@extends('layouts.app', ['title' => 'Профиль'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            <form class="stack-form auth-card" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <h1>Редактирование профиля</h1>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                <button class="button" type="submit">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
