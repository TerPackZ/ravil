<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статус тест-драйва</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2933;">
    <h2>Статус записи на тест-драйв обновлён</h2>
    <p>Здравствуйте, {{ $testDrive->user->name }}!</p>
    <p><strong>Автомобиль:</strong> {{ $testDrive->car->display_name }}</p>
    <p><strong>Дата:</strong> {{ $testDrive->scheduled_for->format('d.m.Y H:i') }}</p>
    <p><strong>Новый статус:</strong> {{ $testDrive->status->label() }}</p>
    <p>Подробности доступны в <a href="{{ route('dashboard') }}">личном кабинете</a>.</p>
</body>
</html>
