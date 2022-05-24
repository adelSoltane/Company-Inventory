<?php include 'header.php'; ?>

<?php include 'server_pannes.php'; ?>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Description de la panne</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php while ($row = mysqli_fetch_array($description)) { ?>
        <?php echo $row['observation']; ?>
      <?php } ?>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
  </div>
</div>

<h1>Pannes</h1>
    <table>
      <thead>
        <tr>
        <a class="btn btn-primary d-print-none" href="maintenance_pannes.php" style="margin-top: 20px; margin-left: 130px;">
  Historique des pannes
</a>

<a hidden-print href="" id="print" onclick="javascript:window.print()" class="btn btn-primary d-print-none" style="display: inline-block; margin-top: 20px; margin-left: 710px;">
  Imprimer
</a>
          <th>Destinataire</th>
          <th>Matériel</th>
          <th>Description de la panne</th>


          <th style="left: 110px;" colspan="1">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php while ($row = mysqli_fetch_array($results)) { ?>
          <tr>
          <td><?php echo $row['user_nom'].' '.$row['user_prenom']; ?></td>
          <td><?php echo $row['libelle'].' '.$row['marque'].' '.$row['code']; ?></td>
          <td maxlength="20"><?php echo $row['observation']; ?></td>
          <td align="right">
            <a class="btn btn-success  d-print-none" href="pannes_admin.php?ok=<?php echo $row['id_panne']; ?>">Réparé</a>
          
            <a class="btn btn-danger d-print-none" href="pannes_admin.php?del=<?php echo $row['id_panne']; ?>">Réformé</a>
          
            <a class="btn btn-primary d-print-none" href="" data-toggle="modal" data-target="#exampleModalCenter">Details</a>
          </td>
         
        </tr>
        
        <?php } ?>
        
        
      </tbody>
    </table>

    <?php for($i=1;$i<=$nbpage;$i++){
      echo "<a style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary d-print-none\" href=\"pannes_admin.php?p=$i\">$i </a>";
      } 
    
    ?>

    
<?php include 'footer.php'; ?>