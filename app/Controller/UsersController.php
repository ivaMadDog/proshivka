<?php
class UsersController extends AppController {

    var $name = 'Users';
    var $uses = array('User');
	//var $components=array('Captcha');
    var $paginate = array('limit'=>20);
    var $roles = array('admin'=>'Admnistrator','user'=>'User');
    var $helpers = array('User');
    var $modelName = 'User';
	var $pageTitle = 'Members';
	var $menuFlag = 'Members';

    var $image_dir = '/files/users/';
    var $big_image_dir = 'big/';
    var $small_image_dir = 'small/';
    var $mid_image_dir = 'mid/';
    var $tiny_image_dir = 'tiny/';
    
    var $title_options = array('Mr.'=>'Mr.','Ms.'=>'Ms.','Mrs.'=>'Mrs.');
    
    function beforeFilter(){

        parent::beforeFilter();
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
        
        $this->User->Auth = $this->Auth;
        $this->set('modelName', $this->modelName);

        // avoid hashing at once after submit form, pwd hashed in beforeSave() only
        //if($this->params['action'] == 'register')  $this->Auth->authenticate = $this->User;
/*        
        // rights
        if(!$this->isRole('user')) $this->Auth->deny(array('profile_edit','new_password','change_photo','delete_photo'));
        if($this->isRole('admin'))  $this->Auth->deny(array('profile_edit','register'));
        if($this->Auth->user('id'))  $this->Auth->deny(array('register'));
        
        if($this->params['action'] == 'profile' && empty($this->params['pass'][0]) && !$this->isRole('user')){
            $this->Auth->deny('profile');
        }
//
//        if($this->isRole('user') && in_array($this->params['action'], array('register')))
//        $this->redirect(array('action'=>'profile'));
        
        //if($this->isRole('user')){
            $user_id = $this->Auth->user('id');
        
        //}
*/        
		if(isset($this->params['admin'])){
			$pageTitle = $this->pageTitle;
			$menuFlag = $this->menuFlag;
			$this->$modelName->locale = 'eng';
			$this->set(compact('menuFlag','pageTitle'));
			
		}            
        
		foreach($this->title_options AS $k=>$v){
			$this->title_options[$k] = __($v,'');
		}
        $this->set('title_options', $this->title_options);
    }

    /////////////////////////////	ADMIN	///////////////////////////////////////        
	
