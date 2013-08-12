<?  //		debug($brands)?>
<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('type'=>'file','url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'PrinterForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Название принтера</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('style'=>'width: 400px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Производитель</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('brand_id', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>URL оф. сайта</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('url', array('style'=>'width: 300px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>URL оф.прошивки</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('url_firmware', array('style'=>'width: 300px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>URL оф. документации</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('url_guide', array('style'=>'width: 300px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>URL-youtube обзор</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('video', array('style'=>'width: 300px','label'=>false, 'div'=>false)) ;?>
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
          <p>Фото <br />(400px*400px, 1:1)</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('image', array( 'type'=>'file','label'=>false, 'div'=>false)) ;?>
            <?if(!empty($this->request->data[$modelName]['image'])) : ?>
                <div class="clear"></div>
                <div id="thumb_<?=$this->request->data[$modelName]['id']?>" class="input_image">
					<a class="fancybox" href="/files/images/<?=$controllerName?>/image/original/<?=$this->request->data[$modelName]['image']?>" title="<?=$this->request->data[$modelName]['name']?>">
                    <?= $this->html->image("/files/images/$controllerName/image/small/{$this->request->data[$modelName]['image']}",
                            array("alt"=>"{$this->request->data[$modelName]['name']}", "escape"=>false));?>
					<a>
                    <a class="input_image_delete" onclick="removeImg(<?=$this->request->data[$modelName]['id']?>,'<?=$controllerName?>','image', '#thumb_<?=$this->request->data[$modelName]['id']?>');return false;">Удалить Х</a>
                </div>
            <? endif; ?>
        </div>
    </div>
	<div class="row">
        <div class="column grid_2 title-left">
          <p>Цена принтера</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('price_printer', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Цена фикса</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('price_fix', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Цена обновляемого фикса</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('price_update_fix', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
	<div class="row">
        <div class="column grid_2 title-left">
          <p>Ресурс картриджа</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('life_cartridge', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
	<div class="row">
        <div class="column grid_2 title-left">
          <p>Ресурс фотобарабана</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('life_photobaraban', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
	<div class="row">
        <div class="column grid_2 title-left">
          <p>Картридж</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('cartridge', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>

    <div class="row">
        <div class="column grid_2 title-left">
          <p>Краткое описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('short_description', array('placeholder'=>"Краткое описание", 'data-placeholder'=>"Краткое описание ",'rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
	<div class="row">
		<div class="column grid_2 title-left">
          <p>Полное описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('full_description', array('id'=>"TextField1",'rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
			<?= $this->ck->load("TextField1");?>
        </div>
    </div>
	<div class="row">
		<div class="column grid_2 title-left">
          <p>Описание для прошивки</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('fix_description', array('id'=>"TextField2",'rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
			<?= $this->ck->load("TextField2");?>
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