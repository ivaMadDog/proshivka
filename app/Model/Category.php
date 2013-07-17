<?php 

class Category extends AppModel {
    public $name = 'Category';
    public $actsAs = array("Containable" );

    public $hasMany = array(
        'Article'=>array('className' => 'Article', 'foreignKey' => 'category_id', 'dependent' => true)
    );

   
    public $validate = array(
            'title' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Введите название категории'
            ),
      );
        
        
        
}
?>
