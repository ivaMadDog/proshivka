<?php

class Company extends AppModel {
    
    public $name = 'Company';
    
    public $hasOne = array(
        'User' => array(
            'className'    => 'User',
            'conditions'   => array('User.published' => '1'),
            'dependent'    => false
        )   
    );
    
    public $belongsTo = array(
        'City' => array(
            'className'    => 'City',
            'foreignKey'   => 'city_id'
        ),
    );
    
    }
?>
