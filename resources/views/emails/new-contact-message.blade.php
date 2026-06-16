<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новое сообщение</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2933;">
    <h2>Новое сообщение с формы контактов</h2>
    <p><strong>Имя:</strong> {{ $contactMessage->name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    @if($contactMessage->phone)
        <p><strong>Телефон:</strong> {{ $contactMessage->phone }}</p>
    @endif
    <p><strong>Сообщение:</strong> {{ $contactMessage->message }}</p>
</body>
</html>
