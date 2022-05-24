<div class="modal fade" id="<?php echo $id_materiel;; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUpdateLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?php''.echo $row['materiel_id'].''; ?>">Mettre à jour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="server_materiel.php">
    <input type="hidden" name="id" value="<?php echo $id_materiel; ?>">
      <div class="input-group">
        
        <label>Nom</label>
        <input type="text" name="nom" value="<?php echo $row['libelle']; ?>">
      </div>
      <div class="input-group">
        <label>Prénom</label>
        <input type="text" name="prenom" value="<?php echo $row['date_acquis']; ?>">
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
