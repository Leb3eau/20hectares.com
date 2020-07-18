<?php

class commandemodel {

    public $numero_commande;
    public $date_commande;
    public $reference_produit;
    public $prix_produit;
    public $etat_commande;
    public $matricule;
    public $epargne;
    public $con;

    function __construct() {
        require "database/connexion.php";
    }

    // generation de code
    
    public function NbreProduitInactifs() {
        $req = $this->con->prepare('SELECT * FROM produit WHERE etat_produit="Inactif"');
        $req->execute();
        $nbre = $req->rowCount();
        return $nbre;
    }
    
// Ajouter
    public function ajoutercommande() {
        $req = $this->con->prepare('INSERT INTO commande VALUES(:numero_commande, :mat, :date_commande,:reference_produit,:prix_produit,:epargne,:etat_commande)');

        $req->bindParam(':date_commande', $this->date_commande);
        $req->bindParam(':prix_produit', $this->prix_produit);
        $req->bindParam(':reference_produit', $this->reference_produit);
        $req->bindParam(':numero_commande', $this->numero_commande);
        $req->bindParam(':mat', $this->matricule);
        $req->bindParam(':epargne', $this->epargne);
        $req->bindParam(':etat_commande', $this->etat_commande);
        $sol = $req->execute();
        return $sol;
    }

// Modifier
    public function modifiercommande() {
        $req = $this->con->prepare('UPDATE commande SET epargne=:epargne,matricule=:mat,date_commande=:date_commande,prix_produit=:prix_produit,reference_produit=:reference_produit,etat_commande=:etat_commande WHERE numero_commande=:numero_commande');

        $req->bindParam(':date_commande', $this->date_commande);
        $req->bindParam(':prix_produit', $this->prix_produit);
        $req->bindParam(':reference_produit', $this->reference_produit);
        $req->bindParam(':numero_commande', $this->numero_commande);
        $req->bindParam(':mat', $this->matricule);
        $req->bindParam(':epargne', $this->epargne);
        $req->bindParam(':etat_commande', $this->etat_commande);
        $sol = $req->execute();
        return $sol;
    }

    public function PayerCommande($com, $mont) {
        $req = $this->con->prepare('UPDATE commande SET epargne=epargne+:epargne WHERE numero_commande=:numero_commande');
        $req->bindParam(':numero_commande', $com);
        $req->bindParam(':epargne', $mont);
        $sol = $req->execute();
        return $sol;
    }
    
    public function ChangerEtatProduit($ref) {
        $req = $this->con->prepare('UPDATE produit SET etat_produit="Non Disponible" WHERE reference_produit=:ref');
        $req->bindParam(':ref', $ref);
        $sol = $req->execute();
        return $sol;
    }

// Supprimer
    public function supprimercommande() {
        $req = $this->con->prepare('DELETE FROM commande WHERE numero_commande=:numero_commande');
        $req->bindParam(':numero_commande', $this->numero_commande);
        $req->execute();
        $sol = $req->execute();
        return $sol;
    }

// Rechercher des commandes par periode
    public function recherchercommande($rech1) {
        $req = $this->con->prepare('SELECT * FROM commande WHERE numero_commande=:numero_commande');
        $req->bindParam(':numero_commande', $rech1);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

// Rechercher des commandes par periode
    public function recherchercommandeperiode($rech1, $rech2) {
        $req = $this->con->prepare('SELECT commande.*, utilisateur.nom_prenom FROM commande,utilisateur WHERE commande.matricule=utilisateur.matricule AND date_commande BETWEEN :datedebut AND :datefin');
        $req->bindParam(':datedebut', $rech1);
        $req->bindParam(':datefin', $rech2);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    // Rechercher des commandes par periode par client
    public function recherchercommandeperiodelog($dd, $df, $log) {
        $req = $this->con->prepare('SELECT commande.* FROM commande,produit,utilisateur WHERE commande.date_commande BETWEEN :datedebut AND :datefin AND produit.reference_produit = commande.reference_produit AND produit.code_fournisseur = utilisateur.matricule AND utilisateur.login=:log ');
        $req->bindParam(':datedebut', $dd);
        $req->bindParam(':datefin', $df);
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    // Rechercher des commandes par client
    public function recherchercommandeclient($log) {
        $req = $this->con->prepare('SELECT commande.*, produit.libelle_produit as lib FROM commande,utilisateur,produit WHERE commande.matricule=utilisateur.matricule AND commande.reference_produit=produit.reference_produit AND utilisateur.matricule=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    // Rechercher des commandes par partenaire
    public function recherchercommandepartenaire($log) {
        $req = $this->con->prepare('SELECT * FROM commande,produit WHERE commande.reference_produit=produit.reference_produit AND produit.code_fournisseur=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function listecommande() {
        $req = $this->con->prepare('SELECT * FROM commande');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function listecommandeComplete() {
        $req = $this->con->prepare('SELECT commande.*, utilisateur.nom_prenom FROM commande, utilisateur WHERE commande.matricule=utilisateur.matricule');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    public function lacommandeComplete($code) {
        $req = $this->con->prepare('SELECT commande.*, utilisateur.nom_prenom, produit.details_produit, produit.type_produit FROM commande, utilisateur, produit WHERE commande.matricule=utilisateur.matricule AND produit.reference_produit=commande.reference_produit AND commande.numero_commande=:numero_commande');
        $req->bindParam(":numero_commande",$code);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function recherchercarte($numero) {
        $req = $this->con->prepare('SELECT * FROM carte WHERE numero_carte = :numero_carte');
        $req->bindParam(':numero_carte', $numero);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function recherchercartemat($log) {
        $req = $this->con->prepare('SELECT carte.* FROM carte,utilisateur WHERE carte.matricule = utilisateur.matricule AND utilisateur.login=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function listeproduit() {
        $req = $this->con->prepare('SELECT * FROM produit');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function rechercheproduitreference($ref) {
        $req = $this->con->prepare('SELECT * FROM produit WHERE reference_produit=:ref');
        $req->bindParam(':ref', $ref);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
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

}

?>