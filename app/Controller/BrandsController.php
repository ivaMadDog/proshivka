<?php
class BrandsController extends AppController {

    public $name = 'Brands';
    public $uses = array('Brand');

	public $components = array("FileUpload","RequestHandler");

    public $controllerName='brands';
    public $modelName = 'Brand';
    public $cp_title='Производители принтеров';

    function beforeFilter(){
         parent::beforeFilter();
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
       $this->set(array('cp_subtitle'=> 'Редактирование группы', 'action'=>$actionName, 'id'=>$id));

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


}
?>
