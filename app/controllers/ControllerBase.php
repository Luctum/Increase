<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller{

    protected $model;
    protected $title;
    protected $controller;

    public function indexAction(){
        $objects = call_user_func($this->model."::find");
        $this->view->setVars(array("objects"=>$objects,"title"=>$this->title, "controller"=>$this->controller));
        $this->view->pick("main/index");
    }

    public function frmAction(){
        echo "Pas encore implémenté...";
    }

    public function readAction(){
        echo "Pas encore implémenté...";
    }

    public function updateAction(){
        echo "Pas encore implémenté...";
    }

    public function deleteAction(){
        echo "Pas encore implémenté...";
    }

    public function asAdminAction(){
        echo "Pas encore implémenté...";
    }

    public function asUserAction(){
        echo "Pas encore implémenté...";
    }
}
