<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="La liste des produits.">

        <title>20Hectares - Produit / Liste par Fournisseur</title>

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
                    <h1><i class="fa fa-th-list"></i> Liste des produits par Fournisseur</h1>

                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Produit</li>
                    <li class="breadcrumb-item Actif"><a href="#">Liste par Fournisseur</a></li>
                </ul>
            </div>
            <form action="http://localhost:81/20hectares.com/search/produit/fournisseur" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="table-responsive">
                                <?php if($_SESSION['role'] == "admin"){ ?>
                                <center>
                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <div class="form-group">
                                                <table>
                                                    <tr>
                                                        <td>Code du fournisseur : </td>
                                                        <td><input type="text" name="sai_rechercher" class="form-control"></td>
                                                        <td><button name="btn_rechercher" type="submit" class="btn btn-danger">Rechercher</button></td>
                                                    </tr>
                                                </table>      
                                            </div>
                                        </div>
                                    </div>

                                </center>
                                <?php } ?>
                                <br>
                            <br>
                           <div class="table-responsive">
                                <table class="table table-hover table-bordered table-responsive" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>Ref</th>
                                            <th>Libellé</th>
                                            <th>Type</th>
                                            <th>Prix normal</th>
                                            <th>Prix de reduction</th>
                                            <th>Quota</th>
                                            <th>Pays</th>
                                            <th>Ville</th>
                                            <th>Statut</th>
                                            <th>Look</th>
                                            <th>Album</th>
                                            <?php if($_SESSION['role'] == "admin") {?>
                                                <th>Confirmer</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($produitsFournisseurs)) {
                                            foreach ($produitsFournisseurs as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['reference_produit']; ?></td>
                                                    <td><?php echo $value['libelle_produit']; ?></td>
                                                    <td><?php echo $value['type_produit']; ?></td>
                                                    <td><?php echo $value['prix_reduction']; ?></td>
                                                    <td><?php echo $value['prix_reduction']; ?></td>
                                                    <td><?php echo $value['quota']; ?></td>
                                                    <td><?php echo $value['pays']; ?></td>
                                                    <td><?php echo $value['ville']; ?></td>
                                                    <td><?php echo $value['etat_produit']=="Inactif"?"Produit inactif en attente de confirmation":$value['etat_produit']; ?></td>
                                                    <td>
                                                        <a class="btn btn-outline-danger" href="http://localhost:81/20hectares.com/search/produit/enregistrement&reference=<?php echo $value['reference_produit']; ?>">Visualiser</a>
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-outline-primary decl" cont="<?php echo $value['reference_produit']; ?>" href="javascript:void(0)"><i class="fa fa-eye"></i> Voir</span>
                                                    </td>
                                                    <?php if($_SESSION['role'] == "admin"){ ?>
                                                    <td>
                                                        <?php echo $value['etat_produit']!="Inactif"?"Produit publié": '<span class="btn btn-outline-success confir" cont="'.$value['reference_produit'].'" href="javascript:void(0)"><i class="fa fa-check-square-o"></i> Confirmer ?</span>';?>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="album">                                
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src=" http://localhost:81/20hectares.com/assets/js/jquery-3.2.1.min.js"></script>
    <script src=" http://localhost:81/20hectares.com/assets/js/popper.min.js"></script>
    <script src=" http://localhost:81/20hectares.com/assets/js/bootstrap.min.js"></script>
    <script src=" http://localhost:81/20hectares.com/assets/js/main.js"></script>
    <script src=" http://localhost:81/20hectares.com/assets/js/lescript.js"></script>
        
    <!-- The javascript plugin to display page loading on top-->
    <script src=" http://localhost:81/20hectares.com/assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src=" http://localhost:81/20hectares.com/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src=" http://localhost:81/20hectares.com/assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
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