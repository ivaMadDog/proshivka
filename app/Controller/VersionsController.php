<?php
class VersionsController extends AppController {

    public $name = 'Versions';
    public $uses = array('Version');

    public $controllerName='versions';
    public $modelName = 'Version';
    public $cp_title='Версии прошивок принтеров';

    function beforeFilter(){
         parent::beforeFilter();
         $this->set(array('cp_title'=>$this->cp_title.' - '.Configure::read("WEBSITE_NAME"),
                          'controllerName'=>$this->controllerName,
                          'modelName'=>$this->modelName));
        if(empty($this->request->params["admin"])) {
              $this->layout='default_aside';
              $this->set(array('headerColor'=> 'header-green','headerBgImg'=> 'model.png'));
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
          if($this->$modelName->saveField('is_active',$active, array('validate'=>false, 'callbacks'=>false))){
              echo 1;
          }else{
              echo 0;
          }
          exit;
      }    
    
    public function admin_index($id=null){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;

       (!empty($id) && is_numeric($id))?$cond["$modelName.printer_id"]=(int)$id: $cond=array();

       $this->paginate=array(
           'limit'=>12,
           'order'=>array("$modelName.name","$modelName.position", "$modelName.id"),
           'conditions'=>$cond,
           'recursive'=>-1,
           'contain'=>array('Printer'=>array('fields'=>array('Printer.name')))
       );

       $data=$this->paginate($modelName);
       $this->set(array('data'=>$data));
    }

    public function admin_add($id=null){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;
       $actionName='add';

       if(!empty($id)) $this->set('printer_id', $id);
       
       $this->loadModel('Printer');
       $printers=$this->Printer->find('list');       
       
       $this->set(array('cp_subtitle'=> 'Добавление данных', 'action'=>$actionName, 'printers' =>$printers));

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

       $this->loadModel('Printer');
       $printers=$this->Printer->find('list');          
       
       if(empty($id)){
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
       }

       $id=(int)$id;
//	   $old_image=$this->$modelName->read(null, $id);
       $this->set(array('cp_subtitle'=> 'Редактирование версии прошивки', 'action'=>$actionName, 'id'=>$id, 'printers' =>$printers));

       if(!empty($this->request->data)){
		  $this->request->data["$modelName"]["id"] = $id;
          if($this->$modelName->save($this->request->data)){
              $this->Session->setFlash('Данные успешно были обновлены','flash_msg_success',array('title'=>'Обновление данных'));
              $this->redirect("/admin/$this->controllerName/index");
			  exit;
          }else{
              $this->Session->setFlash( 'Не удалось добавить данные','flash_msg_error',array('title'=>'Ошибка обновления данных'));
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
