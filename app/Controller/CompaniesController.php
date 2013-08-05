<?php
class CompaniesController extends AppController {

    public $name = 'Companies';
    public $uses = array('Company');

	public $components = array("FileUpload","RequestHandler");

    public $controllerName='companies';
    public $modelName = 'Company';
    public $cp_title='Компании пользователей';

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
           'order'=>array("$modelName.is_default DESC", "$modelName.name","$modelName.position", "$modelName.id"),
           'conditions'=>$cond, 
           'contain'=>array(
               "City"=>array("id", "name",),
               "User"=>array("id", "name", "username","secondname","email")
           )
            );

       $data=$this->paginate($modelName);
       $this->set(array('data'=>$data));
    }

    public function admin_add(){
       $controllerName= $this->controllerName;
       $modelName=$this->modelName;
       $actionName='add';
       
       $cities=$this->$modelName->City->find('list');
       $users=$this->$modelName->User->find('list');
       $this->set(array('cp_subtitle'=> 'Добавление данных', 'action'=>$actionName,
                        'users'=>$users, 'cities'=>$cities));
       
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
             $this->Session->setFlash( 'Неверный запрос','flash_msg_error',array('title'=>'Страница отсутствует'));
             $this->redirect("/admin/$this->controllerName/index");
             exit;
       }

       $id=(int)$id;
       $cities=$this->$modelName->City->find('list');
       $users=$this->$modelName->User->find('list');
       $this->set(array('cp_subtitle'=> 'Редактирование компании', 'action'=>$actionName, 'id'=>$id,
                        'users'=>$users, 'cities'=>$cities));

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
           $this->request->data=$this->$modelName->find('first',array('conditions'=>array("$modelName.id"=>$id)));
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

}
?>
