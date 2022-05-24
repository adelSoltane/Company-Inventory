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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<!-- Bootstrap css -->

<link rel="stylesheet" href="../../bootstrap-4.0.0/dist/css/bootstrap.css">




<link rel='shortcut icon' type='image/x-icon' href='../../img/anep.ico' />


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <title print-hidden>ANEP Parc</title>
  
  
      <link rel="stylesheet" media="screen" href="../css/style.css">
      <link media="print" rel="stylesheet" href="../css/print.css"/>


  
</head>

<body>

  <span class="bckg"></span>
<header>
  <h1><a href="../home_admin.php">Tableau de bord</a></h1>
  <nav>
    <ul>
     <li>
        <a href="materiel_admin.php" data-title="Materiel">Matériel</a>
      </li>
      <li>
        <a href="comptes_admin.php" data-title="Comptes">Comptes</a>
      </li>
      <li>
        <a href="commandes_admin.php" data-title="Commandes">Commandes</a>
      </li>
      <li>
        <a href="pannes_admin.php" data-title="Pannes">Pannes</a>
      </li>
      <li>
        <a href="fournisseurs_admin.php" data-title="Fournisseurs">Fournisseurs</a>
      </li>
      <li>
        <a href="services_admin.php" data-title="Services">Services</a>
      </li>
      <li>
        <a href="bureaux_admin.php" data-title="Bureaux">Bureaux</a>
      </li>
      <li>
        <a href="affectations_admin.php" data-title="Affectations">Affectations</a>
      </li>
      <li>
        <a href="reforme.php" data-title="Réforme">Réforme</a>
      </li>
    </ul>
  </nav>
</header>
<main>
  <div class="title">
    <h2>Bienvenue Admin !</h2>
       <?php
        if(isset($_SESSION['u_id'])) {
          echo '<form action="../../includes/logout.inc.php" method="POST" id="form2">
      <button id="myBtn" type="submit" name="submit" id="logout">Deconnexion</button>
    </form>';
        }
      ?> 
    
    <a href="javascript:void(0);"><?php 


 $uid = $_SESSION['u_id'];

    $sql = "SELECT user_pseudo FROM users WHERE user_id='$uid'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_fetch_assoc($result);

        echo $resultCheck['user_pseudo'];
    
     ?></a>
  </div>

  