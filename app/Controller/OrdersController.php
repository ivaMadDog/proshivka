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

			if (isset($this->request->data[$modelName]['fix_link']['name']) && !empty($this->request->data[$modelName]['fix_link']['name'])){
			   $retArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["fix_link"], WWW_ROOT . 'files/fixes', 'file', array('randomName' => true, "extensions" => "rar,zip,7z"));
			   if (!$retArray['error']) {
				   $this->request->data[$modelName]['fix_link'] = $retArray['fileName'];
			   } else {
				   $this->request->data[$modelName]['fix_link'] = "";
				   $fileError = $retArray['errorMsg'];
				   $this->Session->setFlash($fileError,'flash_msg_error',array('title'=>'Ошибка загрузки файла'));
			   }
			}else {
				unset($this->request->data[$modelName]['fix_link']);
			}
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
            $selectedPrinter=$this->$modelName->Printer->find('first', array('conditions'=>array('Printer.id'=>$this->request->data[$modelName]['printer_id']),
                                                                              'recursive'=>-1));
            $this->request->data['Printer_info']=$selectedPrinter['Printer'];

            if($this->$modelName->save($this->request->data)){

                $this->request->data['Payment']=$this->Order->Payment->find('first', array('conditions'=>array(
                                                            'Payment.id'=>$this->request->data[$modelName]['payment_id']),
                                                            'fields'=>array('Payment.name', 'Payment.full_description'),
                                                            'recursive'=>-1,
                                                            ));
                $this->sendEmail($this->request->data[$modelName]['email'], "Заказ на прошивку принят", "fix/create_fix", $this->request->data, $reply_to = "", $from_email = "");
                $this->sendEmail(Configure::read("BASE_ADMIN_EMAIL"), "Новый заказ на прошивку", "fix/admin_create_fix", $this->request->data, $reply_to = "", $from_email = "");

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

    public function user_index(){
		$modelName=$this->modelName;
		$controllerName=$this->controllerName;

		if(!$this->Auth->user()){
                $this->Session->setFlash('Пройдите авторизацию на сайте','flash_msg_error',array('title'=>'Ошибка просмотра заказов'));
				$this->redirect("/");
				exit;
		}
		//статистика по заказам
		$summary=$this->$modelName->getUserSummary($this->Auth->user('id'));
		if(!empty($summary[0])) $this->set('summary',$summary[0]);
		//список заказов
		$cond=array();

		$this->paginate= array(
			'conditions'=>array("$modelName.user_id"=>$this->Auth->user('id')),
			'order'=>array("$modelName.created"),
			'limit'=>5,
			'fields'=>array("$modelName.user_id","$modelName.printer_id","$modelName.order_type_id","$modelName.price",
							"$modelName.created", "$modelName.modified" ,"$modelName.fix_link"),
			'contain'=>array('OrderType'=>array('fields'=>array("OrderType.id", "OrderType.name",)),
							 'Printer'=>array('fields'=>array("Printer.id", "Printer.name","Printer.brand_id", "Printer.slug"), ),
							),
		);

		$this->set('data',$this->paginate($modelName));

    }

}

?>