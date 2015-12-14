<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Url;

class ControllerBase extends Controller
{

    protected $model;
    protected $title;
    protected $controller;
    protected $messageTimerInterval = 3000;

    public function afterExecuteRoute($dispatcher)
    {
        $baseUrl = $this->baseUrl;
        $this->view->setVar("baseUrl", $baseUrl);
        $this->view->setVar("controller", $this->controller);
        $this->view->setVar("title", $this->title);
    }

    public function indexAction($message = NULL)
    {
        $msg = "";
        if (isset($message)) {
            if (is_string($message)) {
                $message = new DisplayedMessage($message);
            }
            $message->setTimerInterval($this->messageTimerInterval);
            $msg = $this->_showDisplayedMessage($message);
        }
        $this->view->setVar("msg", $msg);
        $objects = call_user_func($this->model . "::find");
        $this->view->setVar("objects", $objects);
        $this->view->pick("main/index");
    }

    public function frmAction($id = NULL)
    {
        echo "Pas encore implémenté...";
    }

    public function getInstance($id = NULL)
    {
        if (isset($id)) {
            $object = call_user_func($this->model . "::findfirst", $id);
        } else {
            $className = $this->model;
            $object = new $className();
        }
        return $object;
    }

    public function readAction($id = NULL)
    {
        if ($id != null) {
            $object = call_user_func($this->model . '::find', "id = $id");
            $this->view->setVar("object", $object);
            $this->view->pick("main/read");
        }
    }

    protected function setValuesToObject(&$object)
    {
        $object->assign($_POST);
    }

    /////////////////////////////////////////
    public function updateAction()
    {
        $id = $this->request->getPost('id', 'int');
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

    //PErmet l'édition d'un seul champ à la fois
    public function soloUpdateAction()
    {
        $name = $this->request->getPost('name', 'string');
        //Créer la fonction variable 'set' en fonction du name en POST
        $func = 'set' . ucfirst($name);
        $projet = call_user_func($this->model . '::findFirst', $_POST['pk']);
        $projet->$func($_POST['value']);
        $projet->save();

    }


    public function deleteAction($id = null)
    {
        $object = call_user_func($this->model . '::findFirst', "$id");
        $object->delete();
        $this->response->redirect("$this->controller/index");
    }

    public function asAdminAction()
    {
        $user = User::findFirst("id=3");
        $this->session->set("user", $user);
        $this->response->redirect("$this->controller/index");
    }

    public function asUserAction()
    {
        $user = User::findFirst("id=1");
        $this->session->set("user", $user);
        $this->response->redirect("$this->controller/index");
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect("Index/index");
    }


    /**
     * Affiche un message Alert bootstrap
     * @param DisplayedMessage $message
     */
    public function _showDisplayedMessage($message)
    {
        return $message->compile($this->jquery);
    }

    /**
     * Affiche un message Alert bootstrap
     * @param string $message texte du message
     * @param string $type type du message (info, success, warning ou danger)
     * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
     * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
     */
    public function _showMessage($message, $type = "success", $timerInterval = 0, $dismissable = true, $visible = true)
    {
        $message = new DisplayedMessage($message, $type, $timerInterval, $dismissable, $visible);
        $this->_showDisplayedMessage($message);
    }


    public function messageSuccess($message, $timerInterval = 0, $dismissable = true)
    {
        $this->_showMessage($message, "success", $timerInterval, $dismissable);
    }

    /**
     * Affiche un message Alert bootstrap de type warning
     * @param string $message texte du message
     * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
     * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
     */
    public function messageWarning($message, $timerInterval = 0, $dismissable = true)
    {
        $this->_showMessage($message, "warning", $timerInterval, $dismissable);
    }

    /**
     * Affiche un message Alert bootstrap de type danger
     * @param string $message texte du message
     * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
     * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
     */
    public function messageDanger($message, $timerInterval = 0, $dismissable = true)
    {
        $this->_showMessage($message, "danger", $timerInterval, $dismissable);
    }

    /**
     * Affiche un message Alert bootstrap de type info
     * @param string $message texte du message
     * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
     * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
     */
    public function messageInfo($message, $timerInterval = 0, $dismissable = true)
    {
        $this->_showMessage($message, "info", $timerInterval, $dismissable);
    }


}
