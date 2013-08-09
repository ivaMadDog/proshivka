<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('type'=>'file','url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'ArticleForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Название статьи</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Категория</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('category_id', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Автор статьи</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('user_id', array('label'=>false, 'div'=>false)) ;?>
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
          <p>Позиция</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('position', array( 'type'=>'text','style'=>'width: 40px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>№ блока в футере</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('block_footer', array( 'options'=>array(0,1,2,3,4),'style'=>'width: 40px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Дата отображения</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('date', array( 'type'=>'text','label'=>false, 'div'=>false, 'class'=>'datepicker lft')) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Фото <br />(600px*400px, 3:2)</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('image', array( 'type'=>'file','label'=>false, 'div'=>false)) ;?>
            <?if(!empty($this->request->data[$modelName]['image'])) : ?>
                <div class="clear"></div>
                <div id="thumb_<?=$this->request->data[$modelName]['id']?>" class="input_image">
                    <?= $this->html->image("/files/images/$controllerName/image/small/{$this->request->data[$modelName]['image']}",
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
            <?= $this->form->input('short_description', array('placeholder'=>"Краткое описание", 'data-placeholder'=>"Краткое описание сайта",'rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
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