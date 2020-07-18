<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Enregistrement des documents de l'entreprise.">
   
    <title>20Hectares - Dossiers / envoi</title>
    
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
          <h1><i class="fa fa-edit"></i> Envoi des dossiers</h1>
          
        </div>
        <?php echo $message; ?>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Dossiers</li>
          <li class="breadcrumb-item"><a href="#">Envoi</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Envoi des dossiers</h3>
            <div class="tile-body">
              <form action="http://localhost:81/20hectares.com/search/document/saisie" method="POST" enctype="multipart/form-data">
                
                                <br>
                <div class="row">
                <div class="col-md-6">
                <div hidden="" class="form-group">
                  <label>Code du document</label>
      <input name="sai_code_document" type="text" class="form-control" value="<?php echo $code_document;?>">
                </div>
                <div class="form-group">
                  <label>Titre du dossier</label>
      <select name="sai_titre_document" class="form-control">
                                                        
            <option value="Lettre de motivation">Lettre de motivation</option>
            <option value="Curriculum vitae">Curriculum vitae</option>
            <option value="Lettre de recommandation">Lettre de recommandation</option>
            <option value="Piece d'identite">Piece d'identite</option>
                
                  </select> 
                </div>

                <div hidden="" class="form-group">
                 <label>
        Auteur
      </label>
      <input name="sai_auteur_document" type="text" class="form-control" value="<?php echo $_SESSION['matricule'];?>"> 
                </div>
                <div hidden="" class="form-group">
                 <label>Domaine / filiere</label>
      <input name="sai_domaine_document" type="text" class="form-control" value="Dossiers de stage">
                </div>
                <div hidden="" class="form-group">
                   <label>Date de saisie</label>
      <input name="sai_date_document" type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                </div>
                
                </div>
                
                <div class="col-md-6">
                <div hidden="" class="form-group">
                  <label>Categorie du document</label>
      <input name="sai_categorie_document" type="text" class="form-control" value="Dossiers de stage">
                </div>
                <div class="form-group">
                	<label>
        Piece jointe
      </label>
      <input name="sai_piece_jointe_document" type="file" class="form-control">
                  
                </div>

                <div hidden="" class="form-group">
                   <label>
        Etat du document
      </label>
      <input name="sai_etat_document" type="text" class="form-control" value="Protege">
                </div>
                <div hidden="" class="form-group">
                 <label>Description du document</label>
  <textarea name="sai_description_document" rows="5" class="form-control"></textarea> 
                </div>
                </div>

            </div>
                </div>
              
            </div>
             <center>
            <div class="tile-footer">
              <button class="btn btn-success" name="btn_ajouter"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>
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