<!DOCTYPE html>
<html lang="fr">
    <head>

        <title>20Hectares - Produit / enregistrement</title>

        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href=" http://localhost:81/20hectares.com/assets/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/font-awesome.min.css">
    </head>
    <body class="app sidebar-mini rtl">

        <?php include "config/dashboard.php"; ?>

        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-edit"></i> Enregistrement des produits</h1>

                </div>
                <?php echo $message; ?>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Produit</li>
                    <li class="breadcrumb-item"><a href="#">Enregistrement</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Enregistrement des produits</h3>
                        <div class="tile-body">
                            <form id="createProduit" enctype="multipart/form-data" action="http://localhost:81/20hectares.com/controllers/apppsp.php" method="POST">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" hidden="">
                                            <label>Reference</label>
                                            <input type="text" class="form-control" name="sai_reference_produit" value="<?php echo $reference_produit; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Libelle du produit</label>
                                            <input type="text" class="form-control" name="sai_libelle_produit" value="<?php echo $libelle_produit; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Type de produit</label>
                                            <select name="sai_type_produit" class="form-control">
                                                <option  selected value="<?php echo $type_produit; ?>"><?php echo $type_produit; ?></option>
                                                <option value="Maison">Maison</option>
                                                <option value="Terrain">Terrain</option>
                                            </select>
                                        </div>

                                        <div class="form-group" id="etat">

                                            <?php
                                            if ($_SESSION['role'] == "partenaire") {
                                                if (!$btnrech) {
                                                    ?>

                                                    <select name="sai_etat_produit" class="form-control" hidden="">
                                                        <option  selected value="Inactif">Inactif</option>
                                                        <option value="Disponible">Disponible</option>
                                                        <option value="Non Disponible">Non Disponible</option>
                                                    </select>
                                                <?php } else {
                                                    ?>
                                                    <label>
                                                        Etat du produit
                                                    </label>
                                                    <select name="sai_etat_produit" class="form-control" disabled="">
                                                        <option  selected value="<?php echo $etat_produit; ?>"><?php echo $etat_produit; ?></option>
                                                        <option value="Disponible">Disponible</option>
                                                        <option value="Non Disponible">Non Disponible</option>
                                                    </select>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <select name="sai_etat_produit" class="form-control">
                                                    <option  selected value="<?php echo $etat_produit; ?>"><?php echo $etat_produit; ?></option>
                                                    <option value="Disponible">Disponible</option>
                                                    <option value="Non Disponible">Non Disponible</option>
                                                </select>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Pays</label>
                                            <input type="text" class="form-control" name="sai_pays" value="<?php echo $pays; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Ville</label>
                                            <input type="text" class="form-control" name="sai_ville" value="<?php echo $ville; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Devise</label>
                                            <select name="sai_devise" class="form-control">
                                                <option  selected value="<?php echo $devise; ?>"><?php echo $devise; ?></option>
                                                <option value="F CFA">F CFA</option>
                                                <option value="YEN">YEN</option>
                                                <option value="Euros">Euros</option>
                                                <option value="Dollars">Dollars</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            if ($_SESSION['role'] == "partenaire") {
                                                ?>                                           
                                                <label>Prix Vente</label>
                                                <?php
                                            } else {
                                                echo '<label>Prix normal</label>';
                                            }
                                            ?>

                                            <input type="text" class="form-control" name="sai_prix_normal" value="<?php echo $prix_normal; ?>">
                                        </div>

                                        <?php
                                        if ($_SESSION['role'] !== "partenaire") {
                                            ?>
                                            <div class="form-group">
                                                <label>Prix de Vente</label>
                                                <input type="text" class="form-control" name="sai_prix_reduction" value="<?php echo $prix_reduction; ?>">
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <div class="form-group">
                                            <label>Quartier</label>
                                            <input type="text" class="form-control" name="sai_quartier" value="<?php echo $quartier; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Adresse</label>
                                            <input type="text" class="form-control" name="sai_adr" value="<?php echo $adresse; ?>">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>Caracteristiques</label>
                            <textarea rows="3" class="form-control" name="sai_details_produit"><?php echo $details_produit; ?> </textarea>
                            <small class="text-secondary">Maximum de 255 caractères.</small>
                        </div>
                        <?php if (!$btnrech) { ?>
                            <div class="form-group">
                                <div class="row roro"> 
                                    <?php
                                    $arrayNumber = 0;
                                    for ($x = 1; $x < 3; $x++) {
                                        ?> 
                                        <div class="col-md-6 addRowBtn45" num="<?php echo $arrayNumber; ?>" id="row<?php echo $x; ?>">
                                            <div class="form-group" id="image">
                                                <label>Image :</label>
                                                <div class="form-group form-inline">
                                                    <input type="file" class="form-control" name="sai_photo[]">
                                                    <button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $arrayNumber++;
                                    }
                                    ?>

                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-outline-secondary" id="btncacher"><i class="fa fa-file-image-o"></i> Ajouter une galerie </button>
                                    <center>
                                        <button type="button" class="btn btn-dark" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Ajouter une image </button>
                                    </center>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <center>
                        <div class="tile-footer">
                            <?php if (!$btnrech) { ?>
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>
                            <button type="reset" id="reset" class="btn btn-default btn-lg" hidden=""><i class="glyphicon glyphicon-erase"></i> Réinitialiser</button>
                                <?php
                            } else {
                                if ($_SESSION['role'] == "admin") {
                                    ?>
                                    <button class="btn btn-success" name="btn_modifier"><i class="fa fa-fw fa-lg fa-edit"></i>Modifier</button>
                                    <button class="btn btn-success" name="btn_supprimer"><i class="fa fa-fw fa-lg fa-eraser"></i>Supprimer</button>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
</main>
<!-- Essential javascripts for application to work-->
<script src=" http://localhost:81/20hectares.com/assets/js/jquery-3.2.1.min.js"></script>
<script src=" http://localhost:81/20hectares.com/assets/js/popper.min.js"></script>
<script src=" http://localhost:81/20hectares.com/assets/js/bootstrap.min.js"></script>
<script src=" http://localhost:81/20hectares.com/assets/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="http://localhost:81/20hectares.com/assets/js/lescript.js" type="text/javascript"></script>
<script src=" http://localhost:81/20hectares.com/assets/js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<!-- Google analytics script-->
<script type="text/javascript">
                                            if (document.location.hostname == 'pratikborsadiya.in') {
                                                (function (i, s, o, g, r, a, m) {
                                                    i['GoogleAnalyticsObject'] = r;
                                                    i[r] = i[r] || function () {
                                                        (i[r].q = i[r].q || []).push(arguments)
                                                    }, i[r].l = 1 * new Date();
                                                    a = s.createElement(o),
                                                            m = s.getElementsByTagName(o)[0];
                                                    a.async = 1;
                                                    a.src = g;
                                                    m.parentNode.insertBefore(a, m)
                                                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
                                                ga('create', 'UA-72504830-1', 'auto');
                                                ga('send', 'pageview');
                                            }
</script>
</body>
</html>