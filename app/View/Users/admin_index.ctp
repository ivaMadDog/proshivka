 <div class="row">
    <div class="column ">
      <ul class="row-top-commands">
          <li class="row-top-command">
                <a class="controls control-add" href="<?="/admin/$controllerName/add/"?>" title="Добавить запись"></a>
                <a href="<?="/admin/$controllerName/add/"?>" title="Добавить запись">Добавить пользователя</a>
          </li>
          <li class="row-top-command">
                <a class="controls control-add" href="<?="/admin/companies/add/"?>" title="Добавить запись"></a>
                <a href="<?="/admin/companies/add/"?>" title="Добавить запись">Добавить компанию</a>
          </li>
          <li class="row-top-command">
                <a class="controls control-list" href="<?="/admin/companies/"?>" title="Список компаний"></a>
                <a href="<?="/admin/companies"?>" title="Добавить запись">Список компаний</a>
          </li>
      </ul>
    </div>
</div>
<div class="content_area">
     <div class="row">
        <div class="column grid_3 title">
          <p>Email / Логин</p>
        </div>
        <div class="column grid_2 title">
          <p>Компания</p>
        </div>
        <div class="column grid_2 title">
          <p>Группа</p>
        </div>
        <div class="column grid_1 title">
          <p>Скидка</p>
        </div>
        <div class="column grid_2 title">
          <p>Общая сумма, грн.</p>
        </div>
        <div class="column grid_2 title">
          <p>Управление</p>
        </div>
    </div>
    <?php foreach($data as $key=>$item):  ?>
    <div id="row_<?=$item[$modelName]['id']?>" class="row">
        <div class="column grid_3">
          <p><?= $item[$modelName]['email']?></p>
        </div>
        <div class="column grid_2 center">
          <p><?php if(empty($item['Company']['name'])) echo 'Не создана' ; else echo $item['Company']['name']; ?></p>
        </div>
        <div class="column grid_2 center">
          <p><?= $item['Group']['name'] ?></p>
        </div>
        <div class="column grid_1 center">
          <p><?= $item['Sale']['sale'] ?></p>
        </div>
        <div class="column grid_2 center">
          <p><?= $item[$modelName]['money'] ?></p>
        </div>
<?php
$link_view = "/$controllerName/view/";
$link_add = "/admin/$controllerName/add/";
$link_edit = "/admin/$controllerName/edit/";
$link_delete = "/admin/$controllerName/delete/{$item[$modelName]['id']}";
$link_active = "/admin/$controllerName/active/{$item[$modelName]['id']}";
?>        
        <div class="column grid_2">
            <p>
                <span><a class="controls control-add" href="<?=$link_add?>" title="Добавить запись"></a></span>
                <span><a class="controls control-view" href="<?= $link_view.$item[$modelName]['id'] ?>" title="Просмотр записи" target="_blank" ></a></span>
                <span><a class="controls control-edit" href="<?= $link_edit.$item[$modelName]['id'] ?>" title="Редактировать запись"></a></span>
                <span id="del_span_<?=$item[$modelName]['id']?>">
                    <?=$this->html->link('', '#', array('id'=>"del_a_{$item[$modelName]['id']}",'class'=>'controls control-del',"escape"=>false,"onClick"=>"delete_entry('$link_delete','row_{$item[$modelName]['id']}', 'del_span_{$item[$modelName]['id']}', 'del_a_{$item[$modelName]['id']}');return false;"),null, false);?>
                </span>
                <span id="is_active_<?=$item[$modelName]['id']?>">
                    <? $activeClass='controls '.($item[$modelName]['is_active']? 'control-locked': 'control-unlocked')?>
                    <?=$this->html->link('', '#', array('id'=>"active_a_{$item[$modelName]['id']}",'class'=>"$activeClass",'title'=>"Блокировать/Заблокировать запись", "escape"=>false,"onClick"=>"change_active('$link_active','is_active_{$item[$modelName]['id']}', 'active_a_{$item[$modelName]['id']}');return false;"),null, false);?>
                </span>
            </p>
        </div>
    </div><!-- end .row-->
    <?php endforeach; ?>
    
    <?php echo $this->element('pagin');?>
</div><!-- end .content-area-->