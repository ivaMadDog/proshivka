<?php
/* SVN FILE: $Id: app_controller.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */

class AppController extends Controller
{
    var $uses = array();
    var $helpers = array('Form', 'Html', 'Js', 'Time', 'Ck', 'Text', 'Cache');
    var $components = array('Session','RequestHandler', 'Email',
                            'Auth' => array(
                                    'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
                                    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
                                ));


    function beforeFilter(){
        
        $this->Auth->allow('index', 'view');
        
      
    }


    function admin_beforeFilter()
    {
        ini_set('upload_max_filesize', '64M');
        $level = $this->Session->read('Admin.level');
        $this->set('level', $level);
        $this->set('adminid', $this->Session->read('Admin.id'));
    }

    function user_beforeFilter() {

    }

    function saveSlug($modelName)
    {
        if (isset($this->request->data["$modelName"]["slug"])) {
            $slug = $this->request->data["$modelName"]["slug"];
            $slug = strtolower(addslashes(preg_replace("/ /", "-", htmlspecialchars($slug))));
            $slug = strtolower(addslashes(preg_replace("/'/", "-", htmlspecialchars($slug))));
            $this->request->data["$modelName"]["slug"] = $slug;
        }
    }

    function sendEmail($to, $subject, $template, $data, $reply_to = "", $from_email = "")
    {
        $no_reply = Configure::read("BASE_NOREPLY_EMAIL");

        if (empty($reply_to))
            $reply_to = Configure::read("BASE_ADMIN_EMAIL");

        if (empty($from_email))
            $from_email = $no_reply;

        $email_prefix = Configure::read("EMAIL_SUBJECT_PREFIX");

        $this->Email->from = $email_prefix . "<$from_email>";
        $this->Email->to = $to;

        $this->Email->subject = $email_prefix . ' | ' . $subject;
        $this->Email->sendAs = 'both';

        $this->Email->replyTo = $reply_to;
        $this->Email->template = $template; ///////////////
        $this->set('data', $data);
        if ($this->Email->send()) {
            $this->Email->reset();
            return 1;
        } else return 0;
    }
	
	/* gets the aro_id of this user */
	function getAroId($userId){
		$this->loadModel("Aro");
		$aroInfo = $this->Aro->find("first",array("conditions"=>array("Aro.foreign_key"=>$userId,"Aro.model"=>"Administrator")));
		
		if(!empty($aroInfo["Aro"]["id"]))
			$aroId = $aroInfo["Aro"]["id"];
		else $aroId = 0;
		
		return $aroId;
	}
	
	function checkPermissions($acoName,$action){
		$userInfo = $this->Session->read("Admin.data");
		$userId = $userInfo["Administrator"]["id"];
		$userParentAroId = $userInfo["Administrator"]["administrator_group_id"];
		$userAroId = $this->getAroId($userId);
		
		if($userParentAroId > 0 && !$this->Acl->check(array('model' => 'AdministratorGroup', 'foreign_key' => $userParentAroId), $acoName, $action)){
			$this->Session->setFlash("You don't have enought permissions to access this page","admin/admin_err");
			$this->redirect("/admin/Administrators/index");
			exit;
		}
		
	}
}
