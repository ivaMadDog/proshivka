<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('type'=>'file','url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'BrandForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Производитель</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('placeholder'=>"Название", 'data-placeholder'=>"Название", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Сайт</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('url', array('placeholder'=>"URL-адрес сайта", 'data-placeholder'=>"URL-адрес сайта", 'label'=>false, 'div'=>false)) ;?>
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
          <p>Позиция</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('position', array( 'type'=>'text','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Фото</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('image', array( 'type'=>'file','label'=>false, 'div'=>false)) ;?>
            <?if(!empty($this->request->data[$modelName]['image'])) : ?>
                <div class="clear"></div>                
                <div id="thumb_<?=$this->request->data[$modelName]['id']?>" class="input_image">
                    <?= $this->html->image("/files/images/$controllerName/image/preview/{$this->request->data[$modelName]['image']}",
                            array("alt"=>"{$this->request->data[$modelName]['name']}", "escape"=>false));?>
                    <a class="input_image_delete" onclick="removeImg(<?=$this->request->data[$modelName]['id']?>,'<?=$controllerName?>','image', '#thumb_<?=$this->request->data[$modelName]['id']?>');return false;">Удалить Х</a>
                </div>
            <? endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Краткое описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('short_description', array('placeholder'=>"Краткое описание сайта", 'data-placeholder'=>"Краткое описание сайта",'rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
	<div class="row">
    <div class="column grid_2 title-left">
          <p>Полное описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('full_description', array('id'=>"TextField",'rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
			<?= $this->ck->load("TextField");?>
        </div>
    </div>

	<?= $this->element('admin/seo');?>

    <div class="row">
        <div class="column grid_2"><p></p></div>
        <div class="column grid_2 ">
            <?= $this->form->submit('Сохранить', array('class'=>'btn_orange','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>


    <?php echo $this->form->end() ?>
</div><!-- end .content-area-->