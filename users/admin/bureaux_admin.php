<?php include 'header.php'; ?>

<?php include 'server_bureaux.php'; 

  // fetch the record to update
 if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $edit_state = true;
    $rec = mysqli_query($conn, "SELECT * FROM bureaux WHERE IdBureau=$id");
    $record = mysqli_fetch_array($rec);
    $code = $record['CodeService'];
    $service = $record['LibelleService'];
    $id = $record['IdBureau']; 
    $bureau = $record['LibelleBureau']; 
 }
?>

<h1>Bureaux</h1>
          <?php echo $success; echo $error; echo $error2; echo $empty; echo $del;?>

    <table>
      <thead>
        <tr>

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-print-none" data-toggle="modal" data-target="#ModalAdd" style="margin-top: 20px; margin-left: 120px;">
  Ajouter un bureau
</button>

<a hidden-print href="" id="print" onclick="javascript:window.print()" class="btn btn-primary d-print-none" style="display: inline-block; margin-top: 20px; margin-left: 820px;">
  Imprimer
</a>

<form action="bureaux_admin.php" method="GET">
  <input type="text" style="position: relative; width: 80%; margin-left: 120px; position: relative; margin-top: 20px;" class="form-control d-print-none" placeholder="Recherche" name="motCle" value="<?php echo ($mc) ?>"/>
</form>

<!-- Modal Update-->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddLabel">Ajouter un fournisseur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="bureaux_admin.php">

    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="input-group">
     <label>Code du service</label>
        <input list="browsers" class="input-group" name="service" >
        <datalist id="browsers">
          
        
        <?php while ($row = mysqli_fetch_array($recordd)) {

          echo '<option value="'.$row['CodeService'].'" >'.$row['LibelleService'].'  </option>';
            }
            ?>
            
            </datalist>

      </div>
      
      <div class="input-group">
        <label>Bureau</label>
        <input type="text" name="bureau" value="<?php echo $bureau; ?>">
      </div>
      <?php if ($edit_state == false): ?>
        <button type="submit" name="save" class="btn">Sauvegarder</button>
      <?php else: ?>
        <button type="submit" name="update" class="btn">Update</button>
      <?php endif ?>
      </div>
    </form>
      </div>
    
    </div>
  </div>
</div>
          <th>Code du Service</th>
          
          <th>Libellé de Bureau</th>

          <th style="left: 270px;" colspan="1">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
          <tr>
          <td><?php echo $row['CodeService']; ?></td>
          
          <td><?php echo $row['LibelleBureau']; ?></td>
          <td align="right">
            <a class="btn btn-primary d-print-none" href="bureaux_admin.php?edit=<?php echo $row['IdBureau']; ?>">Modifier</a>
         
            <a class="btn btn-danger d-print-none" href="bureaux_admin.php?del=<?php echo $row['IdBureau']; ?>">Effacer</a>
          </td>
        </tr>
        

        <?php } ?>
        
      </tbody>
    </table>

     <?php for($i=1;$i<=$nbpage;$i++){
      echo "<a style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary d-print-none\" href=\"bureaux_admin.php?p=$i\">$i </a>";
      } 
    
    ?>

    <form method="POST" action="server_bureaux.php">

    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="input-group">
     <label>Code du service</label>
        <input list="browsers" class="input-group" name="service" >
        <datalist id="browsers">
          
        
        <?php while ($row = mysqli_fetch_array($recordd)) {

          echo '<option value="'.$row['CodeService'].'" >'.$row['LibelleService'].'  </option>';
            }
            ?>
            
            </datalist>

      </div>
      
      <div class="input-group">
        <label>Bureau</label>
        <input type="text" name="bureau" value="<?php echo $bureau; ?>">
      </div>
      <?php if ($edit_state == false): ?>
        <button type="submit" name="save" class="btn">Save</button>
      <?php else: ?>
        <button type="submit" name="update" class="btn">Update</button>
      <?php endif ?>
      </div>
    </form>

<?php include 'footer.php'; ?>