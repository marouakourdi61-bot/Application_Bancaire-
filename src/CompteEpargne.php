<?php
require_once '../config/database.php';

require_once 'Compte.php';

class CompteEpargne extends Compte {

    
    public function depot($montant) {
        if ($montant <= 0) {
            throw new Exception("Le montant du dépôt doit être positif");
        }

        $this->solde += $montant;
    }

  
    public function retrait($montant) {
        if ($montant <= 0) {
            throw new Exception("Le montant du retrait doit être positif");
        }

        if ($montant > $this->solde) {
            throw new Exception("Solde insuffisant");
        }

        $this->solde -= $montant;
    }
}


?>