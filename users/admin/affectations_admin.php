<?php include 'header.php'; ?>

<?php include 'server_affectations.php'; 

  // fetch the record to update
 if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $edit_state = true;
    $rec = mysqli_query($conn, "SELECT * FROM affectation WHERE id_affectation=$id");
    if (!$rec) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
    $record = mysqli_fetch_array($rec);
    $materiel = $record['id_materiel'];
    $proprio = $record['user_id'];
    $id = $record['id_affectation']; 
    $date_debut = $record['date_affectation']; 
    $date_fin = $record['date_affectation_fin'];
    

 }
?>
<h1>Affectations</h1>
          <?php echo $success; echo $error; echo $error2; echo $empty; echo $del;?>

    <table>
      <thead>
        <tr>
          <a class="btn btn-primary d-print-none" href="historique_admin.php" style="margin-top: 20px; margin-left: 130px;">
  Historique d'affectations
</a>

<button type="button" class="btn btn-primary d-print-none" data-toggle="modal" data-target="#ModalAdd" style="margin-top: 20px; margin-left: 50px;">
  Ajouter une affectation
</button>

<a href="" id="print" onclick="javascript:window.print()" class="btn btn-primary d-print-none" style="display: inline-block; margin-top: 20px; margin-left: 580px;">
  Imprimer
</a>

<!-- Modal Add-->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddLabel">Ajout affectation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="affectations_admin.php">
   <input type="hidden" name="id" value="<?php echo $id; ?>">

   <label>Matériel</label>
        <div class="input-group">
        <input list="browsers" class="input-group" name="materiel" value="<?php echo $materiel ?>" >
        <datalist id="browsers">
        <?php while ($row = mysqli_fetch_array($recordd)) {

          echo '<option value="'.$row['id_materiel'].'"> '.$row['libelle'].' '.$row['marque'].' '.$row['code'].' </option>';
            }
            ?>
            </datalist>
      </div>
     
      <div class="input-group">
        <label>Propriétaire</label>
        <input list="browserss" class="input-group" name="proprio" value="<?php echo $proprio ?>" >
        <datalist  id="browserss">
        <?php while ($row = mysqli_fetch_array($results)) {

          echo '<option value="'.$row['user_id'].'"> '.$row['user_pseudo'].' </option>';
            }
            ?>
            </datalist>
      </div>
      <div class="input-group">
        <label>Date d'affectation</label>
        <input type="date" name="date_debut" value="<?php echo $date_debut; ?>">
      </div>
     <br>
  
    
      <div class="input-group">
      <?php if ($edit_state == false): ?>
        <button type="submit" name="save" class="btn">Enregistrer</button>
      <?php else: ?>
        <button type="submit" name="update" class="btn">Enregistrer</button>
      <?php endif ?>
      </div>
    </form>
      </div>
    
    </div>
  </div>
</div>
          <th>Matériel</th>
          <th>Propriétaire</th>
          <th>Date d'acquisition</th>
          
          
          
          <th style="left: 170px;" colspan="1" class="d-print-none">Action</th>
        </tr>
      </thead>
      <tbody>

      <?php while ($row = mysqli_fetch_array($recorddd)) { ?>
          <tr>
          <td><?php echo $row['libelle'].' '.$row['code']; ?></td>
          <td><?php echo $row['user_pseudo']; ?></td>
          <td><?php echo $row['date_affectation']; ?></td>
          
          
     
          
          <td align="right">
            <a class="btn btn-primary d-print-none" href="affectations_admin.php?edit=<?php echo $row['id_affectation']; ?>">Modifier</a>
          
            <a class="btn btn-danger d-print-none" href="affectations_admin.php?del=<?php echo $row['id_affectation']; ?>">Effacer</a>
          </td>
        </tr>
        
        <?php } ?>
        
        
      </tbody>
    </table>

     <?php for($i=1;$i<=$nbpage;$i++){
      echo "<a style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary d-print-none\" href=\"affectations_admin.php?p=$i\">$i </a>";
      } 
    
    ?>

    <form method="POST" action="affectations_admin.php">
   <input type="hidden" name="id" value="<?php echo $id; ?>">

   <label>Matériel</label>
        <div class="input-group">
        <input list="browsers" class="input-group" name="materiel" value="<?php echo $materiel ?>" >
        <datalist id="browsers">
        <?php while ($row = mysqli_fetch_array($recordd)) {

          echo '<option value="'.$row['id_materiel'].'"> '.$row['libelle'].' '.$row['marque'].' '.$row['code'].' </option>';
            }
            ?>
            </datalist>
      </div>
     
      <div class="input-group">
        <label>Propriétaire</label>
        <input list="browserss" class="input-group" name="proprio" value="<?php echo $proprio ?>" >
        <datalist  id="browserss">
        <?php while ($row = mysqli_fetch_array($results)) {

          echo '<option value="'.$row['user_id'].'"> '.$row['user_pseudo'].' </option>';
            }
            ?>
            </datalist>
      </div>
      <div class="input-group">
        <label>Date d'affectation</label>
        <input type="date" name="date_debut" value="<?php echo $date_debut; ?>">
      </div>
     <br>
  
    
      <div class="input-group">
      <?php if ($edit_state == false): ?>
        <button type="submit" name="save" class="btn">Enregistrer</button>
      <?php else: ?>
        <button type="submit" name="update" class="btn">Enregistrer</button>
      <?php endif ?>
      </div>
    </form>


<?php include 'footer.php'; ?>