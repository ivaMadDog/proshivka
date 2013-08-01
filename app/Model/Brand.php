<?php
class Brand extends AppModel {

    public $name = 'Brand';
    public $actsAs = array('Containable');

	public $folderName = 'brands';
	//имя каталога на сервере для хранения ориганального изображения
	public $originalFolderName= "original";
	//массив полей таблицы привязанных к изображениям
	//width: новая ширина изображения, height: новая высота изображения, path: имя каталога для данного размера изображения
	public $resizeSettings= array('image'=>array(
											 'preview'=>array('width'=>200,'height'=>150,),
											 'thumb'=>array('width'=>120,'height'=>90,),),
//								  'video'=>array(
//											 'preview'=>array('width'=>200,'height'=>150,),
//											 'thumb'=>array('width'=>120,'height'=>90,),),
							);

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
//        'url' => array(
//            'required' => array(
//                'rule' => array('url'),
//                'message' => 'Неверный url адрес производителя'
//            ),
//        ),
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
            foreach($this->resizeSettings as $field=>$options)
                if($this->currentItem[$this->name][$field]!=$this->data[$this->name][$field])
                    $this->deleteImageField($field);

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



}
?>
