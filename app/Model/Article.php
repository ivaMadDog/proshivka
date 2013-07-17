<?php
  class Article extends AppModel
{
    public $name = 'Article';
    public $actsAs = array("Containable" );

    public $belongsTo = array(
        'Category' => array(
            'className'    => 'Category',
            'foreignKey'   => 'category_id'
        ),
    );
    
    public $hasAndBelongsToMany = array(
        'Printer' =>
            array(
                'className'              => 'Printer',
                'joinTable'              => 'articles_printers',
                'foreignKey'             => 'article_id',
                'associationForeignKey'  => 'printer_id',
                'unique'                 => true,
            ),
    ); 
   
    public $validate = array(
            'title' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Введите название статьи'
            ),
      );
        
        
        
}
?>
