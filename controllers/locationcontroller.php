<?php

require "models/location.php";

class location {

    public function demande() {
        $message = "";
        $btnrech = FALSE;
        $location = new locationModel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $location->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $location->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $location->NbreProduitInactifs();
            $notif = new produitmodel();
        }

        if (isset($_POST['btn_ajouter'])) {
            $location->adresse = filter_input(INPUT_POST, 'sai_adr', FILTER_SANITIZE_STRING);
            $location->details_location = filter_input(INPUT_POST, 'sai_details_produit', FILTER_SANITIZE_STRING);
            $location->montant = filter_input(INPUT_POST, 'sai_budget', FILTER_SANITIZE_STRING);
            $location->etat = "En Cours";
            $location->pays = filter_input(INPUT_POST, 'sai_pays', FILTER_SANITIZE_STRING);
            $location->ville = filter_input(INPUT_POST, 'sai_ville', FILTER_SANITIZE_STRING);
            $location->quartier = filter_input(INPUT_POST, 'sai_quartier', FILTER_SANITIZE_STRING);
            $location->user = $_SESSION['user_id'];
            $response = $location->ajouterDemande();
            if($response){
                $message = "<div class='alert alert-success'><center><h6> Demande envoyée !<br> L'administrateur vous contactera incessamment pour une suite favorable !<br>Merci de votre fidélité...</h6></center></div>";
            }else{
                $message = "<div class='alert alert-danger'><h3> Demande non envoyée !<br> Veuillez réessayer plus tard SVP...</h3></div>";
            }
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
    
    public function liste() {
         $message = "";
        $btnrech = FALSE;
        $location = new locationModel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $location->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $location->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $location->NbreProduitInactifs();
            $notif = new produitmodel();
        }

        $les_locations = $location->listeLocation();
        $les_users = $location->listeuser();
        if(isset($_POST['liste'])){
            if($_POST['rech'] == "all"){
                $les_locations = $location->listeLocation();
            }else{
           $les_locations = $location->listeLocationUser($_POST['rech']);
            }
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
        
        include 'views/produit/liste_location.php';
    }

}

?>