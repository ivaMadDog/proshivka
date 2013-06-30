<?php


class Sale extends AppModel {
    
    public $name = 'Sale';

        public $hasMany = array(
            'User' => array(
                'className'     => 'User',
                'foreignKey'    => 'sale_id',
                'order'         => 'User.created DESC',
                'dependent'     => false
        )
    );
}
?>
