<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="Enregistrement des commandes des clients.">

        <title>Epencia - Commande/ enregistrement</title>

        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/font-awesome.min.css">
    </head>
    <body class="app sidebar-mini rtl">

        <?php include "config/dashboard.php"; ?>

        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-edit"></i> Enregistrement des commandes</h1>

                </div>
                <?php echo $message; ?>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Commande</li>
                    <li class="breadcrumb-item"><a href="#">Enregistrement</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Enregistrement des commandes</h3>
                        <div class="tile-body">
                            <form action="http://localhost:81/20hectares.com/search/commande/enregistrement" method="POST" enctype="multipart/form-data">
                                <center>
                                    <div id="rech" class="row">
                                        <div  class="col-lg-12"> 
                                            <div class="form-group">
                                                <table>
                                                    <tr>
                                                        <td>Entrer le n°commande : </td>
                                                        <td><input name="sai_rechercher" class="form-control" type="text"></td>
                                                        <td><button name="btn_rechercher" type="submit" class="btn btn-danger">Rechercher</button></td>
                                                    </tr>
                                                </table>      
                                            </div>
                                        </div>
                                    </div>
                                </center>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Numero de commande</label>
                                            <input name="sai_numero_commande" type="text" class="form-control" value="<?php echo $numero_commande; ?>">
                                        </div>

                                        <div id="date_commande" class="form-group">
                                            <label>Date de commande</label>
                                            <input readonly="" name="sai_date_commande" type="date" class="form-control" value="<?php echo $date_commande; ?>">
                                        </div>                             
                                    </div>
                                    <div class="col-md-6">                                        
                                        <div class="form-group">
                                            <label>Matricule Client</label>
                                            <input type="text" name="sai_mat" class="form-control" value="<?php echo $matricule; ?>" placeholder="Saisir le matricule du client">                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Produit</label>
                                            <input placeholder="Entrer la reference du produit" name="sai_reference_produit" class="form-control" value="<?php echo $reference_produit; ?>">
                                        </div>   
                                    </div>
                                </div>
                        </div>

                    </div>
                    <center>
                        <div class="tile-footer">
                            <?php if(!$rech){ ?>
                            <button id="ajouter" class="btn btn-success" name="btn_ajouter"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>
                            <?php }else{ ?>
                            <button id="modifier" class="btn btn-success" name="btn_modifier"><i class="fa fa-fw fa-lg fa-edit"></i>Modifier</button>
                            <button id="supprimer" class="btn btn-success" name="btn_supprimer"><i class="fa fa-fw fa-lg fa-eraser"></i>Supprimer</button>
                            <?php } ?>
                        </div>
                    </center>

                </div>
            </div>
        </form>
    </div>
</div>
</main>
<!-- Essential javascripts for application to work-->
<script src="http://localhost:81/20hectares.com/assets/js/jquery-3.2.1.min.js"></script>
<script src="http://localhost:81/20hectares.com/assets/js/popper.min.js"></script>
<script src="http://localhost:81/20hectares.com/assets/js/bootstrap.min.js"></script>
<script src="http://localhost:81/20hectares.com/assets/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="http://localhost:81/20hectares.com/assets/js/plugins/pace.min.js"></script>
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