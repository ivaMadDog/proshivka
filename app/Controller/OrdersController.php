<?php
class OrdersController extends AppController {

    public $name = 'Orders';
    public $uses = array('Order');

	public $components = array("FileUpload","RequestHandler","Auth");

    public $controllerName='orders';
    public $modelName = 'Order';
    public $cp_title='Заказы прошивок';

    function beforeFilter(){
         parent::beforeFilter();
         $folderName=$this->{$this->modelName}->folderName;
         $this->set(array('cp_title'=>$this->cp_title.' - '.Configure::read("WEBSITE_NAME"),
                          'controllerName'=>$this->controllerName,
                          'modelName'=>$this->modelName, 'folderName'=>$folderName));
         $this->Auth->allow("order_fix");
         if(empty($this->request->params["admin"])) {
              $this->layout='default';
         }
    }

    public function admin_index() {
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
       $this->set(array('cp_subtitle'=> 'Редактирование заказа', 'action'=>$actionName, 'id'=>$id));

	   $printers=$this->$modelName->Printer->find('list');
	   $order_types=$this->$modelName->OrderType->find('list');
	   $payments=$this->$modelName->Payment->find('list', array('conditions'=>array('Payment.is_active'=>1)));
	   $this->set(compact('printers','order_types','payments'));

       if(!empty($this->request->data)){
          $this->$modelName->id=$id;
          if($this->$modelName->save($this->request->data)){
              $this->Session->setFlash('Данные успешно были обновлены','flash_msg_success',array('title'=>'Обновление данных'));
              $this->redirect("/admin/$this->controllerName/index");
          }else{
              $this->Session->setFlash( 'Не удалось добавить данные','flash_msg_error',array('title'=>'Ошибка добавления данных'));
          }
       }else{
           $this->request->data=$this->$modelName->find('first',array('conditions'=>array("$modelName.id"=>$id)));
       }

       $this->render('admin_form');
	}

    public function order_fix($printer_id=0) {
        $modelName=$this->modelName;
        $controllerName=$this->controllerName;

        $printers=$this->$modelName->Printer->find('list', array('order'=>'name'));
        $payments=$this->$modelName->Payment->find('list', array('conditions'=>array('Payment.is_active'=>1)));

        if(!empty($this->request->data)){
            if($this->Auth->user()) $this->request->data[$modelName]['user_id']=$this->Auth->user('id'); //получаем ID авторизованного юзера
            $this->request->data[$modelName]['order_type_id']= $this->$modelName->OrderType->getNewStatus(); //получаем статус нового заказа
            $this->request->data[$modelName]['price']=$this->$modelName->Printer->getPriceFix($this->request->data[$modelName]['printer_id']);
            if($this->$modelName->save($this->request->data)){

                $this->sendEmail($this->request->data[$modelName]['email'], "Заказ на прошивку принят", "fix/create_fix", $this->request->data[$modelName], $reply_to = "", $from_email = "");
                $this->sendEmail(Configure::read("BASE_ADMIN_EMAIL"), "Новый заказ на прошивку", "fix/admin_create_fix", $this->request->data[$modelName], $reply_to = "", $from_email = "");

                $this->Session->setFlash('Дополнительная информация была выслана на указанный email','flash_msg_success',array('title'=>'Заказ добавлен'));
                $this->redirect("/");
            }else{
                $this->Session->setFlash( 'Не удалось сохранить заказ','flash_msg_error',array('title'=>'Ошибка добавления заказа'));
            }
        }
        if(!empty($printer_id)) $this->request->data[$modelName]['printer_id']=(int)$printer_id;
        if($this->Auth->user()) {
            $this->request->data[$modelName]['email']=$this->Auth->user('email');
        }
        $this->set(compact('printers','payments'));

    }

    public function index(){

    }

}

?>