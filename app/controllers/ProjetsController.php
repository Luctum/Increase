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

    public function readAction($id = null){
        $projet = Projet::findFirst($id);
        $usecases = Usecase::find("idProjet = $id");

        //Calcul le taux de finition du projet en fonction du nombre d'usecases total et du % fini sur chaque usecases.
        $countUsecases = count($usecases);
        $totalAvancementFini = $countUsecases*100;
        $totalAvancementReel = 0;

        foreach($usecases as $u){
            $totalAvancementReel = $totalAvancementReel + $u->getAvancement();
        }
        $avancementReel = ($totalAvancementReel / $totalAvancementFini)*100;
        $avancementReel = number_format($avancementReel,1);

        $this->view->setVar("projet",$projet);
        $this->view->setVar("usecases",$usecases);
        $this->view->setVar("avancement",$avancementReel);

        //Création de la progressbar
        $progress= $this->jquery->bootstrap()->htmlProgressbar("progress","info",$avancementReel);
        $progress->showcaption(true);
        echo $this->jquery->compile($this->view);


    }
}
