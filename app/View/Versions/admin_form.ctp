<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('type'=>'file','url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'BrandForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Версия прошивки</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('placeholder'=>"Название", 'data-placeholder'=>"Название", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Модель принтера</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('printer_id', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>    
	<div class="row">
        <div class="column grid_2 title-left">
          <p>Отображать?</p>
        </div>
        <div class="column grid_10 ">
            <? 
            if($action=='add')
                echo $this->form->input('is_active', array('checked'=>'checked','label'=>false, 'div'=>false)) ;
            else
                echo $this->form->input('is_active', array('label'=>false, 'div'=>false)) ;
            ?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Обновляемая?</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('is_update', array( 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>    
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Позиция</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('position', array('type'=>'text','label'=>false, 'div'=>false)) ;?>
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