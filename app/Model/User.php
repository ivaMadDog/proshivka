<?php

class User extends AppModel {
    
    public $name = 'User';
    
    public $hasOne = array(
        'Company' => array(
            'className'    => 'Company',
            'conditions'   => array('Company.published' => '1'),
            'dependent'    => true
        )   
    );
    
    public $belongsTo = array(
        'Group' => array(
            'className'    => 'Group',
            'foreignKey'   => 'group_id'
        ),
        'Sale' => array(
            'className'    => 'Sale',
            'foreignKey'   => 'sale_id'
        ),
    );
    
    public $hasMany = array(
        'Order' => array(
            'className'     => 'Order',
            'foreignKey'    => 'user_id',
            'order'         => 'Order.created DESC',
            'dependent'     => true
        )
    );
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
}


?>
