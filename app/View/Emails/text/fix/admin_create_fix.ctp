<? print "Мы получили заказ на прошивку. \n \n

Информация по заказу: \n \n

Email:{$this->request->data['Order']['email']} \n
Телефон: {$this->request->data['Order']['phone']} \n
Принтер: {$this->request->data['Printer_info']['name']} \n
Тип оплаты: {$this->request->data['Payment']['Payment']['name']} \n
Сумма: {$this->request->data['Printer_info']['price_fix']} грн. \n
Серийный номер: {$this->request->data['Order']['serial_number']} \n
Версия прошивки: {$this->request->data['Order']['version_fix']} \n
Crum-номер: {$this->request->data['Order']['crum']}  \n
Статус заказа: новый  \n \n
";

Configure::read("EMAIL_SIGNATURE_TEXT");?>