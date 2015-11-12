<?php

class UsersController extends \ControllerBase
{
    protected $model;
    protected $title;

    public function initialize(){
        $this->model = "User";
        $this->title = "Users";
    }

    public function indexAction() {
        parent::indexAction();
    }

}

