<?php

$cnx = new PDO('mysql:host=localhost; dbname=20hectares', 'root', '');

$req = $cnx->prepare("select produit from album where id=:id");
$req->bindParam(':id', $_POST['ide']);
$req->execute();
$res = $req->fetchAll();

if (!empty($_FILES['file']['name'])) {

    $photos = $_FILES['file']['name'];
    $ext = strtolower(pathinfo($photos, PATHINFO_EXTENSION));
    $nvo = $_POST['ide'] . "." . $ext;
    $way = "../upload/produits/" . $nvo;
    $reset = move_uploaded_file($_FILES['file']['tmp_name'], $way);
    if ($reset) {
        $req = $cnx->prepare('UPDATE album SET fichier=:fic WHERE id=:i');
        $req->bindParam(':i', $_POST['ide']);
        $req->bindParam(':fic', $nvo);
        $ok = $req->execute() or die(print_r($cnx->errorInfo()));
    }
}

$req = $cnx->prepare("select * from album where produit=:p");
$req->bindParam(':p', $res[0]['produit']);
$req->execute();
$res = $req->fetchAll();
$tab = "<br /><center><h3>ALBUM DE L'ÉLÉMENT " . $res[0]['produit'] . "</h3></center><br />
                                <div class='row'>";
foreach ($res as $value) {
    $tab .= '
                <div class="col-md-2">
                  <img style="width: 100%; height: 70%;" src="http://localhost:81/20hectares.com/upload/produits/' . $value['fichier'] . '" alt="image" title=""/>
                  <center style="margin-top:3%">
                  <span style="cursor: pointer;" class="btn btn-outline-danger" onclick="suppphoto(' . $value['id'] . ')"><i class="fa fa-trash"></i></span>
                  <span style="cursor: pointer;" class="btn btn-outline-warning" ide=' . $value['id'] . ' onclick="affformphoto(' . $value['id'] . ')"><i class="fa fa-edit"></i></span>
                     </center>
                     
            <form method="POST" enctype="multipart/form-data" id="formphoto' . $value['id'] . '" style="display:none; padding-bottom:5%; padding-top:3%">
                <div class="form-group form-inline">
                    <input type="hidden" class="form-control" name="id" value="' . $value['id'] . '">
                    <input type="file" class="form-control" name="photo" style="width:70%">
                    <span style="padding:5%" class="btn btn-outline-success" onclick="chnagerphoto(' . $value['id'] . ')"><i class="fa fa-check"></i></span><br />
                </div>
            </form>
            
                </div>';
}
$tab .= "</div>";

echo $tab;
