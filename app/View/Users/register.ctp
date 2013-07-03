<h1 class="hpage txt_purple">Регистрация на proshivki.biz</h1>
<div class="register-user"> 
    <?= $this->Form->create(array('action'=>'register'));?>
        <div class="register-user-wrapper">
            <div class="register-user-row">
                <?= $this->Form->input('email', array('type'=>'text' ,'label'=>'','data-placeholder'=>'Email', 'placeholder'=>'Email'));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('password', array('type'=>'password', 'label'=>'','data-placeholder'=>'Пароль', 'placeholder'=>'Пароль'));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('confirm_password', array('type'=>'password','label'=>'', 'data-placeholder'=>'Подтвердите пароль', 'placeholder'=>'Подтвердите пароль'));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('money', array('type'=>'hidden','value'=>0,'label'=>''));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('balls', array('type'=>'hidden','value'=>0,'label'=>''));?>
            </div>
        </div> 
        <div class="clr"></div>
        <input class="btn big_orange" type="submit" value="Регистрация"/>
   <?=$this->Form->end() ;?>

</div>