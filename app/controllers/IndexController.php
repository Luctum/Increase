<?php

class IndexController extends ControllerBase
{
    protected $model;
    protected $title;
    protected $controller;

    public function initialize(){
        $this->model = "Index";
        $this->title = "Accueil";
        $this->controller= "Index";
    }

    public function indexAction()
    {

    }
}

