<h1 class="hpage txt_purple">Кабинет пользователя</h1>
                            
                            
<section class="user-page">

    <?php echo $this->element('menus/user_menu');?>

    <section class="user-page-body">
        <div>
            <?php echo $this->form->create('User', array('url'=>array('controller'=>'users', 'action'=>'user_change_password'))); ?>    
                <div class="form-row">
                    <div class="form-row-label">
                        Старый пароль
                    </div>
                    <div class="form-row-value">
                        <?php echo $this->form->input('password', array("type"=>"password", "label"=>false )); ?>
                    </div>
                </div> 
               <div class="form-row">
                    <div class="form-row-label">
                        Новый пароль
                    </div>
                    <div class="form-row-value">
                        <?php echo $this->form->input('confirm_password', array("type"=>"password","label"=>false )); ?>
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-row-label">
                        Повторить пароль
                    </div>
                    <div class="form-row-value">
                        <?php echo $this->form->input('new_confirm_password', array("type"=>"password", "label"=>false )); ?>
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-row-value">
                        <?php echo $this->form->submit('Сохранить', array('class'=>'btn_form btn_orange')); ?>
                        <?php echo $this->html->link('Отправить на email новый пароль', '/user/users/reciveNewPwd'); ?>
                    </div>
                </div> 
            <?php echo $this->form->end(); ?>
        </div>
    </section>

</section>

<script type="text/javascript">
  $(document).ready(function(){  
        $('#UserPassword').focus();
  });        
</script>
   