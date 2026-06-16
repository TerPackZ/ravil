<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статус заявки</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2933;">
    <h2>Статус вашей заявки обновлён</h2>
    <p>Здравствуйте, {{ $application->user->name }}!</p>
    <p><strong>Автомобиль:</strong> {{ $application->car->display_name }}</p>
    <p><strong>Новый статус:</strong> {{ $application->status->label() }}</p>
    <p>Вы можете посмотреть детали в <a href="{{ route('dashboard') }}">личном кабинете</a>.</p>
</body>
</html>
