<?php

session_start();

if(!isset($_SESSION['u_id']))
{
    // not logged in
    header('Location: ../index.php');
    exit();
}

include '../includes/dbh.inc.php';

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>ANEP Parc</title>

    <link rel='shortcut icon' type='image/x-icon' href='../img/anep.ico' />

      
      <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.css">

      <link rel="stylesheet" href="css/style.css">
      
  
</head>

<body>

  <span class="bckg"></span>
<header>
  <h1><a href="home_directeur.php">Tableau de bord</a></h1>
  <nav>
    <ul>
     
      <li>
        <a href="directeur/materiel_directeur.php" data-title="Materiel">Matériel</a>
      </li>
      <li>
        <a href="directeur/comptes_directeur.php" data-title="Comptes">Comptes</a>
      </li>
      <li>
        <a href="directeur/commandes_directeur.php" data-title="Commandes">Commandes</a>
      </li>
      <li>
        <a href="directeur/pannes_directeur.php" data-title="Pannes">Pannes</a>
      </li>
    
    </ul>
  </nav>
</header>
<main>
  <div class="title">
    <h2>Bienvenue Directeur !</h2>
      <?php
        if(isset($_SESSION['u_id'])) {
          echo '<form action="../includes/logout.inc.php" method="POST" id="form2">
      <button id="myBtn" type="submit" name="submit" id="logout">Deconnexion</button>
    </form>';
        }
      ?> 
    
    <a href="javascript:void(0);"><?php 


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


    <div style="text-align: center; border-color: #5F9EA0; border-radius: 3px; border-style: solid; margin: 20px 50px;">
    <img style="display: inline-block; margin-top: 80px;" src="../img/parc-informatique.png" alt="Mountain View">
    <p style="display: inline-block;">Gérez votre matériel informatique grâce à ANEP Parc ! En tant que directeur vous avez la possibilité de filtrer les commandes des employés de votre service.</p>
    </div>
  
</main>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
