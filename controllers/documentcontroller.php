<?php
session_start();
require 'models/document.php';

class document {

    public function enregistrement() {

        //
        $piece_jointe_document = "";
        $code_document = "";
        $titre_document = "";
        $date_document = "";
        $auteur_document = "";
        $description_document = "";
        $domaine_document = "";
        $categorie_document = "";
        $etat_document = "";

        $message="";
        

        $document = new documentmodel();
        if(!empty($_SESSION['user_id'])){
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }

        

        if (isset($_POST['btn_ajouter']) and !empty($_FILES['sai_piece_jointe_document'])) {

            move_uploaded_file($_FILES['sai_piece_jointe_document']['tmp_name'], "upload/documents/".$_POST['sai_auteur_document'].$_FILES['sai_piece_jointe_document']['name']);
            

            $document->piece_jointe_document = $_POST['sai_auteur_document'].$_FILES['sai_piece_jointe_document']['name'];
            $document->code_document = $_POST['sai_code_document'];
            $document->date_document = $_POST['sai_date_document'];
            $document->auteur_document = $_POST['sai_auteur_document'];
            $document->description_document = $_POST['sai_description_document'];
            $document->titre_document = $_POST['sai_titre_document'];
            $document->categorie_document = $_POST['sai_categorie_document'];
            $document->domaine_document = $_POST['sai_domaine_document'];
            $document->etat_document = $_POST['sai_etat_document'];

            $res = $document->ajouterdocument();
            

     $_SESSION['piece_jointe_document'] = $_FILES['sai_piece_jointe_document']['name'];
   if($res)

    { 
$message = "Enregistrement effectué avec succes";

     } 
      else{
        $message = "Echec de l'enregistrement";
      }


        }


        if (isset($_POST['btn_modifier']) and !empty($_FILES['sai_piece_jointe_document'])) {

            move_uploaded_file($_FILES['sai_piece_jointe_document']['tmp_name'], "upload/documents/" . $_POST['sai_auteur_document'] .$_FILES['sai_piece_jointe_document']['name']);
            

            $document->piece_jointe_document = $_POST['sai_auteur_document'].$_FILES['sai_piece_jointe_document']['name'];
            $document->code_document = $_POST['sai_code_document'];
            $document->date_document = $_POST['sai_date_document'];
            $document->auteur_document = $_POST['sai_auteur_document'];
            $document->description_document = $_POST['sai_description_document'];
            $document->titre_document = $_POST['sai_titre_document'];
            $document->categorie_document = $_POST['sai_categorie_document'];
            $document->domaine_document = $_POST['sai_domaine_document'];
            $document->etat_document = $_POST['sai_etat_document'];


            $res = $document->modifierdocument();

     $_SESSION['piece_jointe_document'] = $_FILES['sai_piece_jointe_document']['name'];


   if($res)

    { 
$message = "Modification effectuée avec succes";

     } 
      else{
        $message = "Echec de la modification";
      }


        }



        if (isset($_POST['btn_supprimer'])) {

           
            $document->code_document = $_POST['sai_code_document'];

           $res = $document->supprimerdocument();
   if($res)

    { 
$message = "Suppression effectuée avec succes";

     } 
      else{
        $message = "Echec de la suppression";
      }


        }


        if (isset($_POST['btn_rechercher'])) {

            $code = $_POST['sai_rechercher'];
            $rech = $document->rechercherdocumentcode($code);
           
           if(!empty($rech))
           {
            $piece_jointe_document = $rech[0]['piece_jointe_document'];
            $code_document = $rech[0]['code_document'];
            $date_document = $rech[0]['date_document'];
            $titre_document = $rech[0]['titre_document'];
            $auteur_document = $rech[0]['auteur_document'];
            $description_document = $rech[0]['description_document'];
            $categorie_document = $rech[0]['categorie_document'];
            $domaine_document = $rech[0]['domaine_document'];
            $etat_document = $rech[0]['etat_document'];
            }
            else{
           $message = "Ce document existe dejà";
        } 

        }


        if (isset($_GET['code'])) {

            $code = $_GET['code'];
            $rech = $document->rechercherdocumentcode($code);
           
           if(!empty($rech))
           {
            $piece_jointe_document = $rech[0]['piece_jointe_document'];
            $code_document = $rech[0]['code_document'];
            $date_document = $rech[0]['date_document'];
            $titre_document = $rech[0]['titre_document'];
            $auteur_document = $rech[0]['auteur_document'];
            $description_document = $rech[0]['description_document'];
            $categorie_document = $rech[0]['categorie_document'];
            $domaine_document = $rech[0]['domaine_document'];
            $etat_document = $rech[0]['etat_document'];
            }
            else{
         
            $message = "Ce document n'existe pas";
         
        } 

        }


         // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='admin')
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

       


        include 'views/document/enregistrement_document.php';
    }

    public function liste()
    {
        $document = new documentmodel();

        if(!empty($_SESSION['user_id']))
        {
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }

        $sol = $document->listedocument();


         // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='admin')
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

        include 'views/document/liste_documents.php';
    }


