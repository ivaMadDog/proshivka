<?php
App::import('Sanitize');
class SeoManagementController extends AppController
{
	var $name = "SeoManagement";
	var $helpers = array('Html','Form','Javascript');
	var $components = array('Access','RequestHandler');
	var $uses=array('SeoManagement');
	var $modelName="SeoManagement";
	var $controllerName="seo_management";
	var $sectionName="seo_management";
	var $sectionTitle="SEO Default Values";
	//////////////////////////////////ADMIN INTERFACE//////////////////////////////////////////////////////////
	
	function admin_index(){
		
		$modelName="SeoManagement";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;

		$this->set('modelName', $modelName);
		$this->set('controllerName', $controllerName);
		$adminConfigArray=array("modelName"=>$modelName,"controllerName"=>$controllerName,"sectionName"=>$sectionName,"menuFlag"=>$controllerName);
		$this->set('adminConfigArray', $adminConfigArray);
		$this->set('page_subtitle', "List SEO Default Values");

		$data=$this->$modelName->find();
		$this->set('data', $data);

		
	}
	
	function admin_edit(){
		$this->set("menuFlag",5);
		$modelName="SeoManagement";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;
		$this->set('modelName', $modelName);
		$this->set('controllerName', $controllerName);
		$adminConfigArray=array("modelName"=>$modelName,"controllerName"=>$controllerName,"sectionName"=>$sectionName,"menuFlag"=>$controllerName);
		$this->set('adminConfigArray', $adminConfigArray);
		
		if(!empty($this->data)){
			$this->data["$modelName"]["id"]=1;

			if($this->$modelName->save($this->data)){
	
				Cache::set(array('path' => CACHE."seo_management"));
				Cache::clear();
	
				$this->Session->setFlash("Data saved successfully");
				$this->redirect("/admin/$controllerName/edit");
				exit;
		}
		}else{
			
			$this->data=$this->get_all_locales(array("$modelName.id"=>1),"$modelName",Configure::read('LOCALES'),array('prepend_title','append_title','title','keywords','description'),array("id"));
		}
		
		$this->set("page_title",$this->sectionTitle);
		$this->set("page_subtitle","Edit ".$this->sectionTitle);
	}
		
	

}
?>