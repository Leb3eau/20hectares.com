<?php

class utilisateurModel {

    public $id;
    public $login;
    public $nom_prenom;
    public $date_naissance;
    public $lieu_naissance;
    public $sexe;
    public $nationalite;
    public $ville;
    public $quartier;
    public $nbre_enfant;
    public $sit_matri;
    public $email;
    public $mdp;
    public $telephone;
    public $matricule;
    public $role;
    public $date_creation;
    public $photo;
    public $etat;
    public $con;

    public function __construct() {
        require "database/connexion.php";
    }

    
    
    public function ajouterUtilisateur() {

//verifier si le login n'existe pas deja
        $l = $this->verification();

        if (!empty($l)) {
            ?>
            <script>alert("Cet utilisateur existe dejà !")</script>
            <?php

        } else {

            $req = $this->con->prepare('INSERT INTO utilisateur SET login=:log, nom_prenom=:nom, email=:mail, mdp=:mdp, telephone=:tel, role=:role, matricule=:mat,date_creation=:date_creation,photo=:photo,etat=:etat');
            $req->bindParam(':log', $this->login);
            $req->bindParam(':nom', $this->nom_prenom);
            $req->bindParam(':mail', $this->email);
            $req->bindParam(':mdp', $this->mdp);
            $req->bindParam(':tel', $this->telephone);
            $req->bindParam(':role', $this->role);
            $req->bindParam(':mat', $this->matricule);
            $req->bindParam(':date_creation', $this->date_creation);
            $req->bindParam(':photo', $this->photo);
            $req->bindParam(':etat', $this->etat);
            $sol = $req->execute();
            return $sol;
        }
    }

    public function ajouterUtilisateurComplet() {

//verifier si le login n'existe pas deja
        $l = $this->verification();

        if (!empty($l)) {
            ?>
            <script>alert("Cet utilisateur existe dejà !")</script>
            <?php

        } else {

            $req = $this->con->prepare('INSERT INTO utilisateur SET situation_matrimoniale=:sit,nombre_enfant=:nbre_enf,quartier=:quartier,ville=:ville,nationalite=:nat,sexe=:sexe,lieu_naissance=:lieu_naiss,date_naissance=:dte_naiss,login=:log, nom_prenom=:nom, email=:mail, mdp=:mdp, telephone=:tel, role=:role, matricule=:mat,date_creation=:date_creation,photo=:photo,etat=:etat');
            $req->bindParam(':log', $this->login);
            $req->bindParam(':nom', $this->nom_prenom);
            $req->bindParam(':dte_naiss', $this->date_naissance);
            $req->bindParam(':lieu_naiss', $this->lieu_naissance);
            $req->bindParam(':nat', $this->nationalite);
            $req->bindParam(':sexe', $this->sexe);
            $req->bindParam(':quartier', $this->quartier);
            $req->bindParam(':ville', $this->ville);
            $req->bindParam(':nbre_enf', $this->nbre_enfant);
            $req->bindParam(':sit', $this->sit_matri);
            $req->bindParam(':mail', $this->email);
            $req->bindParam(':mdp', $this->mdp);
            $req->bindParam(':tel', $this->telephone);
            $req->bindParam(':role', $this->role);
            $req->bindParam(':mat', $this->matricule);
            $req->bindParam(':date_creation', $this->date_creation);
            $req->bindParam(':photo', $this->photo);
            $req->bindParam(':etat', $this->etat);
            $sol = $req->execute();
            return $sol;
        }
    }

