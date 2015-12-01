<?php

class TestController extends \Phalcon\Mvc\Controller
{

	protected $model;
	protected $title;
	protected $controller;
	
    public function indexAction()
    {
    	$operationsBdd = Operation::find();
    	foreach ($operationsBdd as $operation) {
    		$operations[] = $operation->getOperation();
    	}
    	foreach ($operations as $operation) {
    		echo $operation;
    	}
    }

    public function initialize() {
    	$this->model="Test";
    	$this->title="Test";
    	$this->controller="Test";
    }
    
}

