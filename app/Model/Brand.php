<?php

class Brand extends AppModel {
    
    public $name = 'Brand';

    public $hasMany = array(
            'Printer' => array(
                'className'     => 'Printer',
                'foreignKey'    => 'brand_id',
                'dependent'     => false
        )
    );
}
?>
