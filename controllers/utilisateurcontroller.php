<?php

//require 'config/function.php';
require 'models/utilisateur.php';

class utilisateur {

    public function dashboard() {

        $utilisateur = new utilisateurModel();

        if (!empty($_SESSION['user_id'])) {
            $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $utilisateur->NbreProduitInactifs();
            $notif = new utilisateurModel();
        }

        $toususer = $utilisateur->NreUtilisateur();
        $client = $utilisateur->nbreclient();
        $partenaire = $utilisateur->nbrepartenaire();
        $admin = $utilisateur->nbreadmin();
        $nbreterrains = $utilisateur->nbreProduits("Terrain");
        $ntv = $utilisateur->nbreProduitsVendus("Terrain");
        $gain_ter = $utilisateur->GainProduit("Terrain");
        $nbreMaisons = $utilisateur->nbreProduits("Maison");
        $nbreterrainsP = $utilisateur->nbreProduitsPartenaire("Terrain", $_SESSION['matricule']);
        $nbreMaisonsP = $utilisateur->nbreProduitsPartenaire("Maison", $_SESSION['matricule']);
        $nmv = $utilisateur->nbreProduitsVendus("Maison");
        $gain_mais = $utilisateur->GainProduit("Maison");
        $venteTotal = $utilisateur->totalVente();
        $AchatTotal = $utilisateur->totalAchat();
        $quota = $utilisateur->totalQuota();

        $nbuser = !empty($toususer) ? $toususer[0]['nb'] : "0";
        $nbadmin = !empty($admin) ? $admin[0]['nb'] : "0";
        $nbterr = !empty($nbreterrains) ? $nbreterrains[0]['nb'] : "0";
        $nbmais = !empty($nbreMaisons) ? $nbreMaisons[0]['nb'] : "0";
        $nbterrp = !empty($nbreterrainsP) ? $nbreterrainsP[0]['nb'] : "0";
        $nbmaisp = !empty($nbreMaisonsP) ? $nbreMaisonsP[0]['nb'] : "0";
        $nbclts = !empty($client) ? $client[0]['nb'] : "0";
        $nbtv = !empty($ntv) ? $ntv[0]['nb'] : "0";
        $nbmv = !empty($nmv) ? $nmv[0]['nb'] : "0";
        $quota = !empty($quota) ? $quota[0]['nb'] : "0";
        $nbtvente = !empty($venteTotal) ? $venteTotal[0]['nb'] : "0";
        $nbtachat = !empty($AchatTotal) ? $AchatTotal[0]['nb'] : "0";
        $nbpartenaire = !empty($partenaire) ? $partenaire[0]['nb'] : "0";
        $gt = !empty($gain_ter) ? $gain_ter[0]['nb'] : 0;
        $gm = !empty($gain_mais) ? $gain_mais[0]['nb'] : 0;


        $Notification = $utilisateur->totalNotification();
        $Notification = !empty($Notification) ? $Notification[0]['nb'] : 0;

        if (!empty($_SESSION['matricule'])) {

            if ($_SESSION['role'] == "client") {
                $cnv = !empty($utilisateur->cmdenonvalidee($_SESSION['matricule'])) ? $utilisateur->cmdenonvalidee($_SESSION['matricule'])[0]['nb'] : 0;
                $cv = !empty($utilisateur->cmdevalidee($_SESSION['matricule'])) ? $utilisateur->cmdevalidee($_SESSION['matricule'])[0]['nb'] : 0;
                $ta = !empty($utilisateur->totachat($_SESSION['matricule'])) ? $utilisateur->totachat($_SESSION['matricule'])[0]['nb'] : 0;
                $tc = !empty($utilisateur->totcmde($_SESSION['matricule'])) ? $utilisateur->totcmde($_SESSION['matricule'])[0]['nb'] : 0;
            }
            if ($_SESSION['role'] == "partenaire") {
                $cnv = !empty($utilisateur->cmdenonvalideep($_SESSION['matricule'])) ? $utilisateur->cmdenonvalideep($_SESSION['matricule'])[0]['nb'] : 0;
                $cv = !empty($utilisateur->cmdevalideep($_SESSION['matricule'])) ? $utilisateur->cmdevalideep($_SESSION['matricule'])[0]['nb'] : 0;
                $ta = !empty($utilisateur->totachatp($_SESSION['matricule'])) ? $utilisateur->totachatp($_SESSION['matricule'])[0]['nb'] : 0;
                $tc = !empty($utilisateur->totcmdep($_SESSION['matricule'])) ? $utilisateur->totcmdep($_SESSION['matricule'])[0]['nb'] : 0;
            }
        }



        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire' and $_SESSION['role'] != 'stagiaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        include 'views/utilisateur/tableau_bord.php';
    }

