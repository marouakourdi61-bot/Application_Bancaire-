<?php
require_once '../config/database.php';



class Transaction {

    private $id;
    private $type;        
    private $montant;
    private $date;
    private $compteId;

    public function __construct($type, $montant, $compteId) {
        $this->type = $type;
        $this->montant = $montant;
        $this->compteId = $compteId;
        $this->date = date('Y-m-d H:i:s');
    }

    
    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getMontant() {
        return $this->montant;
    }

    public function getDate() {
        return $this->date;
    }

    public function getCompteId() {
        return $this->compteId;
    }

    
    public function setId($id) {
        $this->id = $id;
    }
}



?>