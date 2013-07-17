Уважаемый,<br/>
<br/>
Email: <?=$data['username']?><br/>
Пароль: <?=$data['password']?><br/>
<br/>
Используйте данный email и пароль для входа на сайт:  <a href="<?=$data['link']?>"><?=$data['link']?></a>

<?echo '<br/><br/>'.Configure::read('EMAIL_SIGNATURE_HTML');?>