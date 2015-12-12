<?php

class UsecasesController extends \ControllerBase
{

    protected $model;
    protected $title;
    protected $controller;

    public function initialize()
    {
        $this->model = "Usecase";
        $this->title = "Usecases";
        $this->controller = "Usecases";
    }

    public function updateAction($id=null){
        parent::updateAction();
        $this->response->redirect("Projets/read/$id/2");
    }
}

