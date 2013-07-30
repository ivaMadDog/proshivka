<?php
class Brand extends AppModel {

    public $name = 'Brand';
    public $actsAs = array('Containable');

	public $folderName = 'brands';
	public $originalFolderName= "original";
	public $resizeSettings= array('image'=>array(
											 'preview'=>array('width'=>200,'height'=>150,),
											 'thumb'=>array('width'=>120,'height'=>90,),),
								  'video'=>array(
											 'preview'=>array('width'=>200,'height'=>150,),
											 'thumb'=>array('width'=>120,'height'=>90,),),
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
    function beforeSave()
    {	//сохраняем картинки для полей, которые могут содержать имена изображений
		foreach($this->resizeSettings as $field=>$options) $this->saveFieldImage($field);

        $this->saveSeo('name', 'short_description');
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
