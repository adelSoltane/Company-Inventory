<?php
	
	// initialize variables
	$del = "";
	$error2 = "";
	$error = "";
	$success = "";
	$empty = "";
	$date = "";
	$model = "";
	$marque = "";
	$garantie = "";
	
	$uid = $_SESSION['u_id'];
	$libelle = "";
	$code = "";
	$prix = "";
	$fournisseur = "";
	$id = 0;
	$edit_state = false;

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'parc');

	//if save button is clicked
	if (isset($_POST['save'])) {
		$date = mysqli_real_escape_string($conn, $_POST['date']);
		$model = mysqli_real_escape_string($conn, $_POST['model']);
		$marque = mysqli_real_escape_string($conn, $_POST['marque']);
		$garantie = mysqli_real_escape_string($conn, $_POST['garantie']);
		$libelle = mysqli_real_escape_string($conn, $_POST['libelle']);
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$prix = mysqli_real_escape_string($conn, $_POST['prix']);
		$fournisseur = mysqli_real_escape_string($conn, $_POST['fournisseur']);
		$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);



		if (empty($date) || empty($model) || empty($marque) || empty($garantie) || empty($libelle) || empty($code) || empty($prix) || empty($fournisseur)) {
			
			
			$empty = '<div class="alert alert-warning" role="alert">
  Veuillez remplir tous les champs !
</div>';
		} else {
			$sql = "SELECT code FROM materiel WHERE code='$code'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_fetch_array($result);

			if ($resultCheck['code'] == $code) {
				$error = '<div class="alert alert-warning" role="alert">
  Ce numéro dinventaire est déjà pris !
</div>';
		} else {
			$sql2 = "SELECT LibelleFournisseurs FROM fournisseurs WHERE LibelleFournisseurs='$fournisseur'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_fetch_array($result2);

			if ($resultCheck2['LibelleFournisseurs'] !== $fournisseur) {
				$error2 = '<div class="alert alert-warning" role="alert">
  Veuillez entrer un fournisseur disponible !
</div>';

		} else {

		$query = "INSERT INTO materiel (date_acquis, model, marque, garantie, libelle, code, prix, fournisseur) VALUES ('$date', '$model', '$marque', '$garantie', '$libelle', '$code', '$prix', '$fournisseur');";
		mysqli_query($conn, $query);
		
		$success = '<div class="alert alert-success" role="alert">
  Matériel ajouté !
</div>';
		}
		}
		}
	}
	

	// update records
	if (isset($_POST['update'])){
		$date = mysqli_real_escape_string($conn, $_POST['date']);
		$model = mysqli_real_escape_string($conn, $_POST['model']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$marque = mysqli_real_escape_string($conn, $_POST['marque']);
		$garantie = mysqli_real_escape_string($conn, $_POST['garantie']);
		
		$libelle = mysqli_real_escape_string($conn, $_POST['libelle']);
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$prix = mysqli_real_escape_string($conn, $_POST['prix']);
		$fournisseur = mysqli_real_escape_string($conn, $_POST['fournisseur']);

		if (empty($date) || empty($model) || empty($marque) || empty($garantie) || empty($libelle) || empty($code)  || empty($prix)  || empty($fournisseur)) {
			
			header("Location:materiel_admin.php");
		} else {

		mysqli_query($conn, "UPDATE materiel SET date_acquis='$date', model='$model', marque='$marque', garantie='$garantie', libelle='$libelle', code='$code', prix ='$prix', fournisseur='$fournisseur' WHERE id_materiel=$id");

}
		
		header('location:materiel_admin.php');
	  }
	

	// delete records
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($conn, "DELETE FROM materiel WHERE id_materiel=$id");
		
		$del = '<div class="alert alert-success" role="alert">
  Matériel effacé !
</div>';
	}

	// pagination matériel

	$count = mysqli_query($conn, "SELECT COUNT(id_materiel) as Nbr FROM materiel");
	$row = mysqli_fetch_array($count);
	$Nbr = $row['Nbr'];
  	$perpage = '10';
  	$nbpage = ceil($Nbr/$perpage);
	

	if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
		$cpage = $_GET['p'];
	} else {
		$cpage = 1;
	}

	
  // Admin materiel search
  $mc ="";
 if(isset($_GET['motCle'])){
  
  $mc = $_GET['motCle'];

  if (empty($mc)) {
 	header("Location:materiel_admin.php");
 	exit();
 } else {
  
  $results = mysqli_query($conn, "SELECT * FROM materiel WHERE libelle LIKE '%$mc%' OR marque LIKE '%$mc%' OR code LIKE '%$mc%'");

 } 
} 
 else {
  $results = mysqli_query($conn, 'SELECT * FROM materiel ORDER BY id_materiel DESC LIMIT '.(($cpage-1)*$perpage).', '.$perpage.'');
 }

 	// Directeur search
 if(isset($_GET['motCleF'])){
  
  $mc = $_GET['motCleF'];

  if (empty($mc)) {
 	header("Location:materiel_directeur.php");
 	exit();
 } else {

  $propre = mysqli_query($conn, "SELECT * FROM affectation, materiel, users WHERE date_affectation_fin = '00-00-0000' AND users.user_id = affectation.user_id AND materiel.id_materiel = affectation.id_materiel AND affectation.user_id='$uid' AND materiel.libelle LIKE '%$mc%' OR materiel.marque LIKE '%$mc%' OR materiel.code LIKE '%$mc%'");
}
 } else {
  $propre = mysqli_query($conn, "SELECT * FROM affectation, materiel, users WHERE users.user_id = affectation.user_id AND materiel.id_materiel = affectation.id_materiel AND affectation.user_id='$uid' AND date_affectation_fin = '00-00-0000'");
 }

 // Employe search
 if(isset($_GET['motCleFF'])){
  
  $mc = $_GET['motCleFF'];

  if (empty($mc)) {
 	header("Location:materiel_employe.php");
 	exit();
 } else {

  $propre2 = mysqli_query($conn, "SELECT * FROM affectation, materiel, users WHERE date_affectation_fin = '00-00-0000' AND users.user_id = affectation.user_id AND materiel.id_materiel = affectation.id_materiel AND affectation.user_id='$uid' AND materiel.libelle LIKE '%$mc%' OR materiel.marque LIKE '%$mc%' OR materiel.code LIKE '%$mc%'");
}
 } else {
  $propre2 = mysqli_query($conn, "SELECT * FROM affectation, materiel, users WHERE users.user_id = affectation.user_id AND materiel.id_materiel = affectation.id_materiel AND affectation.user_id='$uid' AND date_affectation_fin = '00-00-0000'");
 }



  	

	// retrieve records
	
	 
	$recordd = mysqli_query($conn, "SELECT * FROM fournisseurs");
	$recorddd = mysqli_query($conn, "SELECT * FROM affectation,users,materiel WHERE affectation.user_id = users.user_id and affectation.id_materiel = materiel.id_materiel ");
	

	


?>