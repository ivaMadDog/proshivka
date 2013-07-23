<?php

class GroupsController extends AppController {
    
    public $name = 'Groups';
    public $uses = array('Group');

    public $controllerName='groups';
    public $modelName = 'Group';
    public $cp_title='Группы пользователей';

   function beforeFilter(){

         parent::beforeFilter();
         $this->Auth->allow('forgot_password','register');
         
         $this->set('roles', $this->roles);
         
         $this->set(array('cp_title'=>$this->cp_title.' - '.Configure::read("WEBSITE_NAME"), 
                          'controllerName'=>$this->controllerName,
                          'modelName'=>$this->modelName));
    }
    
    public function admin_index(){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;
       
       $cond=array();
       
       $this->paginate=array(
           'limit'=>12,
           'order'=>array("position", "id"),
           'conditions'=>$cond,
       );
       
       $data=$this->paginate($modelName);
       $this->set(array('data'=>$data));
    }
    
    public function admin_add(){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;
       
       $this->set(array('cp_subtitle'=> 'Добавление группы'));
       
       if(!empty($this->request->data)){
          $this->$modelName->create();
          if($this->$modelName->save($this->request->data)){
              $this->Session->setFlash('Данные успешно были добавлены','flash_msg_success',array('title'=>'Добавление данных')); 
              $this->redirect("/admin/$this->controllerName/index");
          }else{
              $this->Session->setFlash( 'Не удалось добавить данные','flash_msg_error',array('title'=>'Ошибка добавления данных')); 
          }
       }
       
    }
    
    
    
    
    
    
    
}   
?>