    public function modifierUtilisateur_avec_photo() {
        $req = $this->con->prepare("UPDATE utilisateur SET login=:log, nom_prenom=:nom, email=:mail, mdp=:mdp, telephone=:tel, role=:role, matricule=:mat,date_creation=:date_creation,photo=:photo,etat=:etat WHERE  id=:id");
        $req->bindParam(':id', $this->id);
        $req->bindParam(':log', $this->login);
        $req->bindParam(':nom', $this->nom_prenom);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':mdp', $this->mdp);
        $req->bindParam(':tel', $this->telephone);
        $req->bindParam(':role', $this->role);
        $req->bindParam(':mat', $this->matricule);
        $req->bindParam(':date_creation', $this->date_creation);
        $req->bindParam(':photo', $this->photo);
        $req->bindParam(':etat', $this->etat);
        $sol = $req->execute() or die(print_r($this->con->errorInfo()));
        return $sol;
    }

    public function modifierUtilisateur_avec_photoComplet() {
        $req = $this->con->prepare("UPDATE utilisateur SET situation_matrimoniale=:sit,nombre_enfant=:nbre_enf,quartier=:quartier,ville=:ville,nationalite=:nat,sexe=:sexe,lieu_naissance=:lieu_naiss,date_naissance=:dte_naiss,login=:log, nom_prenom=:nom, email=:mail, mdp=:mdp, telephone=:tel, role=:role, matricule=:mat,date_creation=:date_creation,photo=:photo,etat=:etat WHERE  id=:id");
        $req->bindParam(':id', $this->id);
        $req->bindParam(':log', $this->login);
        $req->bindParam(':nom', $this->nom_prenom);
        $req->bindParam(':dte_naiss', $this->date_naissance);
        $req->bindParam(':lieu_naiss', $this->lieu_naissance);
        $req->bindParam(':nat', $this->nationalite);
        $req->bindParam(':sexe', $this->sexe);
        $req->bindParam(':quartier', $this->quartier);
        $req->bindParam(':ville', $this->ville);
        $req->bindParam(':nbre_enf', $this->nbre_enfant);
        $req->bindParam(':sit', $this->sit_matri);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':mdp', $this->mdp);
        $req->bindParam(':tel', $this->telephone);
        $req->bindParam(':role', $this->role);
        $req->bindParam(':mat', $this->matricule);
        $req->bindParam(':date_creation', $this->date_creation);
        $req->bindParam(':photo', $this->photo);
        $req->bindParam(':etat', $this->etat);
        $sol = $req->execute() or die(print_r($this->con->errorInfo()));
        return $sol;
    }

    public function modifierUtilisateur_sans_photoComplet() {
        $req = $this->con->prepare("UPDATE utilisateur SET situation_matrimoniale=:sit,nombre_enfant=:nbre_enf,quartier=:quartier,ville=:ville,nationalite=:nat,sexe=:sexe,lieu_naissance=:lieu_naiss,date_naissance=:dte_naiss,login=:log, nom_prenom=:nom, email=:mail, mdp=:mdp, telephone=:tel, role=:role, matricule=:mat,date_creation=:date_creation,etat=:etat WHERE id=:id");
        $req->bindParam(':id', $this->id);
        $req->bindParam(':log', $this->login);
        $req->bindParam(':nom', $this->nom_prenom);
        $req->bindParam(':dte_naiss', $this->date_naissance);
        $req->bindParam(':lieu_naiss', $this->lieu_naissance);
        $req->bindParam(':nat', $this->nationalite);
        $req->bindParam(':sexe', $this->sexe);
        $req->bindParam(':quartier', $this->quartier);
        $req->bindParam(':ville', $this->ville);
        $req->bindParam(':nbre_enf', $this->nbre_enfant);
        $req->bindParam(':sit', $this->sit_matri);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':mdp', $this->mdp);
        $req->bindParam(':tel', $this->telephone);
        $req->bindParam(':role', $this->role);
        $req->bindParam(':mat', $this->matricule);
        $req->bindParam(':date_creation', $this->date_creation);
        $req->bindParam(':etat', $this->etat);
        $sol = $req->execute() or die(print_r($this->con->errorInfo()));
        return $sol;



        /* } */
    }

    public function modifierUtilisateur_sans_photo() {
        $req = $this->con->prepare("UPDATE utilisateur SET login=:log, nom_prenom=:nom, email=:mail, mdp=:mdp, telephone=:tel, role=:role, matricule=:mat,date_creation=:date_creation,etat=:etat WHERE id=:id");
        $req->bindParam(':id', $this->id);
        $req->bindParam(':log', $this->login);
        $req->bindParam(':nom', $this->nom_prenom);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':mdp', $this->mdp);
        $req->bindParam(':tel', $this->telephone);
        $req->bindParam(':role', $this->role);
        $req->bindParam(':mat', $this->matricule);
        $req->bindParam(':date_creation', $this->date_creation);
        $req->bindParam(':etat', $this->etat);
        $sol = $req->execute() or die(print_r($this->con->errorInfo()));
        return $sol;



        /* } */
    }

    public function modifierUtilisateur() {

        $req = $this->con->prepare("UPDATE utilisateur SET login=:log, nom_prenom=:nom, email=:mail, mdp=:mdp, telephone=:tel, role=:role, matricule=:mat,date_creation=:date_creation,photo=:photo,etat=:etat WHERE  id=:id");
        $req->bindParam(':id', $this->id);
        $req->bindParam(':log', $this->login);
        $req->bindParam(':nom', $this->nom_prenom);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':mdp', $this->mdp);
        $req->bindParam(':tel', $this->telephone);
        $req->bindParam(':role', $this->role);
        $req->bindParam(':mat', $this->matricule);
        $req->bindParam(':date_creation', $this->date_creation);
        $req->bindParam(':photo', $this->photo);
        $req->bindParam(':etat', $this->etat);
        $sol = $req->execute();

        return $sol;



        /* } */
    }

    public function supprimerUtilisateur() {
        $req = $this->con->prepare('DELETE FROM utilisateur WHERE login=:log');
        $req->bindParam(':log', $this->login);
        $sol = $req->execute();
        return $sol;
    }

    public function avoirMatriculePartenaire() {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE role="partenaire"');
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    public function avoirDateFinAbonnement($mat) {
        $req = $this->con->prepare('SELECT * FROM forfait WHERE matricule=:mat ORDER BY id DESC LIMIT 1');
        $req->bindParam(':mat', $mat);
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    public function utilisateurId() {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE id = :l');
        $req->bindParam(':l', $this->id);
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    public function rechercherUtilisateur($mat, $login) {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE login=:login AND matricule=:mat');
        $req->bindParam(':login', $login);
        $req->bindParam(':mat', $mat);
        $req->execute();
        $data = $req->fetchAll();
        return $data;
    }

    public function connexion() {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE login=:log AND mdp=:mdp');
        $req->bindParam(':log', $this->login);
        $req->bindParam(':mdp', $this->mdp);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function utilisateur_carte($id) {
        $req = $this->con->prepare('SELECT * FROM utilisateur,carte WHERE utilisateur.id=carte.user AND utilisateur.id=:id');
        $req->bindParam(':id', $id);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function rechercher($login) {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE login=:log');
        $req->bindParam(':log', $login);
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    public function verification() {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE id=:id');
        $req->bindParam(':id', $this->id);
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    public function inscriptionUtilisateur() {
        $req = $this->con->prepare('INSERT INTO utilisateur SET login=:log, nom_prenom=:nom, email=:mail, mdp=:mdp, telephone=:tel, role=:role, matricule=:mat,date_creation=:date_creation,etat="Actif"');
        $req->bindParam(':log', $this->login);
        $req->bindParam(':nom', $this->matricule);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':mdp', $this->mdp);
        $req->bindParam(':tel', $this->telephone);
        $req->bindParam(':role', $this->role);
        $req->bindParam(':mat', $this->matricule);
        $req->bindParam(':date_creation', $this->date_creation);
        $sol = $req->execute() or die(print_r($this->con->errorInfo()));
        return $sol;
    }

    public function verificationEmailTelephone() {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE email=:email OR telephone=:telephone');
        $req->bindParam(':email', $this->email);
        $req->bindParam(':telephone', $this->telephone);
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }
    
    public function verificationUsername() {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE login=:log');
        $req->bindParam(':log', $this->login);
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    public function afficherUtilisateur() {
        $req = $this->con->prepare('SELECT * FROM utilisateur');
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }
    public function NreUtilisateur() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM utilisateur');
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    public function afficherUtilisateurMat($mat) {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE matricule=:matricule');
        $req->bindParam(':matricule', $mat);
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    public function recherchecartematricule($mat) {

        $req = $this->con->prepare('SELECT * FROM carte WHERE matricule=:matricule');
        $req->bindParam(':matricule', $mat);
        $exec = $req->execute();

        return $exec;
    }

    public function nbreclient() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM utilisateur WHERE role="client" ');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function nbreadmin() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM utilisateur WHERE role="admin" ');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function nbrepartenaire() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM utilisateur WHERE role="partenaire" ');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function nbreProduits($type) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM produit WHERE type_produit=:t');
        $req->bindParam(":t", $type);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    
    public function nbreProduitsPartenaire($type, $code) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM produit WHERE type_produit=:t AND code_fournisseur=:code');
        $req->bindParam(":t", $type);
        $req->bindParam(":code", $code);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function nbreProduitsVendus($type) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM produit,commande WHERE produit.reference_produit=commande.reference_produit AND produit.type_produit=:t AND commande.epargne>0');
        $req->bindParam(":t", $type);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function GainProduit($type) {
        $req = $this->con->prepare('SELECT SUM(produit.quota) AS nb FROM produit,commande WHERE produit.reference_produit=commande.reference_produit AND produit.type_produit=:t');
        $req->bindParam(":t", $type);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totalVente() {
        $req = $this->con->prepare('SELECT SUM(prix_reduction) AS nb FROM produit');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
        public function totalAchat() {
            $req = $this->con->prepare('SELECT SUM(prix_normal) AS nb FROM produit');
            $req->execute();
            $sol = $req->fetchAll();
            return $sol;
        }
   

    public function totalQuota() {
        $req = $this->con->prepare('SELECT SUM(produit.quota) AS nb FROM produit,commande WHERE produit.reference_produit=commande.reference_produit');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function cmdenonvalidee($client) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM commande WHERE epargne=0 AND matricule=:t');
        $req->bindParam(":t", $client);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    public function cmdenonvalideep($client) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM commande,produit WHERE produit.reference_produit=commande.reference_produit AND commande.epargne=0 AND produit.code_fournisseur=:t');
        $req->bindParam(":t", $client);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    public function cmdevalidee($client) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM commande WHERE epargne>0 AND matricule=:t');
        $req->bindParam(":t", $client);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    public function cmdevalideep($client) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM commande,produit WHERE produit.reference_produit=commande.reference_produit AND commande.epargne>0 AND produit.code_fournisseur=:t');
        $req->bindParam(":t", $client);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    public function totachat($client) {
        $req = $this->con->prepare('SELECT SUM(prix_produit) AS nb FROM commande WHERE epargne>0 AND matricule=:t');
        $req->bindParam(":t", $client);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    public function totcmde($client) {
        $req = $this->con->prepare('SELECT SUM(prix_produit) AS nb FROM commande WHERE epargne=0 AND matricule=:t');
        $req->bindParam(":t", $client);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    
    public function totachatp($client) {
        $req = $this->con->prepare('SELECT SUM(produit.prix_normal) AS nb FROM commande,produit WHERE produit.reference_produit=commande.reference_produit AND commande.epargne>0 AND produit.code_fournisseur=:t');
        $req->bindParam(":t", $client);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }
    public function totcmdep($client) {
        $req = $this->con->prepare('SELECT SUM(produit.prix_reduction) AS nb FROM commande,produit WHERE produit.reference_produit=commande.reference_produit AND commande.epargne>0 AND produit.code_fournisseur=:t');
        $req->bindParam(":t", $client);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totalNotification() {
        $req = $this->con->prepare('SELECT COUNT(id) AS nb FROM notifications');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totalCarte() {
        $req = $this->con->prepare('SELECT COUNT(*) AS som FROM carte');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totalCompteInactif() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM compte WHERE etat_compte="Inactif" ');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totalCompteActif() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nb FROM compte WHERE etat_compte="Actif" ');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totalSoldeCompte() {
        $req = $this->con->prepare('SELECT SUM(solde_compte) AS som FROM compte');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totalSoldeCarte() {
        $req = $this->con->prepare('SELECT SUM(solde_carte) AS som FROM carte');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    // client
    public function NbreUtilisateurSpecial($l) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM utilisateur WHERE utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function TotalDepotCarte($l) {
        $req = $this->con->prepare('SELECT SUM(transaction.montant_transaction) AS som FROM utilisateur,transaction,carte WHERE transaction.numero_expediteur = carte.numero_carte AND carte.matricule = utilisateur.matricule AND transaction.type_transaction ="Depot" AND utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function TotalRetraitCarte($l) {
        $req = $this->con->prepare('SELECT SUM(transaction.montant_transaction) AS som FROM utilisateur,transaction,carte WHERE transaction.numero_expediteur = carte.numero_carte AND carte.matricule = utilisateur.matricule AND transaction.type_transaction ="Retrait" AND utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function TotalTransfertCarte($l) {
        $req = $this->con->prepare('SELECT SUM(transaction.montant_transaction) AS som FROM utilisateur,transaction,carte WHERE transaction.numero_expediteur = carte.numero_carte AND carte.matricule = utilisateur.matricule AND transaction.type_transaction ="Transfert" AND utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function TotalDepotCompte($l) {
        $req = $this->con->prepare('SELECT SUM(transaction.montant_transaction) AS som FROM utilisateur,transaction,compte WHERE transaction.numero_expediteur = compte.numero_compte AND compte.matricule = utilisateur.matricule AND transaction.type_transaction ="Depot" AND utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function TotalRetraitCompte($l) {
        $req = $this->con->prepare('SELECT SUM(transaction.montant_transaction) AS som FROM utilisateur,transaction,compte WHERE transaction.numero_expediteur = compte.numero_compte AND compte.matricule = utilisateur.matricule AND transaction.type_transaction ="Retrait" AND utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function TotalTransfertCompte($l) {
        $req = $this->con->prepare('SELECT SUM(transaction.montant_transaction) AS som FROM utilisateur,transaction,compte WHERE transaction.numero_expediteur = compte.numero_compte AND compte.matricule = utilisateur.matricule AND transaction.type_transaction ="Transfert" AND utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function SommeTotalCarte($l) {
        $req = $this->con->prepare('SELECT SUM(carte.solde_carte) AS som FROM carte,utilisateur WHERE  carte.matricule = utilisateur.matricule AND utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function SommeTotalCompte($l) {
        $req = $this->con->prepare('SELECT SUM(compte.solde_compte) AS som FROM compte,utilisateur WHERE  compte.matricule = utilisateur.matricule AND utilisateur.login = :l');
        $req->bindParam(':l', $l);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    function nbre_notif_Lue($u) {
        $sql = "SELECT  COUNT(notifications.id) AS nbre FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=1 AND utilisateur.login=:u";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $nbre = $req->fetchAll();
        return $nbre;
    }

    function nbre_notif_Non_Lue($u) {
        $sql = "SELECT  COUNT(notifications.id) AS nbre FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=0 AND utilisateur.login=:u";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $nbre = $req->fetchAll();
        return $nbre;
    }

    function nbre_compte_actif($u) {
        $sql = "SELECT  COUNT(compte.numero_compte) AS nbre FROM utilisateur,compte WHERE utilisateur.matricule=compte.matricule AND utilisateur.login=:u AND etat_compte='Actif' ";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $nbre = $req->fetchAll();
        return $nbre;
    }

    function nbre_compte_inactif($u) {
        $sql = "SELECT  COUNT(compte.numero_compte) AS nbre FROM utilisateur,compte WHERE utilisateur.matricule=compte.matricule AND utilisateur.login=:u AND etat_compte='Inactif' ";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $nbre = $req->fetchAll();
        return $nbre;
    }

    function nbre_compte_special($u) {
        $sql = "SELECT  COUNT(compte.numero_compte) AS nbre FROM utilisateur,compte WHERE utilisateur.matricule=compte.matricule AND utilisateur.login=:u";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $nbre = $req->fetchAll();
        return $nbre;
    }

    public function nbrecommandeclient($log) {
        $req = $this->con->prepare('SELECT COUNT(commande.numero_commande) AS nbre FROM commande,carte,utilisateur WHERE carte.matricule=utilisateur.matricule AND commande.numero_carte=carte.numero_carte AND utilisateur.login=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function nbreclientpart($log) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM client,utilisateur WHERE  utilisateur.matricule = client.code_partenaire AND utilisateur.login=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function nbrestagiairepart($log) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM stagiaire,utilisateur WHERE  utilisateur.matricule = stagiaire.code_partenaire AND utilisateur.login=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function nbreproduit($log) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM produit,utilisateur WHERE utilisateur.matricule = produit.code_fournisseur AND utilisateur.login=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function nbrecommande($log) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM produit,utilisateur,commande WHERE utilisateur.matricule = produit.code_fournisseur AND produit.reference_produit = commande.reference_produit AND utilisateur.login=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totaldoclog($log) {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM document,utilisateur WHERE utilisateur.matricule = document.auteur_document AND utilisateur.login=:log');
        $req->bindParam(':log', $log);
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totaltheme() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM theme_stage');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totalstagiaire() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM stagiaire');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    public function totaldocumentpublique() {
        $req = $this->con->prepare('SELECT COUNT(*) AS nbre FROM document WHERE etat_document="Publique" ');
        $req->execute();
        $sol = $req->fetchAll();
        return $sol;
    }

    //fin


    function notification_Non_Lue($u) {
        $sql = "SELECT * FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=0 AND vue.user=:u ORDER BY notifications.id DESC";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }

    function nbre_notification_Non_Lue($u) {
        $sql = "SELECT * FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=0 AND vue.user=:u";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $nbre = $req->rowCount();
        return $nbre;
    }

    function proprietaire_de_notification($u) {
        $sql = "SELECT utilisateur.*, notifications.id FROM notifications,utilisateur WHERE utilisateur.id=notifications.user AND notifications.id=:u";
        $req = $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
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