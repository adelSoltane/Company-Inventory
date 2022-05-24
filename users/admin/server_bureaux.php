<?php
	
	// initialize variables
	$del = "";
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$service = "";
	$bureau = "";
	
	$id = 0;
	$edit_state = false;

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');
	mysqli_query($conn, "SET NAMES UTF8"); 
	//if save button is clicked
	if (isset($_POST['save'])) {
		$bureau = ($_POST['bureau']);
		$service = ($_POST['service']);
		


		if (empty($service) || empty($bureau)) {
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir tous les champs !
</div>';
		} else {
			$sql = "SELECT CodeService FROM services WHERE CodeService='$service'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_fetch_array($result);

			if ($resultCheck['CodeService'] !== $service) {
				$error = '<div class="alert alert-warning" role="alert">
  Veuillez entrer un service disponible !
</div>';

		} else {

		$query = "INSERT INTO bureaux (CodeService, LibelleBureau) VALUES ('$service', '$bureau')";
		mysqli_query($conn, $query);
		$success = '<div class="alert alert-success" role="alert">
  Compte ajouté !
</div>';
	}
		}
	}

	// upcode records
	if (isset($_POST['update'])){
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$service = mysqli_real_escape_string($conn, $_POST['service']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$bureau = mysqli_real_escape_string($conn, $_POST['bureau']);

		if (empty($code) || empty($service) || empty($bureau)) {
			
			header("Location:bureaux_admin.php");
		} else {

		mysqli_query($conn, "UPDATE bureaux SET CodeService='$service', LibelleBureau='$bureau' WHERE IdBureau=$id");
		
		header('location:bureaux_admin.php');
	  }
	}

	// delete records
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($conn, "DELETE FROM bureaux WHERE IdBureau=$id");
		
		$del = '<div class="alert alert-success" role="alert">
  Bureau effacé !
</div>';
	}

	// pagination matériel

	$count = mysqli_query($conn, "SELECT COUNT(IdBureau) as Nbr FROM bureaux");
	$row = mysqli_fetch_array($count);
	$Nbr = $row['Nbr'];
  	$perpage = '10';
  	$nbpage = ceil($Nbr/$perpage);
	

	if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
		$cpage = $_GET['p'];
	} else {
		$cpage = 1;
	}

	// Admin bureaux search
  $mc ="";
 if(isset($_GET['motCle'])){
  
  $mc = $_GET['motCle'];
  $results = mysqli_query($conn, "SELECT * FROM bureaux WHERE CodeService LIKE '%$mc%' OR LibelleBureau LIKE '%$mc%'");

 } else {
  $results = mysqli_query($conn, 'SELECT * FROM bureaux ORDER BY IdBureau DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
 }

	// retrieve records
		$recordd = mysqli_query($conn, "SELECT * FROM services");




?>