    public function deconnexion() {


        session_destroy();
        ?>
        <script language="javascript">
            document.location.href = "http://localhost:81/20hectares.com/search/utilisateur/connexion";
        </script>
        <?php

    }

    public function inscription() {

        $utilisateur = new utilisateurModel();

        $message = "";

        if (isset($_POST['btn_ajouter'])) {
// generation de code
            $char = '0123456789';
            $code = '';
            for ($i = 0; $i < 3; $i++) {
                $code .= $char[rand() % strlen($char)];
            }
// fin code de generation
            //verifier si le mail et telephone n'existe pas deja
            $utilisateur->email = $_POST['sai_email'];
            $utilisateur->telephone = $_POST['sai_telephone'];
            //die($utilisateur->telephone);
            $utilisateur->role = $_POST['sai_role'];

            $utilisateur->login = filter_input(INPUT_POST, 'sai_username', FILTER_SANITIZE_STRING);


            $verif = $utilisateur->verificationEmailTelephone();

            if ($verif) {

                $message = "Vous etes deja inscrit.";
            } else {
                $username = $utilisateur->verificationUsername();
                if ($username) {
                    $message = "Ce nom utilisateur est déja utilisé.";
                } else {
                    if ($_POST['sai_pass'] === $_POST['sai_conf_pass']) {
                        $utilisateur->mdp = filter_input(INPUT_POST, 'sai_pass', FILTER_SANITIZE_STRING);
                        if ($_POST['sai_role'] == 'client') {
                            $utilisateur->email = $_POST['sai_email'];
                            $utilisateur->telephone = $_POST['sai_telephone'];
                            $utilisateur->role = $_POST['sai_role'];
                            $utilisateur->matricule = date('y') . 'CLI' . $code;
                            $utilisateur->date_creation = date('Y-m-d');
                            $utilisateur->etat = "Actif";
                        }

                        if ($_POST['sai_role'] == 'partenaire') {
                            $utilisateur->email = $_POST['sai_email'];
                            $utilisateur->telephone = $_POST['sai_telephone'];
                            $utilisateur->role = $_POST['sai_role'];
                            $utilisateur->matricule = date('y') . 'PAR' . $code;
                            $utilisateur->date_creation = date('Y-m-d');
                            $utilisateur->etat = "Actif";
                        }

                        $exec = $utilisateur->inscriptionUtilisateur();

                        if (!empty($exec)) {
                            $_SESSION['loginInscrit'] = $utilisateur->login;
                            
                            $message = "Succes...Votre code est " . $utilisateur->matricule . "<br>";
                            $message .= "Vous recevrez un mail de confirmation !";
                            $header = "MIME-Version: 1.0\r\n";
                            $header .= 'From:"29Hectares.com"<info@29hectares.com>' . "\n";
                            $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                            $header .= 'Content-Transfer-Encoding :8bit';


                            $mess = '<html>
                            <body> <div align="center">
                            <h3>Soyez la bienvenue sur 29Hectares, 
                            le site immobilier spécialisé dans la vente des terrains et des maisons</h3>
                            <h4>Merci pour votre inscription...</h4>
                            <h4>Vos Informations de Connexion :</h4>
                            <br><h5>Nom Utilisateur : ' . $utilisateur->telephone . '</h5>
                            <br><h5>Mot de Passe : ' . $utilisateur->telephone . '</h5>
                                <p>Connectez-vous vite pour changer vos informations de connexion.
                                <br /> Merci de votre confiance.</p><br/>
                                <i><a target="_blank" href="https://www.29hectares.com/search/utilisateur/connexion">Cliquez ici</a></i>
                                pour aller à la page de connexion
                                <div></body></html>';

                            $mess = wordwrap($mess, 70, "\r\n");

                            mail($utilisateur->email, "Confirmation - 29Hectares", $mess, $header);
                        } else {

                            $message = "Echec de l'inscription ";
                        }
                    } else {
                        $message = "Les mots de passe ne correspondent pas! ";
                    }
                }
            }
        }

        include 'views/utilisateur/inscription.php';
    }

