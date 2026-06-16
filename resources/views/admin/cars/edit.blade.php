@extends('layouts.admin', ['title' => 'Редактировать автомобиль'])

@section('content')
    <div class="admin-page-head">
        <h1>Редактировать: {{ $car->display_name }}</h1>
        <a class="button button-ghost" href="{{ route('admin.cars.index') }}">← К списку</a>
    </div>

    <div class="admin-form-wrap">
        <form class="stack-form auth-card" method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.cars.form')
            <button class="button" type="submit">Обновить</button>
        </form>
    </div>
@endsection
