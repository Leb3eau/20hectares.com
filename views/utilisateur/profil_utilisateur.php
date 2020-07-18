<!DOCTYPE html>
<html lang="en">
    <head>

        <title>20Hectares - Profil compte</title>

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
                    <h1><i class="fa fa-edit"></i> Profil du compte</h1>

                </div>
                <?php echo $message; ?>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">Compte</li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Profil du compte</h3>
                        <div class="tile-body">
                            <form enctype="multipart/form-data" action="http://localhost:81/20hectares.com/search/utilisateur/profil" method="POST">
                                <center>
                                    <div class="row">
                                        <div class="col-md-4">                                        
                                        </div>
                                        <div class="col-md-4">
                                            <img src="http://localhost:81/20hectares.com/upload/photo/<?php echo $photo; ?>" width="150" height="150"><br /><br />
                                            <input type="file" class="form-control" placeholder=" im" name="sai_photo"><br />
                                        </div>

                                        <div class="col-md-4">                                        
                                        </div>
                                    </div>
                                </center>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nom et prenoms</label> 
                                            <input name="sai_nom_prenom" type="text" class="form-control" value="<?php echo $nom_prenom; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Telephone</label> 
                                            <input name="sai_telephone" type="text" class="form-control" value="<?php echo $tel; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Mot de passe</label> 
                                            <input name="sai_mdp" type="text" class="form-control" value="<?php echo $mdp; ?>">
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Role</label> 
                                                <input readonly="" name="sai_role" type="text" class="form-control" value="<?php echo $_SESSION['role']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Etat</label> 
                                                <input name="sai_etat" type="text" class="form-control" readonly="" value="<?php echo $etat; ?>">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label> 
                                            <input name="sai_email" type="email" class="form-control" value="<?php echo $email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nom utilisateur</label> 
                                            <input name="sai_login" type="text" class="form-control" value="<?php echo $login; ?>"> 
                                        </div>

                                        <div class="form-group">
                                            <label>Date de création</label> 
                                            <input readonly="" name="sai_date_creation" type="date" class="form-control" value="<?php echo $date_creation; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Matricule</label> 
                                            <input readonly="" name="sai_matricule" type="text" class="form-control" value="<?php echo $matricule; ?>"> 
                                        </div>
                                    </div>

                                </div>
                        </div>

                    </div>
                    <center>
                        <div class="tile-footer">
                            <button class="btn btn-primary" name="btn_modifier"><i class="fa fa-fw fa-lg fa-check-circle"></i>Enregistrer les modifications</button>
                        </div>
                    </center>
                </div>
            </div>
        </form>
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