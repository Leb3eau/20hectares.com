<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Enregistrement des documents de l'entreprise.">
   
    <title>20Hectares - Document/ enregistrement</title>
    
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    
    <?php include "config/dashboard.php"; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Enregistrement des documents</h1>
          
        </div>
        <?php echo $message; ?>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Document</li>
          <li class="breadcrumb-item"><a href="#">Enregistrement</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Enregistrement des documents</h3>
            <div class="tile-body">
              <form action="http://localhost:81/20hectares.com/search/document/enregistrement" method="POST" enctype="multipart/form-data">
                <center>
                                   <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="form-group">
                                            <table>
                                                <tr>
                                    <td>Entrer le code : </td>
                                    <td><input name="sai_rechercher" class="form-control" type="text"></td>
                                                    <td><button name="btn_rechercher" type="submit" class="btn btn-danger">Rechercher</button></td>
                                                </tr>
                                            </table>      
                                        </div>
                                    </div>
                                </div>

                                </center>
                                <br>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label>Code du document</label>
      <input name="sai_code_document" type="text" class="form-control" value="<?php echo $code_document;?>">
                </div>
                <div class="form-group">
                  <label>Categorie de document</label>
      <select name="sai_categorie_document" class="form-control">

        <option  selected value="<?php echo $categorie_document ;?>"><?php echo $categorie_document ;?></option>

                                                                    
            <option value="Lettre de motivation">Lettre de motivation</option>
            <option value="Curriculum vitae">Curriculum vitae</option>
            <option value="Lettre de recommandation">Lettre de recommandation</option>
            <option value="Piece d'identite">Piece d'identite</option>
            <option value="Rapport de stage">Rapport de stage</option>
            <option value="Rapport d'activite">Rapport d'activite</option>
            <option value="Document juridique">Document juridique</option>
                    
                  </select> 
                </div>

                <div class="form-group">
                 <label>
        Auteur
      </label>
      <input name="sai_auteur_document" type="text" class="form-control" value="<?php echo $auteur_document;?>"> 
                </div>
                <div class="form-group">
                 <label>Domaine / filiere</label>
      <input name="sai_domaine_document" type="text" class="form-control" value="<?php echo $domaine_document;?>">
                </div>
                <div class="form-group">
                   <label>Date de saisie</label>
      <input name="sai_date_document" type="date" class="form-control" value="<?php echo $date_document;?>">
                </div>
                
                </div>
                
                <div class="col-md-6">
                <div class="form-group">
                  <label>
        Piece jointe
      </label>
      <input name="sai_piece_jointe_document" type="file" class="form-control" value="<?php echo $piece_jointe_document;?>">
                </div>
                <div class="form-group">
                  <label>Titre du document</label>
      <input name="sai_titre_document" type="text" class="form-control" value="<?php echo $titre_document;?>">
                </div>

                <div class="form-group">
                   <label>
        Etat du document
      </label>
      <select name="sai_etat_document" class="form-control">

        <option  selected value="<?php echo $etat_document ;?>"><?php echo $etat_document ;?></option>
                                                      
            <option value="Publique">Publique</option>
            <option value="Prive">Privé</option>
            <option value="Protege">Protégé</option>
                  </select>
                </div>
                <div class="form-group">
                 <label>Description du document</label>
  <textarea name="sai_description_document" rows="5" class="form-control"><?php echo $description_document;?></textarea> 
                </div>
                </div>

            </div>
                </div>
              
            </div>
             <center>
            <div class="tile-footer">
              <button class="btn btn-success" name="btn_ajouter"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>
               <button class="btn btn-success" name="btn_modifier"><i class="fa fa-fw fa-lg fa-edit"></i>Modifier</button>
               <button class="btn btn-success" name="btn_supprimer"><i class="fa fa-fw fa-lg fa-eraser"></i>Supprimer</button>
            </div>
            </center>

          </div>
        </div>
        </form>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="http://localhost:81/20hectares.com/assets/js/jquery-3.2.1.min.js"></script>
    <script src="http://localhost:81/20hectares.com/assets/js/popper.min.js"></script>
    <script src="http://localhost:81/20hectares.com/assets/js/bootstrap.min.js"></script>
    <script src="http://localhost:81/20hectares.com/assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="http://localhost:81/20hectares.com/assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>