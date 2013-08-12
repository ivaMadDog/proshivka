<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('type'=>'file','url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'PaymentForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Тип оплаты</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('style'=>'width: 300px' , 'label'=>false, 'div'=>false)) ;?>
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
        <div class="column grid_2 title-left">
          <p>Позиция</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('position', array('style'=>'width: 40px' ,'type'=>'text','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Логотип <br />(100px*100px, 1:1)</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('image', array( 'type'=>'file','label'=>false, 'div'=>false)) ;?>
            <?if(!empty($this->request->data[$modelName]['image']) && !empty($this->request->data[$modelName]['id'])) : ?>
                <div class="clear"></div>
                <div id="thumb_<?=$this->request->data[$modelName]['id']?>" class="input_image">
                    <?= $this->html->image("/files/images/$controllerName/image/preview/{$this->request->data[$modelName]['image']}",
                            array("alt"=>"{$this->request->data[$modelName]['name']}", "escape"=>false));?>
                    <a class="input_image_delete" style="position: relative" onclick="removeImg(<?=$this->request->data[$modelName]['id']?>,'<?=$controllerName?>','image', '#thumb_<?=$this->request->data[$modelName]['id']?>');return false;">Удалить Х</a>
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

    <div class="row">
        <div class="column grid_2"><p></p></div>
        <div class="column grid_2 ">
            <?= $this->form->submit('Сохранить', array('class'=>'btn_orange','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>


    <?php echo $this->form->end() ?>
</div><!-- end .content-area-->