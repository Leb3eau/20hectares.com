<?php

class locationModel {

    public $id;
    public $montant;
    public $details_location;
    public $pays;
    public $ville;
    public $adresse;
    public $quartier;
    public $user;
    public $etat;
    public $con;

    function __construct() {
        require "database/connexion.php";
    }

// Ajouter
    public function ajouterDemande() {

        $req = $this->con->prepare('INSERT INTO location VALUES(NULL,:m,:p,:v,:q,:ad,:d,:e,:u)');
        $req->bindParam(':m', $this->montant);
        $req->bindParam(':p', $this->pays);
        $req->bindParam(':v', $this->ville);
        $req->bindParam(':d', $this->details_location);
        $req->bindParam(':e', $this->etat);
        $req->bindParam(':u', $this->user);
        $req->bindParam(':ad', $this->adresse);
        $req->bindParam(':q', $this->quartier);
        $sol = $req->execute();
        return $sol;
    }

    public function rechercherlocationUser($rech) {
        $req = $this->con->prepare('SELECT * FROM location WHERE utilisateur=:reference_produit');
        $req->bindParam(':reference_produit', $rech);
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function listeLocation() {
        $req = $this->con->prepare('SELECT location.*, utilisateur.nom_prenom, utilisateur.telephone FROM location, utilisateur WHERE utilisateur.id=location.utilisateur');
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }
    public function listeLocationUser($rech) {
        $req = $this->con->prepare('SELECT location.*, utilisateur.nom_prenom, utilisateur.telephone FROM location, utilisateur WHERE utilisateur.id=location.utilisateur AND location.utilisateur=:reference_produit');
        $req->bindParam(':reference_produit', $rech);
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }
    public function listeuser() {
        $req = $this->con->prepare('SELECT * FROM utilisateur');
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    function notification_Non_Lue($u) {
        $sql = "SELECT * FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=0 AND vue.user=:u ORDER BY notifications.id DESC";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute() or die(print_r($this->con->ErrorInfo()));
        $res = $req->fetchAll();
        return $res;
    }

    function nbre_notification_Non_Lue($u) {
        $sql = "SELECT * FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=0 AND vue.user=:u";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute() or die(print_r($this->con->ErrorInfo()));
        $nbre = $req->rowCount();
        return $nbre;
    }

    function proprietaire_de_notification($u) {
        $sql = "SELECT utilisateur.*, notifications.id FROM notifications,utilisateur WHERE utilisateur.id=notifications.user AND notifications.id=:u";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute() or die(print_r($this->con->ErrorInfo()));
        $res = $req->fetchAll();
        return $res;
    }

    public function NbreProduitInactifs() {
        $req = $this->con->prepare('SELECT * FROM produit WHERE etat_produit="Inactif"');
        $req->execute();
        $nbre = $req->rowCount();
        return $nbre;
    }

}

?>