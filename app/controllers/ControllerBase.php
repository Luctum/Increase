<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller{

    protected $model;

    public function indexAction(){
        $objects = call_user_func($this->model."::find()");
        $this->view->setVars(array("objects"=>$objects,"title"=>$this->model,"baseHref"=>$this->url->getBaseUri()));
        $this->view->render("main/index.volt");
    }

}
