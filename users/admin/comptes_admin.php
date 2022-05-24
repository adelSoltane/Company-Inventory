<?php include 'header.php'; ?>

<?php include 'server_comptes.php'; 

  // fetch the record to update
 if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $edit_state = true;
    $rec = mysqli_query($conn, "SELECT * FROM users WHERE user_id=$id");
    $record = mysqli_fetch_array($rec);
    $nom = $record['user_nom'];
    $prenom = $record['user_prenom'];
    $id = $record['user_id']; 
    $fonction = $record['user_fonction']; 
    $pseudo = $record['user_pseudo']; 
    $type = $record['user_type']; 
    $pwd = $record['user_pwd'];
    $service = $record['user_service'];
    

 }
?>
<h1>Comptes</h1>
<?php echo $success; echo $error; echo $error2; echo $empty; echo $del;?>

    <table style="position: center;">
      <thead>
        <tr>
          <!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-print-none" data-toggle="modal" data-target="#ModalAdd" style="margin-top: 20px; margin-left: 120px;">
  Ajouter un utilisateur
</button>

<a href="" id="print" onclick="javascript:window.print()" class="btn btn-primary d-print-none" style="display: inline-block; margin-top: 20px; margin-left: 825px;">
  Imprimer
</a>

<form action="comptes_admin.php" method="GET">
  <input type="text" style="position: relative; width: 80%; margin-left: 120px; position: relative; margin-top: 20px;" class="form-control d-print-none" placeholder="Recherche" name="motCle" value="<?php echo ($mc) ?>"/>
</form>



  <!-- Modal Add-->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="comptes_admin.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>"><label>Nom</label>
      <div class="input-group">
        

        <input type="text" name="nom" value="<?php echo $nom; ?>">
      </div>
      <div class="input-group">
        <label>Prénom</label>
        <input type="text" name="prenom" value="<?php echo $prenom; ?>">
      </div>
      <div class="input-group">
        <label>Fonction</label>
        <input type="text" name="fonction" value="<?php echo $fonction; ?>">
      </div>
      <div class="input-group">
        <label>Pseudo</label>
        <input type="text" name="pseudo" value="<?php echo $pseudo; ?>">
      </div>
      <div class="input-group">
        <label>Mot de passe</label>
        <input type="password" name="pwd" id="myInput" value="<?php echo $pwd; ?>">
      </div>
      <input type="checkbox" onclick="myFunction()">Show Password
      <div class="input-group">
        
       <label>Service</label>
        <input list="browsers" class="input-group" name="service" >
        <datalist id="browsers">
          
        
        <?php while ($row = mysqli_fetch_array($recordd)) {

          echo '<option value="'.$row['CodeService'].'" >'.$row['LibelleService'].'   '.$row['CodeService'].' </option>';
            }
            ?>
            
            </datalist>

      </div>
      
      <div class="input-group">
        
        <label>Type</label>
        <select class="input-group" name="type" value="<?php echo $type; ?>">
          <option value="<?php echo $type; ?>" disabled selected>Veuillez choisir le type ...</option>
          <option>Employe</option>
          <option>Directeur</option>
          <option>Admin</option>
        </select>

      </div>
      <div class="input-group">
      <?php if ($edit_state == false): ?>
        <button type="submit" name="save" class="btn">Enregistrer</button>
      <?php else: ?>
        <button type="submit" name="update" class="btn">Enregistrer</button>
      <?php endif ?>&nbsp;&nbsp;
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
      </div>
    
    </div>
  </div>
</div>

          <th>Nom</th>
          <th>Prénom</th>
          <th>Fonction</th>
          <th>Pseudo</th>
          <th>Service</th>
          <th>Type</th>
          
          <th style="left: 40px;" colspan="1" class="d-print-none">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
          <tr>
          <td><?php echo $row['user_nom']; ?></td>
          <td><?php echo $row['user_prenom']; ?></td>
          <td><?php echo $row['user_fonction']; ?></td>
          <td><?php echo $row['user_pseudo']; ?></td>
          <td><?php echo $row['user_service']; ?></td>
          <td><?php echo $row['user_type']; ?></td>
          
          <td align="right">
            <a class="btn btn-primary d-print-none" href="comptes_admin.php?edit=<?php echo $row['user_id']; ?>">Modifier</a>
            
          
            <a class="btn btn-danger d-print-none" href="comptes_admin.php?del=<?php echo $row['user_id']; ?>">Effacer</a>
          </td>
        </tr>
        

        <?php } ?>
        
      </tbody>
    </table>

    <?php for($i=1;$i<=$nbpage;$i++){
      echo "<a style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary  d-print-none\" href=\"comptes_admin.php?p=$i\">$i </a>";
      } 
    
    ?>

    <form method="POST" action="server_comptes.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>"><label>Nom</label>
      <div class="input-group">
        

        <input type="text" name="nom" value="<?php echo $nom; ?>">
      </div>
      <div class="input-group">
        <label>Prénom</label>
        <input type="text" name="prenom" value="<?php echo $prenom; ?>">
      </div>
      <div class="input-group">
        <label>Fonction</label>
        <input type="text" name="fonction" value="<?php echo $fonction; ?>">
      </div>
      <div class="input-group">
        <label>Pseudo</label>
        <input type="text" name="pseudo" value="<?php echo $pseudo; ?>">
      </div>
      <div class="input-group">
        <label>Nouveau mot de passe</label>
        <input type="password" name="pwd" id="myInput" value="">
      </div>
      <input type="checkbox" onclick="myFunction()">Show Password
      <div class="input-group">
        
       <label>Service</label>
        <input list="browsers" class="input-group" name="service" value="<?php echo $service; ?>" >
        <datalist id="browsers">
          
        
        <?php while ($row = mysqli_fetch_array($recordd)) {

          echo '<option value="'.$row['CodeService'].'" >'.$row['LibelleService'].'  </option>';
            }
            ?>
            
            </datalist>

      </div>
      
      <div class="input-group">
        
        <label>Type</label>
        <select class="input-group" name="type" value="<?php echo $type; ?>">
          
          <option selected disabled hidden><?php echo $type; ?></option>
          <option>Employe</option>
          <option>Directeur</option>
          <option>Admin</option>
        </select>

      </div>
      <div class="input-group">
      <?php if ($edit_state == false): ?>
        <button type="submit" name="save" class="btn">Enregistrer</button>
      <?php else: ?>
        <button type="submit" name="update" class="btn">Mettre à jour</button>
      <?php endif ?>
      </div>
    </form>

    <script type="text/javascript">
      function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

    </script>

 

<?php include 'footer.php'; ?>