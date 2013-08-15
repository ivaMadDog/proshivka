<?php
class CategoriesController extends AppController
{
    public $name = 'Categories';
    public $uses = array('Category');

    public $helpers = array("NumbersFormat");

    public $modelName = "Category";
    public $controllerName = "categories";

    public $cp_title='Категории новостей';


    function beforefilter(){
         parent::beforeFilter();
         $this->set(array('cp_title'=>$this->cp_title.' - '.Configure::read("WEBSITE_NAME"),
                          'controllerName'=>$this->controllerName,
                          'modelName'=>$this->modelName));
    }
    
    public function admin_index(){
         $this->Category->recursive=-1;
         //$categories=$this->Category->find('threaded');
         $Categorylist=$this->Category->generateTreeList(null, null, null, "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
         $this->set(compact('Categorylist'));
    }
    
    public function admin_add() {
        
        $modelName=$this->modelName;
        $controllerName=$this->controllerName;
        $actionName='add';
        
        if (!empty($this->request->data)) {
            $this->Category->save($this->request->data);
            $this->Session->setFlash('Данные успешно были добавлены','flash_msg_success',array('title'=>'Добавление категории'));
            $this->redirect(array('action'=>'index'));
        } else {
                $parents[0] = "[ Верхний уровень ]";
                $Categorylist = $this->Category->generateTreeList(null,null,null," - ");
                if($Categorylist){
                    foreach ($Categorylist as $key=>$value){
                    $parents[$key] = $value;
                }
            }
        }
        $this->set(array('parents'=>$parents,'modelName'=>$modelName,'controllerName'=>$controllerName, 'action'=>$actionName));
        $this->render('admin_form');
     }
 
    public function admin_edit($id=null) {
        $modelName=$this->modelName;
        $controllerName=$this->controllerName;
        $actionName='edit';
        
        if(empty($id)) {
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
        }
        
        if (!empty($this->request->data)) {
            $this->$modelName->id=$id;
            if($this->$modelName->save($this->request->data)){
                $this->Session->setFlash('Данные успешно были обновлены','flash_msg_success',array('title'=>'Обновление данных'));
                $this->redirect("/admin/$this->controllerName/index");
                exit; 
            }else{
                $this->Session->setFlash( 'Не удалось добавить данные','flash_msg_error',array('title'=>'Ошибка обновления данных'));
            }
        } else {
            $this->request->data = $this->$modelName->read(null, $id);
            $parents[0] = "[ Верхний уровень ]";
            $Categorylist = $this->$modelName->generateTreeList(null,null,null," - ");
            if($Categorylist)
              foreach ($Categorylist as $key=>$value)
                 $parents[$key] = $value;
            
        }
        $this->set(array('parents'=>$parents,'modelName'=>$modelName,'controllerName'=>$controllerName, 'action'=>$actionName, 'id'=>$id));
        $this->render('admin_form');
    }
 
    public function admin_delete($id=null) {
       if(empty($id)){
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
       }
       
        $this->{$this->modelName}->id=$id;
        if($this->{$this->modelName}->delete()==false)
               $this->Session->setFlash('Не удалось удалить данные','flash_msg_error',array('title'=>'Ошибка удаления'));
        $this->redirect(array('action'=>'index'));
     }
 
    public function admin_moveup($id=null) {
        
       if(empty($id)){
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
       }
        
        $this->{$this->modelName}->id=$id;
        if($this->{$this->modelName}->moveUp()==false)
               $this->Session->setFlash('Категория не может быть перемещена вверх','flash_msg_error',array('title'=>'Ошибка удаления'));
        $this->redirect(array('action'=>'index'));
    }
 
    public function admin_moveDown($id=null) {
       if(empty($id)){
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
       }
       
        $this->{$this->modelName}->id=$id;
        if($this->{$this->modelName}->movedown()==false)
               $this->Session->setFlash('Категория не может быть перемещена вниз','flash_msg_error',array('title'=>'Ошибка удаления'));
        $this->redirect(array('action'=>'index'));
    }
    
    public function admin_removeNode($id=null){
       if(empty($id)){
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
       }
       
        if($this->{$this->modelName}->removeFromTree($id)==false)
               $this->Session->setFlash('Не удалось удалить данные','flash_msg_error',array('title'=>'Ошибка удаления'));
        $this->redirect(array('action'=>'index'));
     }
    
    
    
    
    
    
    
    
    
    
}

?>