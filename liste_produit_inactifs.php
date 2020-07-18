<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta name="description" content="La liste des produits.">

        <title>20Hectares - Produits / Liste Produits Inactifs</title>

        <!-- Main CSS-->

        <link rel="stylesheet" type="text/css" href="https://www.29hectares.com/assets/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://www.29hectares.com/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.29hectares.com/assets/ecommerce/ecom.css">

    </head>
    <body class="app sidebar-mini rtl">

        <?php include "config/dashboard.php"; ?>

        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-th-list"></i> Liste des Produits en attente de confirmation</h1>
                </div>
                <?php echo $message; ?>
                <ul class="app-breadcrumb breadcrumb side">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Produit</li>
                    <li class="breadcrumb-item Actif"><a href="#">Liste</a></li>
                </ul>
            </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>Ref</th>
                                            <th>Libellé</th>
                                            <th>Type</th>
                                            <th>Prix normal</th>
                                            <th>Prix de reduction</th>
                                            <th>Pays</th>
                                            <th>Ville</th>
                                            <th>Look</th>
                                            <th>Album</th>
                                            <?php if($_SESSION['role'] == "admin") {?>
                                                <th>Confirmer</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($tsles_produits_inactifs)) {
                                            foreach ($tsles_produits_inactifs as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['reference_produit']; ?></td>
                                                    <td><?php echo $value['libelle_produit']; ?></td>
                                                    <td><?php echo $value['type_produit']; ?></td>
                                                    <td><?php echo $value['prix_reduction']; ?></td>
                                                    <td><?php echo $value['prix_reduction']; ?></td>
                                                    <td><?php echo $value['pays']; ?></td>
                                                    <td><?php echo $value['ville']; ?></td>
                                                    <td>
                                                        <a class="btn btn-outline-danger" href="https://www.29hectares.com/search/produit/enregistrement&reference=<?php echo $value['reference_produit']; ?>">Visualiser</a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-primary decl" cont="<?php echo $value['reference_produit']; ?>" href="javascript:void(0)"><i class="fa fa-eye"></i> Voir</button>
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
                </div>            
           
        </main>
        <!-- Essential javascripts for application to work-->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://www.29hectares.com/assets/js/popper.min.js"></script>
        <script src="https://www.29hectares.com/assets/js/bootstrap.min.js"></script>
        <script src="https://www.29hectares.com/assets/js/main.js"></script>
        <script src="https://www.29hectares.com/assets/js/lescript.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="https://www.29hectares.com/assets/js/plugins/pace.min.js"></script>
        <!-- Page specific javascripts-->
        <!-- Data table plugin-->
        <script type="text/javascript" src="https://www.29hectares.com/assets/js/plugins/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://www.29hectares.com/assets/js/plugins/dataTables.bootstrap.min.js"></script>
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

        <script>
            
        </script>
    </body>
</html>