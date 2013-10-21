<div class="ContactPage">
    <section class="ContactPage-columnLeft">
		<h2 class="ContactPage-title">Контакты</h2>
		<span class="ContactPage-phoneIco contacts-ico"></span>
        <div class="ContactPage-phone clear">
            <div>office@proshivki.biz</div>
            <div>info@proshivki.biz</div>
        </div>
        <span class="ContactPage-emailIco contacts-ico"></span>
        <div class="ContactPage-email clear">
            +38 097 187 84 85
        </div>
		<span class="ContactPage-skypeIco contacts-ico"></span>
        <div class="ContactPage-skype clear">
            ivaMadDog
        </div>
    </section>
    <section class="ContactPage-columnRight">
        <h2 class="ContactPage-title">Пишите нам</h2>
        <?= $this->form->create('Contact', array('url'=>array('controller'=>'contacts', 'action'=>'feedback'), 'class'=>'ContactPage-Form'));?>
            <div class="rght">
                    <?= $this->form->input('message', array('type'=>'text', 'rows'=>3,'label'=>false, 'div'=>false, 'class'=>'ContactPage-FormMessage rnd5', 'placeholder'=>'Введите текст'));?>
            </div>
            <div class="lft">
                    <?= $this->form->input('email', array('label'=>false, 'div'=>false, 'class'=>'ContactPage-FormEmail', 'placeholder'=>'Ваш Email'));?>
            </div>
            <div class="lft">
                    <?= $this->form->input('subject', array('label'=>false, 'div'=>false, 'class'=>'ContactPage-FormSubject', 'placeholder'=>'Имя'));?>
            </div>
            <?=$this->form->submit('Отправить', array('class'=>"btn big_orange rght", 'style'=>'width: 200px;', 'div'=>false));?>
			<?=$this->CaptchaTool->show(); ?>
        <?=$this->form->end();?>
    </section>
</div>
