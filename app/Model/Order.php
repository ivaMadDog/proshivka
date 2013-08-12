<?php
class Order extends AppModel {

    public $name = 'Order';
    public $actsAs = array('Containable');

//	public $hasOne = array(
//            'Fix' => array(
//                'className'     => 'Fix',
//                'foreignKey'    => false,
//                'conditions' => array('Order.id = Fix.order_id')
//            )
//	);
    public $belongsTo = array(
        'OrderType' => array(
            'className'    => 'OrderType',
            'foreignKey'   => 'order_type_id'
        ),
		'Payment' => array(
            'className'    => 'Payment',
            'foreignKey'   => 'payment_id'
        ),
		'User'=>array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
		),
		'Printer'=>array(
            'className'    => 'Printer',
            'foreignKey'   => 'printer_id'
		)
    );

    public $validate= array(
        'printer_id'=>array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Не выбрана модель принтера'
            ),
        ),
        'order_type_id'=>array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Невозможно указать статус заказа'
            ),
        ),
        'email'=> array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'Неверный email адрес',
                'required'=> true,
                'on'=>'create'
            ),
        ),
        'phone'=>array(
            'required' => array(
                'rule' => array('between', 5, 20),
                'message' => 'Укажите номер телефона в международном формате (+380123456789)'
            ),
        ),
        'serial_number'=>array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите серийный номер принтера'
            ),
        ),
        'crum'=>array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите crum-номер принтера'
            ),
        ),
        'version_fix'=>array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите версию прошивки'
            ),
        ),
        'price'=>array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Цена прошивки не определена'
            ),
        ),
    );




}
?>
