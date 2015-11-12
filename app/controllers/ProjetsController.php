<?php

class ProjetsController extends \ControllerBase{

    protected $model;
    protected $title;
    protected $controller;

    public function initialize(){
        $this->model = "Projet";
        $this->title = "Projets";
        $this->controller = "Projets";
    }
}

