 <h1 class="hpage txt_blue">Сделай 4 шага и принтер будет печатать!</h1>
<ul class="circle-step">
    <li class="col4">
        <div class="sprite-circle circle-blue" ><a class="sprite-big-btn big-btn-forms" href="#" title=""></a></div>
        <a href="#" title="">Заполните форму</a>
    </li>
    <li  class="col4">
        <div class="sprite-circle circle-yellow"  ><a class="sprite-big-btn big-btn-card" href="#" title=""></a></div>
        <a href="#" title="">Оплатите заказ</a>
    </li>
    <li class="col4">
        <div class="sprite-circle circle-green"  ><a class="sprite-big-btn big-btn-email" href="#" title=""></a></div>
        <a href="#" title="">Получите прошивку</a>
    </li>
    <li class="col4">
        <div class="sprite-circle circle-purple" ><a class="sprite-big-btn big-btn-printer" href="#" title=""></a></div>
        <a href="#" title="">Установите и печатайте</a>
    </li>
</ul>
<div class="clr"></div>

<div class="bg_grey OrderFix">
    <?= $this->form->create('Order', array('url'=>array('controller'=>'orders', 'action'=>'order_fix')));?>
        <h2 class="BottomLightLine">Шаг 1: Заказать прошивку</h2>
        <div class="OrderFix-col">
            <div class="OrderFix-row">
                <div class="OrderFix-label">Email:</div>
                <?= $this->form->input('email', array('label'=>false, 'div'=>false));?>
            </div>
            <div class="OrderFix-row">
                <div class="OrderFix-label">Номер телефона:</div>
                <?= $this->form->input('phone', array('label'=>false, 'div'=>false));?>
            </div>
            <div class="OrderFix-row">
                <div class="OrderFix-label">Модель принтера:</div>
                <?= $this->form->input('printer_id', array('id'=>'printer_id','empty'=>'Выбрать модель','label'=>false, 'div'=>false, 'onchange'=>'onChangePrinter()'));?>
            </div>
            <div class="OrderFix-row">
                <div class="OrderFix-label">Цена прошивки:</div>
                <?= $this->form->input('price', array("id"=>"price",'type'=>'text', 'style'=>'background: #fff','label'=>false, 'div'=>false,  "disabled"=>"disabled"));?>
            </div>
        </div>
        <div class="OrderFix-col">
			<div class="OrderFix-row">
                <div class="OrderFix-label">Способ оплаты:</div>
                <?= $this->form->input('payment_id', array('id'=>'payment_id','empty'=>'Тип оплаты','onchange'=>'onChangePayment()','label'=>false, 'div'=>false));?>
				<img id="payment_logo" src="/files/images/payments/image/thumb/privatbank.png" style="display: none"/>
            </div>
            <div class="OrderFix-row">
                <div class="OrderFix-label">Серийный номер:</div>
                <?= $this->form->input('serial_number', array('label'=>false, 'div'=>false));?>
            </div>
            <div class="OrderFix-row">
                <div class="OrderFix-label">Версия прошивки:</div>
                <?= $this->form->input('version_fix', array('label'=>false, 'div'=>false));?>
            </div>
            <div class="OrderFix-row">
                <div class="OrderFix-label">Crum номер:</div>
                <?= $this->form->input('crum', array('label'=>false, 'div'=>false));?>
            </div>
        </div>
        <div class="clr"></div>
        <?=$this->form->submit('Заказать прошивку', array('class'=>"btn big_orange"));?>
    <?=$this->form->end();?>
</div>

