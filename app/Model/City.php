<?php

class City extends AppModel {
    
    public $name = 'City';

        public $hasMany = array(
            'Company' => array(
                'className'     => 'Company',
                'foreignKey'    => 'city_id',
                'order'         => 'Company.created DESC',
                'dependent'     => false
        )
    );
}
?>
