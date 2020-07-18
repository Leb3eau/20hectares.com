<!DOCTYPE html>
<html>
    <head>

        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href=" http://localhost:81/20hectares.com/assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/fonts/eleganticons/et-icons.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/font-awesome.min.css">
        <title>20Hectares - Espace de connexion</title>
    </head>
    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="login-content">
            <div class="logo">
                <h1>20Hectares</h1>
            </div>
            <div class="login-box">
                <form class="login-form" method="POST" action="http://localhost:81/20hectares.com/search/utilisateur/connexion">
                    <center><p style="color: red"><?php echo $message; ?></p></center>
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>CONNEXION</h3>

                    <?php
                    if (isset($_SESSION['loginInscrit'])) {
                        $add = " hidden=''";
                    } else {
                        $add = "";
                    }
                    ?>
                    
                    <div class="form-group" <?= $add ?>>
                        <label class="control-label">Nom utilisateur</label>
                        <input  name="sai_login" class="form-control" type="text" placeholder="Username" value="<?= (isset($_SESSION['loginInscrit'])) ? $_SESSION['loginInscrit'] : ""; ?>" autofocus>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Mot de passe</label>
                        <input  name="sai_mdp" class="form-control" type="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="utility">
                            <div class="animated-checkbox">
                                <label>
                                    <a href="http://localhost:81/20hectares.com/search/utilisateur/inscription"><span class="label-text">S'inscrire</span></a>
                                </label>
                            </div>
                            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Mot de passe oublié ?</a></p>
                        </div>
                    </div>
                    <div class="form-group btn-container">
                        <button  name="btn_connexion" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SE CONNECTER</button>
                    </div>
                </form>
                <form class="forget-form" method="POST" action="http://localhost:81/20hectares.com/search/utilisateur/connexion">
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Mot de passe</h3>
                    <div class="form-group">
                        <label class="control-label">EMAIL</label>
                        <input class="form-control" type="text" placeholder="Email">
                    </div>
                    <div class="form-group btn-container">
                        <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>ENVOYER</button>
                    </div>
                    <div class="form-group mt-3">
                        <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Se connecter</a></p>
                    </div>
                </form>
            </div>
        </section>
        <!-- Essential javascripts for application to work-->
        <script src=" http://localhost:81/20hectares.com/assets/js/jquery-3.2.1.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/popper.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/bootstrap.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/main.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src=" http://localhost:81/20hectares.com/assets/js/plugins/pace.min.js"></script>
        <script type="text/javascript">
            // Login Page Flipbox control
            $('.login-content [data-toggle="flip"]').click(function () {
                $('.login-box').toggleClass('flipped');
                return false;
            });
        </script>
    </body>
</html>