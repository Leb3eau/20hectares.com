<!DOCTYPE html>
<html>
    <head>

        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href=" http://localhost:81/20hectares.com/assets/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/pidie-0.0.8.css">

        <title>20Hectares - Inscription</title>
    </head>
    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="login-content">
            <div class="logo" style="margin-top: -10px">
                <h1>20Hectares</h1>
            </div>
            <div class="login-box" style="height: 730px;margin-top: -20px; width: 30%">
                <form class="login-form" method="POST" action="http://localhost:81/20hectares.com/search/utilisateur/inscription">
                    <center><p style="color: red"><?php echo $message; ?></p></center>
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INSCRIPTION</h3>
                    
                    <div class="form-group" style="margin-left: -3%; width: 107%">
                        <label>Telephone</label>
                        <div class="pd-telephone-input selectpicker" data-live-search="true">
                            <input name="sai_telephone" type="tel" class="form-control" placeholder="numero de telephone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input name="sai_email" type="email" class="form-control" placeholder="adresse E-mail...">
                    </div>
                    
                    <div class="form-group">
                        <label>Nom utilisateur</label>
                        <input name="sai_username" type="text" class="form-control" placeholder="Nom utilisateur ou login...">
                    </div>
                    <div class="form-group">
                        <label>Mot de Passe</label>
                        <input name="sai_pass" type="password" class="form-control" placeholder="Mot de passe...">
                    </div>
                    <div class="form-group">
                        <label>Confirmez Mot de Passe</label>
                        <input name="sai_conf_pass" type="password" class="form-control" placeholder="Confirmation de mot de passe...">
                    </div>
                    <div class="form-group">
                        <label>Role</label> 
                        <select name="sai_role" type="text" class="form-control">
                            <option value="client">Client</option>
                            <option value="partenaire">Partenaire</option>
                        </select>
                    </div>
                    <div hidden class="form-group">
                        <label>Matricule</label> 
                        <input name="sai_matricule" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="utility">
                            <div class="animated-checkbox">
                                <label>
                                    <p class="semibold-text mb-2"><a href="">Lisez moi</a></p>

                                </label>
                            </div>
                            <p class="semibold-text mb-2"><a href="http://localhost:81/20hectares.com/search/utilisateur/connexion">Se connecter</a></p>
                        </div>
                    </div>

                    <div class="form-group btn-container">
                        <button  name="btn_ajouter" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>S'INSCRIRE</button>
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
        <script src=" http://localhost:81/20hectares.com/assets/js/bootstrap-select.min.js"></script>
        <script src=" http://localhost:81/20hectares.com/assets/js/pidie-0.0.8.js"></script>
        <script type="text/javascript">
            // Login Page Flipbox control
            $('.login-content [data-toggle="flip"]').click(function () {
                $('.login-box').toggleClass('flipped');
                return false;
            });

            var pidie = new Pidie();
        </script>
        
        <?php if(isset($_SESSION['loginInscrit'])){ ?>
        <script type="text/javascript">
            $(function (){
               $('body').delay(3000, function (){
                   location.href='http://localhost:81/20hectares.com/search/utilisateur/connexion';
               });
            });
        </script>
        <?php } ?>
    </body>
</html>