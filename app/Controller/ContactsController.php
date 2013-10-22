<?php
App::import('Vendor', 'recaptcha/recaptchalib');
App::uses('Sanitize', 'Utility');

class ContactsController extends AppController {

    public $name = 'Contacts';
    public $uses = array('Contact');
	public $components = array("Captcha","Email");
    public $helpers = array("CaptchaTool");

    public $controllerName="contacts";
    public $modelName = 'Contact';
    public $cp_title='Список контактов';

    function beforeFilter(){
         parent::beforeFilter();
         $this->set(array('cp_title'=>$this->cp_title.' - '.Configure::read("WEBSITE_NAME"),
                          'controllerName'=>$this->controllerName,
                          'modelName'=>$this->modelName));    }

    public function admin_index(){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;

       $cond=array();

       $this->paginate=array(
           'limit'=>12,
           'order'=>array("position ASC", "id"),
           'conditions'=>$cond,
       );

       $data=$this->paginate($modelName);
       $this->set(array('data'=>$data));
    }

    public function admin_add(){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;
       $actionName='add';

       $this->set(array('cp_subtitle'=> 'Добавление данных', 'action'=>$actionName));

       if(!empty($this->request->data) && $this->request->is('post')){
          $this->$modelName->create();
          if($this->$modelName->save($this->request->data)){
              $this->Session->setFlash('Данные успешно были добавлены','flash_msg_success',array('title'=>'Добавление данных'));
              $this->redirect("/admin/$this->controllerName/index");
          }else{
              $this->Session->setFlash( 'Не удалось добавить данные','flash_msg_error',array('title'=>'Ошибка добавления данных'));
          }
       }

       $this->render('admin_form');
    }

    public function admin_edit($id){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;
       $actionName='edit';

       if(empty($id)){
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страницы отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
       }

       $id=(int)$id;
       $this->set(array('cp_subtitle'=> 'Редактирование контакта', 'action'=>$actionName, 'id'=>$id));

       if(!empty($this->request->data)){
          $this->$modelName->id=$id;
          if($this->$modelName->save($this->request->data)){
              $this->Session->setFlash('Данные успешно были обновлены','flash_msg_success',array('title'=>'Обновление данных'));
              $this->redirect("/admin/$this->controllerName/index");
          }else{
              $this->Session->setFlash( 'Не удалось добавить данные','flash_msg_error',array('title'=>'Ошибка добавления данных'));
          }
       }else{
           $this->request->data=$this->$modelName->find('first',array('conditions'=>array('id'=>$id)));
       }

       $this->render('admin_form');
    }


    public function admin_delete($id) {

          $modelName=$this->modelName;
          $controllerName = $this->controllerName;

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
                if($this->RequestHandler->isAjax()){
                    echo 1;exit;
                }else{
                    $this->Session->setFlash('Данные успешно были удалены','flash_msg_success',array('title'=>'Удаление записи'));
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


      public function index(){
          $modelName = $this->modelName;
          $controllerName = $this->controllerName;
		  $err=0;
		  if($this->request->is('post') && !empty($this->request->data)){
			  if (!$this->Captcha->validate()) $err=1;
				if($err==0){
					$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
					$this->sendEmail(Configure::read("BASE_ADMIN_EMAIL"), "Обратная связь", "contact", $this->request->data['Contact']);
					$this->sendEmail($this->request->data['Contact']['email'], "Мы получили Ваше письмо", "contact_user", $this->request->data['Contact']);
					$this->Session->setFlash(__('Письмо успешно было отправлено.'),'flash_msg_success',array('title'=>'Письмо отправлено'));
					$this->redirect(array('action' => 'index'));
				}
		  }

		  $this->set('list_contacts',$this->$modelName->find('all', array('conditions'=>array("$modelName.is_active"=>1))));

      }


}
?>
