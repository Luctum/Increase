<?php

class TachesController extends \ControllerBase
{

    protected $model;
    protected $title;
    protected $controller;

    public function initialize()
    {
        $this->model = "Tache";
        $this->title = "Taches";
        $this->controller = "Taches";
    }


}

