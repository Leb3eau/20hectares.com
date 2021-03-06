<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="La liste des commandes.">

        <title>Epencia - Commandes / liste</title>

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
                    <h1><i class="fa fa-th-list"></i> Liste des commandes</h1>

                </div>
                <?php echo $message; ?>
                <ul class="app-breadcrumb breadcrumb side">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Commande</li>
                    <li class="breadcrumb-item Actif"><a href="#">Liste</a></li>
                </ul>
            </div>
            <form action="http://localhost:81/20hectares.com/search/commande/liste" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">             
                            <br>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>Numero commande</th>
                                            <th>Date commande</th>
                                            <th>Matricule</th>
                                            <th>Nom & Prenoms</th>
                                            <th>Reference produit</th>
                                            <th>Prix</th>
                                            <th>Montant Versé</th>
                                            <th>Etat</th>
                                            <th>Opérations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($commandes)) {
                                            foreach ($commandes as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td class="text-nowrap"><?php echo $value['numero_commande']; ?></td>
                                                    <td class="text-nowrap"><?php echo $value['date_commande']; ?></td>
                                                    <td class="text-nowrap"><?php echo $value['matricule']; ?></td>
                                                    <td class="text-nowrap"><?php echo $value['nom_prenom']; ?></td>
                                                    <td class="text-nowrap"><?php echo $value['reference_produit']; ?></td>
                                                    <td class="text-nowrap"><?php echo $value['prix_produit']; ?></td>
                                                    <td class="text-nowrap"><?php echo $value['epargne']; ?></td>
                                                    <td class="text-nowrap"><?php echo $value['etat_commande']; ?></td>
                                                    <td>
                                                        <a href="http://localhost:81/20hectares.com/search/commande/enregistrement&numero_commande=<?php echo $value['numero_commande']; ?>" class="btn btn-outline-info" style="padding: 5%"><i class="fa fa-eye fa-lg"></i></a>
                                                        <span style="cursor: pointer; padding: 5%" class="btn btn-outline-warning paipai" der="<?php echo $value['numero_commande']; ?>"><i class="fa fa-pencil"></i></span>
                                                        <a target="_blank" href="http://localhost:81/20hectares.com/search/commande/imprimer&numero_commande=<?php echo $value['numero_commande']; ?>" style="padding: 5%" class="btn btn-outline-success"><i class="fa fa-print"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        </main>

        <div class="modal fade paymentOrderModal" tabindex="-1" role="dialog" id="paymentOrderModal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Édition du Paiement</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

                        <div class="paymentOrderMessages"></div>
                        <form action="http://localhost:81/20hectares.com/search/commande/liste" method="POST">
                            <div class="form-group">
                                <label for="due" class="control-label">Reste à payer</label>
                                <div class="">
                                    <input type="hidden" class="form-control commande" id="commande" name="commande"/>					
                                    <input type="text" class="form-control reste" id="reste" name="reste" disabled="true" />					
                                </div>
                            </div> <!--/form-group-->		
                            <div class="form-group">
                                <label for="payAmount" class="control-label">Montant Versé</label>
                                <div class="">
                                    <input type="text" class="form-control" id="paye" name="paye"/>					      
                                </div>
                            </div> <!--/form-group-->                
                    </div> <!--/modal-body-->
                        
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times"></i> Fermer</button>
                            <button name="btn_payer" type="submit" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."><i class="fa fa-check"></i> Enregistrer le Paiement</button>	
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /edit order-->

        <!-- Essential javascripts for application to work-->
        <script src=" http://localhost:81/20hectares.com/assets/js/jquery-3.2.1.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/popper.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/bootstrap.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/main.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src=" http://localhost:81/20hectares.com/assets/js/plugins/pace.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/lescript.js"></script>
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
            $(function (){
                
             });
        </script>
    </body>
</html>