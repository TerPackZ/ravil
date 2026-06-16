<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новая заявка</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2933;">
    <h2>Новая заявка на покупку</h2>
    <p><strong>Клиент:</strong> {{ $application->user->name }} ({{ $application->user->email }})</p>
    <p><strong>Автомобиль:</strong> {{ $application->car->display_name }}</p>
    <p><strong>Цена:</strong> {{ number_format($application->car->price, 0, '.', ' ') }} ₽</p>
    @if($application->message)
        <p><strong>Комментарий:</strong> {{ $application->message }}</p>
    @endif
    <p><strong>Дата:</strong> {{ $application->created_at->format('d.m.Y H:i') }}</p>
</body>
</html>
