<?php
class NotificationsModel {
    private $id;
    private $mat;
    private $debut;
    private $fin;
    private $objet;
    private $titre;
    private $text;
    private $date;
    private $user;
    private $fichier;
    private $notification;
    private $lecture;
    private $affichage;
    public $con;
    
    function __construct() {
        require 'database/connexion.php';
        
    }
    public function NbreProduitInactifs() {
        $req = $this->con->prepare('SELECT * FROM produit WHERE etat_produit="Inactif"');
        $req->execute();
        $nbre = $req->rowCount();
        return $nbre;
    }
    
    function getId() {
        return $this->id;
    }
    function getNotification() {
        return $this->notification;
    }

    function setNotification($notification) {
        $this->notification = $notification;
    }

        function getLecture() {
        return $this->lecture;
    }

    function getAffichage() {
        return $this->affichage;
    }

    function getCon() {
        return $this->con;
    }

    function setLecture($lecture) {
        $this->lecture = $lecture;
    }

    function setAffichage($affichage) {
        $this->affichage = $affichage;
    }

    function setCon($con) {
        $this->con = $con;
    }

    
    function getObjet() {
        return $this->objet;
    }

    function getTitre() {
        return $this->titre;
    }

    function getText() {
        return $this->text;
    }

    function getDate() {
        return $this->date;
    }

    function getUser() {
        return $this->user;
    }

    function getFichier() {
        return $this->fichier;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setObjet($objet) {
        $this->objet = $objet;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setFichier($fichier) {
        $this->fichier = $fichier;
    }
    function getMat() {
        return $this->mat;
    }

    function getDebut() {
        return $this->debut;
    }

    function getFin() {
        return $this->fin;
    }

    function setMat($mat) {
        $this->mat = $mat;
    }

    function setDebut($debut) {
        $this->debut = $debut;
    }

    function setFin($fin) {
        $this->fin = $fin;
    }

    

    function ajouterNotification_Avec_Pieces_Jointes(){
        $sql="INSERT INTO notifications VALUES(NULL, :o, :tit, :text, :date, :u, :f)";
        $req= $this->con->prepare($sql);
        $req->bindParam(':o', $this->objet);
        $req->bindParam(':tit', $this->titre);
        $req->bindParam(':text', $this->text);
        $req->bindParam(':date', $this->date);
        $req->bindParam(':u', $this->user);
        $req->bindParam(':f', $this->fichier);
        $res = $req->execute();
        
      return $res;
    }
   
    function ajouterNotification_Sans_Pieces_Jointes(){
        $sql="INSERT INTO notifications VALUES(NULL, :o, :tit, :tex, :dat, :u, NULL)";
        $req= $this->con->prepare($sql);
        $req->bindParam(':o', $this->objet);
        $req->bindParam(':tit', $this->titre);
        $req->bindParam(':tex', $this->text);
        $req->bindParam(':dat', $this->date);
        $req->bindParam(':u', $this->user);
        $res = $req->execute();

        return $res;
    }
    
    function ajouterNotification(){
        $sql="INSERT INTO notifications VALUES(NULL, :o, :tit, :text, :date, :u)";
        $req= $this->con->prepare($sql);
        $req->bindParam(':o', $this->objet);
        $req->bindParam(':tit', $this->titre);
        $req->bindParam(':text', $this->text);
        $req->bindParam(':date', $this->date);
        $req->bindParam(':u', $this->user);
        $res = $req->execute();
        return $res;
        
    }
    
    function ajouterNotification_additif(){
        $sql="INSERT INTO vue VALUES(NULL, :not, :u, '0', '1')";
        $req= $this->con->prepare($sql);
        $req->bindParam(':not', $this->id);
        $req->bindParam(':u', $this->user);
        $res = $req->execute();
        return $res;
        
    }
    
    function liste_user(){
        $sql="SELECT * FROM utilisateur";
        $req= $this->con->prepare($sql);
        $res = $req->execute();
        $resul=$req->fetchAll();
        return $resul;
    }
    
    function notification_Non_Lue($u){
        $sql="SELECT * FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=0 AND vue.user=:u ORDER BY notifications.id DESC";
        $req= $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $res = $req->fetchAll();
        return $res;        
    }
    
    function nbre_notification_Non_Lue($u){
        $sql="SELECT * FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=0 AND vue.user=:u";
        $req= $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute() or die(print_r($this->con->ErrorInfo()));
        $nbre = $req->rowCount();
        return $nbre;      
    }
    
    function details_notification($u){
        $sql="SELECT * FROM notifications, utilisateur WHERE utilisateur.id=notifications.user AND notifications.id=:u";
        $req= $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute() or die(print_r($this->con->ErrorInfo()));
        $res = $req->fetchAll();
        return $res;        
    }
    
    function notification_Non_supprimee($u){
        $sql="SELECT * FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.affichage=1 AND vue.user=:u ORDER BY notifications.id DESC";
        $req= $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $res = $req->fetchAll();
        return $res;        
    }
    
    function proprietaire_de_notification($u){
        $sql="SELECT utilisateur.*, notifications.id FROM notifications,utilisateur WHERE utilisateur.id=notifications.user AND notifications.id=:u";
        $req= $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute();
        $res = $req->fetchAll();
        return $res;        
    }
    
    public function avoirMatriculePartenaire() {
        $req = $this->con->prepare('SELECT * FROM utilisateur WHERE role="partenaire"');
        $req->execute();
        $l = $req->fetchAll();
        return $l;
    }

    
    function supprimer_notification(){
        $sql="UPDATE vue SET affichage=0 WHERE user=:u AND notification=:not";
        $req= $this->con->prepare($sql);
        $req->bindParam(':not', $this->notification);
        $req->bindParam(':u', $this->user);
        $l = $req->execute();
       return $l;      
    }
    
    function forfait_notification(){
        $sql="INSERT INTO forfait VALUES(NULL, :mat, :dat, :deb, :fin)";
        $req= $this->con->prepare($sql);
        $req->bindParam(':mat', $this->mat);
        $req->bindParam(':dat', $this->date);
        $req->bindParam(':deb', $this->debut);
        $req->bindParam(':fin', $this->fin);
        $res= $req->execute() ;
        
        return $res;
        
    }
    
    
    function lire_notification(){
        $sql="UPDATE vue SET lecture=1 WHERE user=:u AND notification=:not";
        $req= $this->con->prepare($sql);
        $req->bindParam(':not', $this->notification);
        $req->bindParam(':u', $this->user);
        $l = $req->execute();
        return $l;
               
    }
    
    
    
    
    
    
    

    
}
