<?php

require 'models/commande.php';
require 'config/ChiffresEnLettres.php';

class commande {

    public function enregistrement() {

        //
        $numero_commande = "";
        $prix_produit = "";
        $date_commande = "";
        $montant_commande = "";
        $reference_produit = "";
        $matricule = "";
        $rech = FALSE;

        $message = "";

        // generateur de code 
        $char = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $char[rand() % strlen($char)];
        }

        $code_comm = "COM" . date('y') . $code;

        $message = "Saisissez ce code : " . $code_comm;


        $commande = new commandemodel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $commande->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $commande->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $commande->NbreProduitInactifs();
            $notif = new commandemodel();
        }


        if (isset($_POST['btn_ajouter'])) {

            $ref = $_POST['sai_reference_produit'];
            $prod = $commande->rechercheproduitreference($ref);

            if ($prod) {
                $commande->numero_commande = $_POST['sai_numero_commande'];
                $commande->date_commande = date('Y-m-d');
                $commande->prix_produit = $prod[0]['prix_reduction'];
                $commande->reference_produit = $_POST['sai_reference_produit'];
                $commande->epargne = 0;
                $commande->etat_commande = "En Cours";
                $commande->matricule = $_POST['sai_mat'];
                $res = $commande->ajoutercommande();

                if ($res) {
                    $message = "Enregistrement effectué avec succes";
                } else {
                    $message = "Echec de l'enregistrement";
                }
            } else {
                $message = "Ce produit n'existe pas";
            }
        }



        if (isset($_POST['btn_modifier'])) {


            $ref = $_POST['sai_reference_produit'];
            $prod = $commande->rechercheproduitreference($ref);

            if ($prod) {
                $commande->numero_commande = $_POST['sai_numero_commande'];
                $commande->date_commande = date('Y-m-d');
                $commande->prix_produit = $prod[0]['prix_reduction'];
                $commande->reference_produit = $_POST['sai_reference_produit'];
                $commande->epargne = 0;
                $commande->etat_commande = "En Cours";
                $commande->matricule = $_POST['sai_mat'];
                $res = $commande->modifiercommande();

                if ($res) {
                    $message = "Modification effectuée avec succes";
                } else {
                    $message = "Echec de la modification";
                }
            } else {
                $message = "Ce produit n'existe pas";
            }
        }



        if (isset($_POST['btn_supprimer'])) {

            $commande->numero_commande = $_POST['sai_numero_commande'];

            $res = $commande->supprimercommande();
            if ($res) {
                $message = "Suppression effectuée avec succes";
            } else {
                $message = "Echec de la suppression";
            }
        }


        if (isset($_POST['btn_rechercher'])) {

            $code = $_POST['sai_rechercher'];
            $rech = $commande->recherchercommande($code);
            if (!empty($rech)) {
                $matricule = $rech[0]['matricule'];
                $numero_commande = $rech[0]['numero_commande'];
                $date_commande = $rech[0]['date_commande'];
                $reference_produit = $rech[0]['reference_produit'];
            } else {
                $message = "Cette commande existe dejà";
            }
        }


        if (isset($_GET['numero_commande'])) {
            $code = $_GET['numero_commande'];
            $rech = $commande->recherchercommande($code);
            if (!empty($rech)) {
                $matricule = $rech[0]['matricule'];
                $numero_commande = $rech[0]['numero_commande'];
                $date_commande = $rech[0]['date_commande'];
                $reference_produit = $rech[0]['reference_produit'];
            } else {
                $message = "Cette commande existe dejà";
            }
        }


        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'client') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        if ($_SESSION['role'] == 'client') {
            ?>
            <style type="text/css">
                #modifier{display: none}
                #supprimer{display: none}
                #rech{display: none}
                #date_commande{display: none}
                #prix_produit{display: none}
                #montant_commande{display: none}
                #etat_validation{display: none}
            </style>
            <?php

        }

        if ($_SESSION['role'] == 'admin') {
            ?>
            <style type="text/css">
                #date_commande{display: block;}
                #prix_produit{display: block;}
                #montant_commande{display: block;}
                #etat_validation{display: block;}
            </style>
            <?php

        }



        include 'views/commande/enregistrement_commande.php';
    }

    public function liste() {
        $message = "";
        $commande = new commandemodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $commande->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $commande->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $commande->NbreProduitInactifs();
            $notif = new commandemodel();
        }
        if (isset($_POST['btn_payer'])) {
            $com = $_POST['commande'];
            $mont = $_POST['paye'];
            $faite = $commande->PayerCommande($com, $mont);
            if ($faite) {
                $ref = $commande->recherchercommande($com);
                $fait = $commande->ChangerEtatProduit($ref[0]['reference_produit']);
                if ($fait) {
                    $message = "<center>
                    <label class='alert alert-success'> Paiement effectué avec succès !</label>
                </center>";
                } else {
                    $message = "<center>
                    <label class='alert alert-danger'> Échec de Changement d'etat !</label>
                </center>";
                }
            }else {
                    $message = "<center>
                    <label class='alert alert-danger'> Échec de Paiement !</label>
                </center>";
                }
        }

        $commandes = $commande->listecommandeComplete();


        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        include 'views/commande/liste_commande.php';
    }
    public function imprimer() {        
        $commande = new commandemodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $commande->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $commande->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $commande->NbreProduitInactifs();
            $notif = new commandemodel();
        }
        
        if (isset($_GET['numero_commande'])) {
           $enlettre = new ChiffreEnLettre(); 
            $code = $_GET['numero_commande'];
            $rech = $commande->lacommandeComplete($code);            
            if (!empty($rech)) {
                $matricule = $rech[0]['matricule'];
                $numero_commande = $rech[0]['numero_commande'];
                $date_commande = $rech[0]['date_commande'];
                $reference_produit = $rech[0]['reference_produit'];
                $prix = $rech[0]['prix_produit'];
                $verse = $rech[0]['epargne'];
                $nom_prenom = $rech[0]['nom_prenom'];
                $type = $rech[0]['type_produit'];
                $details = $rech[0]['details_produit'];
                $reste = $prix - $verse;
                 include 'views/commande/recuversement.php';
                
            } else {
                $message = "Cette commande existe dejà";
            }
        }


        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

       
    }

    public function liste_commande_periode() {

        $commande = new commandemodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $commande->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $commande->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $commande->NbreProduitInactifs();
            $notif = new commandemodel();
        }


        if (isset($_POST['btn_payer'])) {
            $com = $_POST['commande'];
            $mont = $_POST['paye'];
            $faite = $commande->PayerCommande($com, $mont);
            if ($faite) {
                $ref = $commande->recherchercommande($com);
                $fait = $commande->ChangerEtatProduit($ref[0]['reference_produit']);
                if ($fait) {
                    $message = "<center>
                    <label class='alert alert-success'> Paiement effectué avec succès !</label>
                </center>";
                } else {
                    $message = "<center>
                    <label class='alert alert-danger'> Échec de Changement d'etat !</label>
                </center>";
                }
            }else {
                    $message = "<center>
                    <label class='alert alert-danger'> Échec de Paiement !</label>
                </center>";
                }
        }

        if (isset($_POST['btn_rechercher'])) {

            $dd = $_POST['sai_date_debut'];
            $df = $_POST['sai_date_fin'];

            $commandes = $commande->recherchercommandeperiode($dd, $df);
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        include 'views/commande/liste_commande_periode.php';
    }

