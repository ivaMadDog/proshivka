<?php 
class AdministratorsController extends AppController
{
	var $name = "Administrators";
	var $helpers = array();
	var $components = array();
	var $uses=array('Administrator');

	function beforeFilter(){
		if(in_array($this->request->params["action"],array("admin_index","admin_editpassword"))){
			parent::beforeFilter();
		}
	}

	function admin_index() {
		$this->layout='admin/default';
	}

	function admin_editpassword()
	{
		$this->layout='admin/default';
		$id=$this->Session->read('Admin.id');
		if(empty($this->request->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid administrator.', null, null, 'err');
				$this->redirect('/admin/Administrators/');
				exit;
			}
			$this->request->data = $this->Administrator->read(null, $id);
		} else {
			$entered_pass=md5($this->request->data['Administrator']['password']);
			$count=$this->Administrator->find('count',array('conditions'=>array('Administrator.id'=>$id,'Administrator.password'=>$entered_pass)));
            if($count>0){
				if($this->request->data['Administrator']['newpassword']!=""){
					if($this->request->data['Administrator']['newpassword']==$this->request->data['Administrator']['confirmpassword']){
						$this->request->data['Administrator']['password'] =$this->request->data['Administrator']['newpassword'];
						
						$this->Administrator->id=$id;
						$this->request->data['Administrator']['id']=$id;
						$this->request->data['Administrator']['password']=md5($this->request->data['Administrator']['password']);
						
						$this->Administrator->set($this->request->data);
						if($this->Administrator->save($this->request->data)) {
							$this->Session->setFlash('The Password has been changed.', 'admin/admin_succ');
							$this->redirect('/admin/Administrators/');
							exit;
						}
				    } else {
                        $this->Session->setFlash('The password and its confirmation do not match', 'admin/admin_err');
                    }
				}
			} else {
				$this->Session->setFlash('Incorrect Old Password.', 'admin/admin_err');
			}
		}
	}

	function login(){
		
		$this->layout='admin/login';

		$ip=$_SERVER['REMOTE_ADDR'];
		if ($this->request->data){
			$date=date('mY');
			$username=$this->request->data['Administrator']['username'];
			
			$results = $this->Administrator->find("first",array("conditions"=>array("Administrator.username"=>$username)));
			
			if ($results && $results['Administrator']['password'] == md5($this->request->data['Administrator']['password'])){
				if($results['Administrator']['active'] == 0){
					$this->Session->setFlash('Your account is not activated','admin/admin_err');
					$this->redirect('/Administrators/login/');
					exit;
				}
				$loginMessage="Login successfull using username: '$username' from IP: $ip";
				$this->log($loginMessage, "logins/$date/logs");

                $this->Session->write('Admin.id', $results['Administrator']['id']);
                $this->Session->write('Admin.admin_name', $results['Administrator']['name']);
                $this->Session->write('Admin.level', $results['Administrator']['level']);
				$this->Session->write('Admin.data', $results);
				
				setcookie("cyberchisel_ck_authorized", "true", 0, "/");
				
				$this->redirect('/admin/Administrators/index/');
			}
			else {
				$loginMessage="Login unsuccessfull using username: '$username' from IP: $ip";
				$this->log($loginMessage, "logins/$date/logs");
				$this->Session->setFlash('Wrong username/password. Please try again. ','admin/admin_err');
				$this->redirect('/Administrators/login/');
			}
		}
	}

	function logout(){
		
		setcookie("cyberchisel_ck_authorized", "false", 0, "/");
		
		$this->Session->destroy();
		$this->Session->setFlash('You are logged out! ','admin/admin_err');
		$this->redirect('/Administrators/login');
	}


}