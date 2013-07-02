<?php
class HomeController extends AppController{
	var $name='Home';
	var $uses=array('User');
        var $helpers = array('Form', 'Html', 'Js', 'Time', 'Ck', 'Text', 'Cache');
	var $menuFlag = 'Home';

	function beforeFilter(){
	    parent::beforefilter();
            $this->layout = 'default';
	}
	
	function index(){
	}
	
}