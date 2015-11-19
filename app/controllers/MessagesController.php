<?php

class MessagesController extends ControllerBase
{

    public function initialize(){
        $this->model = "Message";
        $this->title = "Messages";
        $this->controller= "Messages";
    }

}

