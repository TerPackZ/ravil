@extends('layouts.admin', ['title' => 'Редактировать пользователя'])

@section('content')
    <div class="admin-page-head">
        <h1>Редактирование: {{ $user->name }}</h1>
        <a class="button button-ghost" href="{{ route('admin.users.index') }}">← К списку</a>
    </div>

    <div class="admin-form-wrap">
        <form class="stack-form auth-card" method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="field">
                <label class="field-label" for="name">Имя</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="field">
                <label class="field-label" for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="field">
                <label class="field-label" for="phone">Телефон</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
            </div>
            <label class="checkbox">
                <input type="checkbox" name="is_admin" value="1" @checked(old('is_admin', $user->is_admin))>
                <span>Права администратора</span>
            </label>
            <button class="button" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
