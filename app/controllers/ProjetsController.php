<?php

class ProjetsController extends \Phalcon\Mvc\Controller
{

    public function indexAction(){
        $projets = Projet::find();
        $this->view->setVar("projets",$projets);

        $bs=$this->jquery->bootstrap();


        $panel = $bs->htmlPanel("panelClients","");
        $panel->setStyle(\Ajax\bootstrap\html\base\CssRef::CSS_WARNING);
        $panel->addHeader("Utilisateurs");

        $button = $bs->htmlButton("bt1","Okay");
        $button->onClick($this->jquery->getDeferred("Users","#panelClients"));


        $bs->htmlSplitbutton("sBtn","Split Bouton", array("Salut","Bonjour"));
        $this->jquery->getOnClick("#a-sBtn-dropdown-item-1","users/","#panelClients");

        $modal=$bs->htmlModal("modal1","Bonjour");

        $this->jquery->click("#a-sBtn-dropdown-item-2", $modal->jsShow());
        $this->jquery->compile($this->view);

    }

}

