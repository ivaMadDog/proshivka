<?php

class OrderType extends AppModel {
    
    public $name = 'OrderType';

    public $hasMany = array(
        'Order' => array(
            'className'     => 'Order',
            'foreignKey'    => 'order_type_id',
            'dependent'     => true
        )
    );
    
    
    
    
}
?>
