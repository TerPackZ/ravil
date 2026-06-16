@extends('layouts.admin', ['title' => 'Добавить автомобиль'])

@section('content')
    <div class="admin-page-head">
        <h1>Добавить автомобиль</h1>
        <a class="button button-ghost" href="{{ route('admin.cars.index') }}">← К списку</a>
    </div>

    <div class="admin-form-wrap">
        <form class="stack-form auth-card" method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.cars.form')
            <button class="button" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
