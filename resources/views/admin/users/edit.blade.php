@extends('layouts.app', ['title' => 'Редактировать пользователя'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            @include('admin.partials.nav')
            <form class="auth-card stack-form" method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')
                <h1>Редактирование пользователя</h1>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                <label class="checkbox">
                    <input type="checkbox" name="is_admin" value="1" @checked(old('is_admin', $user->is_admin))>
                    <span>Права администратора</span>
                </label>
                <button class="button" type="submit">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
