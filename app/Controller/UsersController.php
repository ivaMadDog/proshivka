<?php
class UsersController extends AppController {

    public $name = 'Users';
    public $uses = array('User');
    public $components = array('FileUpload');

    public $modelName = 'User';
    public $controllerName = 'users';
    public $cp_title='Пользователи ';

    public $folderName = 'users';
    public $previewWidth = "300";
    public $previewHeight = "400";
    public $thumbWidth = "90";
    public $thumbHeight = "120";

    private $roles = array('admin'=>'admin','user'=>'user');

    function beforeFilter(){

         parent::beforeFilter();
         $this->Auth->allow('forgot_password','register');

         $this->set('roles', $this->roles);
         $this->set('headerColor', 'header-purple'); //переопределяем дефолтный клас для фона хедера
         $this->set('headerBgImg', 'login.png');     //переопределяем фоновое изображения хедера

         $this->set(array('cp_title'=>$this->cp_title.Configure::read("WEBSITE_NAME"),
                          'controllerName'=>$this->controllerName,
                          'modelName'=>$this->modelName));
    }

 /* авторизация пользователя */
    public function login($data = null){
       //если пользователь уже зарегистрирован, редирект на главную
       if($this->_loggedIn()) {
           $this->Session->setFlash(__('Вы уже авторизованы.'),'flash_msg_info', array('title'=>'Авторизация невозможна'));
           $this->homePageRedirect();
           exit();
       }
       //если запрос с формы, то пытаемся авторизовать пользователя
        if ($this->request->is('post') && !empty($this->request->data[$this->modelName]['email']) && !empty($this->request->data[$this->modelName]['password']) ) {
            $data = $this->{$this->modelName}->find('first', array(
                    'conditions'=>array("{$this->modelName}.email"=>$this->request->data[$this->modelName]['email'],
                                         "{$this->modelName}.password"=> AuthComponent::password($this->request->data[$this->modelName]['password'])
                                        ),
                    'recursive'=>-1
                ));
            
            if (!empty($data) && $this->Auth->login($data['User'])) {
                $this->Session->setFlash(__('Спасибо, что Вы снова с нами.'),'flash_msg_success', array('title'=>'Авторизация прошла успешно'));
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Неправильный email  или пароль'),'flash_msg_error',array('title'=>'Ошибка авторизации'));
            }
        }
    }

/* выход пользователя */
    public function logout() {
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
        $this->logged_in=FALSE;
        $this->set('logged_in', $this->logged_in);

    }

 /* регистрация пользователя */
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
           $this->redirect('/');
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

