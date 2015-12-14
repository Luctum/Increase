<?php

class TestController extends ControllerBase
{

	protected $model;
	protected $title;
	protected $controller;
	
    public function indexAction()
    {
    	$this->view->pick("Index/index");
    	echo $this->jquery->bootstrap()->htmlAlert("alert1","Vous n'avez pas les droits pour accéder à cette page !");
    	
    }

    public function initialize() {
    	$this->model="Test";
    	$this->title="Test";
    	$this->controller="Test";
    }
 
}

