@extends('layouts.app', ['title' => 'Страница не найдена'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="empty-state">
                <h1>404 — страница не найдена</h1>
                <p>Запрашиваемая страница не существует или была перемещена.</p>
                <div class="page-cta page-cta-center">
                    <a class="button" href="{{ route('home') }}">На главную</a>
                    <a class="button button-ghost" href="{{ route('cars.index') }}">В каталог</a>
                </div>
            </div>
        </div>
    </section>
@endsection
