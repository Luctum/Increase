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

    public function updateAction($id = null)
    {
        parent::updateAction();
        $this->response->redirect("Projets/read/$id/2");

    }

    public function soloUpdateAction()
    {

        $name = $this->request->getPost('name', 'string');
        //Créer la fonction variable 'set' en fonction du name en POST
        $func = 'set' . ucfirst($name);
        $projet = call_user_func($this->model . '::findFirst', $_POST['pk']);
        $projet->$func($_POST['value']);
        $projet->save();

        //Update l'avancement de la usecase lors de changements sur une usecase
        $avancementTotal = 0;
        $usecase = Usecase::findFirst("code='" . $projet->getCodeUseCase() . "'");
        $taches = Tache::find("codeUseCase LIKE '" . $projet->getCodeUseCase() . "'");
        foreach ($taches as $tache) {
            $avancementTotal += $tache->getAvancement();
        }
        $avancementTotal = $avancementTotal / count($taches);
        $usecase->setAvancement($avancementTotal);
        $usecase->save();
    }
}

