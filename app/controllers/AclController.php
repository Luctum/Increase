<?php
class AclController extends ControllerBase
{
    protected $model;
    protected $title;
    protected $controller;

    public function initialize(){
        $this->model = "Acl";
        $this->title = "Acl";
        $this->controller= "Acl";
    }

    public function frmAction(){
        $typesUser = TypeUser::find();
        $operations = Operation::find();
        $ressources = Ressource::find();

        $this->view->setVar("operations",$operations);
        $this->view->setVar("ressources",$ressources);
        $this->view->setVar("typesUser",$typesUser);

    }

    public function updateAction(){
        parent::updateAction();
        $this->response->redirect("$this->controller/index");
    }
}