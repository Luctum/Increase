<?php

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;

class UsersController extends ControllerBase
{
    protected $model;
    protected $title;
    protected $controller;

    public function initialize(){
        $this->model = "User";
        $this->title = "Utilisateurs";
        $this->controller = "Users";
    }
    
    public function loginAction() {
    	
    }
    
    public function signInAction() {
    	$bootstrap = $this->jquery->bootstrap();
    	 
    	if(!empty($_POST['identite']) && !empty($_POST['password'])) {
    		
    		$userPseudo = User::findFirst("identite = '".$_POST['identite']."'");

    		$userMail = User::findFirst("mail = '".$_POST['identite']."'");
    	
    		if($userPseudo != NULL && password_verify($_POST['password'], $userPseudo->getPassword())) {
    			$this->session->set("user", $userPseudo);
    			$this->response->redirect("Index/index");
    			$this->loadAclAction($userPseudo->getRole());
    		} else if($userMail != NULL && password_verify($_POST['password'], $userMail->getPassword())) {
    			$this->session->set("user", $userMail);
    			$this->response->redirect("Index/index");
    			$this->loadAclAction($userMail->getRole());
    		} else {
    			echo $bootstrap->htmlAlert("alert1","L'identifiant ou le mot de passe est incorrecte.");
    		}
    	}
    }
    
    
	
	public function readAction($id = NULL) {
		
	}
	
	public function rulesAction() {
		$accordion=$this->jquery->bootstrap()->htmlAccordion("accordion1");
		$accordion->addPanel("Panel 1","Contenu du panel 1");
		$accordion->addPanel("Panel 2","Contenu du panel 2");
		echo $accordion;
	}

 

}

