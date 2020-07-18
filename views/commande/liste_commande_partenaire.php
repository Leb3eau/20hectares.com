<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="La liste des commandes.">

        <title>29 Hectares - Commandes / Suivi</title>
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="https://www.29hectares.com/assets/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://www.29hectares.com/assets/css/font-awesome.min.css">
    </head>
    <body class="app sidebar-mini rtl">

        <?php include "config/dashboard.php"; ?>

        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-th-list"></i> Suivi des commandes de mes produits</h1>          
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Commande</li>
                    <li class="breadcrumb-item Actif"><a href="#">Suivi des produits</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <center>

                        </center>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Date commande</th>
                                        <th>Etat</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($suivi)) {
                                        foreach ($suivi as $key => $value) {
                                            ?>
                                            <tr>
                                                <td class="text-nowrap"><?php echo $value['libelle_produit']; ?></td>
                                                <td class="text-nowrap"><?php echo $value['date_commande']; ?></td>
                                                <td class="text-nowrap"><?php echo $value['epargne'] > 0 ? "Commandé" : "Vendu !"; ?></td>                                                
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
            </div>
        </main>
       <!-- Essential javascripts for application to work-->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://www.29hectares.com/assets/js/popper.min.js"></script>
        <script src="https://www.29hectares.com/assets/js/bootstrap.min.js"></script>
        <script src="https://www.29hectares.com/assets/js/main.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="https://www.29hectares.com/assets/js/plugins/pace.min.js"></script>
        <script src="https://www.29hectares.com/assets/js/lescript.js"></script>
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
            $(function (){
                
             });
        </script>
    </body>
</html>