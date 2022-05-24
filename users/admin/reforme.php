<?php include 'header.php'; ?>

<?php include 'server_reforme.php'; ?>




<h1>Réforme</h1>

    <table>
      <thead>
        <tr>
        <?php echo $success; echo $empty;?>
                  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-print-none" data-toggle="modal" data-target="#ModalAdd" style="margin-top: 20px; margin-left: 130px;">
  Ajouter un matériel à la réforme
</button>

<a href="" id="print" onclick="javascript:window.print()" class="btn btn-primary d-print-none" style="display: inline-block; margin-top: 20px; margin-left: 780px;">
  Imprimer
</a>

<!-- Modal Update-->

  <!-- Modal Add-->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddLabel">Ajout réforme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="reforme.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

      
      <div class="input-group">
        
       <label>Matériel</label>
        <input list="browsers" class="input-group" name="materiel" >
        <datalist id="browsers">
          
        
        <?php while ($row = mysqli_fetch_array($materiel)) {

          echo '<option value="'.$row['id_materiel'].'" >'.$row['libelle'].'   '.$row['marque'].'  '.$row['code'].' </option>';
            }
            ?>
            
            </datalist>

      </div>

      <div class="input-group">
        
        <label>Propriétaire</label>
<input list="browserss" class="input-group" name="proprio" >
        <datalist id="browserss">
          
        
        <?php while ($row = mysqli_fetch_array($user)) {

          echo '<option value="'.$row['user_id'].'" >'.$row['user_nom'].'   '.$row['user_prenom'].'</option>';
            }
            ?>
            
            </datalist>

      </div>
      
    
      <div class="input-group">
      
        <button type="submit" name="save" class="btn btn-primary">Enregistrer</button>
     &nbsp;
      <button class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
      </div>
    
    </div>
  </div>
</div>
     
          <th>Ancien Propriétaire</th>
          <th>Matériel</th>
          
          <th>Date de la réforme</th>

          
        </tr>
      </thead>
      <tbody>
          <?php while ($row = mysqli_fetch_array($reforme)) { ?>
          <tr>
          <td><?php echo $row['user_nom'].' '.$row['user_prenom']; ?></td>
          <td><?php echo $row['libelle'].' '.$row['marque'].' '.$row['code']; ?></td>
          
          <td><?php echo $row['date_reforme']; ?></td>
          
         
        </tr>
        
        <?php } ?>
        
        
      </tbody>
    </table>

     <?php for($i=1;$i<=$nbpage;$i++){
      echo "<a style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary d-print-none\" href=\"maintenance_pannes.php?p=$i\">$i </a>";
      } 
    
    ?>

    
<?php include 'footer.php'; ?>