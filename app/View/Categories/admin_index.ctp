<div class="content_area">
    
     <div class="row">
        <div class="column ">
          <p>
              <a class="controls control-add" href="<?="/admin/$controllerName/add/"?>" title="Добавить запись"></a>
              <a href="<?="/admin/$controllerName/add/"?>" title="Добавить запись">Добавить категорию</a>
          </p>
        </div>
    </div>
     <div class="row">
        <div class="column grid_10 title">
          <p>Дерево категорий</p>
        </div>
        <div class="column grid_2 title">
          <p>Управление</p>
        </div>
    </div>
    <?php  foreach($Categorylist as $key=>$value) { ?>
        <div class="row">
           <div class="column grid_10">
               <?=$value;?>
           </div>
           <div class="column grid_2 title">
             <?
             echo $this->Html->link($this->Html->image('admin/ico_edit.png', array( 'alt' => 'Редактировать категорию' )),
                         array('controller'=>'categories', 'action' => 'edit',$key ,'admin'=>true), array('title'=>'Редактировать категорию','escape'=>false)); 
             echo '      ';
             echo $this->Html->link($this->Html->image('admin/ico_up.png', array( 'alt' => 'Поднять категорию' )),
                         array('controller'=>'categories', 'action' => 'moveup',$key ,'admin'=>true), array('title'=>'Поднять категорию','escape'=>false)); 
             echo '      ';
             echo $this->Html->link($this->Html->image('admin/ico_down.png', array( 'alt' => 'Опустить категорию' )),
                         array('controller'=>'categories', 'action' => 'movedown',$key ,'admin'=>true), array('title'=>'Опустить категорию','escape'=>false)); 
             echo '      ';
             echo $this->Html->link($this->Html->image('admin/ico_delete.png', array( 'alt' => 'Удалить категорию' )),
                         array('controller'=>'categories', 'action' => 'delete', $key ,'admin'=>true), array('title'=>'Удалить категорию','escape'=>false),
                   "Вы действительно хотите удалить эту категорию?");
             ?>
           </div>
       </div>                     
     <? }  ?>
</div><!-- end .content-area-->