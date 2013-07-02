<?php
class UsersController extends AppController {
    
    
    public $name = 'Users';
    public $uses = array('User');

    public $modelName = 'User';
    public $controller = 'Users';

    
    public $image_dir = '/files/users/';
    public $big_image_dir = 'big/';
    public $small_image_dir = 'small/';
    public $mid_image_dir = 'mid/';
    public $tiny_image_dir = 'tiny/';
    
    private $roles = array('admin'=>'admin','user'=>'user');

    
    function beforeFilter(){

         parent::beforeFilter();
         $this->Auth->allow('register');
         
         $this->set('roles', $this->roles);
         $this->set('headerColor', 'header-purple'); //переопределяем дефолтный клас для фона хедера
         $this->set('headerBgImg', 'login.png');     //переопределяем фоновое изображения хедера
    }

    public function login($data = null){
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }


    public function logout() {
        $role = $this->viewVars['Auth']['User']['role'];
        $this->Session->destroy();
        $this->set('logged_in', false);
        $this->Auth->logout();
        $this->redirect(Router::url(array('controller'=>'home','action'=>'index', 'lang'=>$this->lang)));
    }
    
    
    public function register(){
        
       if($this->Auth->user()) {
           $this->Session->setFlash(__('Вы уже авторизованы.'),'flash_msg_info', array('title'=>'Авторизация невозможна'));
           $this->redirect($this->Auth->redirect());
           exit();
       }
        
        $groups = $this->User->Group->find('first', array('conditions'=>array('is_default'=>1)));
        $sales  = $this->User->Sale->find('first', array('conditions'=>array('is_default'=>1)));
        
        if(empty($groups) || empty($sales)) {
           $this->Session->setFlash(__('На данный момент на сайте невозможно зарегистрироваться.'),'flash_msg_info',array('title'=>'Регистрация невозможна'));
           CakeLog::write('register', 'Регистрация на сайте невозможна. Нет дефолтных значений для Груп или Скидок');
           $this->redirect($this->Auth->redirect());
           exit();
        }
        
        if ($this->request->is('post')) {
            if($this->request->data[$this->modelName]['password']!=$this->request->data[$this->modelName]['confirm_password']){
                 $this->Session->setFlash(__('Пароли не совпадают.'),'flash_msg_error',array('title'=>'Ошибка регистрации'));
            }else {
                $this->User->create();
                $this->request->data[$this->modelName]['group_id']= $groups['Group']['id'];
                $this->request->data[$this->modelName]['sale_id']= $sales['Sale']['id'];
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('Вы успешно зарегистрировались на сайте.</br> Теперь можете авторизоваться.'),'flash_msg_success',array('title'=>'Успех регистрации'));
                    $this->redirect(array('controller'=>'users','action' => 'login'));
                } else {
                    $this->Session->setFlash(__('Вы не смогли зарегистрироваться на сайте. Попробуйте ещё раз.'),'flash_msg_error',array('title'=>'Ошибка регистрации'));
                }
            }    
        }
    }

    
}
?>