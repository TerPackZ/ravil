@extends('layouts.app', ['title' => 'Редактировать автомобиль'])

@section('content')
    <section class="section">
        <div class="container auth-wrap">
            @include('admin.partials.nav')
            <form class="auth-card" method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h1>Редактировать автомобиль</h1>
                @include('admin.cars.form')
                <button class="button" type="submit">Обновить</button>
            </form>
        </div>
    </section>
@endsection
