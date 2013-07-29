<?php
class Order extends AppModel {
    
    public $name = 'Order';
    
    public $belongsTo = array(
        'OrderType' => array(
            'className'    => 'OrderType',
            'foreignKey'   => 'order_type_id'
        ),
    );
    
    
    

}
?>
