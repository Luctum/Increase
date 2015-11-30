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
    protected $idRole;

    /**
     *
     * @var integer
     */
    protected $idController;

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
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * Method to set the value of field avancement
     *
     * @param integer $avancement
     * @return $this
     */
    public function setIdController($controller)
    {
        $this->idController = $controller;

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
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Returns the value of field avancement
     *
     * @return integer
     */
    public function getIdController()
    {
        return $this->idController;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('idRole', 'Role', 'id', array('alias' => 'Role'));
        $this->belongsTo('idController', 'Controller', 'id', array('alias' => 'Controller'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'acl';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Acl[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Acl
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}