<?php

class produitModel {

    public $reference_produit;
    public $libelle_produit;
    public $details_produit;
    public $prix_normal;
    public $prix_reduction;
    public $devise;
    public $quota;
    public $type_produit;
    public $pays;
    public $ville;
    public $adresse;
    public $quartier;
    public $etat_produit;
    public $con;

    function __construct() {
        require "database/connexion.php";
    }

// Ajouter
    public function ajouterproduit() {

        $req = $this->con->prepare('INSERT INTO produit VALUES(:reference_produit,:libelle_produit,:details_produit,:prix_normal,:prix_reduction,:devise,:quota,:categorie_produit,:pays, :ville, :adr, :quar, :etat_produit, :cf)');

        $req->bindParam(':reference_produit', $this->reference_produit);
        $req->bindParam(':libelle_produit', $this->libelle_produit);
        $req->bindParam(':details_produit', $this->details_produit);
        $req->bindParam(':prix_normal', $this->prix_normal);
        $req->bindParam(':prix_reduction', $this->prix_reduction);
        $req->bindParam(':devise', $this->devise);
        $req->bindParam(':quota', $this->quota);
        $req->bindParam(':categorie_produit', $this->type_produit);
        $req->bindParam(':pays', $this->pays);
        $req->bindParam(':ville', $this->ville);
        $req->bindParam(':adr', $this->adresse);
        $req->bindParam(':quar', $this->quartier);
        $req->bindParam(':etat_produit', $this->etat_produit);
        $req->bindParam(':cf', $_SESSION['matricule']);
        $sol = $req->execute();
        return $sol;
    }

// Modifier
    public function modifierproduit() {
        $req = $this->con->prepare('UPDATE produit SET libelle_produit=:libelle_produit,details_produit=:details_produit,prix_normal=:prix_normal,prix_reduction=:prix_reduction,devise=:devise,quota=:quota,type_produit=:categorie_produit,pays=:pays, ville=:ville, adresse=:adr, quartier=:quar,etat_produit=:etat_produit WHERE reference_produit=:reference_produit');

        $req->bindParam(':reference_produit', $this->reference_produit);
        $req->bindParam(':libelle_produit', $this->libelle_produit);
        $req->bindParam(':details_produit', $this->details_produit);
        $req->bindParam(':prix_normal', $this->prix_normal);
        $req->bindParam(':prix_reduction', $this->prix_reduction);
        $req->bindParam(':devise', $this->devise);
        $req->bindParam(':quota', $this->quota);
        $req->bindParam(':categorie_produit', $this->type_produit);
        $req->bindParam(':pays', $this->pays);
        $req->bindParam(':ville', $this->ville);
        $req->bindParam(':adr', $this->adresse);
        $req->bindParam(':quar', $this->quartier);
        $req->bindParam(':etat_produit', $this->etat_produit);
        $sol = $req->execute() or die(print_r($this->con->errorInfo()));
        return $sol;
    }

// Supprimer
    public function supprimerproduit() {
        $req = $this->con->prepare('DELETE FROM produit WHERE reference_produit=:reference_produit');
        $req->bindParam(':reference_produit', $this->reference_produit);
        $req->execute();
        $sol = $req->execute();
        return $sol;
    }

// Rechercher par code du produit
    public function rechercherproduitCode($rech) {
        $req = $this->con->prepare('SELECT * FROM produit WHERE reference_produit=:reference_produit');
        $req->bindParam(':reference_produit', $rech);
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function listeProduit() {
        $req = $this->con->prepare('SELECT * FROM produit');
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function listeProduitInactifs() {
        $req = $this->con->prepare('SELECT * FROM produit WHERE etat_produit="Inactif"');
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function NbreProduitInactifs() {
        $req = $this->con->prepare('SELECT * FROM produit WHERE etat_produit="Inactif"');
        $req->execute();
        $nbre = $req->rowCount();
        return $nbre;
    }

    public function listeProduitM() {
        $req = $this->con->prepare('SELECT * FROM produit where type_produit="Maison"');
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function listeProduitT() {
        $req = $this->con->prepare('SELECT * FROM produit where type_produit="Terrain"');
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function listeProduitD() {
        $req = $this->con->prepare('SELECT * FROM produit WHERE etat_produit="Disponible"');
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function AlbumParProduit($ref) {
        $req = $this->con->prepare('SELECT * FROM album WHERE produit=:fic');
        $req->bindParam(":fic", $ref);
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function EnregAlbum($fic, $ref) {
        $req = $this->con->prepare('INSERT INTO album VALUES(NULL, :fic, :p)');
        $req->bindParam(":fic", $fic);
        $req->bindParam(":p", $ref);
        $res = $req->execute();
        return $res;
    }

    public function listeProduitCategoriePartenaire($rech) {
        $req = $this->con->prepare('SELECT * FROM produit WHERE type_produit=:categorie_produit AND code_fournisseur=:code_fournisseur');
        $req->bindParam(':categorie_produit', $rech);
        $req->bindParam(':code_fournisseur', $_SESSION['matricule']);
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function listeProduitCategorie($rech) {
        $req = $this->con->prepare('SELECT * FROM produit WHERE type_produit=:categorie_produit');
        $req->bindParam(':categorie_produit', $rech);
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function CreateCommande($com, $mat, $dte, $ref, $prix, $epargne, $etat) {
        $req = $this->con->prepare('INSERT INTO commande VALUES(:nc, :m, :d, :ref, :p, :ep, :et)');
        $req->bindParam(':nc', $com);
        $req->bindParam(':m', $mat);
        $req->bindParam(':d', $dte);
        $req->bindParam(':ref', $ref);
        $req->bindParam(':p', $prix);
        $req->bindParam(':ep', $epargne);
        $req->bindParam(':et', $etat);
        $solution = $req->execute();
        return $solution;
    }

    public function listeProduitFournisseur($rech) {
        $req = $this->con->prepare('SELECT * FROM produit WHERE code_fournisseur=:code_fournisseur');
        $req->bindParam(':code_fournisseur', $rech);
        $req->execute();
        $solution = $req->fetchAll();
        return $solution;
    }

    public function listeFournisseurMat($rech) {
        $req = $this->con->prepare('SELECT * FROM utilisateur  WHERE matricule=:matricule AND role="partenaire" AND etat="Actif" ');
        $req->bindParam(':matricule', $rech);
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

}

?>