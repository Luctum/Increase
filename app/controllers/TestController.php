<?php

class TestController extends \Phalcon\Mvc\Controller
{

	protected $model;
	protected $title;
	protected $controller;
	
    public function indexAction()
    {
    	$bootstrap = $this->jquery->bootstrap();
    	echo $bootstrap->htmlAlert("alert1","Le nom d'utilisateur ou le mot de passe est incorrecte.");
    }

    public function initialize() {
    	$this->model="Test";
    	$this->title="Test";
    	$this->controller="Test";
    }
    
}

