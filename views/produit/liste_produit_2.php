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
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/site/css/nivo-lightbox/default.css">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/bamboo/css/bamboo.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
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
                    <div class="phone" style="margin-left: 7%; margin-top: 7%"><i class="fa fa-clock-o"></i><span class="heureid"></span></div>
                </div>
                <div class="navbar-header hidden-sm hidden-md hidden-lg">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand page-scroll" href="http://localhost:81/20hectares.com/">29 Hectares</a>
                    <div class="phone" style="margin-left: 10%"><i class="fa fa-clock-o"></i><span class="heureid"></span></div>
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
        <!-- Header -->
        <div id="services">
            <div class="container">
                <div class="section-title">
                    <h2>Nos Terrains</h2>
                </div>
                <div class="row">
                    <?php
                    $a = 0;                  
                    if (!empty($les_produits)) {
                        foreach ($les_produits as $value) {
                            $imageProd = $produit->AlbumParProduit($value['reference_produit']);
                            $fichier = isset($imageProd[0]['fichier']) ? $imageProd[0]['fichier'] : "";
                            $a++;
                            ?>
                            <div class="col-md-4" style="height:380px">
                                
										
                                    <div class="demo<?=$a;?>" style="height:380px">
										<div class="slides">
										<?php foreach($imageProd as $image){ ?>
											<div><a href="http://localhost:81/20hectares.com/search/produit/voir&p=<?=$value['reference_produit'] ?>"><img height="380" src="http://localhost:81/20hectares.com/upload/produits/<?=$image['fichier'];?>"></a></div>
										<?php } ?>
										</div> 
									</div> 
									<div class="service-desc">
										<a href="http://localhost:81/20hectares.com/search/produit/voir&p=<?=$value['reference_produit'] ?>">
											<h3><?= $value['libelle_produit'] ?></h3>
										</a>
										<p><?= $value['details_produit'] ?>.</p>
                                    </div>
                            </div>
                            <?php
							
							if ($a%3==0)
                                echo '<br>';
                               
                        }
                    }
                    ?>
                </div>
            </div>
        </div>


        <div id="footer">
            <div class="container text-center">
                <p>&copy; 2019 29Hectares. Créé par <a href="http://www.templatewire.com" rel="nofollow">Eric Koffi</a></p>
            </div>
        </div>
        <script type="text/javascript" src="assets/site/js/jquery.1.11.1.js"></script> 
        <script type="text/javascript" src="assets/site/js/bootstrap.js"></script> 
        <script type="text/javascript" src="assets/site/js/SmoothScroll.js"></script> 
        <script type="text/javascript" src="assets/site/js/nivo-lightbox.js"></script> 
        <script type="text/javascript" src="assets/site/js/jqBootstrapValidation.js"></script> 
        <script type="text/javascript" src="assets/site/js/contact_me.js"></script> 
        <script type="text/javascript" src="assets/site/js/main.js"></script>
        <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/bamboo/js/bamboo.js"></script>
        <script>
            $(function () {
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
		
		
	  <script type="text/javascript">
	  var nbre = <?php echo count($les_produits) ; ?>
	  
	  for (var x = 1; x <= nbre; x++) {
        var element = document.querySelector(".demo"+x);
		
        var sildeshow = bamboo(element,'roll',{
            hideDot: true,
        });
	  }
 
        </script>
    </body>
</html>