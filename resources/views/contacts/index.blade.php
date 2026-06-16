@extends('layouts.app', ['title' => 'Контакты'])

@section('content')
    <section class="section">
        <div class="container contact-grid">
            <div>
                <p class="eyebrow">Контакты</p>
                <h1>Свяжитесь с командой NewCar</h1>
                <p>Ответим по наличию автомобилей, поможем с выбором и подберем удобное время для визита.</p>
                <div class="contact-list">
                    <p>Телефон: +7 (900) 123-45-67</p>
                    <p>Email: info@newcar.local</p>
                    <p>Адрес: г. Омск, ул. Автомобильная, 10</p>
                </div>
            </div>
            <form class="stack-form auth-card" method="POST" action="{{ route('contacts.store') }}">
                @csrf
                <h2>Напишите нам</h2>
                <div class="field @error('name') field-has-error @enderror">
                    <label class="field-label" for="name">Ваше имя</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                    @error('name')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('email') field-has-error @enderror">
                    <label class="field-label" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('phone') field-has-error @enderror">
                    <label class="field-label" for="phone">Телефон</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="+7 (900) 123-45-67">
                    @error('phone')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <div class="field @error('message') field-has-error @enderror">
                    <label class="field-label" for="message">Ваш вопрос</label>
                    <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                    @error('message')<span class="field-error-text">{{ $message }}</span>@enderror
                </div>
                <button class="button" type="submit">Отправить</button>
            </form>
        </div>
    </section>
@endsection
