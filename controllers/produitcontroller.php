<?php

require 'config/upload.php';
require "models/produit.php";

class produit {

    public function enregistrement() {

        $produit = new produitModel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $produit->NbreProduitInactifs();
            $notif = new produitmodel();
        }

        
//        $r = $produit->con->prepare('ALTER TABLE produit ADD code_fournisseur varchar(220) NULL');
//        $r->execute();

        $reference_produit = "";
        $libelle_produit = "";
        $details_produit = "";
        $prix_normal = "";
        $prix_reduction = " ";
        $quota = "";
        $type_produit = "";
        $code_fournisseur = "";
        $etat_produit = "";
        $devise = "";
        $pays = "";
        $ville = "";
        $quartier = "";
        $adresse = "";

        $message = "";
        $btnrech = FALSE;

        if (isset($_POST['btn_ajouter'])) {
            // generation de code
            $char = '0123456789';
            $code = '';
            for ($i = 0; $i < 3; $i++) {
                $code .= $char[rand() % strlen($char)];
            }

            $produit->reference_produit = date('y') . "REF" . $code;
            $produit->libelle_produit = $_POST['sai_libelle_produit'];
            $produit->details_produit = $_POST['sai_details_produit'];
            $produit->prix_normal = $_POST['sai_prix_normal'];
            $produit->prix_reduction = $_POST['sai_prix_reduction'];
            $produit->devise = $_POST['sai_devise'];
            $produit->quota = $produit->prix_reduction - $produit->prix_normal;
            $produit->type_produit = $_POST['sai_type_produit'];
            $produit->pays = $_POST['sai_pays'];
            $produit->ville = $_POST['sai_ville'];
            $produit->quartier = $_POST['sai_quartier'];
            $produit->adresse = $_POST['sai_adr'];
            $produit->etat_produit = $_POST['sai_etat_produit'];

            $enrProd = $produit->ajouterproduit();

            if ($enrProd) {
                $message = "Ajout effectué avec succes";

                if (!empty($_FILES['sai_photo']['name'])) {
                    $photos = $_FILES['sai_photo'];
                    for ($i = 0; $i < count($photos['name']); $i++) {
                        $destination = "upload/produits/" . $produit->reference_produit . $photos['name'][$i];
                        $fichier = $produit->reference_produit . $photos['name'][$i];
                        move_uploaded_file($photos['tmp_name'][$i], $destination);
                        $al = $produit->EnregAlbum($fichier, $produit->reference_produit);
                    }
                } else {
                    if ($produit->type_produit == "Terrain") {
                        $fichier = "icone_terrain.png";
                        $al = $produit->EnregAlbum($fichier, $produit->reference_produit);
                    }
                    if ($produit->type_produit == "Maison") {
                        $fichier = "icone_maison.jpg";
                        $al = $produit->EnregAlbum($fichier, $produit->reference_produit);
                    }
                }
            } else {
                $message = "Echec de l'ajout";
            }
        }





        if (isset($_POST['btn_modifier'])) {

            $produit->reference_produit = $_POST['sai_reference_produit'];
            $produit->libelle_produit = $_POST['sai_libelle_produit'];
            $produit->details_produit = $_POST['sai_details_produit'];
            $produit->prix_normal = $_POST['sai_prix_normal'];
            $produit->prix_reduction = $_POST['sai_prix_reduction'];
            $produit->devise = $_POST['sai_devise'];
            $produit->quota = $produit->prix_reduction - $produit->prix_normal;
            $produit->type_produit = $_POST['sai_type_produit'];
            $produit->pays = $_POST['sai_pays'];
            $produit->ville = $_POST['sai_ville'];
            $produit->quartier = $_POST['sai_quartier'];
            $produit->adresse = $_POST['sai_adr'];
            $produit->etat_produit = $_POST['sai_etat_produit'];

            $sol = $produit->modifierproduit();

            if ($sol) {
                $message = "<center>
                    <label class='alert alert-success'> Modification effectuée avec succès !</label>
                </center>";
                $tsles_produits = $produit->listeProduit();
                include 'views/produit/liste_produit.php';
                exit();
            } else {
                $message = "<center>
                    <label class='alert alert-danger'> Echec de la modification !</label>
                </center>";
            }
        }


        if (isset($_POST['btn_supprimer'])) {
            $produit->reference_produit = $_POST['sai_reference_produit'];
            $reponse = $produit->supprimerproduit();
            if ($reponse) {
                $message = "<center>
                    <label class='alert alert-success'> Suppression effectuée avec succès !</label>
                </center>";
                $tsles_produits = $produit->listeProduit();
                include 'views/produit/liste_produit.php';
                exit();
            } else {
                $message = "<center>
                    <label class='alert alert-danger'> Echec de suppression !</label>
                </center>";
            }
        }

