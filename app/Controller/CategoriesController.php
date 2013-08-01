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
        if (!empty($this->request->data)) {
            $this->Category->save($this->request->data);
            $this->redirect(array('action'=>'index'));
        } else {
                $parents[0] = "[ Верхний уровень ]";
                $Categorylist = $this->Category->generatetreelist(null,null,null," - ");
                if($Categorylist){
                    foreach ($Categorylist as $key=>$value){
                    $parents[$key] = $value;
                }
                $this->set(compact('parents'));
            }
        }
     }
 
    public function admin_edit($id=null) {
        if (!empty($this->request->data)) {
            if($this->Category->save($this->request->data)==false)
            $this->Session->setFlash('Ошибка сохранения категории.');
            $this->redirect(array('action'=>'index'));
        } else {
            if($id==null) die("Категория не найдена.");
            $this->request->data = $this->Category->read(null, $id);
            $parents[0] = "[ Верхний уровень ]";
            $Categorylist = $this->Category->generatetreelist(null,null,null," - ");
            if($Categorylist)
              foreach ($Categorylist as $key=>$value)
                 $parents[$key] = $value;
            $this->set(compact('parents'));
        }
    }
 
    public function admin_delete($id=null) {
        if($id==null) die("Категория не найдена.");
        $this->Category->id=$id;
        if($this->Category->delete()==false)
             $this->Session->setFlash('Категория не может быть удалена.');
        $this->redirect(array('action'=>'index'));
     }
 
    public function admin_moveup($id=null) {
        if($id==null) die("No ID received");
        $this->Category->id=$id;
        if($this->Category->moveup()==false)
            $this->Session->setFlash('Категория не может быть перемещена вверх.');
        $this->redirect(array('action'=>'index'));
    }
 
    public function admin_movedown($id=null) {
        if($id==null) die("Категория не найдена.");
        $this->Category->id=$id;
        if($this->Category->movedown()==false)
             $this->Session->setFlash('Категория не может быть перемещена вниз.');
        $this->redirect(array('action'=>'index'));
    }
    
    public function admin_removeNode($id=null){
        if($id==null) die("Нечего удалять.");
        if($this->Category->removeFromTree($id)==false)
             $this->Session->setFlash('Категория не может быть удалена.');
        $this->redirect(array('action'=>'index'));
     }
    
    
    
    
    
    
    
    
    
    
}

?>