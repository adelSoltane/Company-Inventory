<?php



	// initialize variables
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$designation = "";
	$quantite = "";
	$uid = "";
	$id = 0;
	$uservice = ($_SESSION['u_service']);
	$edit_state = false;

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');
	mysqli_query($conn, "SET NAMES UTF8"); 
	//if save button is clicked
	if (isset($_POST['save'])) {
		$designation = mysqli_real_escape_string($conn, $_POST['designation']);
		$quantite = mysqli_real_escape_string($conn, $_POST['quantite']);
		$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
		

		if (empty($quantite) || empty($designation)) {
			
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir tous les champs !
</div>';
		} else if ($quantite > 99) {
			$error = '<div class="alert alert-warning" role="alert">
  Veuillez ajouter une quantité inférieure à 99 !
</div>';
		} else {

		$query = "INSERT INTO commandes (designation_commande, quantite_commande, date_commande, user_id) VALUES ('$designation', '$quantite', CURRENT_TIMESTAMP, '$uid')";
		mysqli_query($conn, $query);
		
    
    $success = '<div class="alert alert-success" role="alert">
  Commande envoyée !
</div>';

}
}

if (isset($_POST['save2'])) {
		$designation = mysqli_real_escape_string($conn, $_POST['designation']);
		$quantite = mysqli_real_escape_string($conn, $_POST['quantite']);
		$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
		

		if (empty($quantite) || empty($designation)) {
			
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir tous les champs !
</div>';
		} else if ($quantite > 99) {
			$error = '<div class="alert alert-warning" role="alert">
  Veuillez ajouter une quantité inférieure à 99 !
</div>';
		} else {

		$query = "INSERT INTO commandes (designation_commande, quantite_commande, date_commande, user_id, confirmation_commande) VALUES ('$designation', '$quantite', CURRENT_TIMESTAMP, '$uid', 1)";
		mysqli_query($conn, $query);
		
    
    $success = '<div class="alert alert-success" role="alert">
  Commande envoyée !
</div>';
		
		
		
}	
}


	// commande delete
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($conn, "DELETE FROM commandes WHERE id_commandes=$id");
	
		header('location:commandes_directeur.php');
	}

	// set commande at 0
	if (isset($_GET['invt'])) {
		$id = $_GET['invt'];
		mysqli_query($conn, "UPDATE commandes SET confirmation_commande=0 WHERE id_commandes=$id");
		header('location:commandes_admin.php');
	}


	// set commande at 1
	if (isset($_GET['ok'])) {
		$id = $_GET['ok'];
		mysqli_query($conn, "UPDATE commandes SET confirmation_commande=1 WHERE id_commandes=$id");
		header('location:commandes_directeur.php');
	}

	// pagination commandes

	$count = mysqli_query($conn, "SELECT COUNT(id_commandes) as Nbr FROM commandes");
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
	$results = mysqli_query($conn, "SELECT * FROM commandes, users WHERE users.user_id = commandes.user_id AND users.user_service = '$uservice' AND confirmation_commande IS NULL");
	$recordd = mysqli_query($conn, 'SELECT * FROM commandes, users WHERE users.user_id = commandes.user_id AND confirmation_commande=1 ORDER BY id_commandes DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
	$recorddd = mysqli_query($conn, 'SELECT * FROM commandes, users WHERE users.user_id = commandes.user_id AND confirmation_commande=0 ORDER BY id_commandes DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');


?>