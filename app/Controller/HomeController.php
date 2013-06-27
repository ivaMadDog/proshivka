<?php
class HomeController extends AppController{
	var $name='Home';
	var $uses=array('User');
        var $helpers = array('Form', 'Html', 'Js', 'Time', 'Ck', 'Text', 'Cache');
	var $contName='homepage';
	var $menuFlag = 'Home';

	function beforeFilter(){
	    parent::beforefilter();
	    $contName=$this->contName;
	    $this->set('ID',$contName);
            $this->layout = 'default';
	}
	
	function index(){
            // echo 'HOME controller';
	}
	
	function register_newsletter(){
		$modelName="Newsletter";
		/////////////////// save newsletter
		$host=Configure::read('NEWSLETTER_URL');	////////without http
		$port=80;
		$path=Configure::read('NEWSLETTER_REGISTRATION_PATH');////////the action name and parameters
		//$str contains the variables that sould be passed to the newsletter
		$str = urlencode("email").'='.urlencode($this->data[$modelName]['email']).'&';
		$str .= urlencode("type").'=0&';
		$str .= urlencode("redirectback").'='.Configure::read('WEBSITE_LOCATION');
		
		$fp = fsockopen($host,$port);
		
		if(!$fp){
			die($_err.$errstr.$errno);
			echo "An error occured, please try again later.";exit;
			$err=1;
		}else {
			fputs($fp, "POST $path HTTP/1.1\r\n");
			fputs($fp, "Host: $host\r\n");
			fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Content-length: ".strlen($str)."\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $str."\r\n\r\n");
			
			
			$d='';
			while(!feof($fp)){
				$d .= fgets($fp,4096);
			}
			
			$matchArray=explode("newsletter_msg=2",$d);
			if(sizeof($matchArray)>1){
				echo __('email_exists',true);;exit;
				$err=1;
			}else{
				echo __('email_saved',true);;exit;
			}
			/////////////////// save newsletter

		}
		exit;
	}
}