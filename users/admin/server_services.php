<?php
	
	// initialize variables
	$del = "";
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$service = "";
	$code = "";
	$id = 0;
	$edit_state = false;

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');
	mysqli_query($conn, "SET NAMES UTF8"); 
	//if save button is clicked
	if (isset($_POST['save'])) {
		$service = ($_POST['service']);
		$code = ($_POST['code']);


		if (empty($code) || empty($service)) {
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir tous les champs !
</div>';
		} else {
			$sql = "SELECT CodeService FROM services WHERE CodeService='$code'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_fetch_array($result);

			if ($resultCheck['CodeService'] == $code) {
				$error = '<div class="alert alert-warning" role="alert">
  Ce code de service est déjà utilisé !
</div>';
		} else {
			$sql2 = "SELECT LibelleService FROM services WHERE LibelleService='$service'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_fetch_array($result2);

			if ($resultCheck2['LibelleService'] == $service) {
				$error2 = '<div class="alert alert-warning" role="alert">
  Ce nom de service est déjà utilisé !
</div>';
		} else {

		$query = "INSERT INTO services (CodeService, LibelleService) VALUES ('$code', '$service')";
		mysqli_query($conn, $query);
		
		$success = '<div class="alert alert-success" role="alert">
  Service ajouté !
</div>';
		}
		}
		}
	}

	// upcode records
	if (isset($_POST['update'])){
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$service = mysqli_real_escape_string($conn, $_POST['service']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		

		if (empty($code) || empty($service)) {
			
			header("Location:services_admin.php");
		} else {

		mysqli_query($conn, "UPDATE services SET CodeService='$code', LibelleService='$service' WHERE IdService=$id");
		
		header('location:services_admin.php');
	  }
	}

	// delete records
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($conn, "DELETE FROM services WHERE IdService=$id");
		
		$del = '<div class="alert alert-success" role="alert">
  Service effacé !
</div>';
	}

	// pagination matériel

	$count = mysqli_query($conn, "SELECT COUNT(IdService) as Nbr FROM services");
	$row = mysqli_fetch_array($count);
	$Nbr = $row['Nbr'];
  	$perpage = '10';
  	$nbpage = ceil($Nbr/$perpage);
	

	if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
		$cpage = $_GET['p'];
	} else {
		$cpage = 1;
	}

	// Admin service search
  $mc ="";
 if(isset($_GET['motCle'])){
  
  $mc = $_GET['motCle'];
  $results = mysqli_query($conn, "SELECT * FROM services WHERE CodeService LIKE '%$mc%' OR LibelleService LIKE '%$mc%'");

 } else {
  $results = mysqli_query($conn, 'SELECT * FROM services ORDER BY IdService DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
 }


	// retrieve records
	



?>