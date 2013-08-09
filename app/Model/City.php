<?php
class City extends AppModel {
    
    public $name = 'City';

    public $hasMany = array('Company' => array('className'=> 'Company','foreignKey' => 'city_id','order'=> 'Company.created DESC','dependent'=> false ));
    public $belongsTo = array('Country' => array('className'=> 'Country','foreignKey' => 'country_id'), );        
            
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите название города',
                'required'=> true,
                'on'=>'create'
            ),
        ),
    );        
    
}
?>
