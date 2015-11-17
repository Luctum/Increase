<?php

class TestController extends \Phalcon\Mvc\Controller
{

	protected $model;
	protected $title;
	protected $controller;
	
    public function indexAction()
    {
    	$bootstrap = $this->jquery->bootstrap();
    	echo $bootstrap->htmlAlert("alert2-1","Voulez-vous vraiment supprimer l'utilisateur  <div class='btn btn-default id='btnOui'>Oui</div>","alert-success");
    }

    public function initialize() {
    	$this->model="Test";
    	$this->title="Test";
    	$this->controller="Test";
    }
    
}

