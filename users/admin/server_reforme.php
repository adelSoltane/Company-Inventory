<?php



	// initialize variables
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$materiel = "";
	$proprio = "";
	
	$id = 0;
	$date = "";
	$edit_state = false;

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');
	mysqli_query($conn, "SET NAMES UTF8"); 
	//if save button is clicked
	if (isset($_POST['save'])) {
		$materiel = mysqli_real_escape_string($conn, $_POST['materiel']);

		$proprio = mysqli_real_escape_string($conn, $_POST['proprio']);
		
		

		if (empty($proprio) || empty($materiel)) {
			
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir tous les champs !
</div>';
		}

		 else {

		$query = "INSERT IGNORE INTO reforme (id_materiel, user_id, date_reforme) VALUES ('$materiel', '$proprio', CURRENT_TIMESTAMP)";
		mysqli_query($conn, $query);
		
    
    $success = '<div class="alert alert-success" role="alert">
 Matériel ajouté à la Réforme !
</div>';


		
	}	
		
	
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

	$user = mysqli_query($conn, "SELECT * FROM users");
	$materiel = mysqli_query($conn, "SELECT * FROM materiel");
	$reforme = mysqli_query($conn, 'SELECT * FROM reforme, materiel, users WHERE materiel.id_materiel = reforme.id_materiel AND users.user_id = reforme.user_id ORDER BY id_reforme DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
	if (!$reforme) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
	
?>