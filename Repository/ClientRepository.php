<?php
require_once '../config/Database.php';
require_once '../src/Client.php';

class ClientRepository {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }



    // Create

    public function save(Client $client) {
       
        $sqlCheck = "SELECT id FROM clients WHERE email = ?";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute([$client->getEmail()]);

        if ($stmtCheck->fetch()) {
            
            echo "L'email '{$client->getEmail()}' existe déjà.<br>";
            return false;
        }

       

        // Insert client
        $sql = "INSERT INTO clients (nom, email) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            $client->getNom(),
            $client->getEmail()
        ]);

        if ($result) {
            echo "Client '{$client->getNom()}' ajouté avec succès.<br>";
        }

        return $result;
    }



      // Read All
    public function findAll() {
        $sql = "SELECT * FROM clients";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


         // Read id 

     public function findById($id) {
        $sql = "SELECT * FROM clients WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }






    // Update
    public function update(Client $client) {
        $sql = "UPDATE clients SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            $client->getNom(),
            $client->getPrenom(),
            $client->getEmail(),
            $client->getTelephone(),
            $client->getId()
        ]);

        if ($result) {
            echo "Client '{$client->getNom()}' modifié avec succès." . PHP_EOL;
        }

        return $result;
    }




    // Delete
    public function delete($id) {
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as nb FROM comptes WHERE client_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if ($result['nb'] > 0) {
            echo "Impossible de supprimer le client : il possède des comptes !" . PHP_EOL;
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM clients WHERE id = ?");
        $result = $stmt->execute([$id]);

        if ($result) {
            echo "Client supprimé avec succès !" . PHP_EOL;
        }

        return $result;
    }


    
}
?>
