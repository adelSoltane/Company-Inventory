<?php
	
	// initialize variables
	$del = "";
	$error22 = "";
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$nom = "";
	$prenom = "";
	$fonction = "";
	$pseudo = "";
	$pwd = "";
	$type = "";
	$id = 0;
	$edit_state = false;
	$service ="";
	$uservice = ($_SESSION['u_service']);


	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');
	mysqli_query($conn, "SET NAMES UTF8"); 
	//if save button is clicked
	if (isset($_POST['save'])) {
		$nom = ($_POST['nom']);
		$prenom = ($_POST['prenom']);
		$fonction = ($_POST['fonction']);
		$pseudo = ($_POST['pseudo']);
		$pwd = ($_POST['pwd']);
		$type = ($_POST['type']);
		$service = ($_POST['service']);

		if (empty($nom) || empty($prenom) || empty($fonction) || empty($pseudo) || empty($pwd) || empty($type) || empty($service)) {
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir tous les champs !
</div>';
		} else {
			//Check if inpu characters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $nom) || !preg_match("/^[a-zA-Z]*$/", $prenom)) {
			$error = '<div class="alert alert-warning" role="alert">
  Veuillez utiliser des lettres pour le nom et le prénom !
</div>';
		} else {
			$sql = "SELECT * FROM users WHERE user_pseudo='$pseudo'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if ($resultCheck > 0) {
				$error = '<div class="alert alert-warning" role="alert">
  Ce pseudo est déjà pris !
</div>';
			} else {
			$sql2 = "SELECT CodeService FROM services WHERE CodeService='$service'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_fetch_array($result2);

			if ($resultCheck2['CodeService'] !== $service) {
				$error2 = '<div class="alert alert-warning" role="alert">
  Veuillez entrer un service disponible !
</div>';

		} else {
				//Hashing the password
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
				//Insert the user into the database
				$sql = "INSERT INTO users (user_nom, user_prenom, user_fonction, user_pseudo, user_pwd, user_type, user_service) VALUES ('$nom', '$prenom', '$fonction', '$pseudo', '$hashedPwd', '$type', '$service');";
				$result = mysqli_query($conn, $sql);
		
		 $success = '<div class="alert alert-success" role="alert">
  Compte ajouté !
</div>';
		}
	}
}
}
}

	// update records
	if (isset($_POST['update'])){
		$nom = mysqli_real_escape_string($conn, $_POST['nom']);
		$prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$fonction = mysqli_real_escape_string($conn, $_POST['fonction']);
		$pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);
		$service = mysqli_real_escape_string($conn, $_POST['service']);

		if (empty($nom) || empty($prenom) || empty($fonction) || empty($pseudo) || empty($pwd) || empty($type) || empty($service)) {
			
			header("Location:comptes_admin.php");
		} else {
			//Check if input characters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $nom) || !preg_match("/^[a-zA-Z]*$/", $prenom)) {
			header("Location:comptes_admin.php");
			exit();
		} else {
				//Hashing the password
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

		mysqli_query($conn, "UPDATE users SET user_nom='$nom', user_prenom='$prenom', user_fonction='$fonction', user_pseudo='$pseudo', user_pwd='$hashedPwd', user_type='$type', user_service='$service' WHERE user_id=$id");
		
		header('location:comptes_admin.php');
	  }
	}
}

	// delete records
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($conn, "DELETE FROM users WHERE user_id=$id");
		
		$del = '<div class="alert alert-success" role="alert">
  Compte effacé !
</div>';
	}

	// pagination comptes

	$count = mysqli_query($conn, "SELECT COUNT(user_id) as Nbr FROM users");
	$row = mysqli_fetch_array($count);
	$Nbr = $row['Nbr'];
  	$perpage = '10';
  	$nbpage = ceil($Nbr/$perpage);
	

	if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
		$cpage = $_GET['p'];
	} else {
		$cpage = 1;
	}

	 // Admin comptes search
  $mc ="";
 if(isset($_GET['motCle'])){
  
  $mc = $_GET['motCle'];
  $results = mysqli_query($conn, "SELECT * FROM users WHERE user_prenom LIKE '%$mc%' OR user_nom LIKE '%$mc%' OR user_type LIKE '%$mc%' OR user_pseudo LIKE '%$mc%' OR user_fonction LIKE '%$mc%' OR user_service LIKE '%$mc%'");

 } else {
  $results = mysqli_query($conn, 'SELECT * FROM users, services WHERE users.user_service = services.CodeService ORDER BY user_id DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
 }

	// retrieve records
	
	$recordd = mysqli_query($conn, "SELECT * FROM services");
	$resultsD = mysqli_query($conn, 'SELECT * FROM users, services WHERE users.user_service = services.CodeService AND users.user_service = '.$uservice.' ORDER BY user_id DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
	


?>