<?php

class Country extends AppModel {
    
    public $name = 'Country';

    public $hasMany = array(
        'City' => array('className' => 'City', 'foreignKey'=> 'country_id', 'order' =>'City.name ASC', 'dependent' => false )
    );
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите название страны',
                'required'=> true,
                'on'=>'create'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Страна с данным именем уже существует'
            ),
        ),
    );
    
    
    
}
?>
