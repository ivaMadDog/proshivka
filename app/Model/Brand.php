<?php

class Brand extends AppModel {
    
    public $name = 'Brand';

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
