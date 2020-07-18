<?php

require 'models/partenaire.php';

class partenaire {

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


        $partenaire = new partenairemodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $partenaire->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $partenaire->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $partenaire->NbreProduitInactifs();
            $notif = new partenairemodel();
        }

        if (isset($_POST['btn_ajouter'])) {

            $u1 = upload_image('sai_photo', "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
            //move_uploaded_file($_FILES['sai_photo']['tmp_name'], "upload/photo/" . $_POST['sai_matricule'] . $_FILES['sai_photo']['name']);
            if (!empty($u1)) {
                $partenaire->date_naissance = $_POST['sai_date_naissance'];
                $partenaire->lieu_naissance = $_POST['sai_lieu_naissance'];
                $partenaire->nationalite = $_POST['sai_nationalite'];
                $partenaire->nbre_enfant = $_POST['sai_nbre_enfant'];
                $partenaire->quartier = $_POST['sai_quartier'];
                $partenaire->sexe = $_POST['sai_sexe'];
                $partenaire->sit_matri = $_POST['sai_situtation'];
                $partenaire->ville = $_POST['sai_ville'];
                $partenaire->nom_prenom = $_POST['sai_nom_prenom'];
                $partenaire->email = $_POST['sai_email'];
                $partenaire->telephone = $_POST['sai_telephone'];
                $partenaire->login = $_POST['sai_login'];
                $partenaire->mdp = $_POST['sai_mdp'];
                $partenaire->role = "partenaire";
                $partenaire->matricule = $_POST['sai_matricule'];
                $partenaire->date_creation = $_POST['sai_date_creation'];
                $partenaire->photo = $_POST['sai_matricule'] . $_FILES['sai_photo']['name'];
                $partenaire->etat = $_POST['sai_etat'];

                $exec = $partenaire->ajouterUtilisateurComplet();
            }

            if (!empty($exec)) {

                $message = "Enregistrement effectué avec succes !";
            } else {

                $message = "Echec de l'enregistrement ";
            }
        }
// le bouton modifier
        if (isset($_POST['btn_modifier'])) {

            $partenaire->id = $_POST['sai_id'];
            $partenaire->nom_prenom = $_POST['sai_nom_prenom'];
            $partenaire->email = $_POST['sai_email'];
            $partenaire->telephone = $_POST['sai_telephone'];
            $partenaire->login = $_POST['sai_login'];
            $partenaire->mdp = $_POST['sai_mdp'];
            $partenaire->role = "Partenaire";
            $partenaire->matricule = $_POST['sai_matricule'];
            $partenaire->date_creation = $_POST['sai_date_creation'];
            $partenaire->date_naissance = $_POST['sai_date_naissance'];
            $partenaire->lieu_naissance = $_POST['sai_lieu_naissance'];
            $partenaire->nationalite = $_POST['sai_nationalite'];
            $partenaire->nbre_enfant = $_POST['sai_nbre_enfant'];
            $partenaire->quartier = $_POST['sai_quartier'];
            $partenaire->sexe = $_POST['sai_sexe'];
            $partenaire->sit_matri = $_POST['sai_situtation'];
            $partenaire->ville = $_POST['sai_ville'];

            $partenaire->etat = $_POST['sai_etat'];

            if (!empty($_FILES['sai_photo']['name'])) {
                $u1 = upload_image('sai_photo', "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
                if (!empty($u1)) {
                    $partenaire->photo = $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name'];
                    $exec = $partenaire->modifierUtilisateur_avec_photoComplet();
                }
            } else {
                $exec = $partenaire->modifierUtilisateur_sans_photoComplet();
            }

            if (!empty($exec)) {

                $message = "Modification effectuée avec succes !";
            } else {

                $message = "Echec de la modification ";
            }
        }

        // bouton supprimer
        if (isset($_POST['btn_supprimer'])) {
            $partenaire->login = $_POST['sai_login'];
            $exec = $partenaire->supprimerUtilisateur();

            if (!empty($exec)) {

                $message = "Suppression effectuée avec succes !";
            } else {

                $message = "Echec de la suppression ";
            }
        }

// bouton rechercher par post
        if (isset($_POST['btn_rechercher'])) {

            $log = $_POST['sai_rechercher'];

            $sol = $partenaire->rechercherpartenaire($log);

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
                $message = "Ce partenaire n'existe pas !";
            }
        }


        //fonction rechercher par get
        if (isset($_GET['matricule'])) {

            $rech = $_GET['matricule'];

            $sol = $partenaire->rechercherpartenaire($rech);

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


                $message = "Ce partenaire n'as pas été retrouvé  !";
            }
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/partenaire/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/partenaire/connexion');</script>";
            exit();
        }


        include 'views/partenaire/enregistrement_partenaire.php';
    }

    public function liste() {
        $partenaire = new partenairemodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $partenaire->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $partenaire->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $partenaire->NbreProduitInactifs();
            $notif = new partenairemodel();
        }

        $sol = $partenaire->listepartenaire();

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/partenaire/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'partenaire' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/partenaire/connexion');</script>";
            exit();
        }

        include 'views/partenaire/liste_partenaire.php';
    }

   
}
