@extends('layouts.app', ['title' => 'Админка - пользователи'])

@section('content')
    <section class="section">
        <div class="container">
            @include('admin.partials.nav')
            <div class="section-head">
                <h1>Пользователи</h1>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_admin ? 'Администратор' : 'Пользователь' }}</td>
                                <td class="actions">
                                    <a href="{{ route('admin.users.edit', $user) }}">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrap">{{ $users->links() }}</div>
        </div>
    </section>
@endsection
