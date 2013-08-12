<?php
class Contact extends AppModel {

    public $name = 'Contact';

    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите название города',
                'required'=> true,
                'on'=>'create'
            ),
        ),
        'type' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Укажите тип контакта',
                'required'=> true,
                'on'=>'create'
            ),
        ),
    );


    public function getDefaultContact() {
        return $this->find('first', array('conditions'=>array('is_default'=>1, 'is_active'=>1)));
    }

    public function getActiveContacts(){
        return $this->find('all', array('conditions'=>array('is_active'=>1, 'is_default'=>0),
													  'order'=>array('position')));
    }

    public function getFirstDefaultContacts(){
        return $this->find('all', array('conditions'=>array('is_active'=>1),
                                        'order'=>array('is_default ASC', 'position')));
    }

	public function getContactMenus(){
		$contacts['Default']=$this->getDefaultContact();
		$contacts['Others']=$this->getActiveContacts();
		return $contacts;
	}

}
?>
