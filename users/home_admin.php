<?php

session_start();

if(!isset($_SESSION['u_id']))
{
    // not logged in
    header('Location: ../index.php');
    exit();
}

include '../includes/dbh.inc.php';

$query1 = "SELECT user_type, count(*) as number FROM users GROUP BY user_type";
$result1 = mysqli_query($conn, $query1);

$query2 = "SELECT CodeService, count(*) as number FROM bureaux GROUP BY CodeService";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT fournisseur, count(*) as number FROM materiel GROUP BY fournisseur";
$result3 = mysqli_query($conn, $query3);

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>ANEP Parc</title>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
      <link rel='shortcut icon' type='image/x-icon' href='../img/anep.ico' />

      <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">

      <link rel="stylesheet" href="css/style.css">
      
</head>

<body>

  <span class="bckg"></span>
<header>
  <h1><a href="home_admin.php">Tableau de bord</a></h1>
  <nav>
    <ul>
     <li>
        <a href="admin/materiel_admin.php" data-title="Materiel">Matériel</a>
      </li>
      <li>
        <a href="admin/comptes_admin.php" data-title="Comptes">Comptes</a>
      </li>
      <li>
        <a href="admin/commandes_admin.php" data-title="Commandes">Commandes</a>
      </li>
      <li>
        <a href="admin/pannes_admin.php" data-title="Pannes">Pannes</a>
      </li>
      <li>
        <a href="admin/fournisseurs_admin.php" data-title="Fournisseurs">Fournisseurs</a>
      </li>
      <li>
        <a href="admin/services_admin.php" data-title="Directions">Services</a>
      </li>
      <li>
        <a href="admin/bureaux_admin.php" data-title="Bureaux">Bureaux</a>
      </li>
      <li>
        <a href="admin/affectations_admin.php" data-title="Affectation">Affectations</a>
      </li>
      <li>
        <a href="admin/reforme.php" data-title="Réforme">Réforme</a>
      </li>
    </ul>
  </nav>
</header>
<main>
  <div class="title">
    <h2>Bienvenue Admin !</h2>
    
  
    
    <?php
        if(isset($_SESSION['u_id'])) {
          echo '<form action="../includes/logout.inc.php" method="POST" id="form2">
      <button id="myBtn" type="submit" name="submit" id="logout">Deconnexion</button>
    </form>';
        }
      ?> 
    
    <a href="#"><?php 


    $uid = $_SESSION['u_id'];

    $sql = "SELECT user_pseudo FROM users WHERE user_id='$uid';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_fetch_assoc($result);

    

        echo $resultCheck['user_pseudo'];
    
     ?></a>
  </div>

  
    <div id="content">
      <h1>Bienvenue sur ANEP PARC</h1>
    </div>

    
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart for Sarah's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawSarahChart);

      // Draw the pie chart for the Anthony's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawAnthonyChart);

      // Callback that draws the pie chart for Sarah's pizza.
      function drawSarahChart() {

        // Create the data table for Sarah's pizza.
        var data = google.visualization.arrayToDataTable([

          ]);
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([<?php 
          while ($row = mysqli_fetch_array($result1)) {
            echo "['".$row["user_type"]."', ".$row["number"]."],";
          }
          ?>
        ]);

        // Set options for Sarah's pie chart.
        var options = {title:'Pourcentage du type de comptes',
                       width:600,
                       height:300};

        // Instantiate and draw the chart for Sarah's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('Sarah_chart_div'));
        chart.draw(data, options);
      }

      // Callback that draws the pie chart for Anthony's pizza.
      function drawAnthonyChart() {

        // Create the data table for Anthony's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([<?php 
          while ($row = mysqli_fetch_array($result2)) {
            echo "['".$row["CodeService"]."', ".$row["number"]."],";
          }
          ?>
        ]);

        // Set options for Anthony's pie chart.
        var options = {title:'Pourcentage des bureaux en fonction des services',
                       width:600,
                       height:300};

        // Instantiate and draw the chart for Anthony's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('Anthony_chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td><div id="Sarah_chart_div" style="border: 1px solid #ccc"></div></td>
        <td><div id="Anthony_chart_div" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>

    <script type="text/javascript">

      // Load Charts and the corechart and barchart packages.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart and bar chart when Charts is loaded.
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([<?php 
          while ($row = mysqli_fetch_array($result3)) {
            echo "['".$row["fournisseur"]."', ".$row["number"]."],";
          }
          ?>
        ]);

        

        var barchart_options = {title:'Fournisseurs les plus influents',
                       width:1200,
                       height:300,
                       legend: 'none'};
        var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
        barchart.draw(data, barchart_options);
      }
</script>
<body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        
        <td><div id="barchart_div" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
    
    
  

   
      
</main>
  
 
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.js"></script>
    <script src="../js/Chart.min.js"></script>
    
    
   
    <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</body>

</html>


