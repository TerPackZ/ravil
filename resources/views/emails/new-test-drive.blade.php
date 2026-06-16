<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новый тест-драйв</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2933;">
    <h2>Новая запись на тест-драйв</h2>
    <p><strong>Клиент:</strong> {{ $testDrive->user->name }} ({{ $testDrive->user->email }})</p>
    <p><strong>Автомобиль:</strong> {{ $testDrive->car->display_name }}</p>
    <p><strong>Дата и время:</strong> {{ $testDrive->scheduled_for->format('d.m.Y H:i') }}</p>
    @if($testDrive->comment)
        <p><strong>Комментарий:</strong> {{ $testDrive->comment }}</p>
    @endif
</body>
</html>
