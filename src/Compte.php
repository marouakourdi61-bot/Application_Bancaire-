<?php
require_once '../config/database.php';




abstract class Compte {

    protected $id;
    protected $numero;
    protected $solde;
    protected $clientId;

    public function __construct($numero, $solde, $clientId) {
        $this->numero   = $numero;
        $this->solde    = $solde;
        $this->clientId = $clientId;
    }




    public function getId() {
        return $this->id;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getSolde() {
        return $this->solde;
    }

    public function getClientId() {
        return $this->clientId;
    }

   


    public function setId($id) {
        $this->id = $id;
    }

    public function setSolde($solde) {
        $this->solde = $solde;
    }

    

   
    abstract public function depot($montant);

   
    abstract public function retrait($montant);
}

