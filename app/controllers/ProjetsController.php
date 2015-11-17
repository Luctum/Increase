<?php

use Phalcon\Mvc\View;

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
        $messages = Message::find("idProjet = $id");

        //Calcul le taux de finition du projet en fonction du nombre d'usecases total et du taux d'avancement sur chaque usecases.
        $countUsecases = count($usecases);
        $totalAvancementFini = $countUsecases*100;
        $totalAvancementReel = 0;

        foreach($usecases as $u){
            $totalAvancementReel = $totalAvancementReel + $u->getAvancement();
        }

        $avancementReel = ($totalAvancementReel / $totalAvancementFini)*100;
        $avancementReel = number_format($avancementReel,1);

        $this->view->setVar("projet",$projet);
        $this->view->setVar("messages",$messages);
        $this->view->setVar("usecases",$usecases);
        $this->view->setVar("avancement",$avancementReel);

        //Création de la progressbar
        $progress= $this->jquery->bootstrap()->htmlProgressbar("progress","info",$avancementReel);
        $progress->showcaption(true);

        //Creation des évenements onClick et des éléments sur le menu
        $this->jquery->getOnClick("#menu1","Projets/resume/$id","#contentProjet");
        $this->jquery->getOnClick("#menu2","Projets/contributors/$id","#contentProjet");
        $this->jquery->getOnClick("#menu3","Projets/usecases/$id","#contentProjet");
        $this->jquery->getOnClick("#menu4","Projets/stats/$id","#contentProjet");
        $this->jquery->getOnClick("#menu5","Projets/messages/$id","#contentProjet");

        //Compilation de Jquery dans la vue
        $this->jquery->compile($this->view);
    }

    public function messagesAction($id=null){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $messages = Message::find("idProjet = $id");
        $this->view->setVar("messages",$messages);
    }

    public function resumeAction($id=null){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        echo "Pas encore implémenté";
    }

    public function usecasesAction($id=null){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        echo "Pas encore implémenté";
    }

    public function contributorsAction($id=null){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        echo "Pas encore implémenté";
    }

    public function statsAction($id=null){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        echo "Pas encore implémenté";
    }
}
