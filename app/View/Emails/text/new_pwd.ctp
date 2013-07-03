Dear User,

Username: <?=$data['username']?>
New password: <?=$data['password']?>

Use username and password to access by link:  <?=$data['link']?>
<?echo str_replace(array('<br>','<br/>','<br />'),"\r\n", Configure::read('EMAIL_SIGNATURE_HTML'));?>