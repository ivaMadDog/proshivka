Через форму обратной связи было отправлено письмо со следующими данными<br/><br/>
<ul>
	<li><b>Имя пользователя:</b> <?=$data['subject']?></li>
	<li><b>Почта:</b> <?=$data['email']?></li>
	<li><b>Сообщение:</b> <?=$data['message']?></li>
</ul>
<br/><br/>
<?=Configure::read('EMAIL_SIGNATURE_HTML');?>