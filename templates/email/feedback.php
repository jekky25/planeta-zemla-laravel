<?php
global $EMAIL;

$EMAIL = $GLOBALS['EMAIL'];

$CODE_EMAIL = '
<html><head><title>Сообщение обратная связь</title></head>
<body>
<b>Имя: '. $EMAIL['NAME'] .'</b><br><br>
<b>Е-майл: '. $EMAIL['EMAIL'] .'</b><br><br>
<b>Тема: '. $EMAIL['SUBJECT'] .'</b><br><br>
<b>Сообщение: '. $EMAIL['TEXT'] .'</b><br><br>
</body></html>';