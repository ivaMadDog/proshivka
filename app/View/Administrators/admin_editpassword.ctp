<div class="maintitle">Edit Password</div>
<div id="page_content">
	<?php echo $this->Form->create('Administrator',array('url'=>array('controller'=>'administrators','action'=>'admin_editpassword'),'id'=>"edit_pwd",'name'=>'edit_pwd')); ?>
		<div class="input_row">
			<div class="label">Old Password:</div>
			<div class="input_div" style="width:155px;"><?=$this->Form->password('password',array('value'=>'', 'class'=>'required'));?></div>
		</div>
		<div class="input_row">
			<div class="label">New Password:</div>
			<div class="input_div" style="width:155px;"><?php echo $this->Form->password('newpassword',array('value'=>'', 'class'=>'required'));?></div>
		</div>
		<div class="input_row">
			<div class="label">Confirm Password:</div>
			<div class="input_div" style="width:155px;"><?php echo $this->Form->password('confirmpassword',array('value'=>'', 'class'=>'required'));?></div>
		</div>
		<div class="submit_div" style="width:372px;">
			<?php echo $this->Form->submit('Update',array('class'=>'green_button_2'))?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	    $("#edit_pwd").validate({
		  rules: {
		    'data[Administrator][password]': "required",
		    'data[Administrator][newpassword]': "required",
		    'data[Administrator][confirmpassword]': "required",
		    'data[Administrator][confirmpassword]': {
		      equalTo:  '#AdministratorNewpassword'
		    }
		  }
		});
  });
</script>