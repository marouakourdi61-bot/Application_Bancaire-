<?php
require_once '../config/Database.php';
require_once 'CompteCourant.php';
require_once 'CompteEpargne.php';

class CompteRepository {

    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    //CREAT
    public function save(Compte $compte) {
        $stmt = $this->pdo->prepare("
            INSERT INTO comptes (numero, solde, type, client_id)
            VALUES (?, ?, ?, ?)
        ");

        $type = ($compte instanceof CompteCourant) ? 'courant' : 'epargne';

        $stmt->execute([
            $compte->getNumero(),
            $compte->getSolde(),
            $type,
            $compte->getClientId()
        ]);

        $compte->setId($this->pdo->lastInsertId());
        return $compte;
    }

    // READ ALL 
    public function findAll() {
        $stmt = $this->pdo->query("SELECT * FROM comptes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ
    public function findByClient($clientId) {
        $stmt = $this->pdo->prepare("SELECT * FROM comptes WHERE client_id = ?");
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //UPDATE
    public function updateSolde(Compte $compte) {
        $stmt = $this->pdo->prepare("
            UPDATE comptes SET solde = ? WHERE id = ?
        ");
        $stmt->execute([
            $compte->getSolde(),
            $compte->getId()
        ]);
    }

    //DELETE
    public function delete($id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM comptes WHERE id = ? AND solde = 0
        ");
        return $stmt->execute([$id]);
    }

    
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM comptes WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        if ($data['type'] === 'courant') {
            $compte = new CompteCourant(
                $data['numero'],
                $data['solde'],
                $data['client_id']
            );
        } else {
            $compte = new CompteEpargne(
                $data['numero'],
                $data['solde'],
                $data['client_id']
            );
        }

        $compte->setId($data['id']);
        return $compte;
    }
}
