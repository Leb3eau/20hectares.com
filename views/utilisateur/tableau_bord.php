<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Tableau de bord pour administrateur.">
    
    <title>20Hectares | Tableau de bord</title>
    
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href=" http://localhost:81/20hectares.com/assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="http://localhost:81/20hectares.com/assets/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
  
  <?php include "config/dashboard.php"; ?>

   <?php if($_SESSION['role']=="admin") {  ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Tableau de bord</h1>
          <p>Cette page etablit les statistiques</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
        </ul>
      </div>
      <form action="http://localhost:81/20hectares.com/search/utilisateur/dashboard" method="POST">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h6><center>Utilisateurs</center></h6>
              <center><p><b><?php echo $nbuser; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
            <div class="info">
              <h6><center>Terrain Total</center></h6>
              <center><p><b><?php echo $nbterr;  ?></b></p></center>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
             <h6>Total Maisons</h6>
              <center><p><b><?php echo $nbmais; ?></b></p></center>
            </div>
          </div>
        </div>
          <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <h6><center>Total Achats</center></h6>
              <center><p><b><?php echo $nbtachat; ?></b></p></center>
            </div>
          </div>
        </div>
      </div>
            <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
             <h6><center>Clients</center></h6>
              <center><p><b><?php echo $nbclts; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
            <div class="info">
              <h6><center>Terrains non vendus</center></h6>
              <center><p><b><?php echo $nbterr-$nbtv; ?></b></p></center>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h6>Maisons non vendues</h6>
              <center><p><b><?php echo $nbmais-$nbmv; ?></b></p></center>
            </div>
          </div>
        </div>
                <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h6><center>Total Ventes </center></h6>
              <center><p><b><?php echo $nbtvente; ?></b></p></center>
            </div>
          </div>
        </div>
      </div>
            <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
             <h6><center>Partenaires</center></h6>
              <center><p><b><?php echo $nbpartenaire; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
            <div class="info">
              <h6>Terrains vendus</h6>
              <center><p><b><?php echo $nbtv; ?></b></p></center>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h6>Maisons vendues</h6>
              <center><p><b><?php echo $nbmv; ?></b></p></center>
            </div>
          </div>
        </div>
         <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <h6><center>Quota</center></h6>
              <center><p><b><?php echo $quota; ?></b></p></center>
            </div>
          </div>
        </div>
      </div>
            <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
             <h6><center>Administrateurs</center></h6>
              <center><p><b><?php echo $nbadmin; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
            <div class="info">
              <h6>Gain Terrains</h6>
              <center><p><b><?php echo $gt; ?></b></p></center>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h6>Gain Maisons</h6>
              <center><p><b><?php echo $gm; ?></b></p></center>
            </div>
          </div>
        </div>
                <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <h6>Indemnité</h6>
              <center><p><b><?php echo $quota/10; ?></b></p></center>
            </div>
          </div>
        </div>
      </div>
    </form>
        </div>
      </div>
    </main>
    <?php } ?>

       <?php if($_SESSION['role']=="client") {  ?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Tableau de bord</h1>
          <p>Cette page etablit les statistiques</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
        </ul>
      </div>
      <form action="http://localhost:81/20hectares.com/search/utilisateur/dashboard" method="POST">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-building-o fa-3x"></i>
            <div class="info">
              <h6><center>Terrains</center></h6>
              <center><p><b><?php echo $nbterr; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
            <div class="info">
              <h6><center>Commandes Validées</center></h6>
              <center><p><b><?php echo $cv; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <h6><center>Total Achat</center></h6>
              <center><p><b><?php echo $ta; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
             <h6>Notifications</h6>
              <center><p><b><?php echo $Notification; ?></b></p></center>
            </div>
          </div>
        </div>
      </div>
            <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-home fa-3x"></i>
            <div class="info">
             <h6><center>Maisons</center></h6>
              <center><p><b><?php echo $nbmais; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
            <div class="info">
              <h6><center>Commandes non Validées</center></h6>
              <center><p><b><?php echo $cnv; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h6><center> Total Commandes </center></h6>
              <center><p><b><?php echo $tc; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h6>Notifications non lues</h6>
              <center><p><b><?php echo $nbre; ?></b></p></center>
            </div>
          </div>
        </div>
      </div>
           
    </form>
        </div>
      </div>
    </main>
    <?php } ?>

     <?php if($_SESSION['role']=="partenaire") {  ?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Tableau de bord</h1>
          <p>Cette page etablit les statistiques</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
        </ul>
      </div>
      <form action="http://localhost:81/20hectares.com/search/utilisateur/dashboard" method="POST">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-building-o fa-3x"></i>
            <div class="info">
              <h6><center>Terrains</center></h6>
              <center><p><b><?php echo $nbterrp; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
            <div class="info">
              <h6><center>Commandes Validées</center></h6>
              <center><p><b><?php echo $cv; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <h6><center>Total Achat</center></h6>
              <center><p><b><?php echo $ta; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
             <h6>Notifications</h6>
              <center><p><b><?php echo $Notification; ?></b></p></center>
            </div>
          </div>
        </div>
      </div>
            <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-home fa-3x"></i>
            <div class="info">
             <h6><center>Maisons</center></h6>
              <center><p><b><?php echo $nbmaisp; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
            <div class="info">
              <h6><center>Commandes non Validées</center></h6>
              <center><p><b><?php echo $cnv; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h6><center> Total Commandes </center></h6>
              <center><p><b><?php echo $tc; ?></b></p></center>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h6>Notifications non lues</h6>
              <center><p><b><?php echo $nbre; ?></b></p></center>
            </div>
          </div>
        </div>
      </div>
           
    </form>
        </div>
      </div>
    </main>
    <?php } ?>

    <!-- Essential javascripts for application to work-->
    <script src="http://localhost:81/20hectares.com/assets/js/jquery-3.2.1.min.js"></script>
    <script src="http://localhost:81/20hectares.com/assets/js/popper.min.js"></script>
    <script src="http://localhost:81/20hectares.com/assets/js/bootstrap.min.js"></script>
    <script src="http://localhost:81/20hectares.com/assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="http://localhost:81/20hectares.com/assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="http://localhost:81/20hectares.com/assets/js/plugins/chart.js"></script>
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
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