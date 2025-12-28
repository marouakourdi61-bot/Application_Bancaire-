<?php
require_once '../config/Database.php';
require_once 'Transaction.php';

class TransactionRepository {

    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    // creat
    public function save(Transaction $transaction) {
        $stmt = $this->pdo->prepare("
            INSERT INTO transactions (type, montant, date_transaction, compte_id)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $transaction->getType(),
            $transaction->getMontant(),
            $transaction->getDate(),
            $transaction->getCompteId()
        ]);

        $transaction->setId($this->pdo->lastInsertId());
        return $transaction;
    }

    // read
    public function findByCompte($compteId) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM transactions
            WHERE compte_id = ?
            ORDER BY date_transaction DESC
        ");
        $stmt->execute([$compteId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
