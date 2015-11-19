<?php

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
    	$bootstrap = $this->jquery->bootstrap();
    	
    	if(!empty($_POST['identite']) && !empty($_POST['password'])) {
    		$user = new User();
    		$user->findFirst("identite = '".$_POST['identite']."'", "password = '".password_hash($_POST['password'])."'");
    		
    		if($user != NULL) {
    			$this->session->set("user", $user);
    		} else {
    			echo $bootstrap->htmlAlert("alert1","Le nom d'utilisateur ou le mot de passe est incorrecte.");
    		}
    	}
    }

}

