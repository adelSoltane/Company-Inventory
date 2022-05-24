<?php include 'header.php' ?>

<?php include '../admin/server_pannes.php'; ?>

<h1>Pannes</h1>

<form method="POST" action="pannes_directeur.php">

<?php echo $success; echo $empty; echo $error; echo $error2; echo $error22;?>
    
    <input type="hidden" name="id">
      <div class="input-group">
        <label>Matériel</label>
        <input list="browsers3" class="input-group" name="materiel" >
        <datalist id="browsers3">
          
        
        <?php while ($row = mysqli_fetch_array($resultss)) {

          echo '<option value="'.$row['id_materiel'].'"> '.$row['libelle'].' '.$row['marque'].' '.$row['code'].' </option>';
            }
            ?>
            
            </datalist>
      </div>
      <div class="input-group">
        <label>Description de la panne</label>
        <textarea class="input-group" name="description"></textarea>
      </div>
      
      <div class="input-group">
        <button type="submit" name="save" class="btn">Envoyer</button>
      </div>
      
    </form>

<?php include 'footer.php' ?>