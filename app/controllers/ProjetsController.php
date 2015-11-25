<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Url;

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
        $this->jquery->get("Projets/resume/$id","#contentProjet");
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
        $url = new Url();
        $btnSubmit = $this->jquery->bootstrap()->htmlButton("submitMsg","Envoyer");
        $this->jquery->postFormOn("click","submitMsg",$url->get("Messages/update"),"newMsgForm", "#newMsg");
        $this->jquery->compile($this->view);

        $this->view->setVar("msg",$messages);
        $this->view->setVar("idProj",$id);

        $this->view->render("projets","messages");
    }

    public function resumeAction($id=null){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $projet = Projet::findFirst($id);
        $usecases = Usecase::find("idProjet = $id");
        $messages = Message::find("idProjet = $id");

        $this->view->setVar("projet",$projet);
        $this->view->setVar("messages",$messages);
        $this->view->setVar("usecases",$usecases);
    }

    public function usecasesAction($id=null){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $contributor = [];
        $usecases = Usecase::find("idProjet = $id");

        foreach($usecases as $uc){
            $contributor[] = $uc->getUser();
        }

        $contributor = array_unique($contributor, SORT_REGULAR);


        $taches = Tache::find();


        $this->view->setVar("contributors",$contributor);
        $this->view->setVar("usecases",$usecases);
        $this->view->setVar("taches",$taches);
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
