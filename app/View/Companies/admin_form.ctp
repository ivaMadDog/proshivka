<div class="admin_area" >
     <?php echo $this->form->create($modelName, array('url'=>array('controller'=>$controllerName, 'action'=>$action, !empty($id)?$id:'' ), 'id'=>'GroupForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Дата блокировки</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('expiration_date', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>     
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Компания</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('style'=>'width:400px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Веб-сайт</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('url', array('style'=>'width:200px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>   
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Адрес</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('address', array('style'=>'width:400px','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Краткое описание</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('short_description', array('rows'=>5, 'cols'=>50 ,'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Мобильный телефон</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('phone_mob', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Рабочий телефон</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('phone_work', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Факс</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('fax', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>  
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Email</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('email', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>     
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Пользователь</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('user_id', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Город</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('city_id', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Изображение</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('image', array('type'=>'file','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Прайс-услуг и товаров</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('xls', array('type'=>'file','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>    
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Позиция</p>
        </div>
        <div class="column grid_10  title-left">
            <?= $this->form->input('position', array('style'=>'width:40px', 'type'=>'text','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Проверена</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('is_checked', array( 'label'=>false, 'div'=>false)) ;?>
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
        <div class="column grid_2"><p></p></div>
        <div class="column grid_2 ">
            <?= $this->form->submit('Сохранить', array('class'=>'btn_orange','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    
    
    <?php echo $this->form->end() ?>
</div><!-- end .content-area-->
