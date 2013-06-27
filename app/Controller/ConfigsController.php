<?php
class ConfigsController extends AppController {

    var $name = 'Configs';
    var $uses = array('Config');
    var $modelName="Config";
    var $controllerName="configs";
    var $sectionName="config";
    var $pageTitle="Config";
	var $config_file = 'config.ini';
var $menuFlag = 'Config';
        
    //////////////////////////////////ADMIN INTERFACE//////////////////////////////////////////////////////////

    function beforefilter(){
		parent::beforefilter();
		
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);

        $modelName=$this->modelName;
        $controllerName=$this->controllerName;
        $sectionName=$this->sectionName;

       	$this->config_file = ROOT.DS.APP_DIR.DS.'config'.DS.$this->config_file;

        if(!$this->RequestHandler->isAjax() && (isset($this->params['admin']) && $this->params['admin'])){
			$pageTitle = $this->pageTitle;
			$menuFlag = $this->menuFlag;
			$this->set(compact('menuFlag','pageTitle'));

            /*
            $this->set('adminname',$this->Session->read('Admin.admin_name'));
            $adminConfigArray=array("modelName"=>$modelName,"controllerName"=>$controllerName,"sectionName"=>$sectionName,"menuFlag"=>1);
            $this->set('adminConfigArray', $adminConfigArray);
            */
        	
            //          }
        }
    }

    function admin_edit()
    {
    	$modelName = $this->modelName;
        if (!empty($this->data)) {
        	$error = false;
        	$config_content = "";
        	foreach($this->data['Config'] AS $k=>$v){
        		$curr = $this->$modelName->findByKey($k);
        		$this->$modelName->id = $curr[$modelName]['id'];
        		if(!$this->$modelName->saveField('value', $v)){
					$error = true;
				}
				else{
                	$value = h(trim($v));
                	$config_content .= "\r\n{$k}=\"{$value}\"\r\n";
            	}
            }
	$seo_management_data = $this->data['SeoManagement'];
	$seo_management_data['model_name'] = '';
	$seo_management_data['model_id'] = 0;
	$this->$modelName->save_seo_all_locales($seo_management_data);
// save seo by langs
foreach($seo_management_data AS $field=>$v){
	if(is_array($v)){
		foreach($v AS $l=>$val){
		    $config_content .= "\r\n{$field}_{$l}=\"$val\"\r\n";
		}
	}
}

			file_put_contents($this->config_file, $config_content);
            if($error){
                //$this->Config->validationErrors = $this->Configs->get_errors();
            }
            else{
                $this->Session->setFlash(__('Information has been saved', true));
            }
            if($this->RequestHandler->isAjax()) die();
            $this->redirect($this->referer());
        }
        else{
            $this->data = $this->Config->find('all');
            $seo_data=$this->get_seo_all_locales();
            $this->data = array_merge($this->data, $seo_data);
        }
        
        if (!empty($this->params['requested'])) {
            return $this->data;
        }
        $this->set('data', $this->data);
        $this->render('admin_edit');
    }

    function extract()
    {
        // read config vars
        if($config = parse_ini_file($this->config_file, true)){
            foreach($config AS $k=>$v){
                $this->set($k, $v);
                Configure::write("Config.{$k}", $v);
            }
        }
    }
}
?>
