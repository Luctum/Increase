<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller{

    protected $model;
    protected $title;
    protected $controller;

    public function afterExecuteRoute($dispatcher){
        $baseUrl = $this->baseUrl;
        $this->view->setVar("baseUrl", $baseUrl);
        $this->view->setVar("controller", $this->controller);
        $this->view->setVar("title", $this->title);
    }

    public function indexAction(){
        $objects = call_user_func($this->model."::find");
        $this->view->setVar("objects",$objects);
        $this->view->pick("main/index");
    }

    public function frmAction($id =  NULL){
        echo "Pas encore implémenté...";
    }

    public function readAction($id = NULL){
        if($id != null){
            $object = call_user_func($this->model.'::find', "id = $id");
            $this->view->setVar("object",$object);
            $this->view->pick("main/read");
        }
    }

    public function updateAction(){
        echo "Pas encore implémenté...";
    }

    public function deleteAction($id = null){
        $object = call_user_func($this->model.'::findFirst', "id = $id");
        $object->delete();
        $this->response->redirect("Index/index");
    }

    public function asAdminAction(){
        $user = new User();
        $user->findFirst("role = '%admin%' ");
        $this->session->set("user", $user);
        $this->response->redirect("Index/index");
    }

    public function asUserAction(){
        $user = new User();
        $user->findFirst("role = 'user' ");
        $this->session->set("user", $user);
        $this->response->redirect("Index/index");
    }

    public function logoutAction(){
        $this->session->destroy();
        $this->response->redirect("Index/index");
    }

}
