<?php
	
	// initialize variables
	$del = "";
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$materiel = "";
	$proprio = "";
	$date_debut = "";
	
	$id = 0;
	$edit_state = false;
	

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');
	mysqli_query($conn, "SET NAMES UTF8"); 
	//if save button is clicked
	if (isset($_POST['save'])) {
		$materiel = ($_POST['materiel']);
		$proprio = ($_POST['proprio']);
		$date_debut = ($_POST['date_debut']);
		
		

		if (empty($materiel) || empty($date_debut)) {
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir au moins le premier et dernier champs !
</div>';
		} else {
			$sql = "SELECT id_materiel FROM materiel WHERE id_materiel='$materiel'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_fetch_array($result);

			if ($resultCheck['id_materiel'] !== $materiel) {
				$error = '<div class="alert alert-warning" role="alert">
  Veuillez entrer un matériel disponible !
</div>';

		} else {
			$sql2 = "SELECT * FROM reforme WHERE id_materiel='$materiel'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);

			if ($resultCheck2 > 0) {
				$error2 = '<div class="alert alert-danger" role="alert">
  Ce matériel nest plus disponible !
</div>';

		}else {
				
				//Insert the user into the database
				$sql = "INSERT INTO affectation (user_id, id_materiel, date_affectation, date_affectation_fin) VALUES ('$proprio', '$materiel', '$date_debut', '$date_fin');";
				$result = mysqli_query($conn, $sql);
		
		header("Location:affectations_admin.php");
	}}
		}
	}



	// update records
	if (isset($_POST['update'])){
		$materiel = mysqli_real_escape_string($conn, $_POST['materiel']);
		$proprio = mysqli_real_escape_string($conn, $_POST['proprio']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		
		$date_debut = mysqli_real_escape_string($conn, $_POST['date_debut']);
		$date_fin = mysqli_real_escape_string($conn, $_POST['date_fin']);
		

		if (empty($materiel) || empty($date_debut)) {
			
			header("Location:affectations_admin.php");
		}  else {
				
				

		mysqli_query($conn, "UPDATE affectation SET user_id='$proprio', id_materiel='$materiel', date_affectation='$date_debut', date_affectation_fin='$date_fin' WHERE id_affectation=$id");
		
		header('location:affectations_admin.php');
	  }
	}


	// delete records
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($conn, "UPDATE affectation SET date_affectation_fin=CURRENT_TIMESTAMP WHERE id_affectation=$id");
		
		header('location:affectations_admin.php');
	}

	// pagination matériel

	$count = mysqli_query($conn, "SELECT COUNT(id_affectation) as Nbr FROM affectation");
	$row = mysqli_fetch_array($count);
	$Nbr = $row['Nbr'];
  	$perpage = '10';
  	$nbpage = ceil($Nbr/$perpage);
	

	if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
		$cpage = $_GET['p'];
	} else {
		$cpage = 1;
	}

	// retrieve records
	$results = mysqli_query($conn, "SELECT * FROM users");
	$records = mysqli_query($conn, "SELECT * FROM affectation");
	$recordd = mysqli_query($conn, "SELECT * FROM materiel");
	$recorddd = mysqli_query($conn, 'SELECT id_affectation, user_pseudo, user_nom, user_prenom, libelle, marque, date_affectation, date_affectation_fin, code FROM affectation,users,materiel WHERE affectation.user_id = users.user_id and affectation.id_materiel = materiel.id_materiel AND date_affectation_fin = "00-00-000" ORDER BY id_affectation DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
	$recordddd = mysqli_query($conn, 'SELECT id_affectation, user_nom, user_prenom, libelle, marque, date_affectation, date_affectation_fin, code FROM affectation,users,materiel WHERE affectation.user_id = users.user_id and affectation.id_materiel = materiel.id_materiel AND date_affectation_fin != "00-00-000" ORDER BY id_affectation DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');


?>