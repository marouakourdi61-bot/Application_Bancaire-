<?php
require_once '../config/database.php';

require_once 'Compte.php';

class CompteCourant extends Compte {

    private $decouvertAutorise = -500;
    private $fraisDepot = 1;

   
    public function depot($montant) {
        if ($montant <= 0) {
            throw new Exception("Le montant du dépôt doit être positif");
        }

        $montantCredite = $montant - $this->fraisDepot;

        if ($montantCredite <= 0) {
            throw new Exception("Montant insuffisant après frais");
        }

        $this->solde += $montantCredite;
    }

    
    public function retrait($montant) {
        if ($montant <= 0) {
            throw new Exception("Le montant du retrait doit être positif");
        }

        if (($this->solde - $montant) < $this->decouvertAutorise) {
            throw new Exception("Découvert maximum dépassé");
        }

        $this->solde -= $montant;
    }
}



?>