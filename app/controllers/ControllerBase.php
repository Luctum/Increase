<?php

use Phalcon\Mvc\Controller;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Mvc\Url;

class ControllerBase extends Controller{

    protected $model;
    protected $title;
    protected $controller;

    public function afterExecuteRoute($dispatcher){
        $baseUrl = $this->baseUrl;
        $this->view->setVar("baseUrl", $baseUrl);
        $this->view->setVar("controller", $this->controller);
        $this->view->setVar("title", $this->title);
    }

    public function indexAction(){
    	if ($this->verifyAccessAction($this->controller, "index")) {
	        $objects = call_user_func($this->model."::find");
	        $this->view->setVar("objects",$objects);
	        $this->view->pick("main/index");
    	} else {
    		echo $this->jquery->bootstrap()->htmlAlert("alert1","Vous n'avez pas les droits pour accéder à cette page !");
    	}
    }

    public function frmAction($id =  NULL){
        echo "Pas encore implémenté...";
    }

    public function readAction($id = NULL){
        if($id != null){
            $object = call_user_func($this->model.'::find', "id = $id");
            $this->view->setVar("object",$object);
            $this->view->pick("main/read");
        }
    }

    public function updateAction(){
    	$id = $this->request->getPost('id','int');
        if ($this->request->isPost()) {
            $object = $this->getInstance(@$_POST["id"]);
            $this->setValuesToObject($object);
            if ($id) {
                try {
                    $object->save();
                    $msg = new DisplayedMessage("Instance de " . $this->model . " modifiée");
                } catch (\Exception $e) {
                    $msg = new DisplayedMessage("Impossible d'ajouter l'instance de " . $this->model, "danger : $e");
                }
            } else {
                try {
                    $object->save();
                    $msg = new DisplayedMessage("Instance de " . $this->model . " ajoutée");
                } catch (\Exception $e) {
                    $msg = new DisplayedMessage("Impossible d'ajouter l'instance de " . $this->model, "danger : $e");
                }
            }
            $this->dispatcher->forward(array("controller" => $this->dispatcher->getControllerName(), "action" => "index", "params" => array($msg)));
        }
    }

    public function deleteAction($id = null){
    	if ($this->verifyAccessAction($this->controller, "write")) {
	        $object = call_user_func($this->model.'::findFirst', "id = $id");
	        
	        $object->delete();
	        $this->response->redirect("main/index");
    	} else {
    		echo $this->jquery->bootstrap()->htmlAlert("alert1","Vous n'avez pas les droits de suppression sur cette page !");
    		
    		sleep(5);
    		
    		$this->view->pick($this->controller."/index");
    	}
    }

    public function asAdminAction(){
        $user = User::findFirst("id = 3");
        $this->session->set("user", $user);
        $this->response->redirect("Index/index");
    }

    public function asUserAction(){
        $user = User::findFirst("id = 5");
        $this->session->set("user", $user);
        $this->response->redirect("Index/index");
    }

    public function logoutAction(){
        $this->session->destroy();
        $this->response->redirect("Index/index");
    }    
    
    public function loadAclAction($typeUser) {
    	$acl = new AclList();
    	$acl->setDefaultAction(Phalcon\Acl::DENY);
    	
    	$roles = TypeUser::find();
    	foreach ($roles as $role) {
    		$acl->addRole($role->getLibelle());
    	}

    	$operationsBdd = Operation::find();
    	$operations = array();
    	foreach ($operationsBdd as $operation) {
    		$operations[] = $operation->getOperation();
    	}
    	
    	$ressources = Ressource::find();
    	foreach ($ressources as $ressource) {
    		$acl->addResource($ressource->getLibelle(), $operations);
    	}
 
    	$aclsBdd = Acl::find();
    	foreach ($aclsBdd as $aclBdd) {
    		$typeUserBdd = TypeUser::findFirst("id = ".$aclBdd->getIdTypeUser());
    		$ressourceBdd = Ressource::findFirst("id = ".$aclBdd->getIdRessource());
    		$operationBdd = Operation::findFirst("id = ".$aclBdd->getIdOperation());
    		$acl->allow($typeUserBdd->getLibelle(), $ressourceBdd->getLibelle(), $operationBdd->getOperation());
    	}
    	
    	return $acl;
    }
    
    public function verifyAccessAction($activeResource, $activeOperation) {
    	$user = $this->session->get("user");
    	$typeUser = TypeUser::findFirst("id = ".$user->getIdTypeUser());
    	$typeUserSession = $user->getIdTypeUser();
    	$acl = $this->loadAclAction($typeUserSession);
    	if ($acl->isAllowed($typeUser->getLibelle(), $activeResource, $activeOperation)) {
    		return 1;
    	} else {
    		return 0;
    	}
    }
}
