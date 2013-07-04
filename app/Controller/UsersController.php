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
         $this->Auth->allow('forgot_password','register','logout');
         
         $this->set('roles', $this->roles);
         $this->set('headerColor', 'header-purple'); //переопределяем дефолтный клас для фона хедера
         $this->set('headerBgImg', 'login.png');     //переопределяем фоновое изображения хедера
    }

    
    public function login($data = null){
       //если пользователь уже зарегистрирован, редирект на главную 
       if($this->_loggedIn()) {
           $this->Session->setFlash(__('Вы уже авторизованы.'),'flash_msg_info', array('title'=>'Авторизация невозможна'));
           $this->homePageRedirect();
           exit();
       }
       //если запрос с формы, то пытаемся авторизовать пользователя 
        if ($this->request->is('post')) {
            if ($this->Auth->login($this->request->data)) {
                $this->Session->setFlash(__('Спасибо, что Вы снова с нами.'),'flash_msg_success', array('title'=>'Авторизация прошла успешно'));
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Неправильный email  или пароль'),'flash_msg_error',array('title'=>'Ошибка авторизации'));
            }
        }
    }


    public function logout() {
        $this->Session->destroy();
        $this->logged_in=FALSE;
        $this->set('logged_in', $this->logged_in);
        $this->redirect($this->Auth->logout());
    }
    
    
    public function register(){
        
       if($this->_loggedIn()) {
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
                $this->request->data[$this->modelName]['group_id']= $groups['Group']['id']; //получаем группу по дефолту
                $this->request->data[$this->modelName]['sale_id']= $sales['Sale']['id'];    //получаем скидку по дефолту
                
                $login=explode("@", $this->request->data[$this->modelName]['email']);
                if(!empty($login)) $this->request->data[$this->modelName]['username']= $login[0];
                
                if ($this->User->save($this->request->data)) {
                    $this->sendEmail($this->request->data[$this->modelName]['email'], 
                                     "Успешная регистрация на proshivki.biz", 
                                     'register', 
                                     $this->request->data[$this->modelName]);
                    $this->Session->setFlash(__('Вы успешно зарегистрировались на сайте.</br> Теперь можете авторизоваться.'),'flash_msg_success',array('title'=>'Успех регистрации'));
                    $this->redirect(array('controller'=>'users','action' => 'login'));
                } else {
                    $this->Session->setFlash(__('Вы не смогли зарегистрироваться на сайте. Попробуйте ещё раз.'),'flash_msg_error',array('title'=>'Ошибка регистрации'));
                }
            }    
         }
      }
      
      
      public function forgot_password() {
         if(!empty($this->request->data['User'])){
                $data = $this->request->data['User'];
                $User = $this->User->find('first', array('conditions'=>array('email'=>$data['email']), 'recursive'=>-1));
                if(empty($data['email']) || !Validation::email($data['email'])){
                    $this->User->invalidate('email', $error = __('Введите правильный email', true));
                    $this->setFlashError($error,'json');
                }
                elseif(!$User){
                    //$this->Session->setFlash(__('Invalid Email', true));
                    $this->setFlashError($error = __('Введите правильный email', true),'json');
                }
                if($data = $this->User->saveNewPwd($User['User'])){
                    $data['link'] = Router::url(array('controller'=>'users', 'action'=>'login', 'lang'=>$this->lang), true);
                    $this->_sendNewPwdMail($data);
                    $msg = __('Новый пароль был отправлен на Ваш email', true);
                    $this->setFlashMessage($msg,'json');
                    //$this->Session->setFlash($msg);
                    $this->redirect(array('action'=>'login'));
                }
          }
      }

    
}
?>