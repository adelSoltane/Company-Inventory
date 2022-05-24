<?php
	
	// initialize variables
	$del = "";
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$Fournisseur = "";
	$id = 0;
	$edit_state = false;

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');
	mysqli_query($conn, "SET NAMES UTF8"); 
	//if save button is clicked
	if (isset($_POST['save'])) {
		$Fournisseur = ($_POST['fournisseur']);
		


		if (empty($Fournisseur)) {
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir le champs !
</div>';
		} else {

		$query = "INSERT INTO fournisseurs (LibelleFournisseurs) VALUES ('$Fournisseur')";
		mysqli_query($conn, $query);
		
		$success = '<div class="alert alert-success" role="alert">
  Fournisseur ajouté !
</div>';
		}
	}

	// upcode records
	if (isset($_POST['update'])){
		
		$Fournisseur = mysqli_real_escape_string($conn, $_POST['fournisseur']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		

		if (empty($Fournisseur)) {
			
			header("Location:Fournisseurs_admin.php");
		} else {

		mysqli_query($conn, "UPDATE Fournisseurs SET LibelleFournisseurs='$Fournisseur' WHERE IdFournisseur=$id");
		
		header('location:Fournisseurs_admin.php');
	  }
	}

	// delete records
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($conn, "DELETE FROM Fournisseurs WHERE IdFournisseur=$id");
		
		$del = '<div class="alert alert-success" role="alert">
  Fournisseur effacé !
</div>';
	}

	// pagination matériel

	$count = mysqli_query($conn, "SELECT COUNT(IdFournisseur) as Nbr FROM fournisseurs");
	$row = mysqli_fetch_array($count);
	$Nbr = $row['Nbr'];
  	$perpage = '10';
  	$nbpage = ceil($Nbr/$perpage);
	

	if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
		$cpage = $_GET['p'];
	} else {
		$cpage = 1;
	}

	// Admin fournisseur search
  $mc ="";
 if(isset($_GET['motCle'])){
  
  $mc = $_GET['motCle'];
  $results = mysqli_query($conn, "SELECT * FROM fournisseurs WHERE LibelleFournisseurs LIKE '%$mc%'");

 } else {
  $results = mysqli_query($conn, 'SELECT * FROM Fournisseurs ORDER BY IdFournisseur DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
 }

	// retrieve records
	



?>