<?php

session_start();

if (isset($_POST['submit'])) {
	
	include 'dbh.inc.php';

	$pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	

	//Error handlers
	//Check if inputs are empty
	if (empty($pseudo) || empty($pwd)) {
		
		header("location: ../index.php?login=empty");
	} else {

		$sql = "SELECT * FROM users WHERE user_pseudo='$pseudo'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if ($resultCheck < 1) {
			
			header("location: ../index.php?login=error");
		} else {
			foreach ($result as $row) {
				//De-hashing the password
				

				if (password_verify($pwd, $row['user_pwd'])) {
					$_SESSION['pseudo'] = $row['user_pseudo'];
					
				 if ($row['user_type']=='Admin') {
					//Log in the user here
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_nom'] = $row['user_nom'];
					$_SESSION['u_prenom'] = $row['user_prenom'];
					$_SESSION['u_fonction'] = $row['user_fonction'];
					$_SESSION['u_pseudo'] = $row['user_pseudo'];
					$_SESSION['u_type'] = $row['user_type'];
					$_SESSION['u_service'] = $row['user_service'];
					header("Location: ../users/home_admin.php");
					exit();
				} elseif ($row['user_type']=='Employe') {
					//Log in the user here
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_nom'] = $row['user_nom'];
					$_SESSION['u_prenom'] = $row['user_prenom'];
					$_SESSION['u_fonction'] = $row['user_fonction'];
					$_SESSION['u_pseudo'] = $row['user_pseudo'];
					$_SESSION['u_type'] = $row['user_type'];
					$_SESSION['u_service'] = $row['user_service'];
					header("Location: ../users/home_employe.php");
					exit();
				} elseif ($row['user_type']=='Directeur') {
					//Log in the user here
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_nom'] = $row['user_nom'];
					$_SESSION['u_prenom'] = $row['user_prenom'];
					$_SESSION['u_fonction'] = $row['user_fonction'];
					$_SESSION['u_pseudo'] = $row['user_pseudo'];
					$_SESSION['u_service'] = $row['user_service'];
					$_SESSION['u_type'] = $row['user_type'];
					header("Location: ../users/home_directeur.php");
					exit();
				} 
				} else {
					
					header("location: ../index.php?login=mdp");
				}
			}
		}
	}

} else {
	echo "Le Nom d'utilisateur ou le mot de passe sont incorrectes !";
	//header("Location: ../index.php?login=error");
	//exit();
}