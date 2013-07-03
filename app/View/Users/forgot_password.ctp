<h4><?__('Forgot password')?></h4>
<div id="forgotpwd_container">
            <p><?__('Just submit your Email ID and we will send your password to your Email')?></p>

			<?if(!empty($error)){?>
			<div class="error-message"><?=sprintf(__('IMPORTANT: %s',''), $error)?></div>
			<?}?>
    <?=$this->Form->create('User', array('action'=>'forgot_password#forgot_password', 'id'=>'forgotpwd-form', 'class'=>'form', 'inputDefaults' => array('div' => false, 'label'=>false, 'error'=>false)));?>
    <?=$this->Form->input('email', array('label'=>__('Enter your Email',''),'id'=>'ForgotEmail','class'=>'textbox width-186'));?><br/>
    <?=$this->Form->end(array('label'=>__('Submit', true), 'class'=>'submit-btn', 'div'=>false));?>
</div>
<a href="#" class="close-box">close</a>


<script type="text/javascript">
//<![CDATA[
$(function(){
var id = 'forgotpwd-form';
var forgotpwd_form = $('#forgotpwd-form');
//var div = '<div class="error-message">IMPORTANT: Please provide the required information for field(s) marked in red.</div>';
forgotpwd_form.ajaxForm({
	beforeSend:function(){
		var error = false;
        var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
		if($('#ForgotEmail').val() == '' || !$('#ForgotEmail').val().match(pattern)){
			$('#ForgotEmail').addClass('error');
			$('.error-message').remove();
			$('#forgotpwd-form').before('<div class="error-message"><?__('Please enter a valid email address')?></div>');
			error = true;
		}
		if(!error){
			forgotpwd_form.append('<div id="loader"></div>');
		}
		return !error;
	},
	success:function(data){
		$('#ForgotEmail').val('');
		if(isJSON(data)){
			var objResponse = jQuery.parseJSON(data); 
			if (typeof objResponse.message != 'undefined'){
				$('#forgotpwd_container').hide();
				$('H4', $('#forgotpwd_container').parents('DIV:first')).after(objResponse.message);
	    	}
			if (typeof objResponse.error != 'undefined'){
				$('#forgotpwd-form').before('<div class="error-message">'+objResponse.error+'</div>');
	    	}
	    }
		else{
			$('#forgot-pwd-box').html(data);
		}
		$('#loader').remove();
	}
});

$('#password').bind('keypress', function(){$('#HAVE_PWD').attr('checked','checked')});
$('#ForgotEmail').bind('keypress', function(){$('.error-message').remove()});
$('.forgot-pwd').click(function(e){
	e.preventDefault();
	$('.error-message').remove();
	$('#forgotpwd-form .error').removeClass('error');
	$('.forgot-pwd-box #flashMessage').remove();

	$('#ForgotEmail').val('');
	$('#ForgotEmail').focus();
	$('.forgot-pwd-box').show();
	$('#forgotpwd_container').show();
})

$('.close-box').click(function(e){
	e.preventDefault();
	$(this).parents('DIV:first').hide();
});

})
//]]>
</script>
