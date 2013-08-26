<p>Мы получили заказ на прошивку.</p>

<p><b>Информация по заказу:</b></p>
<ul>
    <li><b>Email:</b> <?=$this->request->data['Order']['email'];?></li>
    <li><b>Телефон:</b> <?=$this->request->data['Order']['phone'];?></li>
    <li><b>Принтер:</b> <?=$this->request->data['Printer_info']['name'];?></li>
    <li><b>Тип оплаты: </b><?=$this->request->data['Payment']['Payment']['name'];?></li>
    <li><b>Сумма:</b> <?=$this->request->data['Printer_info']['price_fix'];?> грн.</li>
    <li><b>Серийный номер:</b> <?=$this->request->data['Order']['serial_number'];?></li>
    <li><b>Версия прошивки:</b> <?=$this->request->data['Order']['version_fix'];?></li>
    <li><b>Crum-номер:</b> <?=$this->request->data['Order']['crum'];?></li>
    <li><b>Статус заказа:</b> новый</li>
</ul>

<?=Configure::read("EMAIL_SIGNATURE_TEXT");?>
