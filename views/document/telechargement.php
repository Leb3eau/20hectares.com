<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="La liste des documents par adherent.">
    
    <title>20Hectares - Espace de telechargement</title>
   
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
          <h1><i class="fa fa-th-list"></i> Espace de telechargement</h1>
          
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item Actif"><a href="#">Telechargement</a></li>
        </ul>
      </div>
      <form action="http://localhost:81/20hectares.com/search/document/telechargement" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
     
                                <br>
            <div class="table-responsive">

              <div class="row">
          <div class="col-lg-7">
            <p class="bs-component">
            	<?php foreach ($sol as $key => $value) { ?>
            		
            	
              <a target="_blank" class="btn btn-primary" href="http://localhost:81/20hectares.com/upload/documents/<?php echo $value['piece_jointe_document']; ?>"><?php echo $value['titre_document']; ?></a>

              <?php }  ?>
            </p>
            
            
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