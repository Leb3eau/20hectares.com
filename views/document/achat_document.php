<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Choix du rapport de stage.">
    
    <title>20Hectares - Rapport de stage / choix</title>
   
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
          <h1><i class="fa fa-th-list"></i> Choix du rapport de stage</h1>
          
        </div>
        <?php echo $message; ?>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Rapport de stage</li>
          <li class="breadcrumb-item Actif"><a href="#">Choix</a></li>
        </ul>
      </div>
      <form action="http://localhost:81/20hectares.com/search/document/achat" method="POST">
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
             <center>
              <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="form-group">
                                            <table>
                                                <tr>
                                   <label for="exampleFormControlSelect1">Selectionnez la filière :</label>
    <select class="form-control" name="sai_rechercher"></center>
      <option>Aucun</option>
      <option value="ida">Informatique Developpeur d'Application</option>
      <option value="fcge">Finances Comptabilité et Gestion d'entreprise</option>
      <option value="rhc">Ressources Humaines et Communication</option>
      <option value="gc">Gestion Commerciale</option>
      <option value="ad">Assistanat de Direction</option>
      <option value="rit">Reseaux Informatique et Telecommunications</option>
      <option value="gl">Licence & Master : Genie Logiel ou DASI</option>
      <option value="grh">Licence & Master : Gestion des Ressources Humaines</option>
      <option value="mm">Licence & Master : Marketing & Management</option>
    </select>
    <br>
    <button name="btn_rechercher" class="btn btn-primary mb-2">Lancer l'affichage</button>
                                                </tr>
                                            </table>      
                                        </div>
                                    </div>
                                </div>
                                </center>
                              
                            
                                
                                <br>
            <div class="table-responsive">

              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
       <th scope="col"><center>Code</center></th>
      <th scope="col"><center>Theme du rapport</center></th>
      <th scope="col"><center>Filiere</center></th>
      <th><center>Date d'enregistrement</center></th>
      <th><center>Action</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

      if(!empty($sol))
        { 
      foreach ($sol as $key => $value) {
      ?>
      <tr>
        
        <th scope="row"><center><?php echo $value['code_document']; ?></center></th>
        <td><center><?php echo utf8_encode($value['titre_document']); ?></center></td>
        <td><center><?php echo $value['domaine_document']; ?></center></td>
        <td><center><?php echo $value['date_document']; ?></center></td>
        <td><center><button class="btn btn-outline-danger" name="btn_acheter">Acheter</button></center></td>
      </tr>
      <?php } } ?>
                </tbody>
              </table>
              </form>
               <br>
 
            </div>
          </div>

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
    <!-- Data table plugin-->
    <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/js/plugins/dataTables.bootstrap.min.js"></script>
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