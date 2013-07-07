<? //  debug($this->data)?>
<h1 class="hpage txt_purple">Кабинет пользователя</h1>
                            
<section class="user-page">

    <ul class="user-page-nav">
        <li class="active"><a href="/user/users/profile"><span class="sprite-icons home"></span><span>Профиль</span></a></li>
        <li><a href="/users/user_orders"><span class="sprite-icons trademark"></span><span>Мои заказы</span></a></li>
        <li><a href="/users/change_password"><span class="sprite-icons psw"></span><span>Сменить пароль</span></a></li>
        <li><a href="/users/logout"><span class="sprite-icons logout"></span><span>Выход</span></a></li>
    </ul>

    <section class="user-page-body">
        <div>
            <?= $this->form->create(array('action'=>'user_profile')); ?>
                <div class="form-row">
                    <div class="form-row-label">
                        Имя и Фамилия
                    </div>
                    <div class="form-row-value">
                        <?= $this->form->input('name', array('placeholder'=>"Имя", 'data-placeholder'=>"Имя", 'label'=>false, 'div'=>false)) ;?>
                        <?= $this->form->input('secondname', array('placeholder'=>"Фамилия", 'data-placeholder'=>"Фамилия", 'label'=>false,'div'=>false)) ;?>
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-row-label">
                        Email
                    </div>
                    <div class="form-row-value">
                        <?= $this->form->input('email', array('disabled'=>"disabled",'placeholder'=>"Email", 'data-placeholder'=>"Email", 'label'=>false,'div'=>false)) ;?>
                    </div>
                </div>    
                <div class="form-row">   
                    <div class="form-row-label">
                        Телефоны
                    </div>
                    <div class="form-row-value">
                        <?= $this->form->input('phone1', array('placeholder'=>"phone1", 'data-placeholder'=>"phone1", 'label'=>false,'div'=>false)) ;?>
                        <?= $this->form->input('phone2', array('placeholder'=>"phone2", 'data-placeholder'=>"phone2", 'label'=>false,'div'=>false)) ;?>
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-row-label">
                        Реферальные балы
                    </div>
                    <div class="form-row-value">
                        <?=$this->data['User']['balls'];?>
                    </div>
               </div> 
                <div class="form-row">
                    <div class="form-row-label">
                        Реферальные ссылка
                    </div>
                    <div class="form-row-value">
                        http://proshivki.biz/refferal/123456
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-row-label">
                        Счет
                    </div>
                    <div class="form-row-value">
                        <?=$this->data['User']['money'];?>                                               
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-row-value">
                        <?php echo $this->form->submit('Сохранить', array('class'=>"btn_form btn_orange")); ?>
                    </div>
                </div> 
            <?$this->form->end();?>
        </div>
    </section>

</section>
 
<div class="clr"></div>