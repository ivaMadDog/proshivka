<?php
class Printer extends AppModel {
    
    public $name = 'Printer';

    public $hasAndBelongsToMany = array(
        'User' =>
            array(
                'className'              => 'User',
                'joinTable'              => 'orders',
                'foreignKey'             => 'printer_id',
                'associationForeignKey'  => 'user_id',
                'unique'                 => true,
            ),
         'Article' =>
            array(
                'className'              => 'Article',
                'joinTable'              => 'articles_printers',
                'foreignKey'             => 'printer_id',
                'associationForeignKey'  => 'article_id',
                'unique'                 => true,
            ),
    ); 
    
    public $belongsTo = array(
        'Brand' => array(
            'className'    => 'Brand',
            'foreignKey'   => 'brand_id'
        ), 
    );
}
?>
