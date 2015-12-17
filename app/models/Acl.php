<?php

class Acl extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $idOperation;

    /**
     *
     * @var integer
     */
    protected $idTypeUser;

    /**
     *
     * @var integer
     */
    protected $idRessource;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field idOperation
     *
     * @param integer $idOperation
     * @return $this
     */
    public function setIdOperation($idOperation)
    {
        $this->idOperation = $idOperation;

        return $this;
    }

    /**
     * Method to set the value of field idTypeUser
     *
     * @param integer $idTypeUser
     * @return $this
     */
    public function setIdTypeUser($idTypeUser)
    {
        $this->idTypeUser = $idTypeUser;

        return $this;
    }

    /**
     * Method to set the value of field idRessource
     *
     * @param integer $idRessource
     * @return $this
     */
    public function setIdRessource($idRessource)
    {
        $this->idRessource = $idRessource;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field idOperation
     *
     * @return integer
     */
    public function getIdOperation()
    {
        return $this->idOperation;
    }

    /**
     * Returns the value of field idTypeUser
     *
     * @return integer
     */
    public function getIdTypeUser()
    {
        return $this->idTypeUser;
    }

    /**
     * Returns the value of field idRessource
     *
     * @return integer
     */
    public function getIdRessource()
    {
        return $this->idRessource;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('idTypeUser', 'TypeUser', 'id', array('alias' => 'TypeUser'));
        $this->belongsTo('idRessource', 'Ressource', 'id', array('alias' => 'Ressource'));
        $this->belongsTo('idOperation', 'Operation', 'id', array('alias' => 'Operation'));
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

    public function toString(){
        return " ".$this->getRessource()->getLibelle()." accessible par ".$this->getTypeUser()->getLibelle()." en droit '".$this->getOperation()->getOperation()."'";
    }
}