<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="La liste des documents par stagiaire.">
    
    <title>20Hectares - Dossiers / stagiaire</title>
   
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
          <h1><i class="fa fa-th-list"></i> Liste des dossiers du stagiaire</h1>
          
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Dossiers</li>
          <li class="breadcrumb-item Actif"><a href="#">Liste</a></li>
        </ul>
      </div>
      <form action="http://localhost:81/20hectares.com/search/document/liste_documents_stagiaire" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
     
                                <br>
            <div class="table-responsive">

              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
 <th>Code</th>
                                                <th>Categorie</th>
                                                <th>Titre</th>
                                                <th>Domaine</th>
                                                <th>Auteur</th>
                                                
                                                <th>Opérations</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                         if(!empty($sol))

                                    {
                                    foreach ($sol as $key => $value) 
                                       
                                        { 

                                        ?>
                                             
                                             
                    <tr>

                    <td class="text-nowrap"><?php echo $value['code_document']; ?></td>
                    <td class="text-nowrap"><?php echo $value['categorie_document']; ?></td>
                    <td class="text-nowrap"><?php echo $value['titre_document']; ?></td>
                    <td class="text-nowrap"><?php echo $value['domaine_document']; ?></td>
                    <td class="text-nowrap"><?php echo $value['auteur_document']; ?></td>
                    

                    <td><a target="_blank" href="http://localhost:81/20hectares.com/upload/documents/<?php echo $value['piece_jointe_document']; ?>" class="btn btn-outline-danger">Télécharger</a></td>

                    </tr>

                                    <?php } } ?>
                </tbody>
              </table>
            </div>
            </form>
          </div>
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