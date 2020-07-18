<?php

require 'models/notification.php';
require 'config/function.php';

class notification {

    public function index() {
        $notif = new NotificationsModel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $notif->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $notif->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $notif->NbreProduitInactifs();
        }

        include 'views/index.php';
    }

    public function ajout() {
        $notif = new NotificationsModel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $notif->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $notif->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $notif->NbreProduitInactifs();
        }

        $message = "";

        if (!empty($_SESSION['abonnement'])) {
            if (new DateTime(date('d-m-Y')) <= new DateTime($_SESSION['abonnement'])) {
                
            } else {
                ?>
                <script>
                    alert("Votre abonnement a expiré! \n Pensez à renouveler avant d'utiliser ce service!");
                    window.history.back();
                </script>



                <?php

            }
        }
        if (isset($_POST['btn_envoyer'])) {

            $notif->setTitre(filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING));
            $notif->setObjet(filter_input(INPUT_POST, 'objet', FILTER_SANITIZE_STRING));
            $notif->setText(filter_input(INPUT_POST, 'texte', FILTER_SANITIZE_STRING));
            $notif->setDate(date('Y-m-d H:i:s'));
            $notif->setUser($_SESSION['user_id']);
            if (isset($_FILES['file']) AND ! empty($_FILES['file']['name'])) {
                $way = "upload/photo/" . $_FILES['file']['name'];
                $res = move_uploaded_file($_FILES['file']['tmp_name'], $way);
                if ($res) {
                    $notif->setFichier($_FILES['file']['name']);
                    $exe = $notif->ajouterNotification_Avec_Pieces_Jointes();
                    if ($exe) {
                        $message = "Ajout effectuée avec succès";
                    } else {
                        $message = "Echec de l'ajout";
                    }
                }
            } else {

                $exe = $notif->ajouterNotification_Sans_Pieces_Jointes();
                if ($exe) {
                    $message = "Ajout effectuée avec succès";
                } else {
                    $message = "Echec de l'ajout";
                }
            }
            $id_notification = $notif->con->lastInsertId();
            $user = $notif->liste_user();

            foreach ($user as $key => $value) {

                /* $dest = $value['email'];
                  $mess = $notif->getText();
                  $obj = $notif->getObjet();
                  $header = "MIME-version: 1.0\r\n";
                  $header .= 'From: '.$_SESSION['email']. "\n";
                  $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                  $header .= 'Content-Transfer-Encoding: 8bit';
                  mail($dest, $obj, $mess, $header); */

                $notif->setId($id_notification);
                $notif->setUser($value['id']);
                $notif->ajouterNotification_additif();
            }
        }



        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }



        include 'views/notifications/ajout.php';
    }

    public function liste() {
        $notif = new NotificationsModel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $notif->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $notif->nbre_notification_Non_Lue($_SESSION['user_id']);
            $nns = $notif->notification_Non_supprimee($_SESSION['user_id']);
            $inacts = $notif->NbreProduitInactifs();
        }

        

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'partenaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'stagiaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        include 'views/notifications/liste.php';
    }

    public function details() {
        $notif = new NotificationsModel();
        $message = "";

        $not = filter_input(INPUT_GET, 'nt', FILTER_SANITIZE_NUMBER_INT);


        if (!empty($_SESSION['user_id'])) {
            $notif->setUser($_SESSION['user_id']);
            $notif->setNotification($not);
            $notif->lire_notification();
            $nnl = $notif->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $notif->nbre_notification_Non_Lue($_SESSION['user_id']);
            $nns = $notif->notification_Non_supprimee($_SESSION['user_id']);
            $inacts = $notif->NbreProduitInactifs();
        }

        $details = $notif->details_notification($not);
//        var_dump($details);
//        die();
        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'partenaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'stagiaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        include 'views/notifications/details.php';
    }

    public function supprimer() {
        $notif = new NotificationsModel();
        $not = filter_input(INPUT_GET, 'nt', FILTER_SANITIZE_NUMBER_INT);

        if (!empty($_SESSION['user_id'])) {
            $notif->setUser($_SESSION['user_id']);
            $notif->setNotification($not);
            $notif->supprimer_notification();
            $nnl = $notif->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $notif->nbre_notification_Non_Lue($_SESSION['user_id']);
            $nns = $notif->notification_Non_supprimee($_SESSION['user_id']);
            $inacts = $notif->NbreProduitInactifs();
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'partenaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'stagiaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        include 'views/notifications/liste.php';
    }

    public function forfait() {

        $notif = new NotificationsModel();
        $message = "";

        if (!empty($_SESSION['user_id'])) {
            $notif->setUser($_SESSION['user_id']);
            $nnl = $notif->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $notif->nbre_notification_Non_Lue($_SESSION['user_id']);
            $nns = $notif->notification_Non_supprimee($_SESSION['user_id']);
            $inacts = $notif->NbreProduitInactifs();
        }
        $lespartenaires = $notif->avoirMatriculePartenaire();

        if (isset($_POST['btn_envoyer'])) {
            $notif->setMat($_POST['parte']);
            $notif->setDate(date('d-m-Y'));
            $notif->setDebut(date('d-m-Y', strtotime($_POST['debut'])));
            $duree = $_POST['duree'];
            $notif->setFin(date('d-m-Y', strtotime("+ $duree month", strtotime($notif->getDebut()))));
            $exe = $notif->forfait_notification();
           
            if ($exe) {
                $message = "Forfait activé avec succès";
            } else {
                $message = "Echec de l'activation du forfait";
            }
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }

         include 'views/notifications/forfait_notification.php';
    }

}

?>