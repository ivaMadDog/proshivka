<div class="admin_area" >
     <?php echo $this->form->create('Group', array('type'=>'file', 'url'=>array('controller'=>'groups', 'action'=>'add', 'admin'=>true), 'id'=>'GroupForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Группа</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('placeholder'=>"Название", 'data-placeholder'=>"Название", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('short_description', array('rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Позиция</p>
        </div>
        <div class="column grid_10  title-left">
            <?= $this->form->input('position', array( 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>По-умолчанию</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('is_default', array('placeholder'=>"Email", 'data-placeholder'=>"Email", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
   
    <div class="row">
        <div class="column grid_2"><p></p></div>
        <div class="column grid_2 ">
            <?= $this->form->submit('Добавить', array('class'=>'btn_orange','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    
    
    <?php echo $this->form->end() ?>
</div><!-- end .content-area-->