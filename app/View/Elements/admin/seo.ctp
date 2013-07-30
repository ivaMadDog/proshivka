<div  class="seo row">
    <h3>SEO оптимизация</h3>
</div>
<div class="row">
	<div class="column grid_2 title-left">ЧПУ</div>
	<div class="column grid_10"><?php echo $this->Form->input("$modelName.slug",array('placeholder'=>"ЧПУ ссылка", 'data-placeholder'=>"ЧПУ ссылка",'label'=>false,'class'=>'input_field input_seo','type'=>'text'));?></div>
</div>
<div class="row">
	<div class="column grid_2 title-left">До названия</div>
	<div class="column grid_10"><?php echo $this->Form->input("$modelName.prepend_title",array('placeholder'=>"заголовок до названия", 'data-placeholder'=>"заголовок до названия",'label'=>false,'class'=>'input_seo input_field','type'=>'text'));?></div>
</div>
<div class="row">
	<div class="column grid_2 title-left">После названия</div>
	<div class="column grid_10"><?php echo $this->Form->input("$modelName.append_title",array('placeholder'=>"заголовок после названия", 'data-placeholder'=>"заголовок после названия",'label'=>false,'class'=>'input_seo input_field','type'=>'text'));?></div>
</div>
<div class="row">
	<div class="column grid_2 title-left">Meta Title</div>
	<div class="column grid_10"><?php echo $this->Form->input("$modelName.meta_title",array('placeholder'=>"", 'data-placeholder'=>"",'label'=>false,'class'=>'input_field input_seo','style'=>'height:14px;','type'=>'text'));?></div>
</div>
<div class="row">
	<div class="column grid_2 title-left">Meta Keywords</div>
	<div class="column grid_10"><?php echo $this->Form->input("$modelName.meta_keywords",array('placeholder'=>"ключевые слова", 'data-placeholder'=>"ключевые слова",'label'=>false,'class'=>'input_field','type'=>'textarea'));?></div>
</div>
<div class="row">
	<div class="column grid_2 title-left">Meta Description</div>
	<div class="column grid_10"><?php echo $this->Form->input("$modelName.meta_description",array('placeholder'=>"мета описание", 'data-placeholder'=>"мета описание",'label'=>false,'class'=>'input_field','type'=>'textarea'));?></div>
</div>