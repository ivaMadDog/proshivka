<?php
class Order extends AppModel {

    public $name = 'Order';
    public $actsAs = array('Containable');

	public $hasOne = array(
            'Fix' => array(
                'className'     => 'Fix',
                'foreignKey'    => false,
                'conditions' => array('Order.fix_id = Fix.id')
            )
	);
    public $belongsTo = array(
        'OrderType' => array(
            'className'    => 'OrderType',
            'foreignKey'   => 'order_type_id'
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




}
?>
