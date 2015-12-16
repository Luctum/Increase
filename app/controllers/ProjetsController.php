<?php
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url;

class ProjetsController extends \ControllerBase
{

    protected $model;
    protected $title;
    protected $controller;

    public function initialize()
    {
        $this->model = "Projet";
        $this->title = "Projets";
        $this->controller = "Projets";
    }

    public function indexAction($message = null)
    {
        $projets = Projet::find();
        $this->view->setVar("projets", $projets);

        $dialog = $this->jquery->bootstrap()->htmlModal("modal", "Ajouter un nouveau projet", "test");
        $buttonFrm = $this->jquery->bootstrap()->htmlButton("btFrm", "Nouveau");
        $dialog->addCancelButton();
        $clients = User::find();
        $dialog->renderContent($this->view, "projets", "frm", array("clients" => $clients));

        $buttonFrm->onClick($dialog->jsShow());

        $this->jquery->compile($this->view);
    }

    public function updateAction()
    {
        parent::updateAction();
        //Retrouve l'id du dernier projet créer (En theorie celui qui vient d'être créé)
        $projet = Projet::findFirst(array(
            "order" => "id DESC"
        ));
        $idproj = $projet->getId();
        $this->response->redirect("Projets/read/$idproj");
    }

    public function readAction($id = null, $redirect = null)
    {
        $projet = Projet::findFirst($id);
        $usecases = Usecase::find("idProjet = $id");
        $messages = Message::find("idProjet = $id");
        $colorTexte = "black";

        $color = array();

        $color["r"] = 245;
        $color["g"] = 245;
        $color["b"] = 247;

        $avancementReel = $this->avancementReel($usecases);

        //Passage des différentes variables
        $this->view->setVar("colorTexte", $colorTexte);
        $this->view->setVar("color", $color);
        $this->view->setVar("projet", $projet);
        $this->view->setVar("messages", $messages);
        $this->view->setVar("usecases", $usecases);
        $this->view->setVar("avancement", $avancementReel);

        //Création de la progressbar
        $progress = $this->jquery->bootstrap()->htmlProgressbar("progress", "info", $avancementReel);
        $progress->showcaption(true);
        $this->jquery->get("Projets/resume/$id", "#contentProjet");
        //Creation des évenements onClick et des éléments sur le menu
        $this->jquery->getOnClick("#menu1", "Projets/resume/$id", "#contentProjet");
        $this->jquery->getOnClick("#menu2", "Projets/contributors/$id", "#contentProjet");
        $this->jquery->getOnClick("#menu3", "Projets/usecases/$id", "#contentProjet");
        $this->jquery->getOnClick("#menu5", "Projets/messages/$id", "#contentProjet");

        if ($redirect != null) {
            switch ($redirect) {
                case (1):
                    $this->jquery->get("Projets/contributors/$id", "#contentProjet");
                    break;
                case (2):
                    $this->jquery->get("Projets/usecases/$id", "#contentProjet");
                    break;
                case (3):
                    $this->jquery->get("Projets/messages/$id", "#contentProjet");
                    break;
            }
        }


        //Xeditable
        $this->jquery->exec("$('#nom').editable()", true);
        $this->jquery->exec("$('#image').editable()", true);

        //Compilation de Jquery dans la vue
        $this->jquery->compile($this->view);
    }

    public function messagesAction($id = null)
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $messages = Message::find("idProjet = $id");
        $this->jquery->postFormOnClick("#submitMsg", "Messages/update", "newMsgForm", null, array("jsCallback" => $this->jquery->getDeferred("Projets/messages/$id", "#contentProjet")));
        $this->jquery->compile($this->view);

        $this->view->setVar("msg", $messages);
        $this->view->setVar("idProj", $id);

