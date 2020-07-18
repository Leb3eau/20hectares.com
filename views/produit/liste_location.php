<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta name="description" content="La liste des produits.">

        <title>20Hectares - Produit / Liste Location</title>

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
                    <h1><i class="fa fa-th-list"></i> Liste des Locations</h1>

                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Location</li>
                    <li class="breadcrumb-item Actif"><a href="#">Liste</a></li>
                </ul>
            </div>
            <form action="http://localhost:81/20hectares.com/search/location/liste" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="table-responsive">
                                <?php if ($_SESSION['role'] == "admin") { ?>
                                    <center>
                                        <div class="row">
                                            <div class="col-lg-12"> 
                                                <div class="form-group">
                                                    <table>
                                                        <tr>
                                                            <td>Utilisateur : </td>
                                                            <td> <select class="form-control" name="rech">
                                                                    <option value="all">Tout</option>
                                                                    <?php
                                                                    foreach ($les_users as $key => $value) {
                                                                        echo '<option value="' . $value['id'] . '">' . $value['nom_prenom'] . '</option>';
                                                                    }
                                                                    ?>

                                                                </select> </td>
                                                            <td><button name="liste" type="submit" class="btn btn-danger">Rechercher</button></td>
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
                                                <th>Nom & Prénoms</th>
                                                <th>Téléphone</th>
                                                <th>Pays</th>
                                                <th>Ville</th>
                                                <th>Quartier</th>
                                                <th>Adresse</th>
                                                <th>Montant</th>
                                                <th>Details</th>
                                                <th>État</th>                                                
                                                <?php if ($_SESSION['role'] == "admin") { ?>
                                                    <th>Action</th>
<?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($les_locations)) {
                                                foreach ($les_locations as $key => $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value['nom_prenom']; ?></td>
                                                        <td><?php echo $value['telephone']; ?></td>
                                                        <td><?php echo $value['pays']; ?></td>
                                                        <td><?php echo $value['ville']; ?></td>
                                                        <td><?php echo $value['quartier']; ?></td>
                                                        <td><?php echo $value['adresse']; ?></td>
                                                        <td><?php echo $value['montant']; ?></td>
                                                        <td><?php echo $value['caracteristiques']; ?></td>
                                                        <td><?php echo $value['etat_demande']; ?></td>
                                                        
                                                            <?php if ($_SESSION['role'] == "admin") { ?>
                                                            <td>
                                                            <?php echo $value['etat_demande'] != "En Cours" ? "Demande traitée" : '<span class="btn btn-outline-success trait" conte="' . $value['idlocation'] . '" href="javascript:void(0)"><i class="fa fa-check-square-o"></i> Traiter ?</span>'; ?>
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