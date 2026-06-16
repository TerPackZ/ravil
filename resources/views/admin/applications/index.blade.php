@extends('layouts.admin', ['title' => 'Заявки и обращения'])

@section('content')
    <div class="admin-page-head">
        <h1>Заявки и обращения</h1>
    </div>

    <form class="filters filters-inline" method="GET" action="{{ route('admin.applications.index') }}">
        <select name="application_status" aria-label="Фильтр заявок">
            <option value="">Все заявки</option>
            @foreach($applicationStatuses as $value => $label)
                <option value="{{ $value }}" @selected(($filters['application_status'] ?? '') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <select name="test_drive_status" aria-label="Фильтр тест-драйвов">
            <option value="">Все тест-драйвы</option>
            @foreach($testDriveStatuses as $value => $label)
                <option value="{{ $value }}" @selected(($filters['test_drive_status'] ?? '') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <div class="filters-actions">
            <button class="button" type="submit">Фильтровать</button>
            @if(($filters['application_status'] ?? '') || ($filters['test_drive_status'] ?? ''))
                <a class="button button-ghost" href="{{ route('admin.applications.index') }}">Сбросить</a>
            @endif
        </div>
    </form>

    <div class="dashboard-columns">
        <div class="panel">
            <h2>Заявки на покупку</h2>
            @forelse($applications as $application)
                <div class="record-card">
                    <div class="record-head">
                        <strong>{{ $application->car->display_name }}</strong>
                        <span class="badge badge-{{ $application->status->value }}">{{ $application->status->label() }}</span>
                    </div>
                    <p class="record-meta">{{ $application->user->name }} • {{ $application->user->email }} • {{ $application->created_at->format('d.m.Y H:i') }}</p>
                    @if($application->message)
                        <p class="record-text">{{ $application->message }}</p>
                    @endif
                    <form class="status-form" method="POST" action="{{ route('admin.applications.update', $application) }}">
                        @csrf
                        @method('PATCH')
                        <select name="status" aria-label="Статус заявки">
                            @foreach($applicationStatuses as $value => $label)
                                <option value="{{ $value }}" @selected($application->status->value === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="button button-ghost button-sm" type="submit">Обновить</button>
                    </form>
                </div>
            @empty
                <p class="record-meta">Заявок нет.</p>
            @endforelse
            <div class="pagination-wrap">{{ $applications->links() }}</div>
        </div>

        <div class="panel">
            <h2>Тест-драйвы</h2>
            @forelse($testDrives as $testDrive)
                <div class="record-card">
                    <div class="record-head">
                        <strong>{{ $testDrive->car->display_name }}</strong>
                        <span class="badge badge-{{ $testDrive->status->value }}">{{ $testDrive->status->label() }}</span>
                    </div>
                    <p class="record-meta">{{ $testDrive->user->name }} • {{ $testDrive->scheduled_for->format('d.m.Y H:i') }}</p>
                    @if($testDrive->comment)
                        <p class="record-text">{{ $testDrive->comment }}</p>
                    @endif
                    <form class="status-form" method="POST" action="{{ route('admin.test-drives.update', $testDrive) }}">
                        @csrf
                        @method('PATCH')
                        <select name="status" aria-label="Статус тест-драйва">
                            @foreach($testDriveStatuses as $value => $label)
                                <option value="{{ $value }}" @selected($testDrive->status->value === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="button button-ghost button-sm" type="submit">Обновить</button>
                    </form>
                </div>
            @empty
                <p class="record-meta">Записей нет.</p>
            @endforelse
            <div class="pagination-wrap">{{ $testDrives->links() }}</div>
        </div>
    </div>

    <div class="panel" id="messages">
        <h2>Сообщения с формы контактов</h2>
        @forelse($contactMessages as $message)
            <div class="record-card">
                <div class="record-head">
                    <strong>{{ $message->name }}</strong>
                    <span class="record-meta">{{ $message->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <p class="record-meta">{{ $message->email }} @if($message->phone) • {{ $message->phone }} @endif</p>
                <p class="record-text">{{ $message->message }}</p>
            </div>
        @empty
            <p class="record-meta">Сообщений нет.</p>
        @endforelse
        <div class="pagination-wrap">{{ $contactMessages->links() }}</div>
    </div>
@endsection