    /**
     * @todo Rewrite count for paginate
     *
     * @param unknown_type $expand
     */
    function admin_index($expand = false)
    {
        $modelName = $this->modelName;
        //$cond['Role.key']='user';
        /*
        $this->paginate['User']['joins']=array(
        	array(
        		'table'=>'roles',
	    		'alias'=>'Role',
    			'type'=>'inner',
    			'conditions'=>array('Role.id=User.group_id')
    		),
    	);
    	*/
        $this->paginate[$modelName]['fields'] = array('User.*');
        $data = $this->paginate('User');

//        $this->paginate['User']['conditions'] = array('Group.name="user"','User');
//        $data = $this->paginate('User');
        $this->set(compact('data','options','filter'));
    }
    
        
    function admin_edit($id = null) {
    	$modelName = $this->modelName;
    	if($id){
	    	$this->_setUserImagePath($id);
	    	$old_data = $this->User->findById($id);
    	}
        if(!empty($this->data)){
            if(!empty($this->data['User']['id'])){
                if(empty($this->data['User']['password'])) unset($this->data['User']['password']);
                elseif(!empty($this->data['User']['password']) || !empty($this->data['User']['confirm_password'])){
                    foreach($this->User->validate['password'] AS $k=>$v){
                        $this->User->validate['password'][$k]['on'] = 'update';
                        unset($this->User->validate['password'][$k]['on']);
                    }
                    foreach($this->User->validate['confirm_password'] AS $k=>$v){
                        $this->User->validate['confirm_password'][$k]['on'] = 'update';
                        unset($this->User->validate['confirm_password'][$k]['on']);
                    }
                }
                
	            
                // @begin upload images
                $field = 'image';
	            $type = 'image';
		        $args = $this->{$field.'Args'};
		        $path = $args['folder'];
		        if(!empty($this->data[$modelName][$field.'_upload']['name'])){
		            $file=$this->FileUpload->uploadFile(
		            	$this->data[$modelName][$field.'_upload'],
		            	$path,$type,$args
		            );
		            if(!$file['error']) $this->data[$modelName]['image']=$file['fileName'];
		            else{
		            	$this->$modelName->invalidate($field, $file['errorMsg']); // doesn't work with array
		            }
		        }
                // @end upload images
            }
            if($this->User->saveAll($this->data)){
                if(!$id || !empty($this->data['User']['password'])){
                    $d = $this->User->findById($this->User->id);
                    $d['User']['password'] = $this->data['User']['pwd'];
                    // !!!hack - all except Admin
                    if($d['User']['group_id'] > 1){
                    	$lang = Configure::read('DEFAULT_LANGUAGE');;
	                    $d['User']['link'] = Router::url(array('controller'=>'users', 'action'=>'login', 'admin'=>false, 'lang'=>$lang), true);
                    }
                    $this->_sendNewPwdMail($d['User']);
                }
            
                //die('OK');
                $this->Session->setFlash('Information has been saved');
                $this->redirect(array('action'=>'admin_edit',$this->User->id));
            }
            //debug($this->User->validationErrors);
        }
        elseif($id){
            if($data = $this->User->findById($id)){
                //$data['User']['birthday'] = date('d-m-Y', strtotime($data['User']['birthday']));
                unset($data['User']['password'], $data['User']['code']);
                $this->data = $data;
        	}
        }
        $this->set(compact('id'));
        $this->render('admin_form');
    }
        
        
    function admin_delete($id = null) {
    	if(!($data = $this->User->findById($id))){
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
    	}
    	if($data['User']['username'] == 'admin'){
            $this->Session->setFlash(__('Impossible to delete SUPER Admin User', true));
            $this->redirect(array('action'=>'index'));
    	}
        //$this->checkId($id);
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted', true));
            $this->redirect(array('action'=>'index'));
        }
    }
    
	function admin_delete_file($id,$field){
		$modelName = $this->modelName;
		////////Validating Id////////////
		if(!is_numeric($id) || !($data = $this->$modelName->findById($id))){
			$this->setError('Invalid Request');
			$this->redirect($this->referer());
		}
		$file_name = $data[$modelName][$field];
		$this->$modelName->id=$id;
		$this->$modelName->saveField($field, null);

		$this->_setUserImagePath($id);
		$this->_delete_old_photo($field, $file_name);
		$this->setFlashMessage('File has been deleted successfully', 'json');
		
		$this->redirect($this->referer());
	}
    


    function admin_forgot_password(){
        if(!empty($this->data['User'])) $data = $this->data['User'];
        if(empty($data['username']) || empty($data['email']))
        $this->redirect(array('action'=>'login'));
        if(!($User = $this->User->getUserByUsernameAndEmail($data['username'], $data['email']))){
            $this->Session->setFlash(__('Invalid Email or Username', true), '../users/admin_login/failure');
            $this->redirect(array('action'=>'login'));
        }
            if($data = $this->User->saveNewPwd($User['User'])){
            
            $this->_sendNewPwdMail($data);
            $this->Session->setFlash(__('Your password has been changed successfully', true), '../users/admin_login/forgot_pwd');
        }
        $this->redirect(array('action'=>'login'));
    }
    
	function admin_block($id=null){
		if($this->RequestHandler->isAjax()){
			$this->layout='';
		}
		$modelName=$this->modelName;
		$controllerName=$this->name;
		////////Validating Id////////////
		if($id==null || !is_numeric($id)){
			if($this->RequestHandler->isAjax()){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("admin_index");
			}
			exit;
		}
		$this->$modelName->id=$id;
		$this->$modelName->saveField("is_blocked",DboSource::expression('!is_blocked'));
		$data = $this->$modelName->findById($id);
		$new_status = $data[$modelName]['is_blocked'];

		if(!($this->RequestHandler->isAjax())){
			$this->Session->setFlash("Status Changed successfully");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		echo $new_status;
		exit;
	}

    
    //////////////////////////////////////// FRONT ////////////////////////////////////////////




    function check(){
    //debug($this->params);
    	if(isset($_POST['HAVE_PWD']) && $_POST['HAVE_PWD'] == 0){
    		//$this->register();
    		$this->data['User']['username'] = $_POST['username'];
    		$this->render('register');
    	}
    	elseif(!empty($_POST['password']) || (isset($_POST['HAVE_PWD']) && $_POST['HAVE_PWD'] == 1)){
    		$this->data['User']['username'] = $_POST['username'];
    		$this->data['User']['password'] = $this->User->password($_POST['password']);
    		$this->login($this->data['User']);
 	        if($user_id = $this->Auth->user('id')){
    	        $Auth = $this->Auth->user();
            	$group_id = $Auth['User']['group_id'];
	            $groups = $this->Group->getList();
    	        if($groups[$group_id] == 'user'){
    	        	$User = $this->User->findById($user_id);
    	        	$section = $this->params['section'];
    	        	if(!empty($User['Form'][0])){
            			$this->Session->write($this->Auth->sessionKey.'.Form', $User['Form'][0]);
            			if(!empty($User['Form'][0]['section'])) $section = $User['Form'][0]['section'];
            		}
    	        	$action = !empty($User['Form'][0]['current_step']) ? 'step'.($User['Form'][0]['current_step']+1) : 'step1';
    	        	die(json_encode(array('reload'=>Router::url(array('controller'=>'forms','action'=>$action, 'lang'=>$this->lang, 'section'=>$section)) )));
    	        }
    	    }
    	    
    		$this->render('login_form');
    	}
    	else $this->render('register');
    }

    function login($data = null){
    	$login = $this->Auth->login($data);
    	if(!empty($_POST) && !$login){
    		$this->set('error', $this->Auth->loginError);
    	}
    }


    function logout() {
        $role = $this->viewVars['Auth']['User']['role'];
		$this->Session->destroy();
        $this->Auth->logout();
        $this->redirect(Router::url(array('controller'=>'home','action'=>'index', 'lang'=>$this->lang)));
    }
    
    
    function register(){
        if (!empty($this->data)) {
            $err = false;
            if (!empty($_POST['recaptcha_response_field']) && !$this->Captcha->validate()) {
            	$err = true;
            	$this->Session->write('captcha_error', $this->Captcha->error);
            }
//debug($this->data);
//exit;         
            $group = $this->User->Group->findByName('user');
            $this->data['User']['group_id'] = $group['Group']['id'];
            //$this->data['User']['is_blocked'] = 1;
            //$this->data['User']['status'] = 'pending';
            //$this->data['User']['code'] = $this->User->_generateRegisterCode($this->data['User']);
            $this->User->set($this->data);
            if($this->User->validates() && !$err){
                unset($this->data['User']['confirm_password'], $this->data['User']['retype_username']);
                $this->data['User']['email'] = $this->data['User']['username'];
                $this->data['User']['is_confirmed'] = 1;
                
                $this->User->saveAll($this->data, array('validate' => false));
            	
            	$this->data['User']['role'] = 'user';
            	$this->data['User']['id'] = $this->User->id;
            	$this->Session->write($this->Auth->sessionKey, $this->data['User']);
                
                $this->_sendRegisterMail($this->data['User']);
                //$page_text = $this->requestAction(array('controller'=>'dynamic_pages', 'action'=>'text_block'), array('pass'=>array('Thank-you-for-signing-up-text'), 'lang'=>$this->lang));
                //$msg = $page_text;
                die(json_encode(array('reload'=>Router::url(array('controller'=>'forms', 'action'=>'step1', 'lang'=>$this->lang, 'section'=>$this->params['section'])))));
            }
            else{
            	unset($this->data['User']['password'], $this->data['User']['confirm_password']);
            	if(!empty($this->User->validationErrors['username'])){
                	die(json_encode(array('error'=>__($this->User->validationErrors['username'],'') )));
                }
            }
            //debug($this->User->validationErrors);
        }
    }

    function profile($user_id = null){
    	$modelName = 'User';
    	$title = __('Profile','');
    	$isMyProfile = false;
        if(!$user_id){
            $user_id = $this->Auth->user('id');
            $title = __('My Profile','');
            $isMyProfile = true;
        }
        if(!($data = $this->User->findById($user_id))){
            $this->cakeError('error404');
        }
        
        if($data[$modelName]['id'] == $this->Auth->user('id')) $isMyProfile = true;
        $title_for_layout = $title;
        if($user_id){
        	$title_for_layout .= ' '.$data[$modelName]['name'];
        }

        $this->set(compact('data','title_for_layout','title','user_id','isMyProfile','user_photos'));
    }
    
    function profile_edit(){
        if (!empty($this->data)) {
            unset($this->User->validate['username'], $this->User->validate['password'], $this->User->validate['confirm_password'], $this->User->validate['group_id']);
            $this->data['User']['id'] = $this->Auth->user('id');
            if ($this->User->saveAll($this->data)) {
                $User = $this->User->findById($this->User->id);
                $this->Session->write($this->Auth->sessionKey, $User['User']);
                $this->Session->setFlash(__('Information has been saved successfully', true));
                $this->redirect($this->referer());
            }
            else{
                $this->data['User']['email'] = $this->Auth->user('email');
            }
        }
        $this->data = $this->Auth->user();
        
        $this->render('register');
    }
    
    function new_password()
    {
        if(!empty($this->data['User'])){
            //  --------------- Validation ------------------
            
            $this->User->set( $this->data );
            $this->User->validates(array('fieldList'=>array('password', 'confirm_password')));
            //  --------------- Save ------------------
            if(empty($this->User->validationErrors)) {
            	$pwd = $this->data['User']['pwd'];
            	$this->User->id = $this->Auth->user('id');
                if($this->User->saveField('password', $this->data['User']['password'])){
                    $data = $this->Auth->user();
                    $data['User']['link'] = Router::url(array('controller'=>'users', 'action'=>'login', 'lang'=>$this->lang), true);
                    $data['User']['password'] = $pwd;
                    $this->_sendNewPwdMail($data["User"]);
                    $this->setFlashMessage(__('Your password has been changed successfully', true));
                    $this->redirect($this->referer());
                }
            }
            else{
                $this->data['User']['password'] = $this->data['User']['confirm_password'] = null;
            }

        }
    }

    function forgot_password(){
        if(!empty($this->data['User'])){
            $data = $this->data['User'];
            $User = $this->User->findByEmail($data['email']);
            if(empty($data['email']) || !Validation::email($data['email'])){
                $this->User->invalidate('email', $error = __('Please enter a valid email address', true));
                $this->setFlashError($error,'json');
            }
            elseif(!$User){
                //$this->Session->setFlash(__('Invalid Email', true));
                $this->setFlashError($error = __('Please enter a valid email address', true),'json');
            }
            if($data = $this->User->saveNewPwd($User['User'])){
                $data['link'] = Router::url(array('controller'=>'users', 'action'=>'login', 'lang'=>$this->lang), true);
                $this->_sendNewPwdMail($data);
                $msg = __('Your password has been changed successfully', true);
                $this->setFlashMessage($msg,'json');
                //$this->Session->setFlash($msg);
                $this->redirect(array('action'=>'login'));
            }
        }
    }

    function checkId($id)
    {
        if (!$id || !$this->User->exists($id)) {
//            $this->Session->setFlash(__('Invalid user', true));
//            $this->redirect(array('action' => 'index'));
        }
    }


    function _sendRegisterMail($data)
    {
        $appName = Configure::read('Config.settings.appName');
        $subject = __('Signup', true);
        $template = 'register';
        // additional data
        //$data['confirm_register_link'] = Router::url(array('controller'=>'users', 'action'=>'register_confirm', $data['code'], 'lang'=>$this->lang), true);
        //$data['name'] = implode(' ', array($data['title'], $data['first_name'], $data['last_name']));
        return $this->sendEmail($data, $data['email'], $subject, $template);
    }


    function checkIsRoleUser()
    {
        $res = $this->isRole('user');
        if($this->RequestHandler->isAjax()){
            die($res);
        }
        return $res;
    }
    
}
?>