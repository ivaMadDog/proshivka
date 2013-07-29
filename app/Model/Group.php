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
    
    public $validate=array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Имя не должно быть пустым',
                'required'=> true,
                'on'=>'create'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Такая группа уже существует'
            ),
        ),
    );
    
    
    
    
    
}    
    
?>
