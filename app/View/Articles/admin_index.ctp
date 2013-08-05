<?
// debug($data) ?>
 <div class="row">
    <div class="column ">
      <p>
          <a class="controls control-add" href="<?="/admin/$controllerName/add/"?>" title="Добавить запись"></a>
          <a href="<?="/admin/$controllerName/add/"?>" title="Добавить запись">Добавить статью или новость</a>
      </p>
    </div>
</div>
<div class="content_area">
     <div class="row">
        <div class="column grid_2 title">
          <p>Название</p>
        </div>
         <div class="column grid_3 title">
          <p>Категория</p>
        </div>
        <div class="column grid_1 title">
          <p>Позиция</p>
        </div>
         <div class="column grid_2 title">
          <p>Дата</p>
        </div>
         <div class="column grid_2 title">
          <p>Блок</p>
        </div>
        <div class="column grid_2 title">
          <p>Управление</p>
        </div>
    </div>
    <?php foreach($data as $key=>$item):  ?>
    <div id="row_<?=$item[$modelName]['id']?>" class="row">
        <div class="column grid_2">
          <p><?= $item[$modelName]['name']?></p>
        </div>
        <div class="column grid_3 center">
          <p><?= $item['Category']['name']?></p>
        </div>        
        <div class="column grid_1 center">
          <p><?= $item[$modelName]['position']?></p>
        </div>
        <div class="column grid_2 center">
          <p><?= $item[$modelName]['date']?></p>
        </div>
        <div class="column grid_2 center">
          <p><?= $item[$modelName]['block_footer']?></p>
        </div>
        <?php
        $link_view = "/$controllerName/view/";
        $link_add = "/admin/$controllerName/add/";
        $link_edit = "/admin/$controllerName/edit/";
        $link_delete = "/admin/$controllerName/delete/{$item[$modelName]['id']}";
        $link_active = "/admin/$controllerName/active/{$item[$modelName]['id']}";
        ?>
        <div class="column grid_2 center">
            <p>
                <span><a class="controls control-add" href="<?=$link_add?>" title="Добавить запись"></a></span>
                <span><a class="controls control-edit" href="<?= $link_edit.$item[$modelName]['id'] ?>" title="Редактировать запись"></a></span>
                <span id="del_span_<?=$item[$modelName]['id']?>">
                    <?=$this->html->link('', '#', array('id'=>"del_a_{$item[$modelName]['id']}",'class'=>'controls control-del',"escape"=>false,"onClick"=>"delete_entry('$link_delete','row_{$item[$modelName]['id']}', 'del_span_{$item[$modelName]['id']}', 'del_a_{$item[$modelName]['id']}');return false;"),null, false);?>
                </span>
                <span id="is_active_<?=$item[$modelName]['id']?>">
                    <? $activeClass='controls '.($item[$modelName]['is_active']? 'control-unlocked': 'control-locked')?>
                    <?=$this->html->link('', '#', array('id'=>"active_a_{$item[$modelName]['id']}",'class'=>"$activeClass",'title'=>"Блокировать/Заблокировать запись", "escape"=>false,"onClick"=>"change_active('$link_active','is_active_{$item[$modelName]['id']}', 'active_a_{$item[$modelName]['id']}');return false;"),null, false);?>
                </span>
            </p>
        </div>
    </div><!-- end .row-->
    <?php endforeach; ?>

    <?php echo $this->element('pagin');?>
</div><!-- end .content-area-->