<html><head><title>Сообщение с формы обратной связи</title></head>
<body>
<b>Имя:</b> {{ $data->name }} <br>
<b>Е-майл: </b> {{ $data->email }} <br>
<b>Тема: </b> {{ $data->subject }} <br>
<b>Сообщение: </b> {{ $data->message }} <br>
</body></html>