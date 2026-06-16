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
            <form class="stack-form" method="POST" action="{{ route('contacts.store') }}">
                @csrf
                <input type="text" name="name" placeholder="Ваше имя" value="{{ old('name') }}" required>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input type="text" name="phone" placeholder="Телефон" value="{{ old('phone') }}">
                <textarea name="message" rows="6" placeholder="Ваш вопрос" required>{{ old('message') }}</textarea>
                <button class="button" type="submit">Отправить</button>
            </form>
        </div>
    </section>
@endsection
