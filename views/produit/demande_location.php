<!DOCTYPE html>
<html lang="fr">
    <head>

        <title>20Hectares - Location / location</title>

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
                    <h1><i class="fa fa-edit"></i> Demande de Location</h1>
                </div>
                <?php echo $message; ?>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Location</li>
                    <li class="breadcrumb-item"><a href="#">Demande_Location</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Demande de Location</h3>
                        <div class="tile-body">
                            <form enctype="multipart/form-data" action="http://localhost:81/20hectares.com/search/location/demande" method="POST">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Montant</label>
                                            <input placeholder="Veuillez saisir votre budget..." type="text" class="form-control" name="sai_budget" value="<?php echo "" ?>">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pays</label>
                                            <input type="text" placeholder="Veuillez renseigner Le pays indexé..." class="form-control" name="sai_pays" value="<?php echo "" ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">                                        
                                        <div class="form-group">
                                            <label>Ville désirée</label>
                                            <input placeholder="Veuillez renseigner la ville désirée..." type="text" class="form-control" name="sai_ville" value="<?php echo "" ?>">
                                        </div>
                                        </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Quartier</label>
                                            <input placeholder="Veuillez renseigner le quartier désiré..." type="text" class="form-control" name="sai_quartier" value="<?php echo "" ?>">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Adresse</label>
                                            <input type="text" placeholder="Veuillez renseigner l'adresse precise si possible..." class="form-control" name="sai_adr" value="<?php echo "" ?>">
                                        </div>                                        
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>Caracteristiques</label>
                            <textarea placeholder="Veuillez donner les details de la demande ..." rows="3" class="form-control" name="sai_details_produit"><?php echo "" ?></textarea>
                            <small class="text-secondary">Maximum de 255 caractères.</small>
                        </div>                        
                    </div>
                    <center>
                        <div class="tile-footer">
                            <?php if (!$btnrech) { ?>
                                <button class="btn btn-success" name="btn_ajouter"><i class="fa fa-fw fa-lg fa-check-circle"></i>Valider</button>
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