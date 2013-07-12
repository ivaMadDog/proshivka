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
        'Review' => array(
            'className'     => 'Review',
            'foreignKey'    => 'user_id',
            'order'         => 'Review.created DESC',
            'dependent'     => true
        )
    );
    
     public $hasAndBelongsToMany = array(
        'Printer' =>
            array(
                'className'              => 'Printer',
                'joinTable'              => 'orders',
                'foreignKey'             => 'user_id',
                'associationForeignKey'  => 'printer_id',
                'unique'                 => true,
            ),
    );     
    
    public $validate = array(
        'email' => array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'Неверный email адрес',
                'required'=> true,
                'on'=>'create'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Пользователь с данным email-ом уже существует'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Пароль не должен быть пустым'
            ),
            'minLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'Минимальная длина пароля 6 символов',
            ),
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Пароль должен состоять из букв и цифр',
            ),
        ),
        'confirm_password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Вы не верно ввели пароль'
            ),
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Ошибка. Не верно указанная роль',
                'allowEmpty' => false
            )
        ),
//        'phone1' => array(
//            'valid' => array(
//                'rule'=>"(\+?\d[- .]*){7,13}"
//            )
//        ),
//        'phone2' => array(
//            'valid' => array(
//                'rule'=>"(\+?\d[- .]*){7,13}"
//            )
//        ),        
    );
    
    public function validatePwdConfirm($check){
       return (strcmp($this->request->data[$this->alias]['password'], AuthComponent::password($check['confirm_password'])) === 0);
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
    
    public  function saveNewPwd($data, $new_pwd = null) {   
        if(empty($data['id'])) return;
        $this->id = $data['id'];
        if(!$new_pwd) $new_pwd = self::_generateNewPwd();
        $this->saveField('password', $this->password($new_pwd));
        $data = array_merge($data, array('password'=>$new_pwd));
        return $data;
    }
    
    public  function _generateNewPwd()
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        $length = 7;
        srand((double)microtime()*1000000);    
        $i = 0;    
        $pass = '' ;    
        while ($i <= $length) {        
            $num = rand() % 33;        
            $tmp = substr($chars, $num, 1);        
            $pass = $pass . $tmp;        
            $i++;    
        }
        //$pass = 1;
        return $pass;
    }
    
    public function password($password) {
            return AuthComponent::password($password);
        }
    
    public function getUserEmail($email, $recursive) {
        if(empty($email)) return false;
        
        $data= $this->find('first', array('condition'=>array('email'=>$email),
                                           'recursive'=>$recursive));
        
        if (empty($data)) return false;
        
        return $data;
    }
    
    public function getAuthUser(){
        return $this->find('first', array('conditions'=>array('id'=>  AuthComponent::User('id')), 'recursive'=>-1));
    }
    
}


?>
