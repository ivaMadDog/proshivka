<?  $appName = Configure::read('WEBSITE_NAME');?>

Рады Вас приветствовать на сайте  proshivka.biz - магазин прошивок<br/><br/>

Это письмо содержит информацию по Вашему аккаунту.<br/>
Используйте следующий email и пароль для авторизации на сайте :<br/>
Логин: <?=$data['email']?><br/>
Пароль: <?=$data['password']?><br/>

<?= '<br/><br/>'.Configure::read('EMAIL_SIGNATURE_HTML');?>