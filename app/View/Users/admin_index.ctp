<? // debug($data) ?>

<?php
$link_view = "admin/$controllerName/view";
$link_add = "admin/$controllerName/add";
$link_edit = "admin/$controllerName/edit";
$link_delete = "admin/$controllerName/delete";
$link_active = "admin/$controllerName/active";


?>


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
    <?php foreach($data as $key=>$user):  ?>
    <div class="row">
        <div class="column grid_3">
          <p><?php echo $user[$modelName]['email']?></p>
        </div>
        <div class="column grid_2 center">
          <p><?php if(empty($user['Company']['name'])) echo 'Не создана' ; else echo $user['Company']['name']; ?></p>
        </div>
        <div class="column grid_2 center">
          <p><?php echo $user['Group']['name'] ?></p>
        </div>
        <div class="column grid_1 center">
          <p><?php echo $user['Sale']['sale'] ?></p>
        </div>
        <div class="column grid_2 center">
          <p><?php echo $user[$modelName]['money'] ?></p>
        </div>
        <div class="column grid_2">
            <p>
                <a class="controls control-view" href="#" title=""></a>
                <a class="controls control-add" href="#" title=""></a>
                <a class="controls control-edit" href="#" title=""></a>
                <a class="controls control-del" href="#" title=""></a>
                <a class="controls control-locked" href="#" title=""></a>
            </p>
        </div>
    </div><!-- end .row-->
    <?php endforeach; ?>
    
    <?php echo $this->element('pagin');?>
</div><!-- end .content-area-->