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
    public $uses = array();
    public $helpers = array('Form', 'Html', 'Js', 'Time', 'Ck', 'Text', 'Cache','Session');
    public $components = array('Session','RequestHandler', 'Email',
                             'Auth' => array(
                                   'authenticate' =>
                                            array('Form' =>
                                                    array('fields' => array('username' => 'email'),
                                                          'scope'  => array('is_active' => 1),
                                                          'recursive'=>-1
                                                     )
                                     ),
                                    'loginAction' => array('controller' => 'users', 'action' => 'login', 'admin'=>false),
                                    'authError'      => 'У Вас нет прав доступа к данной странице',
                                    'loginError'     => 'Некорректный логин или пароль',
                                    'loginRedirect'  => array('controller' => 'users', 'action' => 'profile', 'user'=>true),
                                    'logoutRedirect' => array('controller' => 'home', 'action' => 'index'),
                                    'authorize'      => array('Controller'), // Added this line
                                )
        );

    protected $admin=FALSE, $logged_in=FALSE;


    function beforeFilter(){

          $this->Auth->allow('index', 'view', 'brand');

          if($this->Auth->User('role')==='admin' && !empty($this->request->params["admin"])) {
                    $this->layout='admin/default';
                }

		  $this->Init();

          $this->admin=$this->_isAdmin();
          $this->logged_in=$this->_loggedIn();

          $this->set('admin', $this->admin);
          $this->set('logged_in', $this->logged_in);

          $this->set('headerColor', 'header-lblue'); //дефолтный клас для фона хедера
          $this->set('headerBgImg', 'home.png');     //дефолтный клас для фонового изображения хедера
    }

	private function Init(){
          $this->setSeoMetaTags();
        
		  $this->loadModel('Contact');
		  $contacts=$this->Contact->getContactMenus();
          
          $this->loadModel('Payment');
          $footer_payments=$this->Payment->getPaymentIcons();

		  $this->set(compact('contacts','footer_payments'));
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

  /* Метод проверяет имеет ли пользователь права администратора
  * @return boolean
  */
    protected function _isAdmin(){
        $admin=FALSE;
        if ($this->Auth->user('role')==='admin') {
            $admin=TRUE;
        }
        return $admin;
    }

/* Метод проверяет авторизован ли пользователь на сайте
 * @return boolean
*/
      protected function  _loggedIn() {
           $logged_in=FALSE;
           if ($this->Auth->user()) {
               $logged_in=TRUE;
           }
           return $logged_in;
       }


        public function isAuthorized($user = null) {
            // Any registered user can access public functions
            if (empty($this->request->params['admin'])) {
                return true;
            }

            // Only admins can access admin functions
            if (isset($this->request->params['admin'])) {
                return (bool)($user['role'] === 'admin');
            }

            // Default deny
            return false;
        }

/*редирект на главную страницу*/
       public function homePageRedirect () {
            $this->redirect(Router::url(array('controller'=>'home','action'=>'index')));
       }
/**/
       public function setFlashError($msg, $json = false){
		return $this->setFlashMessage($msg, $json, $status = 'error');
	}
/**/
       public function setFlashMessage($msg, $json = false, $status = 'message'){
		if($status == 'message') $key = 'message';
		if($status == 'error') $key = 'error';

		if($this->RequestHandler->isAjax()){
			if($json){
				$msg = '<div id="flashMessage" class="'.$key.'">'.$msg.'</div>';
				die(json_encode(array($key => $msg)));
			}
			else{
				$this->viewVars['msg'] = $msg;
				$this->set('msg', $msg);
				if($key == 'error' && empty($this->params['admin'])){
					$this->Session->setFlash($msg, 'flash_failure');
				}
				else{
					$this->Session->setFlash($msg);
				}
			}
		}
		else{
			if($key == 'error'){
				if(empty($this->params['admin'])){
					$this->Session->setFlash($msg, 'flash_failure');
				}
				else{
					$this->Session->setFlash($msg);
				}
			}
			else{
				$this->Session->setFlash($msg);
			}
		}
	}

/*отправка нового пароля*/
    public  function _sendNewPwdMail($data)
    {
        $subject = __('New password', true);
        $template = 'new_pwd';
        return $this->sendEmail($data['email'], $subject, $template, $data);
    }
    
    protected function setSeoMetaTags($data=null){
        if(!empty($data)) 
            $this->set(array('prepend_title'=> $data['prepend_title'],
					 	 'append_title'=>$data['append_title'],
					 	 'meta_title'=> $data['meta_title'],
						 'meta_keywords'=> $data['meta_keywords'],
						 'meta_description'=> $data['meta_description'],
						 'page_title'=> $data['title']));
        else {
             $this->set(array(
                        'meta_title'=> Configure::read("meta_title"),
                        'meta_keywords'=> Configure::read("meta_keywords"),
                        'meta_description'=> Configure::read("meta_description")));
        }
	}


}
