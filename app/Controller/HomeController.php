<?php
class HomeController extends AppController{
	public $name='Home';
	public $uses=array('User');
    public $helpers = array('Form', 'Html', 'Js', 'Time', 'Ck', 'Text', 'Cache');
	public $menuFlag = 'Home';

	function beforeFilter(){
	    parent::beforefilter();
            $this->layout = 'default';
	}
	
	function index(){
        $this->loadmodel('Printer');
        $printers=$this->Printer->find('list', array('order'=>'name'));
        
        
        $this->set(compact('printers'));
	}
	
}