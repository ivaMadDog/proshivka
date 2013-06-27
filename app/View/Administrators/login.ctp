<? 
//debug($Auth);
$params = array(
'url'=>array('controller'=>'administrators','action'=>'login'), 
'class'=>'forms', 
'id'=>'loginform',
'inputDefaults' => array('div' => false, 'label'=>false));
?>

<?php echo $this->Form->create('User', $params);?>
		<label>Username</label> 
		<?php echo $this->Form->input('username', array('class'=>'required')) ?><br class="clean"/>
		<label>Password</label> 
		<?php echo $this->Form->password('password', array('class'=>'required')) ?><br class="clean"/>

		<input type="submit" value="Login"/>

<?php echo $this->Form->end(); ?>

<script type="text/javascript">
	$("#loginform").validate();
	$('#AdministratorUsername').focus();
</script>