<?  //		debug($this->request->data)?>
<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('type'=>'file','url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'OrderForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Дата заказа</p>
        </div>
        <div class="column grid_10 ">
            <?= date('d-m-Y', strtotime($this->request->data[$modelName]['created'])) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Тип заказа</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('order_type_id', array('options'=>$order_types,'label'=>false, 'div'=>false)) ;?>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('order_description', array('placeholder'=>"описание к изменению статуса",
															  'data-placeholder'=>"описание к изменению статуса",
															  'cols'=>40, 'rows'=>5,'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Тип оплаты</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('payment_id', array('options'=>$payments, 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Пользователь</p>
        </div>
        <div class="column grid_10 ">
            <?  if(!empty($this->request->data[$modelName]['user_id']))
					echo $this->form->input('User.email', array('label'=>false, 'div'=>false));
				else
					$this->request->data[$modelName]['email'];
			?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Принтер</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('printer_id', array('style'=>'width: 300px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Цена прошивки</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('price', array('type'=>'text','style'=>'width: 40px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Телефон</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('phone', array('style'=>'width: 400px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Серийный номер</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('serial_number', array('style'=>'width: 400px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
	<div class="row">
        <div class="column grid_2 title-left">
          <p>Crum номер</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('crum', array('style'=>'width: 400px', 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Версия прошивки</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('version_fix', array( 'type'=>'text','style'=>'width: 400px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Загрузить прошивку</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('fix_link', array( 'type'=>'file','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>

    <div class="row">
        <div class="column grid_2"><p></p></div>
        <div class="column grid_2 ">
            <?= $this->form->submit('Сохранить', array('class'=>'btn_orange','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>


    <?php echo $this->form->end() ?>
</div><!-- end .content-area-->