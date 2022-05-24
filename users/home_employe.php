<?php

session_start();

if(!isset($_SESSION['u_id']))
{
    // not logged in
    header('Location: .../index.php');
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
  <h1><a href="home_employe.php">Tableau de bord</a></h1>
  <nav>
    <ul>
      <li>
        <a href="employe/materiel_employe.php" data-title="Materiel">Matériel</a>
      </li>
      <li>
        <a href="employe/commandes_employe.php" data-title="Commandes">Commandes</a>
      </li>
      <li>
        <a href="employe/pannes_employe.php" data-title="Pannes">Pannes</a>
      </li>
   
    </ul>
  </nav>
</header>
<main>
  <div class="title">
    <h2>Bienvenue Employé !</h2>
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
  <h1>ANEP PARC</h1>

    <div style="text-align: center; border-color: #5F9EA0; border-radius: 3px; border-style: solid; margin: 20px 50px;">
    <img style="display: inline-block; margin-top: 80px;" src="../img/parc-informatique.png" alt="Mountain View">
    <p style="display: inline-block;">Gérez votre matériel informatique grâce à ANEP Parc ! En tant qu'empoloyé vous avez la possibilité de signaler des pannes de votre matériel ou d'envoyer des commandes.</p>
    </div>
  
</main>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
