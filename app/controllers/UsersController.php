<?php

class UsersController extends ControllerBase
{
    protected $model;
    protected $title;
    protected $controller;

    public function initialize()
    {
        $this->model = "User";
        $this->title = "Utilisateurs";
        $this->controller = "Users";
    }

    public function readAction($id = null)
    {
        $user = User::findFirst($id);
        $usecases = Usecase::find("idDev=$id");
        $projets = array();
        foreach ($usecases as $u) {
            $projets[$u->getProjet()->getId()] = $u->getProjet();
        }
        $projetsCree = Projet::find("idClient = $id");

        $this->view->setVar("user", $user);
        $this->view->setVar("projets", $projets);
        $this->view->setVar("projetsCree", $projetsCree);
        $this->view->setVar("usecases", $usecases);
    }
}

