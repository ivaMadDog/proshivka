<?php

class OrderType extends AppModel {

    public $name = 'OrderType';

    public $hasMany = array(
        'Order' => array(
            'className'     => 'Order',
            'foreignKey'    => 'order_type_id',
            'dependent'     => false
        )
    );


    public function getNewStatus(){
        $newStatus=$this->find('first', array('conditions'=>array('is_default'=>1), 'fields'=>array('id', 'is_default'),'recursive'=>-1));
        return $newStatus[$this->alias]['id'];
    }


}
?>