// commande par client par periode
    public function liste_commande_periode_client() {

        $commande = new commandemodel();
        if (!empty($_SESSION['user_id'])) {
                $nnl = $commande->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $commande->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $commande->NbreProduitInactifs();
            $notif = new commandemodel();
        }



        if (isset($_POST['btn_rechercher'])) {


            $mat = $_POST['sai_rechercher'];
            $dd = $_POST['sai_date_debut'];
            $df = $_POST['sai_date_fin'];

            $sol = $commande->recherchercommandeperiodelog($dd, $df, $mat);
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] == 'client' and $_SESSION['role'] == 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }



        if ($_SESSION['role'] == 'client' OR $_SESSION['role'] == 'partenaire') {
            ?>
            <style type="text/css">
                #operation{display: none}
                #operat{display: none}
            </style>
            <?php

        }


        include 'views/commande/liste_commande_periode_client.php';
    }

// commande par client
    public function liste_commande_client() {

        $commande = new commandemodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $commande->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $commande->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $commande->NbreProduitInactifs();
            $notif = new commandemodel();
        }

        if (isset($_POST['btn_payer'])) {
            $com = $_POST['commande'];
            $mont = $_POST['paye'];
            $faite = $commande->PayerCommande($com, $mont);
            if ($faite) {
                $ref = $commande->recherchercommande($com);
                $fait = $commande->ChangerEtatProduit($ref[0]['reference_produit']);
                if ($fait) {
                    $message = "<center>
                    <label class='alert alert-success'> Paiement effectué avec succès !</label>
                </center>";
                } else {
                    $message = "<center>
                    <label class='alert alert-danger'> Échec de Changement d'etat !</label>
                </center>";
                }
            }else {
                    $message = "<center>
                    <label class='alert alert-danger'> Échec de Paiement !</label>
                </center>";
                }
        }
        
        $commandes = $commande->recherchercommandeclient($_SESSION['matricule']);
        
        if (isset($_POST['btn_rechercher'])) {

            $log = $_POST['sai_rechercher'];
            $commandes = $commande->recherchercommandeclient($log);
        }

        // debut de la protection
        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'client') {
            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        if ($_SESSION['role'] == 'client') {
            ?>            
            <style>
                .operation{display:none;}
            </style>
            <?php

        }


        include 'views/commande/liste_commande_client.php';
    }

    // commande par client
    public function liste_commande_partenaire() {

        $commande = new commandemodel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $commande->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $commande->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $commande->NbreProduitInactifs();
            $notif = new commandemodel();
        }

            $suivi = $commande->recherchercommandepartenaire($_SESSION['matricule']);
       

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

        if ($_SESSION['role'] == 'partenaire') {
            ?>

            <style>
                .operation{display:none;}
            </style>
            <?php

        }


        include 'views/commande/liste_commande_partenaire.php';
    }

}
