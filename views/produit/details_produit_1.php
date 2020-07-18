<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Accueil - Site officiel de 29 Hectares</title>
        <meta name="description" content="29 hectares est une entreprise immobilière spécialisée dans la vente et la location de biens immobiliers (terrains et maisons)">
        <meta name="author" content="">

        <!-- Favicons
            ================================================== -->
        <link rel="shortcut icon" href="http://localhost:81/20hectares.com/assets/site/img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="http://localhost:81/20hectares.com/assets/site/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="http://localhost:81/20hectares.com/assets/site/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="http://localhost:81/20hectares.com/assets/site/img/apple-touch-icon-114x114.png">

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css"  href="http://localhost:81/20hectares.com/assets/site/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/site/fonts/font-awesome/css/font-awesome.css">

        <!-- Stylesheet
            ================================================== -->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/site/css/style.css">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/site/css/nivo-lightbox/nivo-lightbox.css">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/site/css/nivo-lightbox/default.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        <link rel="stylesheet" href="http://localhost:81/20hectares.com/assets/ecommerce/ecommerce_1.css">
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <!-- Navigation
            ==========================================-->
        <nav id="menu" class="navbar navbar-default navbar-fixed-top">
            <div class="container"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header hidden-xs" style="width: 34%;">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand page-scroll" href="http://localhost:81/20hectares.com/"style="margin-left: -20%">29 Hectares</a>
                    <div class="phone" style="margin-left: 7%; margin-top: 7%"><i class="fa fa-clock"></i><span class="heureid"></span></div>
                </div>
                <div class="navbar-header hidden-sm hidden-md hidden-lg">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand page-scroll" href="http://localhost:81/20hectares.com/">29 Hectares</a>
                    <div class="phone" style="margin-left: 10%"><i class="fa fa-clock"></i><span class="heureid"></span></div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#about" class="page-scroll">A propos</a></li>
                        <li><a href="#services" class="page-scroll">Terrains</a></li>
                        <li><a href="#portfolio" class="page-scroll">Maisons</a></li>
                        <li><a href="#testimonials" class="page-scroll">Temoignages</a></li>
                        <li><a href="#contact" class="page-scroll">Contacts</a></li>
                        <li><a href="http://localhost:81/20hectares.com/search/utilisateur/connexion" class="">Connexion</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
        </nav>
        <div id="services">
            <div class="container">
                <div class="section-title">
                    <h2>Plus de Details</h2>
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
                                        </article> <!-- card-body.// -->
                                    </aside> <!-- col.// -->
                                </div> <!-- row.// -->
                            </div> <!-- card.// -->
                        </form>
                    </div><!-- /.page -->
                </div>
            </div>
                
            </div>
        </div>

        <!-- Footer Section -->
        <div id="footer">
            <div class="container text-center">
                <p>&copy; 2019 29 Hectares. Créé par <a href="http://www.templatewire.com" rel="nofollow">Eric Koffi</a></p>
            </div>
        </div>
        <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/site/js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/site/js/bootstrap.js"></script> 
        <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/site/js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/site/js/nivo-lightbox.js"></script> 
        <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/site/js/jqBootstrapValidation.js"></script> 
        <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/site/js/contact_me.js"></script> 
        <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/site/js/main.js"></script>
        <script>
            $(function () {
                $(".item-gallery").click(function () {
                    $("#case_image").html($(this).html());
                });
                
                 function dateJ() {
                    $.ajax({
                        url: "http://localhost:81/20hectares.com/controllers/app.php",
                        data: {ok: 1},
                        method: "POST",
                        success: function (data) {
                            $('#heure').html(data);
                            $('.heureid').html(data);
                        }
                    });
                }

                /*Function Calls*/
                setInterval(function () {
                    dateJ();
                }, 1000
                        );//affiche la date 

                
                
            });
        </script>
        
    </body>
</html>