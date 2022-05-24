<?php



	// initialize variables
	$error22 = "";
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$materiel = "";
	$description = "";
	$uid = $_SESSION['u_id'];
	$id = 0;
	$date = "";
	$edit_state = false;

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');
	mysqli_query($conn, "SET NAMES UTF8"); 
	//if save button is clicked
	if (isset($_POST['save'])) {
		$materiel = mysqli_real_escape_string($conn, $_POST['materiel']);
		$description = mysqli_real_escape_string($conn, $_POST['description']);
		$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
		

		if (empty($description) || empty($materiel)) {
			
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir tous les champs !
</div>';
		} else {
			$sql = "SELECT * FROM panne WHERE id_materiel='$materiel' AND reparation IS NULL";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck > 0) {
				$error = '<div class="alert alert-danger" role="alert">
  Une panne a déjà été envoyée pour ce matériel !
</div>';

		} else {
			$sql2 = "SELECT * FROM reforme WHERE id_materiel='$materiel'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);

			if ($resultCheck2 > 0) {
				$error2 = '<div class="alert alert-danger" role="alert">
  Ce matériel nest plus disponible !
</div>';

		} else {
			$sql22 = "SELECT id_materiel FROM affectation WHERE id_materiel='$materiel' AND user_id='$uid'";
			$result22 = mysqli_query($conn, $sql22);
			$resultCheck22 = mysqli_fetch_array($result22);

			if ($resultCheck22['id_materiel'] !== $materiel) {
				$error22 = '<div class="alert alert-warning" role="alert">
  Veuillez entrer un matériel disponible !
</div>';

		} else {

		$query = "INSERT IGNORE INTO panne (id_materiel, observation, date_panne, user_id) VALUES ('$materiel', '$description', CURRENT_TIMESTAMP, '$uid')";
		mysqli_query($conn, $query);
		
    
    $success = '<div class="alert alert-success" role="alert">
  Signalement envoyée !
</div>';


	}
	}	
	}	
	}
}


	// keep panne at 0
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		
		mysqli_query($conn, "INSERT INTO reforme (user_id, id_materiel, date_reforme) SELECT user_id, id_materiel, CURRENT_TIMESTAMP FROM panne WHERE id_panne=$id");
		mysqli_query($conn, "DELETE FROM panne WHERE id_panne=$id");
	//	mysqli_query($conn, "DELETE FROM materiel WHERE panne.id_materiel=materiel.id_materiel");
		
	}


	// set panne at 1
	if (isset($_GET['ok'])) {
		$id = $_GET['ok'];
		mysqli_query($conn, "UPDATE panne SET reparation=1 WHERE id_panne=$id");
		
	}

	// pagination pannes

	$count = mysqli_query($conn, "SELECT COUNT(id_panne) as Nbr FROM panne");
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
	$resultss = mysqli_query($conn, "SELECT * FROM affectation, materiel, users WHERE users.user_id = affectation.user_id AND materiel.id_materiel = affectation.id_materiel AND affectation.user_id='$uid' AND date_affectation_fin = '00-00-0000'");

	$results = mysqli_query($conn, 'SELECT * FROM panne, materiel, users WHERE users.user_id = panne.user_id AND materiel.id_materiel = panne.id_materiel AND reparation IS NULL ORDER BY id_panne DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');

	$recordd = mysqli_query($conn, "SELECT * FROM panne, users WHERE users.user_id = panne.user_id AND reparation=1");

	$resultsss = mysqli_query($conn, 'SELECT * FROM panne, materiel, users WHERE users.user_id = panne.user_id AND materiel.id_materiel = panne.id_materiel AND reparation=1 ORDER BY id_panne DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');

	

	$description = mysqli_query($conn, "SELECT * FROM panne, materiel, users WHERE users.user_id = panne.user_id AND materiel.id_materiel = panne.id_materiel AND reparation IS NULL");
?>