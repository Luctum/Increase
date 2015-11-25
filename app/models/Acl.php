<?php

class Acl extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $operation;

    /**
     *
     * @var integer
     */
    protected $role;

    /**
     *
     * @var integer
     */
    protected $controller;

    /**
     * Method to set the value of field code
     *
     * @param string $code
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field nom
     *
     * @param string $nom
     * @return $this
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Method to set the value of field poids
     *
     * @param integer $poids
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Method to set the value of field avancement
     *
     * @param integer $avancement
     * @return $this
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Returns the value of field code
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field nom
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Returns the value of field poids
     *
     * @return integer
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Returns the value of field avancement
     *
     * @return integer
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('code', 'Tache', 'codeUseCase', array('alias' => 'Taches'));
        $this->belongsTo('idProjet', 'Projet', 'id', array('alias' => 'Projet'));
        $this->belongsTo('idDev', 'User', 'id', array('alias' => 'User'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'usecase';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Usecase[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Usecase
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function toString(){
        return $this->nom."(".$this->avancement.")";
    }
}