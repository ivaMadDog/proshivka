<?php
class PrintersController extends AppController {

    public $name = 'Printers';
    public $uses = array('Printer');

	public $components = array("FileUpload","RequestHandler");

    public $controllerName='printers';
    public $modelName = 'Printer';
    public $cp_title='Список моделей принтеров';

    function beforeFilter(){
         parent::beforeFilter();
         $folderName=$this->{$this->modelName}->folderName;
         $this->set(array('cp_title'=>$this->cp_title.' - '.Configure::read("WEBSITE_NAME"),
                          'controllerName'=>$this->controllerName,
                          'modelName'=>$this->modelName, 'folderName'=>$folderName));

         if(empty($this->request->params["admin"])) {
              $this->layout='default';
              $this->set(array('headerColor'=> 'header-green','headerBgImg'=> 'models.png'));
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

    public function admin_index(){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;

       $cond=array();

       $this->paginate=array(
           'limit'=>12,
           'order'=>array("$modelName.created DESC", "$modelName.name","$modelName.position", "$modelName.id"),
           'conditions'=>$cond,
           'recursive'=>1
       );

       $data=$this->paginate($modelName);
       $this->set(array('data'=>$data));
    }

    public function admin_add(){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;
       $actionName='add';

       $brands=$this->Printer->Brand->find('list', array('order'=>array("Brand.position")));
       $this->set(array('cp_subtitle'=> 'Добавление данных', 'action'=>$actionName, 'brands'=>$brands));

       if(!empty($this->request->data) && $this->request->is('post')){
          $this->$modelName->create();
          if(empty($this->request->data[$modelName]['date']))$this->request->data[$modelName]['date']=date('Y-m-d G:i:s');
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
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
       }

       $brands=$this->Printer->Brand->find('list', array('order'=>array("Brand.position")));
       $this->set(array('cp_subtitle'=> 'Редактирование данных', 'action'=>$actionName, 'brands'=>$brands));

       if(!empty($this->request->data)){
		  $this->request->data["$modelName"]["id"] = $id;
          if(empty($this->request->data[$modelName]['date']))$this->request->data[$modelName]['date']=date('Y-m-d G:i:s');
          if($this->$modelName->save($this->request->data)){
              $this->Session->setFlash('Данные успешно были обновлены','flash_msg_success',array('title'=>'Обновление данных'));
              $this->redirect("/admin/$this->controllerName/index");
			  exit;
          }else{
              $this->Session->setFlash('Не удалось добавить данные','flash_msg_error',array('title'=>'Ошибка обновления данных'));
          }
       }else{
           $this->request->data=$this->$modelName->find('first',array('conditions'=>array('id'=>$id), 'recursive'=>-1));
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

	public function admin_delete_image($id, $fieldImage){
	   if($this->RequestHandler->isAjax()){
			$this->layout='';
		}

		$modelName=$this->modelName;
		$controllerName=$this->controllerName;

		if($id==null || !is_numeric($id) || empty($fieldImage)){
			if(!$this->RequestHandler->isAjax()){
					$this->Session->setFlash("Неверный запрос");
					$this->redirect("/admin/$controllerName/index");
			}
			echo "Неверный id";
			exit;
		}

		$this->$modelName->clearFieldImage((int)$id, $fieldImage);

        $this->autoRender=false;
	}

    public function index($category_id=0) {

       $controllerName= $this->controllerName;
       $modelName=$this->modelName;

       $cond=array("$modelName.is_active"=>1,   );
       if (!empty($category_id))  $cond["$modelName.category_id"]=(int)$category_id;

       $this->paginate=array(
		   'fields'=>array('id','name','slug','price_fix'),
           'order'=>array("$modelName.date DESC", "$modelName.name", "$modelName.position", "$modelName.id"),
           'conditions'=>$cond,
           'recursive'=>-1
       );

       $this->set(array('data'=>$this->paginate($modelName)));
    }

    public function view($id=null){
	   $controllerName= $this->controllerName;
       $modelName=$this->modelName;

       if(empty($id)){
             $this->Session->setFlash('Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/$controllerName/index");
             exit;
       }

	   $item=$this->$modelName->find('first', array('conditions'=>array("$modelName.id"=>(int)$id)));
	   $neighbors=$this->$modelName->find('neighbors', array('field' => 'id', 'value' => (int)$id));
	   $this->set(compact('item','neighbors'));
    }


}
?>
