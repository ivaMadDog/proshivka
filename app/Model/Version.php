<?php
class Version extends AppModel {

    public $name = 'Version';
    public $actsAs = array('Containable');

    public $belongsTo = array('Printer' => array('className' => 'Printer','foreignKey' => 'printer_id' ),);
    
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите название производителя',
                'required'=> true,
                'on'=>'create'
            )
        ),
    );
    
    public function  getActiveVersionsPrinter($id){
        $versions= $this->find('all', array('conditions'=>array("$this->name.printer_id"=>(int)$id, "$this->name.is_active"=>1)));
        return $versions;
    }  

}
?>
