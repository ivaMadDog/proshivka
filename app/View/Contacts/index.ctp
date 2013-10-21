<div class="ContactPage">
    <section class="ContactPage-columnLeft">
            <h2 class="ContactPage-title">Контакты</h2>
        <div class="ContactPage-phone">
            <span class="ContactPage-phoneIco"></span>
            +38 097 187 84 85
        </div>
        <div>
            <span class="ContactPage-emailIco"></span>
            office@mail.ru
        </div>
        <div>
            <span class="ContactPage-skypeIco"></span>
            ivaMadDog
        </div>
    </section> 
    <section class="ContactPage-columnRight">
        <h2 class="ContactPage-title">Пишите нам</h2>
        <?= $this->form->create('Contact', array('url'=>array('controller'=>'contacts', 'action'=>'feedback', 'class'=>'ContactPage-Form')));?>
            <div class="rght">
                    <?= $this->form->input('message', array('type'=>'text', 'rows'=>4,'label'=>false, 'div'=>false, 'class'=>'ContactPage-FormMessage'));?>
            </div>
            <div class="lft">
                    <?= $this->form->input('email', array('label'=>false, 'div'=>false, 'class'=>'ContactPage-FormEmail'));?>
            </div>
            <div class="lft">
                    <?= $this->form->input('subject', array('label'=>false, 'div'=>false, 'class'=>'ContactPage-FormSubject'));?>
            </div>    
            <div class="clr"></div>
            <?=$this->form->submit('Отправить', array('class'=>"btn big_orange"));?>
        <?=$this->form->end();?>
    </section>  
</div>
