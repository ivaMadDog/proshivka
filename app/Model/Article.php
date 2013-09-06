<?php
  class Article extends AppModel
{
    public $name = 'Article';
    public $actsAs = array("Containable" );

	public $folderName = 'articles';
	//имя каталога на сервере для хранения ориганального изображения
	public $originalFolderName= "original";
	//массив полей таблицы привязанных к изображениям
	//width: новая ширина изображения, height: новая высота изображения, path: имя каталога для данного размера изображения
	public $resizeSettings= array('image'=>array(
											 'preview'=>array('width'=>600,'height'=>400,),
                                             'small'=>array('width'=>180,'height'=>120,),
											 'thumb'=>array('width'=>90,'height'=>60,),),
//								  'video'=>array(
//											 'preview'=>array('width'=>200,'height'=>150,),
//											 'thumb'=>array('width'=>120,'height'=>90,),),
							);    
    
    public $belongsTo = array(
        'Category' => array('className'=> 'Category','foreignKey' => 'category_id'),
        'User'=>array('className' => 'User','foreignKey' => 'user_id'),
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
            'name' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Введите название статьи'
            ),
      );

    
	private $currentItem;

    private function setCurrentItem(){
		$this->recursive=-1;
        $this->currentItem=$this->findById($this->id);
    }

    function beforeSave() {
		parent::beforeSave();

        $this->setCurrentItem();
		//сохраняем картинки для полей, которые могут содержать имена изображений
		foreach($this->resizeSettings as $field=>$options)
			$this->saveFieldImage($field);

        $this->saveSeo('name', 'short_description');
    }

	function afterSave($created) {
		parent::afterSave($created);

        if(!empty($this->currentItem)) 
            foreach($this->resizeSettings as $field=>$options){
                if(!empty($this->data[$this->name][$field]) && $this->currentItem[$this->name][$field]!=$this->data[$this->name][$field])
                    $this->deleteImageField($field);
            }
    }

	function beforeDelete($cascade = true) {
		parent::beforeDelete($cascade);
		$this->currentItem = $this->read(null, $this->id);
	}

	function afterDelete() {
		parent::afterDelete();

		$this->deleteImageField();
	}
/*
 * удаление изображений связаных с полями таблицы
 * @method void deleteImageField(int $id,string $imageField)
 * @param int $id - id current record
 * @param  string $field by image, if $field==null then delete all images by field
 * @return true on success or array images files on failure
 */
    public function deleteImageField($imageField=null){
       $errorArr=array();
       if(!empty($imageField)) $field=$imageField;
       foreach ($this->resizeSettings as $field=>$folders){
			$folders[$this->originalFolderName]=array('path'=>$this->originalFolderName);
			foreach($folders as $folder=>$options){
				!empty($options['path'])? $folder_name=$options['path']: $folder_name= $folder;
				$file = WWW_ROOT."files".DS."images".DS.$this->folderName.DS.$field.DS.$folder_name.DS.$this->currentItem[$this->name][$field];
				if(file_exists($file) && is_file($file))
                    if(!unlink($file))
                        $errorArr[]=$file;
			}
		}

        if(empty($errorArr)) return true;
        else return $errorArr;

   }
 /*
 * очищает поле и удаляет изображение
 * @method void clearFieldImage(int $id, string $field)
 * @param int $id
 * @param string $field
 * @return
 */
   public function clearFieldImage($id=null,$imageField=null){
       $this->id=$id;
       $this->setCurrentItem();
       $this->deleteImageField($imageField);
       $this->saveField($imageField, '', array('validate' => false, 'callbacks' => false));

   }
/*
 * @method void saveImage(string $field)
 * @param string $field
 * @return
 */
	public function saveFieldImage($field){
		$modelName = $this->name;
        $folderName = $this->folderName;

        //resizing settings for cover image
        $resizeOptions = array();
        foreach($this->resizeSettings[$field] as $key=>$option) {
			if(!isset($option['path']) || empty($option['path'])) $option['path']=$key;
            $resizeOptions[] = array(
                'folder' => WWW_ROOT."files".DS."images".DS.$folderName.DS.$field.DS.$option['path'].DS,
                'width' => $option['width'],
                'height' => $option['height'],
                'force' => false
            );
        }

		//создание каталога оригинальных изображений
		$original =WWW_ROOT."files".DS."images".DS.$folderName.DS.$field.DS.$this->originalFolderName;
		if(!file_exists($original)) mkdir($original, 0, true);
		//создание каталогов для ресайза изображений
		foreach($resizeOptions as $imagesFolders)
			if(!file_exists($imagesFolders['folder'])) mkdir($imagesFolders['folder'], 0, true);

        App::import('Component', 'FileUpload');
        $FileUpload = new FileUploadComponent(new ComponentCollection());
		//uploading cover image
        if (!empty($this->data[$modelName][$field]['name']) && $this->data[$modelName][$field]['error'] == 0) {
            $this->data[$modelName][$field]['name'] = preg_replace("/[^A-Za-z0-9_\.]/", "", $this->data[$modelName][$field]['name']);

            $retArray = $FileUpload->uploadFile(
                $this->data[$modelName][$field],
                $original,
                'image',
                array(
                    'resize' => true,
                    'resizeOptions' => $resizeOptions,
                    'randomName' => false
                )
            );

            if (!$retArray['error']) {
                $this->data["$modelName"][$field] = $retArray['fileName'];
            }
        } else {
            unset($this->data["$modelName"][$field]);
        }

	}

    public function getArticlesByField($field, $number=3){
        if(empty($field)) return false;
        else return $this->find('all', array('conditions'=>array('Article.is_active'=>1, 'Category.is_active'=>1),
                                        'fields'=>array('id', 'category_id', 'name', 'image', 'slug', 
                                                        'short_description', $field, 'is_active'),
                                        'order'=>array("Article.$field DESC"),
                                        'limit'=>$number,
                                        'recursive'=>1,
                                        'contain'=>array('Category'=>array('fields'=>array('is_active','id')))));
    }
    
    public function getArticlesRecommend( $number=3){
        return $this->find('all', array('conditions'=>array('Article.is_active'=>1, 'Article.is_recommend'=>1,'Category.is_active'=>1),
                                        'fields'=>array('id', 'category_id', 'name', 'image', 'slug', 
                                                        'short_description', 'is_recommend', 'is_active'),
                                        'order'=>array("Article.date DESC"),
                                        'limit'=>$number,
                                        'recursive'=>1,
                                        'contain'=>array('Category'=>array('fields'=>array('is_active','id')))));
    }
    
    public function getArticlesByBlock($block){
        if(empty($block)) return false;
        else return $this->find('all', array('conditions'=>array('Article.is_active'=>1,'Article.block_footer'=>(int)$block ,'Category.is_active'=>1),
                                        'fields'=>array('id', 'category_id', 'name', 'slug', 'is_active', 'block_footer'),
                                        'order'=>array("Article.position "),
                                        'recursive'=>1,
                                        'contain'=>array('Category'=>array('fields'=>array('is_active','id')))));
    }

    

}
?>
