<?php
App::uses('AuthComponent', 'Controller/Component');

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
        'email' => array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'Неверный email адрес'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Вы не верно ввели пароль'
            ),
            'minLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'Минимальная длина пароля 6 символов',
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Ошибка. Не верно указанная роль',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
    
    
    
    
}


?>
