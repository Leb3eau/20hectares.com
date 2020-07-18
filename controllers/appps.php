<?php

$cnx = new PDO('mysql:host=localhost; dbname=20hectares', 'root', '');


if ($_POST) {

    $ref = $_POST['id'];

    if (!empty($_FILES['sai_photo']['name'])) {
        $photos = $_FILES['sai_photo'];
        for ($i = 0; $i < count($photos['name']); $i++) {
            $destination = "../upload/produits/" . $ref . $photos['name'][$i];
            $fichier = $ref . $photos['name'][$i];
            move_uploaded_file($photos['tmp_name'][$i], $destination);

            $req = $cnx->prepare('INSERT INTO album VALUES(NULL, :fic, :p)');
            $req->bindParam(":fic", $fichier);
            $req->bindParam(":p", $ref);
            $res = $req->execute();
        }
    }
    echo "<script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/produit/liste');</script>";
}
