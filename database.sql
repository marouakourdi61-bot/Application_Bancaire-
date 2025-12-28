--@block
USE banque_oop;

--@block
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE
);

--@block
CREATE TABLE comptes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    type ENUM('courant', 'epargne') NOT NULL,
    
    solde DECIMAL(10,2) NOT NULL DEFAULT 0,

    CONSTRAINT fk_comptes_clients
        FOREIGN KEY (client_id)
        REFERENCES clients(id)
);


--@block
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compte_id INT NOT NULL,
    type ENUM('depot', 'retrait') NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,


    CONSTRAINT fk_transactions_comptes
        FOREIGN KEY (compte_id)
        REFERENCES comptes(id)
);
