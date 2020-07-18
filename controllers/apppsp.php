<?php

session_start();
$cnx = new PDO('mysql:host=localhost; dbname=20hectares', 'root', '');

if ($_POST) {

    $char = '0123456789';
    $code = '';
    for ($i = 0; $i < 3; $i++) {
        $code .= $char[rand() % strlen($char)];
    }

    $reference_produit = date('y') . "REF" . $code;
    $libelle_produit = $_POST['sai_libelle_produit'];
    $details_produit = $_POST['sai_details_produit'];
    $prix_normal = $_POST['sai_prix_normal'];
    $prix_reduction = $_POST['sai_prix_reduction'];
    $devise = $_POST['sai_devise'];
    $quota = $prix_reduction - $prix_normal;
    $type_produit = $_POST['sai_type_produit'];
    $pays = $_POST['sai_pays'];
    $ville = $_POST['sai_ville'];
    $quartier = $_POST['sai_quartier'];
    $adresse = $_POST['sai_adr'];
    $etat_produit = $_POST['sai_etat_produit'];


    $req = $cnx->prepare('INSERT INTO produit VALUES(:reference_produit,:libelle_produit,:details_produit,:prix_normal,:prix_reduction,:devise,:quota,:categorie_produit,:pays, :ville, :adr, :quar, :etat_produit, :cf)');

    $req->bindParam(':reference_produit', $reference_produit);
    $req->bindParam(':libelle_produit', $libelle_produit);
    $req->bindParam(':details_produit', $details_produit);
    $req->bindParam(':prix_normal', $prix_normal);
    $req->bindParam(':prix_reduction', $prix_reduction);
    $req->bindParam(':devise', $devise);
    $req->bindParam(':quota', $quota);
    $req->bindParam(':categorie_produit', $type_produit);
    $req->bindParam(':pays', $pays);
    $req->bindParam(':ville', $ville);
    $req->bindParam(':adr', $adresse);
    $req->bindParam(':quar', $quartier);
    $req->bindParam(':etat_produit', $etat_produit);
    $req->bindParam(':cf', $_SESSION['matricule']);
    $enrProd = $req->execute();

    if ($enrProd) {
        $message = "Ajout effectué avec succes";


        if (!empty($_FILES['sai_photo']['name'])) {
            $photos = $_FILES['sai_photo'];
            for ($i = 0; $i < count($photos['name']); $i++) {
                $destination = "../upload/produits/" . $reference_produit . $photos['name'][$i];
                $fichier = $reference_produit . $photos['name'][$i];
                move_uploaded_file($photos['tmp_name'][$i], $destination);

                $req = $cnx->prepare('INSERT INTO album VALUES(NULL, :fic, :p)');
                $req->bindParam(":fic", $fichier);
                $req->bindParam(":p", $reference_produit);
                $res = $req->execute();
            }
        }
    }
    echo "<script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/produit/liste');</script>";
}
