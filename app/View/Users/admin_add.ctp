<? 
// debug($data) 
?>



<div class="content_area" >
     <?php echo $this->form->create('User', array('controller'=>'users', 'action'=>'add', 'admin'=>true));?>
     <div class="row">
        <div class="column grid_2">
          <p>Имя и Фамлия</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('name', array('placeholder'=>"Имя", 'data-placeholder'=>"Имя", 'label'=>false, 'div'=>false)) ;?>
            <?= $this->form->input('secondname', array('placeholder'=>"Фамилия", 'data-placeholder'=>"Фамилия", 'label'=>false,'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Группа</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('group_id', array( 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Скидка</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('sale_id', array( 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Email</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('email', array('placeholder'=>"Email", 'data-placeholder'=>"Email", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Пароль</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('password', array('placeholder'=>"Пароль", 'data-placeholder'=>"Пароль", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Деньги</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('money', array('placeholder'=>"Деньги", 'data-placeholder'=>"Деньги", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Баллы</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('balls', array('placeholder'=>"Баллы", 'data-placeholder'=>"Баллы", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Телефоны</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('phone1', array('placeholder'=>"Телефон 1", 'data-placeholder'=>"Телефон 1", 'label'=>false, 'div'=>false)) ;?>
            <?= $this->form->input('phone2', array('placeholder'=>"Телефон 2", 'data-placeholder'=>"Телефон 2", 'label'=>false,'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Фото</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('photo', array('placeholder'=>"Фото", 'data-placeholder'=>"Фото", 'label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Роль</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('role', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    <div class="row">
        <div class="column grid_2">
          <p>Заблокированный ?</p>
        </div>
        <div class="column grid_10 ">
            <?= $this->form->input('is_active', array('label'=>false, 'div'=>false)) ;?>
        </div>
    </div>
    
    
    <?php echo $this->form->end() ?>
</div><!-- end .content-area-->