<?php

session_start();

if(!isset($_SESSION['u_id']))
{
    // not logged in
    header('Location: ../../index.php');
    exit();
}

include '../../includes/dbh.inc.php';

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>ANEP Parc</title>
  <!-- Bootstrap css -->

<link rel="stylesheet" href="../../bootstrap-4.0.0/dist/css/bootstrap.css">

        <link rel='shortcut icon' type='image/x-icon' href='../../img/anep.ico' />

  
      <link rel="stylesheet" href="../css/style.css">
      
  
</head>

<body>

  <span class="bckg"></span>
<header>
  <h1><a href="../home_directeur.php">Tableau de bord</a></h1>
  <nav>
    <ul>
      <li>
        <a href="materiel_directeur.php" data-title="Materiel">Matériel</a>
      </li>
      <li>
        <a href="comptes_directeur.php" data-title="Comptes">Comptes</a>
      </li>
      <li>
        <a href="commandes_directeur.php" data-title="Commandes">Commandes</a>
      </li>
      <li>
        <a href="pannes_directeur.php" data-title="Pannes">Pannes</a>
      </li>
    
   
    </ul>
  </nav>
</header>
<main>
  <div class="title">
    <h2>Bienvenue Directeur !</h2>
      <?php
        if(isset($_SESSION['u_id'])) {
          echo '<form action="../../includes/logout.inc.php" method="POST" id="form2">
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

  

  
