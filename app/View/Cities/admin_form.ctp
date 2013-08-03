<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'GroupForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Название</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('style'=>'width:400px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Страна</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('country_id', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Краткое описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('short_description', array('rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Полное описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('full_description', array('rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>    
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Позиция</p>
        </div>
        <div class="column grid_10  title-left">
            <?= $this->form->input('position', array('style'=>'width:40px', 'type'=>'text','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>По-умолчанию</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('is_default', array( 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Активный?</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('is_active', array( 'label'=>false, 'div'=>false)) ;?>
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