        $this->view->render("projets", "messages");
    }

    public function resumeAction($id = null)
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $projet = Projet::findFirst($id);
        $usecases = Usecase::find("idProjet = $id");
        $messages = Message::find("idProjet = $id");

        //Créer un array en javascript contenant la liste des utilisateurs pour la liste des clients sur Xeditable
        $client = '[';
        $i = 0;
        foreach (User::find() as $c) {
            $i += 1;
            if ($id != 1) {
                $client .= ',';
            }
            $client .= '{value: ' . $c->getId() . ', text:"' . $c->getIdentite() . '"}';
        }

        $client .= ']';

        //Select Xeditable
        $this->jquery->exec("$('#idClient').editable({
                                type: 'select',
                                pk: $id,
                                title: 'Enter username',
                                source: $client
        })", true);

        //Xeditable

        $this->jquery->exec("$('#description').editable()", true);
        $this->jquery->exec("$('#dateLancement').editable()", true);
        $this->jquery->exec("$('#dateFinPrevue').editable()", true);

        //Passage des variables à la vue
        $this->view->setVar("projet", $projet);
        $this->view->setVar("messages", $messages);
        $this->view->setVar("usecases", $usecases);

        //Compilation de Jquery dans la vue
        $this->jquery->compile($this->view);

    }

    public function usecasesAction($id = null)
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $taches = Tache::find();
        $usecases = Usecase::find(array(
            "idProjet = '$id'",
            "order" => "poids DESC"
        ));

        $this->view->setVar("usecases", $usecases);
        $this->view->setVar("taches", $taches);

        //Création du modal pour la création d'une UseCase.
        $dialog = $this->jquery->bootstrap()->htmlModal("modal", "Ajouter une Usecase", "test");
        $buttonFrm = $this->jquery->bootstrap()->htmlButton("btFrm", "Nouvelle UseCase");
        $dialog->addCancelButton();
        $users = User::find();
        $dialog->renderContent($this->view, "usecases", "frm", array("users" => $users, "id" => $id));

        $buttonFrm->onClick($dialog->jsShow());

        //Création du modal pour les taches.
        $dialogTaches = $this->jquery->bootstrap()->htmlModal("modalTache", "Ajouter une Tache", "test");
        $buttonFrmEdit = $this->jquery->bootstrap()->htmlButton("btFrmTache", "Nouvelle Tache");
        $usecases = Usecase::find();
        $dialogTaches->addCancelButton();
        $dialogTaches->renderContent($this->view, "taches", "frm", array("usecases" => $usecases, "id" => $id));
        $buttonFrmEdit->onClick($dialogTaches->jsShow());


        //Créer un array en javascript contenant la liste des utilisateurs pour la liste des développeurs sur Xeditable
        $dev = '[';
        $i = 0;
        foreach (User::find() as $c) {
            $i += 1;
            if ($id != 1) {
                $dev .= ',';
            }
            $dev .= '{value: ' . $c->getId() . ', text:"' . $c->getIdentite() . '"}';
        }

        $dev .= ']';

        //Select Xeditable
        $this->jquery->exec("$('.idDev').editable({
                                type: 'select',
                                title: 'Enter username',
                                source: $dev
        })", true);


        // Xeditable
        $this->jquery->exec("$('.nom').editable()", true);
        $this->jquery->exec("$('.poids').editable()", true);
        $this->jquery->exec("$('.avancement').editable()", true);

        $this->jquery->compile($this->view);
    }

    public function contributorsAction($id = null)
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $contributor = [];

        $usecases = Usecase::find("idProjet = $id");

        foreach ($usecases as $uc) {
            $contributor[] = $uc->getUser();
        }

        $contributor = array_unique($contributor, SORT_REGULAR);

        $this->view->setVar("contributors", $contributor);
        $this->view->setVar("usecases", $usecases);;

    }

    //Calcule le taux d'avancement total d'un projet
    public function avancementReel($usecases)
    {
        //Calcul le taux de finition du projet en fonction du nombre d'usecases total et du taux d'avancement sur chaque usecases.

        $countUsecases = count($usecases);
        $totalAvancementFini = $countUsecases * 100;
        $totalAvancementReel = 0;

        foreach ($usecases as $u) {

            $totalAvancementReel = $totalAvancementReel + $u->getAvancement();
        }

        $avancementReel = ($totalAvancementReel / $totalAvancementFini) * 100;
        return number_format($avancementReel, 1);
    }

}
