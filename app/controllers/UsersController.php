<?php

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;

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

    public function loginAction() {

    }
    
    public function signInAction() {
    	$bootstrap = $this->jquery->bootstrap();
    	 
    	if(!empty($_POST['identite']) && !empty($_POST['password'])) {
    		
    		$userPseudo = User::findFirst("identite = '".$_POST['identite']."'");

    		$userMail = User::findFirst("mail = '".$_POST['identite']."'");
    	
    		if($userPseudo != NULL && password_verify($_POST['password'], $userPseudo->getPassword())) {
    			$this->session->set("user", $userPseudo);
    			$this->response->redirect("Index/index");
    			$this->loadAclAction($userPseudo->getIdTypeUser());
    		} else if($userMail != NULL && password_verify($_POST['password'], $userMail->getPassword())) {
    			$this->session->set("user", $userMail);
    			$this->response->redirect("Index/index");
    			$this->loadAclAction($userMail->getIdTypeUser());
    		} else {
    			echo $bootstrap->htmlAlert("alert1","L'identifiant ou le mot de passe est incorrecte.");
    		}
    	}
    }
	
	public function rulesAction() {
		$accordion=$this->jquery->bootstrap()->htmlAccordion("accordion1");
		$accordion->addPanel("Panel 1","Contenu du panel 1");
		$accordion->addPanel("Panel 2","Contenu du panel 2");
		echo $accordion;
	}

 

    public function readAction($id = null)
    {
        if ($this->verifyAccessAction($this->controller, "read")) {

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

        $this->jquery->exec("$('#mail').editable()", true);

        $this->jquery->compile($this->view);

        }else {
            $this->view->pick("main/error");
        }
    }

    public function passwordAction(){
        $password = password_hash("password", PASSWORD_DEFAULT);
        echo $password;
    }

    public function frmAction()
    {
        if ($this->verifyAccessAction($this->controller, "write")) {
            $typeUser = TypeUser::find();
            $this->view->setVar("typeUser", $typeUser);
        }else {
            $this->view->pick("main/error");
        }

    }

    public function updateAction(){
        if ($this->verifyAccessAction($this->controller, "write")) {
            if ($this->request->isPost()) {
                $user = new User();
                $this->setValuesToObject($user);
                $user->setPassword(password_hash($this->request->getPost("password", "string"), PASSWORD_DEFAULT));
                try {
                    $user->save();
                    echo "Instance de " . $this->model . " ajoutée";
                } catch (\Exception $e) {
                    echo "Impossible d'ajouter l'instance de " . $this->model, "danger : $e";
                }
            }
        }
        $this->response->redirect("$this->controller/index");
    }
}

