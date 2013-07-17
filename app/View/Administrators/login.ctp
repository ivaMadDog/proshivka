<h1 class="hpage txt_purple">Вход на proshivki.biz</h1>
<div class="register-user"> 
    <?= $this->Form->create(array('action'=>'login'));?>
        <div class="register-user-wrapper">
            <div class="register-user-row">
                <?= $this->Form->input('email', array('type'=>'text' ,'label'=>'','data-placeholder'=>'Email', 'placeholder'=>'Email'));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('password', array('type'=>'password', 'label'=>'','data-placeholder'=>'Пароль', 'placeholder'=>'Пароль'));?>
            </div>
            <div class="register-user-row">
                <?=$this->html->link('Забыли пароль?', array('action'=>'forgot_password'), array('class'=>'txt_purple'));?>
            </div>                                        
        </div> 
        <div class="clr"></div>
        <input class="btn big_orange" type="submit" value="Ввойти"/>
    <?= $this->Form->end() ;?>
</div>

<script type="text/javascript">
  $(document).ready(function(){  
        $('#UserEmail').focus();
  });        
</script>