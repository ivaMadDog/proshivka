<? 
// debug($data) 
?>
<div class="admin_area" >
     <?php echo $this->form->create('User', array('type'=>'file', 'url'=>array('controller'=>'users', 'action'=>'edit', 'admin'=>true), 'id'=>'UserForm'));?>
     <div class="row">
        <div class="column grid_2 title-left">
          <p>Имя и Фамлия</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('placeholder'=>"Имя", 'data-placeholder'=>"Имя", 'label'=>false, 'div'=>false)) ;?>
            <?= $this->form->input('secondname', array('placeholder'=>"Фамилия", 'data-placeholder'=>"Фамилия", 'label'=>false,'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Группа</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('group_id', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Скидка</p>
        </div>
        <div class="column grid_10  title-left">
            <?= $this->form->input('sale_id', array( 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Email</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('email', array('placeholder'=>"Email", 'data-placeholder'=>"Email", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Пароль</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('password', array('value'=>'','placeholder'=>"Пароль", 'data-placeholder'=>"Пароль", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Деньги</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('money', array("type"=>"text", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Баллы</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('balls', array("type"=>"text", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Телефоны</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('phone1', array('placeholder'=>"Телефон 1", 'data-placeholder'=>"Телефон 1", 'label'=>false, 'div'=>false)) ;?>
            <?= $this->form->input('phone2', array('placeholder'=>"Телефон 2", 'data-placeholder'=>"Телефон 2", 'label'=>false,'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Фото</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('photo', array("type"=>"file", 'placeholder'=>"Фото", 'data-placeholder'=>"Фото", 'label'=>false, 'div'=>false)) ;?>
            <br/>
            <img class="user_photo" src="/files/images/<?=$controllerName?>/thumb/<?=$this->request->data[$modelName]['photo'];?>" alt="" /> 
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Роль</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('role', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2 title-left">
          <p>Заблокированный ?</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('is_active', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2"><p></p></div>
        <div class="column grid_2 ">
            <?= $this->form->submit('Изменить', array('class'=>'btn_orange','label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <?= $this->form->end() ?>
</div><!-- end .content-area-->