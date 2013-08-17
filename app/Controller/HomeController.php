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

	public function index(){
        $this->loadModel('Printer'); $this->loadModel('Payment');
        $printers=$this->Printer->find('list', array('order'=>'name'));
        $payments=$this->Payment->find('list', array('conditions'=>array('Payment.is_active'=>1)));

        $this->set(compact('printers', 'payments'));
	}
    public function aboutus(){
        
    }

}