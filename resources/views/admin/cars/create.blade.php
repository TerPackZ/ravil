@extends('layouts.app', ['title' => 'Добавить автомобиль'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            @include('admin.partials.nav')
            <form class="auth-card" method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
                @csrf
                <h1>Добавить автомобиль</h1>
                @include('admin.cars.form')
                <button class="button" type="submit">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
