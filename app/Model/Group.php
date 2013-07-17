<?php

class Group extends AppModel {
    
    public $name = 'Group';
    public $actsAs = array('Containable');
    
    public $hasMany = array(
        'User' => array(
            'className'     => 'User',
            'foreignKey'    => 'group_id',
            'dependent'     => false
        )
    );
    
}    
    
?>
