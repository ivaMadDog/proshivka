<?php
class Subscribe extends AppModel {

    public $name = 'Subscribe';
    public $actsAs = array('Containable');

    public $validate=array(
        'email' => array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'Укажите правильный email',
                'required'=> true,
                'on'=>'create'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Данный email уже подписан на рассылку'
            ),
        ),
    );





}

?>
