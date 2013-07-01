<?php
   $this->session->flash('Auth');
?>
<div class="register-user"> 
    <?= $this->Form->create(array('action'=>'register'));?>
        <div class="register-user-wrapper">
            <div class="register-user-row">
                <?= $this->Form->input('email', array('type'=>'text' ,'label'=>'','data-placeholder'=>'Email', 'placeholder'=>'Email'));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('password', array('type'=>'password', 'label'=>'','data-placeholder'=>'password', 'placeholder'=>'password'));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('confirm_password', array('type'=>'password','label'=>'', 'data-placeholder'=>'Подтвердите пароль', 'placeholder'=>'Подтвердите пароль'));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('group_id', array('label'=>'','type'=>'hidden','options' => $groups));?>
            </div>
            <div class="register-user-row">
                <?= $this->Form->input('sale_id', array('label'=>'','type'=>'hidden','options' => $sales));?>
            </div>
        </div> 
        <div class="clr"></div>
        <input class="btn big_orange" type="submit" value="Зарегистрироваться"/>
    </form>

</div>