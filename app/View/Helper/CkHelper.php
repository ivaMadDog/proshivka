<?php
class CkHelper extends Helper {

    var $helpers = Array('Html');

    function load($id,$lang='en',$options=null){
        if($lang == "ar")
//      	  $config="customConfig :'config_ar.js'";
      	  $config="contentsLangDirection :'rtl'";
//      	else  $config="customConfig :'config.js'";
      	else  $config="contentsLangDirection :'ltr'";

	    $width="";
	    $settings="width:'95%'";
	    if($options["width"])
	    	$settings.="width:".$options["width"];

	    $code="$(function(){var ck_Content$lang = CKEDITOR.replace('".$id."',{".$config.",".$settings."});CKFinder.setupCKEditor(ck_Content$lang,{ basePath : '/js/ckfinder/'});})";

	    return $this->Html->scriptBlock($code);

    }
}
?>