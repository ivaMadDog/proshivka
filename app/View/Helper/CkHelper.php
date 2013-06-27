<?php
class CkHelper extends Helper {

    var $helpers = Array('Html', 'Javascript');

    var $default_config = 'config.js';

    function load($id, $lang = 'en', $default_options = array()){
        $did = '';
        $config = $this->default_config;
        foreach (explode('.', $id) as $v) {
            $did .= ucfirst($v);
        }

        $options = array();
        if($default_options)
            foreach($default_options AS $k=>$v){
                $options[] = "$k:'$v'";
            }
        
        $settings = array();
        $settings[] = "defaultLanguage:'{$lang}'";
        if($lang == "ar"){
            $settings[] = "contentsLangDirection:'rtl'";
            $settings[] = "EditorPreviewTemplate:'ck_preview_ar.html'";
        }

        $settings = array_merge($settings, $options);
        $settings = implode(',', $settings);

        $code = "var ck_Content$lang = CKEDITOR.replace('$did',{{$settings}}); CKFinder.SetupCKEditor(ck_Content$lang);";  
        return $this->Javascript->codeBlock($code); 
        

    }
}
?>