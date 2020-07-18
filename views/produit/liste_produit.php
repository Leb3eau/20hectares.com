<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta name="description" content="La liste des produits.">

        <title>20Hectares - Produits / Liste</title>

        <!-- Main CSS-->

        <link rel="stylesheet" type="text/css" href=" http://localhost:81/20hectares.com/assets/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://localhost:81/20hectares.com/assets/ecommerce/ecom.css">

    </head>
    <body class="app sidebar-mini rtl">

        <?php include "config/dashboard.php"; ?>

        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-th-list"></i> Liste des produits</h1>
                </div>
                <?php echo $message; ?>
                <ul class="app-breadcrumb breadcrumb side">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Produit</li>
                    <li class="breadcrumb-item Actif"><a href="#">Liste</a></li>
                </ul>
            </div>

            <?php if ($_SESSION['role'] == "client") { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="row">
                                <?php
                                $a = 0;
                                if (!empty($les_produits)) {
                                    foreach ($les_produits as $value) {
                                        $imageProd = $produit->AlbumParProduit($value['reference_produit']);
                                        $fichier = isset($imageProd[0]['fichier']) ? $imageProd[0]['fichier'] : "";
                                        $a++;
                                        ?>
                                        <aside class="col-md-2">
                                            <?php
                                            if ($a == 7)
                                                echo '<br>';
                                            ?>
                                            <h5 class="subtitle-doc"><?= $value['type_produit'] ?></h5>
                                            <div id="code_banner1">
                                                <div class="card-banner" style="width: 165px; height:165px; background-image: url('http://localhost:81/20hectares.com/upload/produits/<?= $fichier ?>');">
                                                    <article class="overlay bottom text-center" style="display: block;">
                                                        <h5 class="card-title"><?= $value['libelle_produit'] ?></h5>
                                                        <a href="http://localhost:81/20hectares.com/search/produit/details&p=<?= $value['reference_produit'] ?>" class="btn btn-warning btn-md"> Détails </a>
                                                    </article>
                                                </div> <!-- card.// -->
                                            </div> <!-- code wrap.// -->
                                        </aside>

                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else { ?>
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
                                        if (!empty($tsles_produits)) {
                                            foreach ($tsles_produits as $key => $value) {
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
            <?php } ?>

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

        <script>
            
        </script>
    </body>
</html>