    public function saisie() {

        //
        $piece_jointe_document = "";
        $code_document = "";
        $titre_document = "";
        $date_document = "";
        $auteur_document = "";
        $description_document = "";
        $domaine_document = "";
        $categorie_document = "";
        $etat_document = "";

        $message="";
        

        $document = new documentmodel();
        if(!empty($_SESSION['user_id'])){
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }

        

        if (isset($_POST['btn_ajouter']) and !empty($_FILES['sai_piece_jointe_document'])) {

            move_uploaded_file($_FILES['sai_piece_jointe_document']['tmp_name'], "upload/documents/".$_POST['sai_auteur_document'].$_FILES['sai_piece_jointe_document']['name']);
            

            $document->piece_jointe_document = $_POST['sai_auteur_document'].$_FILES['sai_piece_jointe_document']['name'];
            $document->code_document = $_FILES['sai_piece_jointe_document']['name'];
            $document->date_document = $_POST['sai_date_document'];
            $document->auteur_document = $_POST['sai_auteur_document'];
            $document->description_document = $_POST['sai_description_document'];
            $document->titre_document = $_POST['sai_titre_document'];
            $document->categorie_document = $_POST['sai_categorie_document'];
            $document->domaine_document = $_POST['sai_domaine_document'];
            $document->etat_document = $_POST['sai_etat_document'];

            $res = $document->ajouterdocument();
            

     $_SESSION['piece_jointe_document'] = $_FILES['sai_piece_jointe_document']['name'];
   if(!empty($res))

    { 
$message = "Enregistrement effectué avec succes";

     } 
      else{
        $message = "Echec de l'enregistrement";
      }


        }



        if (isset($_GET['code'])) {

            $code = $_GET['code'];
            $rech = $document->rechercherdocumentcode($code);
           
           if(!empty($rech))
           {
            $piece_jointe_document = $rech[0]['piece_jointe_document'];
            $code_document = $rech[0]['code_document'];
            $date_document = $rech[0]['date_document'];
            $titre_document = $rech[0]['titre_document'];
            $auteur_document = $rech[0]['auteur_document'];
            $description_document = $rech[0]['description_document'];
            $categorie_document = $rech[0]['categorie_document'];
            $domaine_document = $rech[0]['domaine_document'];
            $etat_document = $rech[0]['etat_document'];
            }
            else{
         
            $message = "Ce document n'existe pas";
         
        } 

        }


         // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='stagiaire')
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

       


        include 'views/document/envoi_document.php';
    }


    public function liste_documents_stagiaire() {

        $document = new documentmodel();
        if(!empty($_SESSION['user_id'])){
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }

if(isset($_POST['btn_rechercher']))
        {

        $rech = $_POST['sai_rechercher'];
        $sol = $document->rechercherdocumentmat($rech);

        } 

         // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='admin')
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

        include 'views/document/liste_documents_stagiaire.php';
    }


    public function liste_documents_extension() {

        $document = new documentmodel();
        if(!empty($_SESSION['user_id'])){
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }

        if(isset($_POST['btn_rechercher']))
        {

        

        $ext = $_POST['sai_rechercher'];

        $sol = $document->rechercheextension($ext);
        }

          // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='admin')
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

        include 'views/document/liste_documents_extension.php';
    }

    public function liste_documents_nom() {

        $document = new documentmodel();
        if(!empty($_SESSION['user_id'])){
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }


        $sol = $document->recherchecategorie();

        if(isset($_POST['btn_rechercher']))
        {


        $doc = $_POST['sai_rechercher'];

        $solution = $document->recherchedocumentnom($doc);

    }

          // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='admin')
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

        include 'views/document/liste_documents_nom.php';
    }


    public function liste_dossiers_stagiaire() {

        $document = new documentmodel();
        if(!empty($_SESSION['user_id'])){
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }

        $rech = $_SESSION['matricule'];
        $sol = $document->rechercherdocumentmat($rech);

        
          // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='stagiaire')
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

        include 'views/document/liste_dossiers_stagiaire.php';
    }

public function achat() {


        $document = new documentmodel();
        if(!empty($_SESSION['user_id'])){
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }
        $message="";


        if (isset($_POST['btn_rechercher'])) {
            $doc = $_POST['sai_rechercher'];            
            $sol = $document->rechercherDocumentFiliere($doc);            
        }

        if (isset($_POST['btn_acheter'])) {

            $message="Contactez l'administrateur au 09107849";            
        }
        

         // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='stagiaire' and $_SESSION['role']!='admin')
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

        include "views/document/achat_document.php";
    }


    public function telechargement() {


        $document = new documentmodel();
        if(!empty($_SESSION['user_id'])){
        $nnl = $document->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $document->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $document->NbreProduitInactifs();
        $notif = new documentmodel();
        }
        $message="";
            
            $sol = $document->rechercherdocumentPublique();

         // debut de la protection

        if(!isset($_SESSION['login']) and !isset($_SESSION['mdp']))
        {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();


        }


        if($_SESSION['role']!='stagiaire' )
        {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();

        }

        include "views/document/telechargement.php";
    }



}
