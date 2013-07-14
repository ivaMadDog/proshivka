<?php 
class AdministratorsController extends AppController
{
        public $name = "Administrators";
	public $helpers = array();
	public $components = array();
	public $uses=array('User');

	function beforeFilter(){
		parent::beforeFilter();
                
                $this->Auth->allow('login');
                
                
	}

	public function admin_index() {
        }

	
	public function login(){
            //если пользователь уже зарегистрирован, редирект на главную 
            if($this->_loggedIn()) {
//                $this->Session->setFlash(__('Вы уже авторизованы.'),'flash_msg_info', array('title'=>'Авторизация невозможна'));
                $this->redirect(array('controller'=>'administrators', 'action'=>'admin_index'));
            }
            //если запрос с формы, то пытаемся авторизовать пользователя 
             if ($this->request->is('post') && !empty($this->request->data[$this->modelName]['email']) && !empty($this->request->data[$this->modelName]['password']) ) {
                 $data = $this->{$this->modelName}->find('first', array(
                         'conditions'=>array("{$this->modelName}.email"=>$this->request->data[$this->modelName]['email'],
                                              "{$this->modelName}.password"=> AuthComponent::password($this->request->data[$this->modelName]['password'])   
                                             ),
                         'recursive'=>-1
                     ));
                 if (!empty($data) && $this->Auth->login($data['User'] && $this->Auth->User('role')==='admin')) {
                     $this->Session->setFlash(__('Спасибо, что Вы снова с нами.'),'flash_msg_success', array('title'=>'Авторизация прошла успешно'));
                     $this->redirect(array('controller'=>'administrators', 'action'=>'index', 'admin'=>true));
                 } else {
                     $this->Session->setFlash(__('Неправильный email  или пароль'),'flash_msg_error',array('title'=>'Ошибка авторизации'));
                 }
             }
    }

	function logout(){
		
		setcookie("cyberchisel_ck_authorized", "false", 0, "/");
		
		$this->Session->destroy();
		$this->Session->setFlash('You are logged out! ','admin/admin_err');
		$this->redirect('/Administrators/login');
	}


}