 /* восстановление пароля */
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
                    $this->Session->setFlash(__($msg),'flash_msg_success',array('title'=>'Пароль восстановлен'));
//                    $this->setFlashMessage($msg,'json');
                    //$this->Session->setFlash($msg);
                    $this->redirect(array('action'=>'login'));
                }
          }
      }

 /* смена пароля */
    public function user_change_password() {

            if(!$this->_loggedIn()){
                $this->Session->setFlash( 'У Вас нет прав доступа к данной странице','flash_msg_error',array('title'=>'Ошибка. Страница не найдена'));
                $this->redirect(array('action'=>'login'));
            }

            $this->{$this->modelName}->validator()->remove('email');
            $this->{$this->modelName}->validator()->add('new_confirm_password', array(
                                                            'required' => array(
                                                                'rule' => 'notEmpty',
                                                                'required' => 'create'
                                                            ),
                                                        ));


            $this->{$this->modelName}->recursive=-1;
            $userdata=$this->{$this->modelName}->read(NULL, $this->Auth->User('id'));
            if (!empty($this->request->data) && isset($this->request->data['User']['password']) &&
                    !empty($this->request->data['User']['confirm_password']) && !empty($this->request->data['User']['new_confirm_password'])) {
              if ($this->request->data['User']['confirm_password']==$this->request->data['User']['new_confirm_password'] &&
                      $userdata['User']['password']==$this->{$this->modelName}->password($this->request->data['User']['password'])){
                            if ($this->{$this->modelName}->saveField('password', $this->request->data['User']['confirm_password'])) {
                                   $this->Session->setFlash('Новый пароль успешно сохранен','flash_msg_success',array('title'=>'Пароль обновлен'));
                                   $this->redirect(array('action'=>'user_profile'));
                             }else{
                                   $this->Session->setFlash('Новый пароль не удалось сохранить','flash_msg_error',array('title'=>'Ошибка.'));
                                   $this->redirect(array('action'=>'user_change_password'));                             }
                 }else {
                        $this->Session->setFlash('Пароли не совпадают','flash_msg_error',array('title'=>'Ошибка ввода пароля'));
                 }
             }
        }

 /* редактирование данных */
    public function user_profile(){

       if(!$this->_loggedIn()){
            $this->Session->setFlash( 'У Вас нет прав доступа к данной странице','flash_msg_error',array('title'=>'Ошибка. Страница не найдена'));
            $this->redirect(array('action'=>'login'));
            exit;
        }

        $this->{$this->modelName}->recursive=-1;
         if (!empty($this->request->data['User'])) {
            $this->request->data['User']['id']=$this->Auth->User('id');
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Данные успешно были обновлены','flash_msg_success',array('title'=>'Профиль обновлен'));
                $this->redirect(array('action'=>'user_profile'));
            }else{
                $this->Session->setFlash( 'Не удалось обновить данные профиля','flash_msg_error',array('title'=>'Ошибка обновления данных'));
                $this->redirect(array('action'=>'user_profile'));
                exit;
            }
        }else{
              $this->request->data=$this->{$this->modelName}->find('first', array('conditions'=>array("{$this->modelName}.id"=>$this->Auth->User('id')),
                                                                                           'recursive'=>-1));
        }

  }

    public function  admin_index() {
     $modelName=$this->modelName;
     $cotrollerName= $this->controllerName;

     $cond=array();

     $this->paginate = array(
        'fields' => array("$modelName.id", "$modelName.email", "$modelName.money","$modelName.is_active"),
        'limit' => 15,
        'order' => array("$modelName.id" => 'DESC'),
        'conditions' => $cond,
        'contain'=>array(
              'Company'=>array(
                  'fields'=>array("Company.id", "Company.name")
              ),
              'Group'=>array(
                  'fields'=>array("Group.id","Group.name")
              ),
              'Sale'=>array(
                  'fields'=>array("Sale.sale")
              )
        )
     );

      $data=$this->paginate($modelName);
      $this->set(compact('data'));
  }

    public function admin_add(){
      $modelName= $this->modelName;

      $sales=$this->$modelName->Sale->find('list');
      $groups=$this->$modelName->Group->find('list');

      $this->set(array('cp_subtitle'=> 'Добавление пользователя',
                        'sales'=>$sales,
                        'groups'=>$groups
              ));

      if($this->request->is('post') && !empty($this->request->data)){
        if (isset($this->request->data[$modelName]["photo"]) && !empty($this->request->data[$modelName]["photo"]["name"])){
               $resizes =array(
                            array('folder'=>WWW_ROOT."/files/images/$this->folderName/thumb","width"=>$this->thumbWidth,"height"=>$this->thumbHeight,'force'=>false),
                            array('folder'=>WWW_ROOT."/files/images/$this->folderName/preview","width"=>$this->previewWidth,"height"=>$this->previewHeight,'force'=>false),
                          );

                $this->request->data[$modelName]['photo']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['photo']['name']);
                $retArray=$this->FileUpload->uploadFile(
                                                            $this->request->data[$modelName]['photo'],
                                                            WWW_ROOT."/files/images/$this->folderName/original",
                                                            'image',
                                                            array('resize'=>true,
                                                                  'resizeOptions'=>$resizes,
                                                                  'randomName'=>false)
                                                        );
                if(!$retArray['error']){
                        $this->request->data[$modelName]['photo']=$retArray['fileName'];
                }else{

                        $fileError=$retArray['errorMsg'];
                        $this->request->data[$modelName]['photo']='';
                        $this->Session->setFlash($fileError);
                        $error=1;
                }
        }else{
                $this->request->data[$modelName]['photo']='';
        }

          $this->$modelName->create();
          if($this->$modelName->save($this->request->data)){
              $this->Session->setFlash('Данные успешно были добавлены','flash_msg_success',array('title'=>'Добавление пользователя'));
              $this->redirect("/admin/$this->controllerName/index");
          }else{
              $this->Session->setFlash( 'Не удалось добавить данные','flash_msg_error',array('title'=>'Ошибка добавления данных'));
          }
      }
  }

    public function  admin_edit($id){
      $modelName= $this->modelName;
      $controllerName = $this->controllerName;

      if(empty($id)){
           $this->Session->setFlash('Запись с данным id не существует','flash_msg_error',array('title'=>'Ошибочный запрос'));
           $this->redirect("/admin/$controllerName/index");
           exit;
      }

      $sales=$this->$modelName->Sale->find('list');
      $groups=$this->$modelName->Group->find('list');
      $this->set(compact('sales','groups', 'modelName', 'controllerName'));

      $this->$modelName->id=(int)$id;
      $get_data=$this->$modelName->read();
      if(empty($this->request->data)) {
            $this->request->data = $get_data;
      }else{
           if (isset($this->request->data[$modelName]["photo"]) && !empty($this->request->data[$modelName]["photo"]["name"])){
                    $resizes =array(
                            array('folder'=>WWW_ROOT."/files/images/$this->folderName/thumb","width"=>$this->thumbWidth,"height"=>$this->thumbHeight,'force'=>false),
                            array('folder'=>WWW_ROOT."/files/images/$this->folderName/preview","width"=>$this->previewWidth,"height"=>$this->previewHeight,'force'=>false),
                          );

                    $this->request->data[$modelName]['photo']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['photo']['name']);
                    $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['photo'],WWW_ROOT."/files/images/$this->folderName/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                    if(!$retArray['error']){
                            $this->request->data["$modelName"]['photo']=$retArray['fileName'];
                    }else{

                            $fileError=$retArray['errorMsg'];
                            unset($this->request->data["$modelName"]['photo']);
                            $this->request->data["$modelName"]['photo']=$get_data["$modelName"]['photo'];
                            $this->Session->setFlash($fileError);
                            $error=1;
                    }
            }else{
                    unset($this->request->data["$modelName"]['photo']);
            }
          if($this->$modelName->save($this->request->data, false)){
              $this->Session->setFlash('Данные успешно были обновлены','flash_msg_success',array('title'=>'Обновление пользователя'));
              $this->redirect("/admin/$controllerName/index");
          }else{
              $this->Session->setFlash('Не удалоь обновить данные','flash_msg_error',array('title'=>'Ошибка редактирования'));
          }
     }
  }

    public function admin_delete($id) {

      $modelName=$this->modelName;
      $controllerName = $this->controllerName;
      $folder_name=$this->folderName;

      if(empty($id)){
          $this->Session->setFlash('Запись с данным id не существует','flash_msg_error',array('title'=>'Ошибочный запрос'));
          $this->redirect("/admin/$controllerName/index");
          exit;
      }

      $data=$this->$modelName->find('first', array('conditions'=>array('id'=>(int)$id), 'recursive'=>-1));
      $this->$modelName->id=(int)$id;
      if($this->RequestHandler->isAjax()){
            $this->layout='';
      }
      if($this->$modelName->delete($id)){
            if(!empty($data["$modelName"]['photo'])) {
                $image_name=$data["$modelName"]['photo'];
                $original_location=WWW_ROOT."files/images/$folder_name/original/$image_name";
                $preview_location=WWW_ROOT."files/images/$folder_name/preview/$image_name";
                $thumb_location=WWW_ROOT."files/images/$folder_name/thumb/$image_name";
                if(file_exists($original_location)) unlink($original_location);
                if(file_exists($preview_location)) unlink($preview_location);
                if(file_exists($thumb_location)) unlink($thumb_location);
            }
            if($this->RequestHandler->isAjax()){
                echo 1;exit;
            }else{
                $this->Session->setFlash('Данные успешно были удалены','flash_msg_success',array('title'=>'Удаление пользователя'));
                $this->redirect("/admin/$controllerName/index");
            }
      }else{
           $this->Session->setFlash('Не удалось удалить данные','flash_msg_error',array('title'=>'Ошибка удаления'));
           exit;
      }
  }

    public function admin_active($id){
          $modelName=$this->modelName;
          $controllerName = $this->controllerName;
          $folder_name=$this->folderName;

          if($this->RequestHandler->isAjax()){ $this->layout='';}

          if(empty($id) || !$this->RequestHandler->isAjax() || !is_numeric($id)){ echo 0; exit;}


          $data=$this->$modelName->find('first', array('conditions'=>array('id'=>(int)$id), 'fields'=>array('id','is_active'),'recursive'=>-1));
          $active=(int)($data[$modelName]['is_active']==1)?0:1;
          $this->$modelName->id=(int)$id;
          if($this->$modelName->saveField('is_active',$active)){
              echo 1;
          }else{
              echo 0;
          }
          exit;
      }

    public function  autocomplete () {

        $this->layout = 'ajax';
        $modelName=$this->modelName;
        $terms = $this->$modelName->find('list', array(
            'conditions'=>array('OR'=>array('username LIKE' => $this->params['url']['term'].'%',
                                            'name LIKE' => $this->params['url']['term'].'%',
                                            'secondname LIKE' => $this->params['url']['term'].'%',
                                            'email LIKE' => $this->params['url']['term'].'%',
                )),
            'order'=>array("$modelName.email", "$modelName.name", "$modelName.username", "$modelName.secondname"),
            'limit'=>10,
            'recursive'=>-1,
        ));

        json_encode($terms);
    }
}
?>