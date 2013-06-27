<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
<script type="text/javascript">
		function showRecaptcha(element) {
           Recaptcha.create("<?php echo Configure::read("PUBLIC_KEY_FROM_RECAPTCHA_DOT_NET");?>", element, {
    //         theme: "white",
    //         callback: Recaptcha.focus_response_field
			theme : 'custom',
			lang : 'ara',
	        custom_theme_widget: 'recaptcha_widget'
           });
         }
</script>

<div id="recaptcha_widget" class="<?=$lang?>">
    <div id="recaptcha_image"></div>
    <label for="recaptcha_response_field"><?__('Enter text')?></label>
    <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="" />
    
	<div class="reloadToolbar">
		<a href="javascript:Recaptcha.reload()" class="recaptcha_reload"><?__('Get another CAPTCHA')?></a>
		<a href="javascript:Recaptcha.switch_type('image')" class="recaptcha_only_if_image"><?__('Get an audio CAPTCHA')?></a>
		<a href="javascript:Recaptcha.switch_type('audio')" class="recaptcha_only_if_audio"><?__('Get an image CAPTCHA')?></a>
	</div>
</div>
<? if(!empty($captcha_error)){// = $session->read('captcha_error')){
	echo '<div class="error-message captcha-error '.$lang.'">'.$captcha_error.'</div>';
	//$session->delete('captcha_error');
}//debug($captcha_error1);?>
<script type="text/javascript">
	$('#recaptcha_response_field').recaptchaPlaceholder();
</script>
