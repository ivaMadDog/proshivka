Dear User,<br/>
<br/>
Username: <?=$data['username']?><br/>
New password: <?=$data['password']?><br/>
<br/>
Use username and password to access by link:  <a href="<?=$data['link']?>"><?=$data['link']?></a>

<?echo '<br/><br/>'.Configure::read('EMAIL_SIGNATURE_HTML');?>