<?php

$cnx = new PDO('mysql:host=localhost; dbname=20hectares', 'root', '');

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

if (isset($_POST['ok'])) {
    date_default_timezone_set('Africa/Abidjan');
    echo (strftime("%a")) . ' ' . date('d-m-Y  H:i:s <em>');
}

if (isset($_POST['ref'])) {
    $ref = $_POST['ref'];
    $tab = "<br /><center><h3>ALBUM DE L'ÉLÉMENT $ref</h3></center><br />
                                <div class='row'>";
    $req = $cnx->prepare("select * from album where produit='$ref'");
    $req->execute();
    $res = $req->fetchAll();
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
                    <input type="hidden" id="id" class="form-control" name="id" value="' . $value['id'] . '">
                    <input type="file" class="form-control" name="photo" style="width:70%" id="photor">
                    <span style="padding:5%" class="btn btn-outline-success" onclick="chnagerphoto(' . $value['id'] . ')"><i class="fa fa-check"></i></span><br />
                </div>
            </form>
            </div>';
    }
    $tab .= "</div>";
    $tab .= '<br><br>
        <form method="POST" id="formajoutOtre" enctype="multipart/form-data" action="http://localhost:81/20hectares.com/controllers/appps.php">
            <div class="form-group">
            <input type="hidden" id="id" class="form-control" name="id" value="' . $ref . '">
                                <div class="row roro">
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <div class="col-md-6" id="">
                                            <div class="form-group">
                                                <label>Ajouter d\'autres images :</label>
                                                <input required title="Selectionnez toutes les images en même temps ou en maintenat la touche ctrl pour les selectionner" type="file" class="form-control" name="sai_photo[]" multiple>
                                                <label class="text-info">Selectionnez toutes les images en même temps ou en maintenat la touche ctrl pour les selectionner</label>
                                            </div>
                                        </div>
                                    </center>
                                    <center>
                                        <div class="col-md-6" id="">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            </form>';

    echo $tab;
}

if (isset($_POST['com'])) {

    $valid = array('order' => array(), 'com' => array());

    $req = $cnx->prepare('SELECT * FROM commande WHERE numero_commande=:numero_commande');
    $req->bindParam(':numero_commande', $_POST['com']);
    $req->execute();
    $data = $req->fetchAll();

    $valid['order'] = $data;

    echo json_encode($valid);
}

if (isset($_POST['conf'])) {
    
    $req = $cnx->prepare('UPDATE produit SET etat_produit="Disponible" WHERE reference_produit=:ref');
    $req->bindParam(':ref', $_POST['conf']);
    $red = $req->execute();
    echo $red;
}

if (isset($_POST['trait'])) {
    
    $req = $cnx->prepare('UPDATE location SET etat_demande="Traite" WHERE idlocation=:ref');
    $req->bindParam(':ref', $_POST['trait']);
    $red = $req->execute();
    echo $red;
}


if (isset($_POST['form'])) {
    $req = $cnx->prepare("select produit from album where id=:id");
    $req->bindParam(':id', $_POST['id']);
    $req->execute();
    $res = $req->fetchAll();

    if (!empty($_FILES['photo']['name'])) {
        $ok = "continue...";
        $photos = $_FILES['photo']['name'];
        $destination = "upload/produits/" . $photos;
        move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
        $req = $cnx->prepare('UPDATE album SET fichier=:fic WHERE id=:i');
        $req->bindParam(':i', $_POST['id']);
        $req->bindParam(':fic', $photos);
        $ok = $req->execute() or die(print_r($cnx->errorInfo()));
    }
    
    $req = $cnx->prepare("select * from album where produit=:p");
    $req->bindParam(':p', $res[0]['produit']);
    $req->execute();
    $res = $req->fetchAll();
    $tab = "<br /><center><h3>ALBUM DE L'ÉLÉMENT ". $res[0]['produit']."</h3></center><br />
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
    $tab .= '<br><br>
        <form method="POST" id="formajoutOtre" enctype="multipart/form-data" action="http://localhost:81/20hectares.com/controllers/appps.php">
            <div class="form-group">
            <input type="hidden" id="id" class="form-control" name="id" value="' . $res[0]['produit'] . '">
                                <div class="row roro">
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <div class="col-md-6" id="">
                                            <div class="form-group">
                                                <label>Ajouter d\'autres images :</label>
                                                <input required title="Selectionnez toutes les images en même temps ou en maintenat la touche ctrl pour les selectionner" type="file" class="form-control" name="sai_photo[]" multiple>
                                                <label class="text-info">Selectionnez toutes les images en même temps ou en maintenat la touche ctrl pour les selectionner</label>
                                            </div>
                                        </div>
                                    </center>
                                    <center>
                                        <div class="col-md-6" id="">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            </form>';

    echo $tab;

    echo $ok;
}

if (isset($_POST['sup'])) {
    $req = $cnx->prepare("select produit from album where id=:id");
    $req->bindParam(':id', $_POST['sup']);
    $req->execute();
    $res = $req->fetchAll();

    $req = $cnx->prepare('DELETE FROM album WHERE id=:i');
    $req->bindParam(':i', $_POST['sup']);
    $ok = $req->execute() or die(print_r($cnx->errorInfo()));

    $req = $cnx->prepare("select * from album where produit=:p");
    $req->bindParam(':p', $res[0]['produit']);
    $req->execute();
    $res = $req->fetchAll();
    $tab="";
    if(!empty($res)){
    $tab.= "<br /><center><h3>ALBUM DE L'ÉLÉMENT ". $res[0]['produit']."</h3></center><br />
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
    }
    $tab .= '<br><br>
        <form method="POST" id="formajoutOtre" enctype="multipart/form-data" action="http://localhost:81/20hectares.com/controllers/appps.php">
            <div class="form-group">
            <input type="hidden" id="id" class="form-control" name="id" value="' . $res[0]['produit'] . '">
                                <div class="row roro">
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <div class="col-md-6" id="">
                                            <div class="form-group">
                                                <label>Ajouter d\'autres images :</label>
                                                <input required title="Selectionnez toutes les images en même temps ou en maintenat la touche ctrl pour les selectionner" type="file" class="form-control" name="sai_photo[]" multiple>
                                                <label class="text-info">Selectionnez toutes les images en même temps ou en maintenat la touche ctrl pour les selectionner</label>
                                            </div>
                                        </div>
                                    </center>
                                    <center>
                                        <div class="col-md-6" id="">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            </form>';

    echo $tab;
}
