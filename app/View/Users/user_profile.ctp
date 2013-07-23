<h1 class="hpage txt_purple">
    Кабинет пользователя
    <?php if(!empty($admin) && $admin) echo " - ".$this->html->link('админка', ('/admin/administrators/index'));?>
</h1>
                            
<section class="user-page">

    <?php echo $this->element('menus/user_menu');?>

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
                        <?=$this->data['User']['email'];?>
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
                        Счет (грн.)
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
 