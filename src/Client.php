<?php
require_once '../config/database.php';



class Client {
    private $id;
    private $nom;
    private $email;

    public function __construct($nom, $email) {
        

        $this->nom = $nom;
       

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email invalide: $email");
        }

         $this->email = $email;
    }



    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }


    public function setId($id) {
         $this->id = $id;
    } 
}












      


?>
