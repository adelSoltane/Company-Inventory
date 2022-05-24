<?php include 'header.php'; ?>

<?php include 'server_affectations.php'; 

?>
<h1>Affectations</h1>
    <table>
      <thead>
        <tr>
        <a class="btn btn-primary d-print-none" href="affectations_admin.php" style="margin-top: 20px; margin-left: 130px;">
  Retour
</a>

<a hidden-print href="" id="print" onclick="javascript:window.print()" class="btn btn-primary d-print-none" style="display: inline-block; margin-top: 20px; margin-left: 820px;">
  Imprimer
</a>
          <th>Matériel</th>
          <th>Propriétaire</th>
          <th>Date d'acquisition</th>
          <th>Date de fin d'acquisition</th>
          
          
          
        </tr>
      </thead>
      <tbody>

      <?php while ($row = mysqli_fetch_array($recordddd)) { ?>
          <tr>
          <td><?php echo $row['libelle'].' '.$row['marque']; ?></td>
          <td><?php echo $row['user_nom'].' '.$row['user_prenom']; ?></td>
          <td><?php echo $row['date_affectation']; ?></td>
          <td><?php echo $row['date_affectation_fin']; ?></td>
        </tr>
        
        <?php } ?>
        
        
      </tbody>
    </table>

     <?php for($i=1;$i<=$nbpage;$i++){
      echo "<a style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary d-print-none\" href=\"historique_admin.php?p=$i\">$i </a>";
      } 
    
    ?>



<?php include 'footer.php'; ?>