<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="La liste des produits.">

        <title>20Hectares - Produits / Liste</title>

        <!-- Main CSS-->

        <link rel="stylesheet" type="text/css" href=" http://localhost:81/20hectares.com/assets/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://localhost:81/20hectares.com/assets/ecommerce/ecommerce_1.css">

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
                    <li class="breadcrumb-item"><a href="http://localhost:81/20hectares.com/search/utilisateur/dashboard"><i class="fa fa-home fa-lg"></i></a></li>
                    <li class="breadcrumb-item"><a href="http://localhost:81/20hectares.com/search/produit/liste">Produits</a></li>
                    <li class="breadcrumb-item Actif"><a href="#">Détails</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-block">
                        <form enctype="multipart/form-data" action="http://localhost:81/20hectares.com/search/produit/details" method="POST">
                            <div class="card">
                                <div class="row no-gutters">
                                    <aside class="col-sm-5 border-right">
                                        <article class="gallery-wrap">
                                            <div class="img-big-wrap">
                                                <?php $fichier = isset($albumproduit[0]['fichier']) ? $albumproduit[0]['fichier'] : ""; ?>
                                                <div style="width: 440px;height: 440px;">
                                                    <leb id="case_image">
                                                        <img style="width: 100%;height: 100%;" src="http://localhost:81/20hectares.com/upload/produits/<?= $fichier ?>">
                                                    </leb>                                                   
                                                </div>
                                            </div> <!-- slider-product.// -->
                                            <div class="img-small-wrap">
                                                <?php
                                                if (!empty($albumproduit)) {
                                                    foreach ($albumproduit as $value) {
                                                        ?>                                                
                                                        <div class="item-gallery"> <img alt="image" style="width: 100%;height: 100%;" src="http://localhost:81/20hectares.com/upload/produits/<?= $value['fichier'] ?>"></div>                                                
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div> <!-- slider-nav.// -->
                                        </article> <!-- gallery-wrap .end// -->
                                    </aside>
                                    <aside class="col-sm-7">
                                        <article class="p-5">
                                            <h3 class="title mb-3"><?= $leproduit[0]['libelle_produit'] ?></h3>
                                            <div class="mb-3">
                                                <var class="price h3 text-warning">
                                                    <span class="currency"> <?= $leproduit[0]['devise'] ?> </span><span class="num"><?= $leproduit[0]['prix_reduction'] ?></span>
                                                </var>
                                                <!--<span>/par article</span>-->
                                            </div> <!-- price-detail-wrap .// -->
                                            <dl>
                                                <dt>Description</dt>
                                                <dd>

                                                    <div class="form-group">
                                                        <textarea readonly="" class="form-control" id="exampleFormControlTextarea1" rows="5"><?= $leproduit[0]['details_produit'] ?></textarea>
                                                    </div>

                                                </dd>

                                            </dl>
                                            <dl class="row">
                                                <dt class="col-sm-3">Reference : </dt>
                                                <dd class="col-sm-9"><?= $leproduit[0]['reference_produit'] ?></dd>

                                                <dt class="col-sm-3">Type : </dt>
                                                <dd class="col-sm-9"><?= $leproduit[0]['type_produit'] ?> </dd>

                                                <dt class="col-sm-3">Etat : </dt>
                                                <dd class="col-sm-9"><?= $leproduit[0]['etat_produit'] ?></dd>
                                            </dl>
                                            <hr>
                                            <div class="row" hidden="">
                                                <div class="col-sm-12">
                                                    <dl class="dlist-inline">                                                        
                                                        <input type="text" class="form-control" name="sai_reference" value="<?php echo $leproduit[0]['reference_produit']; ?>">                                                        
                                                        <input type="text" class="form-control" name="sai_prix" value="<?php echo $leproduit[0]['prix_reduction']; ?>">                                                        
                                                    </dl> <!-- item-property .// -->
                                                </div> <!-- col.// -->
                                            </div> <!-- row.// -->                                            
                                            <hr>
                                            <button name="btn_panier" class="btn btn-outline-info" type="submit"><i class="fa fa-shopping-cart fa-lg"></i> Commander </button>

                                        </article> <!-- card-body.// -->
                                    </aside> <!-- col.// -->
                                </div> <!-- row.// -->
                            </div> <!-- card.// -->
                        </form>
                    </div><!-- /.page -->
                </div>
            </div>
        </main>
        <!-- Essential javascripts for application to work-->
        <script src=" http://localhost:81/20hectares.com/assets/js/jquery-3.2.1.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/popper.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/bootstrap.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/main.js"></script>
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
            $(function () {
                $(".item-gallery").click(function () {
                    $("#case_image").html($(this).html());
                });
            });
        </script>
    </body>
</html>