<?php

class UsecasesController extends \ControllerBase
{

    protected $model;
    protected $title;
    protected $controller;

    public function initialize()
    {
        $this->model = "Usecase";
        $this->title = "Usecases";
        $this->controller = "Usecases";
    }

    public function updateAction($id=null){
        parent::updateAction();
        $this->response->redirect("Projets/read/$id/2");
    }

    public function deleteAction($id = null){
        $object = Usecase::findFirst("id = $id");
        $codeUseCase = $object->getCode();
        $taches = Tache::find("codeUseCase = '$codeUseCase'");
        //Deletion des taches liés avant deletion de la UseCase
        foreach($taches as $t){
            $t->delete();
        }
        $object->delete();
        $this->response->redirect($_SERVER['HTTP_REFERER']."/2");
    }
}

