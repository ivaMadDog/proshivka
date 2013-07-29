<?php
class Brand extends AppModel {

    public $name = 'Brand';
    public $actsAs = array('Containable');

    public $hasMany = array(
            'Printer' => array(
                'className'     => 'Printer',
                'foreignKey'    => 'brand_id',
                'dependent'     => false
        )
    );

	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите название производителя',
                'required'=> true,
                'on'=>'create'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Производитель с данным именем уже существует'
            ),
        ),
        'url' => array(
            'required' => array(
                'rule' => array('url'),
                'message' => 'Неверный url адрес производителя'
            ),
        ),
    );
    
    
    function beforeSave(){
        $modelName = $this->name;
        $this->saveSeo('name', 'short_description');
    }


}
?>
