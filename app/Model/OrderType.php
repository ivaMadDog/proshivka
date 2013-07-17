<?php

class OrdersType extends AppModel {
    
    public $name = 'OrdersType';

    public $hasMany = array(
        'Order' => array(
            'className'     => 'Order',
            'foreignKey'    => 'orders_type_id',
            'dependent'     => true
        )
    );
}
?>
