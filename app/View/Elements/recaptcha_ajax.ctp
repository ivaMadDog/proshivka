<style type="text/css">
#recaptcha_widget{
float:right;
width:<?php echo $width;?> !important;

}
div#recaptcha_image{
/*height:67px !important;*/
margin-bottom:1px !important;
/*background-color:#ffffff;*/
border:0px;
width:<?php echo $width;?> !important;
}
div#recaptcha_image  img{
width:<?php echo $width;?> !important;
/*
height:67px !important;*/
}
.recaptcha_only_if_image{
font-size:12px;
}
.recaptcha_only_if_audio{
font-size:12px;
}
#recaptcha_widget a{
color:#9E9063;
font-family:Arial;
font-size:12px;
}

.sprite_help_captcha{
width:5px;
height:11px;
background:url(/img/<?php echo $image;?>) 0px 0px;
border:0px;
}
.sprite_sound_captcha{
width:10px;
height:11px;
background:url(/img/<?php echo $image;?>) -33px 0px;
border:0px;
}
.sprite_image_captcha{
width:14px;
height:11px;
background:url(/img/<?php echo $image;?>) -7px 0px;
border:0px;
}
.sprite_reload_captcha{
width:9px;
height:11px;
background:url(/img/<?php echo $image;?>) -22px 0px;
border:0px;
}
</style>
<?php

$IMG_URL = Configure::read('IMG_URL');

?>
<script type="text/javascript">
$(document).ready(function(){
	
 Recaptcha.create("<?php echo Configure::read("PUBLIC_KEY_FROM_RECAPTCHA_DOT_NET");?>", 'recaptcha_widget', {
        theme: "custom"
//       callback: Recaptcha.focus_response_field
    });
    
});

</script>
<div id="recaptcha_widget" class="floatClass" style="display:none;margin-bottom:10px;">
	<div id="recaptcha_image" style=""></div>
	
	<span class="recaptcha_only_if_audio" id="audio_explanation" style="display:none;">Enter the numbers you hear</span>
	
	<?php
	$val=__('enter_code',true); 
	$val_id="recaptcha_response_field"; 
	$onfocus="change_default('$val_id','$val',this.value,false);";
	$onblur="change_default('$val_id','$val',this.value,true);";
	?>
		
	<input type="text" id="<?php echo $val_id;?>" name="<?php echo $val_id;?>" class="<?php echo $className;?>" style="margin-top:1px;" />
	
	<div class="floatClass" style="margin-top:2px;clear:both;width:<?php echo $width;?>">
		<div class="" style="float:right; width:17px;text-align:center;margin-top:1px;"><a href="javascript:Recaptcha.showhelp()" title="Help"><img src="<?php echo Configure::read('BASE_IMG_URL');?>/img/spacer.gif" alt="Help" border="0" class="sprite_help_captcha"/></a></div>
		<div class="recaptcha_only_if_image " style="float:right; margin-top:1px;width:26px;border-right:solid 1px <?php echo $border_color;?>;text-align:center"><a href="javascript:Recaptcha.switch_type('audio');" title="Get an audio code"><img src="<?php echo Configure::read('BASE_IMG_URL');?>/img/spacer.gif" alt="Get an audio CAPTCHA" border="0" class="sprite_sound_captcha"/></a></div>
		<div class="recaptcha_only_if_audio " style="float:right; margin-top:1px;width:26px;border-right:solid 1px <?php echo $border_color;?>;text-align:center"><a href="javascript:Recaptcha.switch_type('image');" title="Get an image code"><img src="<?php echo Configure::read('BASE_IMG_URL');?>/img/spacer.gif" alt="Get an image CAPTCHA" border="0"  class="sprite_image_captcha"/></a></div>
		<div class="" style="float:right; width:17px;border-right:solid 1px <?php echo $border_color;?>;text-align:left;margin-top:1px;"><a href="javascript:Recaptcha.reload()" title="Get another captcha"><img src="<?php echo Configure::read('BASE_IMG_URL');?>/img/spacer.gif" alt="Get another image" border="0" class="sprite_reload_captcha"/></a></div>
	</div>
	
	
	

</div>