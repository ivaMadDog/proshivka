<h3><?=$pageTitle?></h3>

<div class="config content-inner">
<?//debug($this)
//debug($data);
?>
<?php echo $this->Form->create('Config', array('url'=>array('controller'=>'configs', 'action'=>'admin_edit'), 'id'=>'ConfigForm', 'inputDefaults'=>array('label'=>false))); ?>
        <?php 
        foreach($data AS $k=>$v){
        	if(isset($v['Config'])){
        $v = $v['Config'];
        ?>
            <br class="clean"/>
            <div class="label"><?=Inflector::humanize(strtolower($v['title']))?></div>
            <? $type = $v['type'];
                $params = array('type'=>$type, 'value'=>$v['value']);
                if($type == 'textarea'){ $params['cols']= 40; $params['rows'] = 4; }
                if($type == 'checkbox' && intval($v['value']) > 0){ $params['checked']= 'checked'; }
                echo $this->Form->input($v['key'], $params);
                //if($this->Form->isFieldError($v['key'])) echo $form->error($v['key']);
            ?>
        <?}} ?>
        <br/>
        
		<?foreach ($languages as $l){ ?>
			<?=$this->element('../SeoManagement/admin_fields', array('language'=>$l))?>
		<?}?>
	
        <br class="clean"/>
        <?php echo $this->Form->submit('Save',array('class'=>'submit_btn'));?>
</form>

</div>
<script type="text/javascript">
$('.form-input FORM').submit(function(){
    sthis = $(this);
    $.post(
        sthis.attr('action'),
        sthis.serialize(),
        function(data){
            if(data)
                sthis.parents('.ajax').html(data);
            else document.location.reload();
        }
    );
    return false;
});
</script>