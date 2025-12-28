<?php
require_once '../config/database.php';
require_once '../src/Compte.php';

require_once '../Repository/ClientRepository.php';

require_once '../src/CompteCourant.php';
require_once '../src/CompteEpargne.php';






//ClientRepository
$repo = new ClientRepository();


$client = new Client("Maroua", "maroua@gmail.com");
$repo->save($client);


$clients = $repo->findAll();
print_r($clients);










 //  compte courant
try {
   
    $compte = new CompteCourant("CC001", 100, 1); 

    echo "Solde initial: " . $compte->getSolde() . PHP_EOL;

    $compte->depot(50);
    echo "Après dépôt de 50 (frais 1$): " . $compte->getSolde() . PHP_EOL;

    $compte->retrait(200);
    echo "Après retrait de 200: " . $compte->getSolde() . PHP_EOL;

    $compte->retrait(500);

} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . PHP_EOL;
}







    //  compteEpargne

try {
                            // numr, solde, client_id
    
    $compte = new CompteEpargne("EP001", 1000, 1); 

    echo "Solde initial: " . $compte->getSolde() . PHP_EOL;

    
    $compte->depot(200);
    echo "Après dépôt de 200: " . $compte->getSolde() . PHP_EOL;

    
    $compte->retrait(500);
    echo "Après retrait de 500: " . $compte->getSolde() . PHP_EOL;

   
    $compte->retrait(1000);

} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . PHP_EOL;
}













?>