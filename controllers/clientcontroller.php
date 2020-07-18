<?php

require 'models/client.php';

class client {

    public function enregistrement() {

        $brech = FALSE;
        $id = "";
        $login = "";
        $nom_prenom = "";
        $telephone = "";
        $email = "";
        $mdp = "";
        $role = "";
        $matricule = "";
        $date_creation = "";
        $photo = "";
        $date_naissance = "";
        $lieu_naissance = "";
        $sexe = "";
        $nationalite = "";
        $ville = "";
        $quartier = "";
        $situation_matrimoniale = "";
        $nombre_enfant = "";
        $etat = "";

        $message = "";


        $client = new clientmodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $client->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $client->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $client->NbreProduitInactifs();
            $notif = new clientmodel();
        }

        if (isset($_POST['btn_ajouter'])) {

            $u1 = upload_image('sai_photo', "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
            //move_uploaded_file($_FILES['sai_photo']['tmp_name'], "upload/photo/" . $_POST['sai_matricule'] . $_FILES['sai_photo']['name']);
            if (!empty($u1)) {
                $client->date_naissance = $_POST['sai_date_naissance'];
                $client->lieu_naissance = $_POST['sai_lieu_naissance'];
                $client->nationalite = $_POST['sai_nationalite'];
                $client->nbre_enfant = $_POST['sai_nbre_enfant'];
                $client->quartier = $_POST['sai_quartier'];
                $client->sexe = $_POST['sai_sexe'];
                $client->sit_matri = $_POST['sai_situtation'];
                $client->ville = $_POST['sai_ville'];
                $client->nom_prenom = $_POST['sai_nom_prenom'];
                $client->email = $_POST['sai_email'];
                $client->telephone = $_POST['sai_telephone'];
                $client->login = $_POST['sai_login'];
                $client->mdp = $_POST['sai_mdp'];
                $client->role = "client";
                $client->matricule = $_POST['sai_matricule'];
                $client->date_creation = $_POST['sai_date_creation'];
                $client->photo = $_POST['sai_matricule'] . $_FILES['sai_photo']['name'];
                $client->etat = $_POST['sai_etat'];

                $exec = $client->ajouterUtilisateurComplet();
            }

            if (!empty($exec)) {

                $message = "Enregistrement effectué avec succes !";
            } else {

                $message = "Echec de l'enregistrement ";
            }
        }
// le bouton modifier
        if (isset($_POST['btn_modifier'])) {

            $client->id = $_POST['sai_id'];
            $client->nom_prenom = $_POST['sai_nom_prenom'];
            $client->email = $_POST['sai_email'];
            $client->telephone = $_POST['sai_telephone'];
            $client->login = $_POST['sai_login'];
            $client->mdp = $_POST['sai_mdp'];
            $client->role = $_POST['sai_role'];
            $client->matricule = $_POST['sai_matricule'];
            $client->date_creation = $_POST['sai_date_creation'];
            $client->date_naissance = $_POST['sai_date_naissance'];
            $client->lieu_naissance = $_POST['sai_lieu_naissance'];
            $client->nationalite = $_POST['sai_nationalite'];
            $client->nbre_enfant = $_POST['sai_nbre_enfant'];
            $client->quartier = $_POST['sai_quartier'];
            $client->sexe = $_POST['sai_sexe'];
            $client->sit_matri = $_POST['sai_situtation'];
            $client->ville = $_POST['sai_ville'];

            $client->etat = $_POST['sai_etat'];

            if (!empty($_FILES['sai_photo']['name'])) {
                $u1 = upload_image('sai_photo', "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
                if (!empty($u1)) {
                    $client->photo = $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name'];
                    $exec = $client->modifierUtilisateur_avec_photoComplet();
                }
            } else {
                $exec = $client->modifierUtilisateur_sans_photoComplet();
            }

            if (!empty($exec)) {

                $message = "Modification effectuée avec succes !";
            } else {

                $message = "Echec de la modification ";
            }
        }

        // bouton supprimer
        if (isset($_POST['btn_supprimer'])) {
            $client->login = $_POST['sai_login'];
            $exec = $client->supprimerUtilisateur();

            if (!empty($exec)) {

                $message = "Suppression effectuée avec succes !";
            } else {

                $message = "Echec de la suppression ";
            }
        }

// bouton rechercher par post
        if (isset($_POST['btn_rechercher'])) {

            $log = $_POST['sai_rechercher'];

            $sol = $client->rechercherclient($log);

            if (!empty($sol)) {

                $id = $sol[0]['id'];
                $login = $sol[0]['login'];
                $nom_prenom = $sol[0]['nom_prenom'];
                $telephone = $sol[0]['telephone'];
                $email = $sol[0]['email'];
                $mdp = $sol[0]['mdp'];
                $role = $sol[0]['role'];
                $matricule = $sol[0]['matricule'];
                $date_creation = $sol[0]['date_creation'];
                $photo = $sol[0]['photo'];
                $date_naissance = $sol[0]['date_naissance'];
                $lieu_naissance = $sol[0]['lieu_naissance'];
                $sexe = $sol[0]['sexe'];
                $nationalite = $sol[0]['nationalite'];
                $ville = $sol[0]['ville'];
                $quartier = $sol[0]['quartier'];
                $nombre_enfant = $sol[0]['nombre_enfant'];
                $situation_matrimoniale = $sol[0]['situation_matrimoniale'];
                $etat = $sol[0]['etat'];
                $brech = TRUE;
            } else {
                $message = "Ce client n'existe pas !";
            }
        }


        //fonction rechercher par get
        if (isset($_GET['matricule'])) {

            $rech = $_GET['matricule'];

            $sol = $client->rechercherclient($rech);

            if ($sol) {
                $id = $sol[0]['id'];
                $login = $sol[0]['login'];
                $nom_prenom = $sol[0]['nom_prenom'];
                $telephone = $sol[0]['telephone'];
                $email = $sol[0]['email'];
                $mdp = $sol[0]['mdp'];
                $role = $sol[0]['role'];
                $matricule = $sol[0]['matricule'];
                $date_creation = $sol[0]['date_creation'];
                $photo = $sol[0]['photo'];
                $date_naissance = $sol[0]['date_naissance'];
                $lieu_naissance = $sol[0]['lieu_naissance'];
                $sexe = $sol[0]['sexe'];
                $nationalite = $sol[0]['nationalite'];
                $ville = $sol[0]['ville'];
                $quartier = $sol[0]['quartier'];
                $nombre_enfant = $sol[0]['nombre_enfant'];
                $situation_matrimoniale = $sol[0]['situation_matrimoniale'];
                $etat = $sol[0]['etat'];
                $brech = TRUE;
            } else {


                $message = "Ce client n'as pas été retrouvé  !";
            }
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }


        include 'views/client/enregistrement_client.php';
    }

    public function liste() {
        $client = new clientmodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $client->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $client->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $client->NbreProduitInactifs();
            $notif = new clientmodel();
        }

        $sol = $client->listeclient();

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }

