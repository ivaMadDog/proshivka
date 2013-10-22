<? // debug($list_contacts)?>
<div class="ContactPage">
    <section class="ContactPage-columnLeft">
		<h2 class="ContactPage-title">Контакты</h2>
		<span class="ContactPage-phoneIco contacts-ico"></span>
        <div class="ContactPage-phone clear">
			<? foreach($list_contacts as $item_contact) {
				if($item_contact['Contact']['type']==='email') { ?>
					<div><?=$item_contact['Contact']['name']?></div>
			<?}}?>
        </div>
        <span class="ContactPage-emailIco contacts-ico"></span>
        <div class="ContactPage-email clear">
			<? foreach($list_contacts as $item_contact) {
				if($item_contact['Contact']['type']==='phone') {?>
					<div><?=$item_contact['Contact']['name']?></div>
			<?}}?>
        </div>
		<span class="ContactPage-skypeIco contacts-ico"></span>
        <div class="ContactPage-skype clear">
			<? foreach($list_contacts as $item_contact) {
				if($item_contact['Contact']['type']==='skype') { ?>
					<div><?=$item_contact['Contact']['name']?></div>
			<?}}?>
        </div>
    </section>
    <section class="ContactPage-columnRight">
        <h2 class="ContactPage-title">Пишите нам</h2>
        <?= $this->form->create('Contact', array('url'=>array('controller'=>'contacts', 'action'=>'index'), 'id'=>'contactSendForm','class'=>'ContactPage-Form'));?>
            <div class="rght ContactPage-rghtBlock">
                    <?= $this->form->input('message', array('type'=>'text', 'rows'=>3,'label'=>false, 'div'=>false, 'class'=>'ContactPage-FormMessage rnd5 required', 'placeholder'=>'Введите текст *'));?>
            </div>
            <div class="lft ContactPage-lftBlock">
                    <?= $this->form->input('email', array('label'=>false, 'div'=>false, 'class'=>'ContactPage-FormEmail required email', 'placeholder'=>'Ваш Email *'));?>
            </div>
            <div class="lft ContactPage-lftBlock">
                    <?= $this->form->input('subject', array('label'=>false, 'div'=>false, 'class'=>'ContactPage-FormSubject required', 'placeholder'=>'Имя *'));?>
            </div>
		    <div class="clear"></div>
		    <?=$this->form->submit('Отправить', array('class'=>"contact_send btn big_orange rght", 'style'=>'width: 200px;', 'div'=>false));?>
			<?=$this->CaptchaTool->show(); ?>

        <?=$this->form->end();?>
    </section>
	<div class="clear"></div>
</div>

<script>
	$("#contactSendForm").validate();
</script>
