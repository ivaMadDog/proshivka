<div id="container">
    <div id="content">
        <h1 class="hpage txt_blue">Заказать прошивку</h1>

        <div class="OrderFix"> 
            <?= $this->form->create('Order', array('url'=>array('controller'=>'orders', 'action'=>'order_fix')));?>
                <div style="width: 320px; margin: 20px auto">
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
                        <?= $this->form->input('printer_id', array('label'=>false, 'div'=>false));?>
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

        <div class="banner_center">
            <!--<a href="#"><img src="files/banners/banner_order_fix.png"/></a>-->
        </div>

    </div><!-- #content-->
</div><!-- #container-->