    public function profil() {

        $utilisateur = new utilisateurModel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $utilisateur->NbreProduitInactifs();
            $notif = new utilisateurModel();
        }

        $message = "";

        if (isset($_POST['btn_modifier'])) {

            $utilisateur->id = $_SESSION['user_id'];
            $utilisateur->nom_prenom = $_POST['sai_nom_prenom'];
            $utilisateur->email = $_POST['sai_email'];
            $utilisateur->telephone = $_POST['sai_telephone'];
            $utilisateur->login = $_POST['sai_login'];
            $utilisateur->mdp = $_POST['sai_mdp'];
            $utilisateur->role = $_POST['sai_role'];
            $utilisateur->matricule = $_POST['sai_matricule'];
            $utilisateur->date_creation = $_POST['sai_date_creation'];
            $utilisateur->etat = $_POST['sai_etat'];

            if (!empty($_FILES['sai_photo']['name'])) {

                move_uploaded_file($_FILES['sai_photo']['tmp_name'], "upload/photo/" . $_POST['sai_matricule'] . $_FILES['sai_photo']['name']);
                $utilisateur->photo = $_POST['sai_matricule'] . $_FILES['sai_photo']['name'];

                $res = $utilisateur->modifierUtilisateur_avec_photo();
            } else {
                $res = $utilisateur->modifierUtilisateur_sans_photo();
            }

            if ($res) {
                $message = "Modification effectuée avec succes";
            } else {
                $message = "Echec de la modification";
            }
        }


        $utilisateur->id = $_SESSION['user_id'];
        $profil = $utilisateur->utilisateurId();

