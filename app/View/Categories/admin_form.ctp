<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'CategoryForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Название категории</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
   <div class="row">
        <div class="column grid_2 title-left">
          <p>Родительская категория</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('parent_id', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Активная</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('is_active', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
        <div class="row">
        <div class="column grid_2 title-left">
          <p>Краткое описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('short_description', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
    <div class="column grid_2 title-left">
          <p>Полное описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('full_description', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
   
    <div class="row">
        <div class="column grid_2"><p></p></div>
        <div class="column grid_2 ">
            <?= $this->form->submit('Сохранить', array('class'=>'btn_orange','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    
    <?= $this->element('admin/seo');?>
    
    <?php echo $this->form->end() ?>
</div><!-- end .content-area-->