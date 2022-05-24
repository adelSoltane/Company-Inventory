<!DOCTYPE html>
<html>
<head>
	<title>ANEP Parc</title>

	<link rel='shortcut icon' type='image/x-icon' href='img/anep.ico' />

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	
	<link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.css"  crossorigin="anonymous">

	

</head>
<body>

<div class="log">
	<h1 style="text-align: center;">ANEP Parc</h1>
	<img src="img/ANEP_img.jpg" style="width:100px;height:150px;border-radius: 50%;  display: block;
    margin-left: auto;
    margin-right: auto;
    width: 20%;" alt="Mountain View">


	<form action="includes/login.inc.php" method="POST">
		<input type="text" name="pseudo" placeholder="Nom d'utilisateur">
		<input type="password" name="pwd" placeholder="Mot de passe">
		<button type="submit" name="submit" class="btn btn-success btn-default btn-block" style="width: 50%; display: block;
    margin-left: auto;
    margin-right: auto;">Valider</button><br>
		<?php 
			$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			

			if(strpos($fullUrl, "login=empty") == true) {
				echo "<p style='color : red; text-align: center;'>Veuillez remplir tous les champs.<p>";
			}
			elseif (strpos($fullUrl, "login=error") == true){
				echo "<p style='color : red; text-align: center;'>Nom d'utilisateur ou mot de passe incorrects.<p>";
			}
			elseif (strpos($fullUrl, "login=mdp") == true){
				echo "<p style='color : red; text-align: center;'>Mot de passe incorrect.<p>";
			}


		?><br>
	</form>
</div>
</body>
</html>