        $id = $profil[0]['id'];
        $login = $profil[0]['login'];
        $nom_prenom = $profil[0]['nom_prenom'];
        $email = $profil[0]['email'];
        $mdp = $profil[0]['mdp'];
        $tel = $profil[0]['telephone'];
        $matricule = $profil[0]['matricule'];
        $role = $profil[0]['role'];
        $date_creation = $profil[0]['date_creation'];
        $photo = $profil[0]['photo'];
        $_SESSION['photo'] = $profil[0]['photo'];
        $etat = $profil[0]['etat'];

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin' and $_SESSION['role'] != 'stagiaire' and $_SESSION['role'] != 'client' and $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        include 'views/utilisateur/profil_utilisateur.php';
    }

    public function connexion() {

        $utilisateur = new utilisateurmodel();

        $notif = new utilisateurModel();

        $message = "";

        if (isset($_POST['btn_connexion'])) {
            
            $utilisateur->login = filter_input(INPUT_POST, "sai_login", FILTER_SANITIZE_STRING);

            $utilisateur->mdp = filter_input(INPUT_POST, "sai_mdp", FILTER_SANITIZE_STRING);

            $cnx = $utilisateur->connexion();

            if (!empty($cnx)) {

                $_SESSION['login'] = $cnx[0]['login'];
                $_SESSION['mdp'] = $cnx[0]['mdp'];
                $_SESSION['role'] = $cnx[0]['role'];
                $_SESSION['email'] = $cnx[0]['email'];
                $_SESSION['telephone'] = $cnx[0]['telephone'];
                $_SESSION['nom_prenom'] = $cnx[0]['nom_prenom'];
                $_SESSION['user_id'] = $cnx[0]['id'];
                $_SESSION['photo'] = $cnx[0]['photo'];
                $_SESSION['matricule'] = $cnx[0]['matricule'];
                $_SESSION['date_creation'] = $cnx[0]['date_creation'];
                $_SESSION['etat'] = $cnx[0]['etat'];

                // notification
                $abonnement = $utilisateur->avoirDateFinAbonnement($_SESSION['matricule']);
                if (!empty($abonnement)) {
                    $_SESSION['abonnement'] = $abonnement[0]['fin'];
                    $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
                    $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);
                }
                // carte
                $carte = $utilisateur->recherchecartematricule($_SESSION['matricule']);
                if (!empty($carte)) {
                    $_SESSION['numero_carte'] = $carte[0]['numero_carte'];
                }


                if ($cnx[0]['role'] == "admin") {

                    $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
                    $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);

                    ?>
                    <script language="javascript">
                        document.location.href = "http://localhost:81/20hectares.com/search/utilisateur/dashboard"
                    </script>

                    <?php

                }

                if ($cnx[0]['role'] == "client") {
                    ?>
                    <script language="javascript">
                        document.location.href = "http://localhost:81/20hectares.com/search/utilisateur/dashboard"
                    </script>

                    <?php

                }

                if ($cnx[0]['role'] == "partenaire") {

                    $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
                    $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);


                    // die();
                    ?>
                    <script language="javascript">
                        document.location.href = "http://localhost:81/20hectares.com/search/utilisateur/dashboard"
                    </script>

                    <?php

                }

                if ($cnx[0]['role'] != "admin" or $cnx[0]['role'] != "stagiaire" or $cnx[0]['role'] != "client" or $cnx[0]['role'] != "partenaire") {
                    $message = "Aucun utilisateur n'a ete defini"
                    ?>
                    <script language="javascript">

                        document.location.href = "http://localhost:81/20hectares.com/search/utilisateur/connexion"
                    </script>

                    <?php

                }
            } else {
                $message = "Nom utilisateur ou mot de passe incorrectes"
                ?>
                <script language="javascript">

                    document.location.href = "http://localhost:81/20hectares.com/search/utilisateur/connexion"
                </script>
                <?php

            }
        }


        include 'views/utilisateur/login.php';
    }

    public function enregistrement() {

        $utilisateur = new utilisateurModel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $utilisateur->NbreProduitInactifs();
            $notif = new utilisateurModel();
        }

        $brech = FALSE;
        $id = "";
        $login = "";
        $nom_prenom = "";
        $telephone = "";
        $email = "";
        $mdp = "";
        $role = "";
        $matricule = "";
        $date_creation = "";
        $photo = "";
        $date_naissance = "";
        $lieu_naissance = "";
        $sexe = "";
        $nationalite = "";
        $ville = "";
        $quartier = "";
        $situation_matrimoniale = "";
        $nombre_enfant = "";
        $etat = "";

        $message = "";

        if (isset($_POST['btn_ajouter'])) {

            $u1 = upload_image('sai_photo', "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
            //move_uploaded_file($_FILES['sai_photo']['tmp_name'], "upload/photo/" . $_POST['sai_matricule'] . $_FILES['sai_photo']['name']);
            if (!empty($u1)) {
                $utilisateur->date_naissance = $_POST['sai_date_naissance'];
                $utilisateur->lieu_naissance = $_POST['sai_lieu_naissance'];
                $utilisateur->nationalite = $_POST['sai_nationalite'];
                $utilisateur->nbre_enfant = $_POST['sai_nbre_enfant'];
                $utilisateur->quartier = $_POST['sai_quartier'];
                $utilisateur->sexe = $_POST['sai_sexe'];
                $utilisateur->sit_matri = $_POST['sai_situtation'];
                $utilisateur->ville = $_POST['sai_ville'];
                $utilisateur->nom_prenom = $_POST['sai_nom_prenom'];
                $utilisateur->email = $_POST['sai_email'];
                $utilisateur->telephone = $_POST['sai_telephone'];
                $utilisateur->login = $_POST['sai_login'];
                $utilisateur->mdp = $_POST['sai_mdp'];
                $utilisateur->role = $_POST['sai_role'];
                $utilisateur->matricule = $_POST['sai_matricule'];
                $utilisateur->date_creation = $_POST['sai_date_creation'];
                $utilisateur->photo = $_POST['sai_matricule'] . $_FILES['sai_photo']['name'];
                $utilisateur->etat = $_POST['sai_etat'];

                $exec = $utilisateur->ajouterUtilisateurComplet();
            }

            if (!empty($exec)) {

                $message = "Enregistrement effectué avec succes !";
            } else {

                $message = "Echec de l'enregistrement ";
            }
        }
// le bouton modifier
        if (isset($_POST['btn_modifier'])) {

            $utilisateur->id = $_POST['sai_id'];
            $utilisateur->nom_prenom = $_POST['sai_nom_prenom'];
            $utilisateur->email = $_POST['sai_email'];
            $utilisateur->telephone = $_POST['sai_telephone'];
            $utilisateur->login = $_POST['sai_login'];
            $utilisateur->mdp = $_POST['sai_mdp'];
            $utilisateur->role = $_POST['sai_role'];
            $utilisateur->matricule = $_POST['sai_matricule'];
            $utilisateur->date_creation = $_POST['sai_date_creation'];
            $utilisateur->date_naissance = $_POST['sai_date_naissance'];
            $utilisateur->lieu_naissance = $_POST['sai_lieu_naissance'];
            $utilisateur->nationalite = $_POST['sai_nationalite'];
            $utilisateur->nbre_enfant = $_POST['sai_nbre_enfant'];
            $utilisateur->quartier = $_POST['sai_quartier'];
            $utilisateur->sexe = $_POST['sai_sexe'];
            $utilisateur->sit_matri = $_POST['sai_situtation'];
            $utilisateur->ville = $_POST['sai_ville'];

            $utilisateur->etat = $_POST['sai_etat'];

            if (!empty($_FILES['sai_photo']['name'])) {
                $u1 = upload_image('sai_photo', "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
                if (!empty($u1)) {
                    $utilisateur->photo = $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name'];
                    $exec = $utilisateur->modifierUtilisateur_avec_photoComplet();
                }
            } else {
                $exec = $utilisateur->modifierUtilisateur_sans_photoComplet();
            }

            if (!empty($exec)) {

                $message = "Modification effectuée avec succes !";
            } else {

                $message = "Echec de la modification ";
            }
        }

        // bouton supprimer
        if (isset($_POST['btn_supprimer'])) {
            $utilisateur->login = $_POST['sai_login'];
            $exec = $utilisateur->supprimerUtilisateur();

            if (!empty($exec)) {

                $message = "Suppression effectuée avec succes !";
            } else {

                $message = "Echec de la suppression ";
            }
        }

// bouton rechercher par post
        if (isset($_POST['btn_rechercher'])) {

            $log = $_POST['sai_rechercher'];

            $sol = $utilisateur->rechercher($log);

            if (!empty($sol)) {

                $id = $sol[0]['id'];
                $login = $sol[0]['login'];
                $nom_prenom = $sol[0]['nom_prenom'];
                $telephone = $sol[0]['telephone'];
                $email = $sol[0]['email'];
                $mdp = $sol[0]['mdp'];
                $role = $sol[0]['role'];
                $matricule = $sol[0]['matricule'];
                $date_creation = $sol[0]['date_creation'];
                $photo = $sol[0]['photo'];
                $date_naissance = $sol[0]['date_naissance'];
                $lieu_naissance = $sol[0]['lieu_naissance'];
                $sexe = $sol[0]['sexe'];
                $nationalite = $sol[0]['nationalite'];
                $ville = $sol[0]['ville'];
                $quartier = $sol[0]['quartier'];
                $nombre_enfant = $sol[0]['nombre_enfant'];
                $situation_matrimoniale = $sol[0]['situation_matrimoniale'];
                $etat = $sol[0]['etat'];
                $brech = TRUE;
            } else {
                $message = "Cet utilisateur n'existe pas !";
            }
        }

        // bouton rechercher par post
        if (isset($_GET['login'])) {
            $login = $_GET['login'];

            $sol = $utilisateur->rechercher($login);

            if (!empty($sol)) {

                $id = $sol[0]['id'];
                $login = $sol[0]['login'];
                $nom_prenom = $sol[0]['nom_prenom'];
                $telephone = $sol[0]['telephone'];
                $email = $sol[0]['email'];
                $mdp = $sol[0]['mdp'];
                $role = $sol[0]['role'];
                $matricule = $sol[0]['matricule'];
                $date_creation = $sol[0]['date_creation'];
                $photo = $sol[0]['photo'];
                $etat = $sol[0]['etat'];
                $date_naissance = $sol[0]['date_naissance'];
                $lieu_naissance = $sol[0]['lieu_naissance'];
                $sexe = $sol[0]['sexe'];
                $nationalite = $sol[0]['nationalite'];
                $ville = $sol[0]['ville'];
                $quartier = $sol[0]['quartier'];
                $nombre_enfant = $sol[0]['nombre_enfant'];
                $situation_matrimoniale = $sol[0]['situation_matrimoniale'];
                $brech = TRUE;
            }
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }

        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/20hectares.com/search/utilisateur/connexion');</script>";
            exit();
        }


        include "views/utilisateur/enregistrement_utilisateur.php";
    }

    public function saisie() {

        $utilisateur = new utilisateurModel();
        $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
        $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);
        $inacts = $utilisateur->NbreProduitInactifs();
        $notif = new utilisateurModel();

        $id = "";
        $login = "";
        $nom_prenom = "";
        $telephone = "";
        $email = "";
        $mdp = "";
        $role = "";
        $matricule = "";
        $date_creation = "";
        $photo = "";
        $etat = "";

        $message = "";

        if (isset($_POST['btn_ajouter'])) {



            $u1 = upload_image('sai_photo', "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
            // move_uploaded_file($_FILES['sai_photo']['tmp_name'], "upload/photo/" . $_POST['sai_matricule'] . $_FILES['sai_photo']['name']);
            if (!empty($u1)) {




                $utilisateur->nom_prenom = $_POST['sai_nom_prenom'];
                $utilisateur->email = $_POST['sai_email'];
                $utilisateur->telephone = $_POST['sai_telephone'];
                $utilisateur->login = $_POST['sai_login'];
                $utilisateur->mdp = $_POST['sai_mdp'];
                $utilisateur->role = $_POST['sai_role'];
                $utilisateur->matricule = $_POST['sai_matricule'];
                $utilisateur->date_creation = $_POST['sai_date_creation'];
                $utilisateur->photo = $_POST['sai_matricule'] . $_FILES['sai_photo']['name'];
                $utilisateur->etat = $_POST['sai_etat'];

                $exec = $utilisateur->ajouterUtilisateur();
            }

            if (!empty($exec)) {

                $message = "Enregistrement effectué avec succes !";
            } else {

                $message = "Echec de l'enregistrement ";
            }
        }
// le bouton modifier
        if (isset($_POST['btn_modifier'])) {



            // move_uploaded_file($_FILES['sai_photo']['tmp_name'], "upload/photo/" . $_POST['sai_matricule'] . $_FILES['sai_photo']['name']);



            $utilisateur->id = $_POST['sai_id'];
            $utilisateur->nom_prenom = $_POST['sai_nom_prenom'];
            $utilisateur->email = $_POST['sai_email'];
            $utilisateur->telephone = $_POST['sai_telephone'];
            $utilisateur->login = $_POST['sai_login'];
            $utilisateur->mdp = $_POST['sai_mdp'];
            $utilisateur->role = $_POST['sai_role'];
            $utilisateur->matricule = $_POST['sai_matricule'];
            $utilisateur->date_creation = $_POST['sai_date_creation'];

            $utilisateur->etat = $_POST['sai_etat'];

            $u1 = upload_image('sai_photo', "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
            // move_uploaded_file($_FILES['sai_photo']['tmp_name'], "upload/photo/" . $_POST['sai_matricule'] . $_FILES['sai_photo']['name']);
            if (!empty($u1)) {
                if (!empty($_FILES['sai_photo']['name'])) {
                    $utilisateur->photo = $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name'];
                    //move_uploaded_file($_FILES['sai_photo']['tmp_name'], "upload/photo/" . $_POST['sai_matricule'] . '' . $_FILES['sai_photo']['name']);
                    $exec = $utilisateur->modifierUtilisateur_avec_photo();
                }
            } else {
                $exec = $utilisateur->modifierUtilisateur_sans_photo();
            }

            if (!empty($exec)) {

                $message = "Modification effectuée avec succes !";
            } else {

                $message = "Echec de la modification ";
            }
        }

        // bouton supprimer
        if (isset($_POST['btn_supprimer'])) {
            $utilisateur->login = $_POST['sai_login'];
            $exec = $utilisateur->supprimerUtilisateur();

            if (!empty($exec)) {

                $message = "Suppression effectuée avec succes !";
            } else {

                $message = "Echec de la suppression ";
            }
        }

// rechercher par post
        if (isset($_POST['btn_rechercher'])) {

            $log = $_POST['sai_rechercher'];
            $mat = $_SESSION['matricule'];


            $sol = $utilisateur->rechercherUtilisateur($mat, $log);

            if (!empty($sol)) {

                $id = $sol[0]['id'];
                $login = $sol[0]['login'];
                $nom_prenom = $sol[0]['nom_prenom'];
                $telephone = $sol[0]['telephone'];
                $email = $sol[0]['email'];
                $mdp = $sol[0]['mdp'];
                $role = $sol[0]['role'];
                $matricule = $sol[0]['matricule'];
                $date_creation = $sol[0]['date_creation'];
                $photo = $sol[0]['photo'];
                $etat = $sol[0]['etat'];
            } else {


                $message = "Cet utilisateur n'existe pas !";
            }
        }


        // bouton rechercher par post
        if (isset($_GET['login'])) {

            $login = $_GET['login'];


            $sol = $utilisateur->rechercher($login);

            if (!empty($sol)) {

                $id = $sol[0]['id'];
                $login = $sol[0]['login'];
                $nom_prenom = $sol[0]['nom_prenom'];
                $telephone = $sol[0]['telephone'];
                $email = $sol[0]['email'];
                $mdp = $sol[0]['mdp'];
                $role = $sol[0]['role'];
                $matricule = $sol[0]['matricule'];
                $date_creation = $sol[0]['date_creation'];
                $sol[0]['date_creation'];
                $photo = $sol[0]['photo'];
                $etat = $sol[0]['etat'];
            }
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'stagiaire' AND $_SESSION['role'] != 'client' AND $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }


        include "views/utilisateur/envoi_utilisateur.php";
    }

    public function liste() {

        $utilisateur = new utilisateurModel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $utilisateur->NbreProduitInactifs();
            $notif = new utilisateurModel();
        }

        $sol = $utilisateur->afficherUtilisateur();

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'admin') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }
        include "views/utilisateur/liste_utilisateurs.php";
    }

    public function liste_compte() {

        $utilisateur = new utilisateurModel();
        if (!empty($_SESSION['user_id'])) {
            $nnl = $utilisateur->notification_Non_Lue($_SESSION['user_id']);
            $nbre = $utilisateur->nbre_notification_Non_Lue($_SESSION['user_id']);
            $inacts = $utilisateur->NbreProduitInactifs();
            $notif = new utilisateurModel();
        }

        if (!empty($_SESSION['matricule'])) {
            $m = $_SESSION['matricule'];
            $sol = $utilisateur->afficherUtilisateurMat($m);
        }

        // debut de la protection

        if (!isset($_SESSION['login']) and ! isset($_SESSION['mdp'])) {

            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }


        if ($_SESSION['role'] != 'stagiaire' AND $_SESSION['role'] != 'client' AND $_SESSION['role'] != 'partenaire') {

            session_destroy();
            echo "
            <script type='text/javascript'>document.location.replace('http://localhost:81/search/utilisateur/connexion');</script>";
            exit();
        }
        include "views/utilisateur/liste_utilisateur_compte.php";
    }

}
