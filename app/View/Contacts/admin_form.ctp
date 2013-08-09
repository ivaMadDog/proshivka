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
          <p>Тип</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->select('type', array('phone'=>'Телефон',
                                                 'email'=>'Email',
                                                 'skype'=>'Skype',
                                                 'fax'=>'Факс',
                                                 'fb'=>'Компьютер',),
                                           array( 'empty'=> 'Выберите тип контакта','label'=>false, 'div'=>false)) ;?>
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
          <p>Размещение в меню</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('top', array('label'=>' Верхнее меню', 'div'=>false)) ;?>
            <?= $this->form->input('footer', array('label'=>' Нижнее меню', 'div'=>false)) ;?>
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