        //fonction rechercher par get
        if (isset($_GET['reference'])) {
            $btnrech = TRUE;
            $rech = $_GET['reference'];
            $sol = $produit->rechercherproduitCode($rech);
            if ($sol) {
                $reference_produit = $sol[0]['reference_produit'];
                $libelle_produit = $sol[0]['libelle_produit'];
                $details_produit = $sol[0]['details_produit'];
                $prix_normal = $sol[0]['prix_reduction'];
                $prix_reduction = $sol[0]['prix_reduction'];
                $quota = $sol[0]['quota'];
                $type_produit = $sol[0]['type_produit'];
                $pays = $sol[0]['pays'];
                $ville = $sol[0]['ville'];
                $devise = $sol[0]['devise'];
                $quartier = $sol[0]['quartier'];
                $adresse = $sol[0]['adresse'];
                $etat_produit = $sol[0]['etat_produit'];
            }
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        if ($_SESSION['role'] == 'client') {
            ?>

            <style>
                #quota{display:none;}
                #etat{display:none;}
                #image1{display:none;}
                #image2{display:none;}
                #image3{display:none;}
                #image4{display:none;}
                .tile-footer{display:none;}

            </style>
            <?php

        }






        include "views/produit/enregistrement_produit_1.php";
    }

// liste des produits
    public function liste() {
        $message = "";
        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $produit->NbreProduitInactifs();
            $notif = new produitmodel();
        }

        $les_produits = $produit->listeProduitD();
        $tsles_produits = $produit->listeProduit();

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'stagiaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        include 'views/produit/liste_produit.php';
    }

    public function location() {
        $message = "";
        $btnrech = FALSE;
        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $produit->NbreProduitInactifs();
            $notif = new produitmodel();
        }   
        
        // debut de la protection
        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'stagiaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }
        include 'views/produit/demande_location.php';
    }

    public function inactifs() {
        $message = "";
        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $produit->NbreProduitInactifs();
            $notif = new produitmodel();
        }

        $tsles_produits_inactifs = $produit->listeProduitInactifs();

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'stagiaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        include 'views/produit/liste_produit_inactifs.php';
    }

// liste des produits
    public function voirMaisons() {
        $message = "";
        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $notif = new produitmodel();
        }

        $les_produits = $produit->listeProduitM();



        include 'views/produit/liste_produit_1.php';
    }

    public function voirTerrains() {
        $message = "";
        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $notif = new produitmodel();
        }

        $les_produits = $produit->listeProduitT();

        include 'views/produit/liste_produit_2.php';
    }

    public function categorie() {
        $message = "";
        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $produit->NbreProduitInactifs();
            $notif = new produitmodel();
        }

        if (isset($_POST['btn_rechercher'])) {

            $cateproduits = $_SESSION['role'] == "admin" ? $produit->listeProduitCategorie($_POST['sai_rechercher']) : $produit->listeProduitCategoriePartenaire($_POST['sai_rechercher']);
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'stagiaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        include 'views/produit/liste_produit_categorie.php';
    }

// produits par fournisseur

    public function fournisseur() {
        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $notif = new produitmodel();
        }

        $part = $_SESSION['matricule'];

        if (isset($_POST['btn_rechercher'])) {
            $part = $_POST['sai_rechercher'];
        }
        $produitsFournisseurs = $produit->listeProduitFournisseur($part);

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'stagiaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }

        if ($_SESSION['role'] != 'admin') {
            ?>

            <style>
                .quota{display:none;}      
            </style>
            <?php

        }

        include 'views/produit/liste_produit_fournisseur.php';
    }

    // liste des produits
    public function vitrine() {

        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $produit->NbreProduitInactifs();
            $notif = new produitmodel();
        }

        $sol = $produit->listeProduit();

        include 'shop.php';
    }

    // liste des produits
    public function details() {
        $message = "";
        $produit = new produitmodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $produit->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $produit->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $produit->NbreProduitInactifs();
            $notif = new produitmodel();
        }

        if (isset($_POST['btn_panier'])) {
            $ref = $_POST['sai_reference'];
            $prix = $_POST['sai_prix'];
            $mat = $_SESSION['matricule'];
            $date = date("Y-m-d");
            $ep = 0;
            $etat = "En cours";

            $char = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = '';
            for ($i = 0; $i < 6; $i++) {
                $code .= $char[rand() % strlen($char)];
            }

            $code_comm = "COM" . date('y') . $code;

            $commande = $produit->CreateCommande($code_comm, $mat, $date, $ref, $prix, $ep, $etat);
            if ($commande) {
                $message = "<center>
                    <label class='alert alert-success'> Commande prise en compte !</label>
                </center>";
                $les_produits = $produit->listeProduitD();
                include 'views/produit/liste_produit.php';
                exit();
            } else {
                $message = "<center>
                    <label class='alert alert-danger'> Commande non validée !</label>
                </center>";
            }
        }

        $leproduit = $produit->rechercherproduitCode($_GET['p']);
        $albumproduit = $produit->AlbumParProduit($_GET['p']);

        include 'views/produit/details_produit.php';
    }

    public function voir() {
        $message = "";
        $produit = new produitmodel();

        $leproduit = $produit->rechercherproduitCode($_GET['p']);
        $albumproduit = $produit->AlbumParProduit($_GET['p']);

        include 'views/produit/details_produit_1.php';
    }

}
?>