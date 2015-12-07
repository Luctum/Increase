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

    public function updateAction($id = null)
    {
        if ($id = null) {
            //Retrouve l'id du dernier projet créer (En theorie celui qui vient d'être créé)
            $projet = Projet::findFirst(array(
                "order" => "id DESC"
            ));
            $idproj = $projet->getId();
            $this->response->redirect("Projets/read/$idproj");
        }
    }

    public function soloUpdateAction()
    {
        //Créer la fonction variable 'set' en fonction du name en POST
        $func = 'set' . ucfirst($_POST['name']);
        $projet = Projet::findFirst($_POST['pk']);
        $projet->$func($_POST['value']);
        $projet->save();

        /*$value = $_POST['value'];
        $pk = $_POST['pk'];
        $name = $_POST['name'];
        $this->modelsManager->createQuery("UPDATE Projet SET $name = '$value' WHERE id = $pk")->execute();*/
    }

    public function readAction($id = null)
    {
        $url = new Url();
        $projet = Projet::findFirst($id);
        $usecases = Usecase::find("idProjet = $id");
        $messages = Message::find("idProjet = $id");
        $colorTexte = "black";

        $color = $projet->getDominantColor();

        //Si jamais la couleur retournée est noire, alors change sa couleur en gris clair
        if ($color["r"] == 0 && $color["g"] == 0 && $color["b"] == 0) {
            $color["r"] = 240;
            $color["g"] = 240;
            $color["b"] = 240;
            //Sinon si la couleur est trop sombre change l'écriture en blanc pour qu'elle sois visible
        } elseif ($color["r"] < 120 || $color["g"] < 120 || $color["b"] < 120) {
            $colorTexte = "white";
            $color["r"] += 70;
            $color["g"] += 70;
            $color["b"] += 70;
        }

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

        $this->jquery->exec("$('#nom').editable()", true);

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

        $this->view->setVar("projet", $projet);
        $this->view->setVar("messages", $messages);
        $this->view->setVar("usecases", $usecases);
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
        $this->view->setVar("usecases", $usecases);


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
