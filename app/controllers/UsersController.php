<?php

class UsersController extends \ControllerBase {
	
    protected $model;
    protected $title;
    protected $controller;

    public function initialize(){
        $this->model = "User";
        $this->title = "Utilisateurs";
        $this->controller = "Users";
    }

    public function loginAction() {
    	 
    	$pwd = "moiquatre";
    	echo password_hash($pwd, PASSWORD_DEFAULT);
    	 
    }
    
}

