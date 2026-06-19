@extends('layouts.admin', ['title' => 'Пользователи'])

@section('content')
    <div class="admin-page-head">
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
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge badge-role-admin">Администратор</span>
                            @else
                                <span class="badge badge-new">Пользователь</span>
                            @endif
                        </td>
                        <td class="table-actions">
                            <a href="{{ route('admin.users.edit', $user) }}">Редактировать</a>
                            @if(auth()->id() !== $user->id)
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" data-confirm="Удалить пользователя {{ $user->name }}?">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button button-ghost button-sm" type="submit">Удалить</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="table-empty">Пользователей нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $users->links() }}</div>
@endsection
