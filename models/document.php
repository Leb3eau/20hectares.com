<?php 
class documentmodel
{
  public $code_document;
  public $date_document;
  public $categorie_document;
  public $titre_document;
  public $domaine_document;
  public $description_document;
  public $piece_jointe_document;
  public $auteur_document;
  public $etat_document;
  public $con;

  function __construct()
  {
   require "database/connexion.php";
 }

 // generation de code
public function NbreProduitInactifs() {
        $req = $this->con->prepare('SELECT * FROM produit WHERE etat_produit="Inactif"');
        $req->execute();
        $nbre = $req->rowCount();
        return $nbre;
    }
// Ajouter
 public function ajouterdocument()
 {  
   $req = $this->con->prepare('INSERT INTO document VALUES(:code_document,:date_document,:categorie_document,:titre_document,:domaine_document,:description_document,:piece_jointe_document,:auteur_document,:etat_document)');

   $req->bindParam(':auteur_document',$this->auteur_document);
   $req->bindParam(':date_document',$this->date_document);
   $req->bindParam(':titre_document',$this->titre_document);
   $req->bindParam(':piece_jointe_document',$this->piece_jointe_document);
   $req->bindParam(':categorie_document',$this->categorie_document);
   $req->bindParam(':domaine_document',$this->domaine_document);
   $req->bindParam(':description_document',$this->description_document);
   $req->bindParam(':code_document',$this->code_document);
   $req->bindParam(':etat_document',$this->etat_document);

   $sol = $req->execute();

 return $sol;
    } 

    
    

// Modifier
    public function modifierdocument()
    {
     $req = $this->con->prepare('UPDATE document SET auteur_document=:auteur_document,
      date_document=:date_document,piece_jointe_document=:piece_jointe_document,titre_document=:titre_document,categorie_document=:categorie_document,description_document=:description_document,domaine_document=:domaine_document,etat_document=:etat_document WHERE code_document=:code_document');

   $req->bindParam(':auteur_document',$this->auteur_document);
   $req->bindParam(':date_document',$this->date_document);
   $req->bindParam(':titre_document',$this->titre_document);
   $req->bindParam(':piece_jointe_document',$this->piece_jointe_document);
   $req->bindParam(':categorie_document',$this->categorie_document);
   $req->bindParam(':domaine_document',$this->domaine_document);
   $req->bindParam(':description_document',$this->description_document);
   $req->bindParam(':code_document',$this->code_document);
   $req->bindParam(':etat_document',$this->etat_document);

   $sol = $req->execute();
return $sol;
 
      }

// Supprimer
      public function supprimerdocument()
      {
       $req = $this->con->prepare('DELETE FROM document WHERE code_document=:code_document');
       $req->bindParam(':code_document',$this->code_document);
       $req->execute();
       $sol = $req->execute();
 return $sol;
      }

// Rechercher des documents par auteur_document et code
      public function rechercherdocument($rech1,$rech2)
      {
       $req = $this->con->prepare('SELECT * FROM document WHERE auteur_document=:auteur_document AND code_document=:code_document');
       $req->bindParam(':auteur_document',$rech1);
       $req->bindParam(':code_document',$rech2);
       $req->execute();
       $sol = $req->fetchAll();
       return $sol;
     }

     // Rechercher des documents par auteur_document seulement
      public function rechercherdocumentmat($rech1)
      {
       $req = $this->con->prepare('SELECT * FROM document WHERE auteur_document=:auteur_document');
       $req->bindParam(':auteur_document',$rech1);
       $req->execute();
       $sol = $req->fetchAll();
       return $sol;
     }

 public function rechercherdocumentcode($rech1)
      {
       $req = $this->con->prepare('SELECT * FROM document WHERE code_document=:code_document');
       $req->bindParam(':code_document',$rech1);
       $req->execute();
       $sol = $req->fetchAll();
       return $sol;
     }

     public function rechercherDocumentFiliere($rech)
      {
       $req = $this->con->prepare('SELECT * FROM document WHERE domaine_document=:domaine_document');
       $req->bindParam(':domaine_document',$rech);
       $req->execute();
       $sol = $req->fetchAll();
       return $sol;
     }
   

    public function rechercherdocumentTous()
    {
     $req = $this->con->prepare('SELECT * FROM document');
     $req->execute();
     $sol = $req->fetchAll();
     return $sol;
   }

   public function rechercherdocumentPublique()
    {
     $req = $this->con->prepare('SELECT * FROM document WHERE etat_document="Publique" ');
     $req->execute();
     $sol = $req->fetchAll();
     return $sol;
   }



public function recherchecategorie()
{
  

  $req=$this->con->prepare('SELECT DISTINCT(categorie_document) FROM document');
  $req->execute();
  $sol = $req->fetchAll();
  return $sol;
}

public function recherchedocumentnom($rech)
{
  

  $req=$this->con->prepare('SELECT * FROM document WHERE categorie_document =:categorie_document');
  $req->bindParam(':categorie_document',$rech);
  $req->execute();
  $sol = $req->fetchAll();
  return $sol;
}

public function rechercheextension($rech)
{
  

  $req=$this->con->prepare("SELECT * FROM document WHERE piece_jointe_document LIKE '%".$rech."%' ");
  $req->execute();
  $sol = $req->fetchAll();
  
  return $sol;
}

public function listedocument()
{
  

  $req=$this->con->prepare('SELECT * FROM document');
  $req->execute();
  $sol = $req->fetchAll();
  return $sol;
}

function notification_Non_Lue($u){
        $sql="SELECT * FROM notifications,utilisateur,vue WHERE utilisateur.id=vue.user AND vue.notification=notifications.id AND vue.lecture=0 AND vue.user=:u ORDER BY notifications.id DESC";
        $req= $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute() or die(print_r($this->con->ErrorInfo()));
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

    function proprietaire_de_notification($u){
        $sql="SELECT utilisateur.*, notifications.id FROM notifications,utilisateur WHERE utilisateur.id=notifications.user AND notifications.id=:u";
        $req= $this->con->prepare($sql);
        $req->bindParam(':u', $u);
        $req->execute() or die(print_r($this->con->ErrorInfo()));
        $res = $req->fetchAll();
        return $res;        
    }
    
 

 }


 ?>