        include 'views/client/liste_client.php';
    }

    public function liste_periode() {

        $client = new clientmodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $client->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $client->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $client->NbreProduitInactifs();
            $notif = new clientmodel();
        }

        if (isset($_POST['btn_rechercher'])) {
            $k1 = $_POST['sai_date_debut'];
            $k2 = $_POST['sai_date_fin'];
            $sol = $client->rechercherclientperiode($k1, $k2);
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
                <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
                <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }


        include "views/client/liste_client_periode.php";
    }

    public function etat() {

        $client = new clientmodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $client->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $client->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $client->NbreProduitInactifs();
            $notif = new clientmodel();
        }

        if (isset($_POST['btn_rechercher'])) {
            $etat = $_POST['sai_etat'];
            $sol = $client->listeclientEtat($etat);
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
                <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
                <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }


        include "views/client/liste_client_etat.php";
    }

    public function liste_client_partenaire() {

        $client = new clientmodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $client->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $client->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $client->NbreProduitInactifs();
            $notif = new clientmodel();
        }

        if (!empty($_SESSION['login'])) {
            $log = $_SESSION['login'];
            $sol = $client->listeclientPartenaire($log);
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
                <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
                <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/client/connexion');</script>";
            exit();
        }

        if ($_SESSION['role'] == 'partenaire') {
            ?>

            <style> .operation{display:none} </style>
            <?php

        }


        include "views/client/liste_client_partenaire.php";
    }

}
