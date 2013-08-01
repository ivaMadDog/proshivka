<?php 

class Category extends AppModel {
    public $name = 'Category';
    public $actsAs = array("Containable" , "Tree" );

    public $hasMany = array(
        'Article'=>array('className' => 'Article', 'foreignKey' => 'category_id', 'dependent' => true)
    );
   
    public $validate = array(
            'name' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Введите название категории'
            ),
            'parent_id' => array(
                'rule' => array('numeric'),
                'message' => 'Не выбрана родительская категория',
                'required' => false,
            ),
      );
    
/*
 * метод возращает корневые узлы-категории
 * @return array
 */        
    public function getRootNods () {
        return $this->find('all',array('conditions'=>array('parent_id'=>0), 'recursive'=>-1));;
    }
 /*
  * метод возвращает все категории
  * @return array
  */       
    public function getCategories(){
        return $this->find('all', array('recursive'=>-1)) ;
    }
  /** 
 * Метод читает из таблицы category все сточки, и  
 * возвращает двумерный массив, в котором первый ключ - id - родителя  
 * категории (parent_id) 
 * @return Array - упорядоченный массив  
 */        
   public function getArrayCategories() { 
        //Читаем все строчки и записываем в переменную $result         
        $result = $this->getCategories();
        //Перелапачиваем массим (делаем из одномерного массива - двумерный, в котором  
        //первый ключ - parent_id) 
        $return = array(); 
        foreach ($result as $value) { //Обходим массив            
            $return[$value['Category']['parent_id']][] = $value['Category']; 
           } 
        return $return; 
    } 
    
        
        
        
}
?>
