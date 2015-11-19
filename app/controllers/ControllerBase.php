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

    public function getInstance($id=NULL){
        if(isset($id)){
            $object=call_user_func($this->model."::findfirst",$id);
        }else{
            $className=$this->model;
            $object=new $className();
        }
        return $object;
    }

    public function readAction($id = NULL){
        if($id != null){
            $object = call_user_func($this->model.'::find', "id = $id");
            $this->view->setVar("object",$object);
            $this->view->pick("main/read");
        }
    }

    protected function setValuesToObject(&$object){
        $object->assign($_POST);
    }

    public function updateAction(){
        if($this->request->isPost()){
            $object=$this->getInstance(@$_POST["id"]);
            $this->setValuesToObject($object);
            $object->save();
            $this->dispatcher->forward(array("controller"=>$this->dispatcher->getControllerName(),"action"=>"index"));
        }
    }

    public function deleteAction($id = null){
        $object = call_user_func($this->model.'::findFirst', "id = $id");
        $object->delete();
        $this->response->redirect("Index/index");
    }

    public function asAdminAction(){
        $user = User::findFirst("id=3");
        $this->session->set("user", $user);
        $this->response->redirect("Index/index");
    }

    public function asUserAction(){
        $user = User::findFirst("id=1");
        $this->session->set("user", $user);
        $this->response->redirect("Index/index");
    }

    public function logoutAction(){
        $this->session->destroy();
        $this->response->redirect("Index/index");
    }

}
