<?php include 'header.php'; ?>

<?php include 'server_pannes.php'; ?>




<h1>Pannes</h1>
    <table>
      <thead>
        <tr>
        <a class="btn btn-primary d-print-none" href="pannes_admin.php" style="margin-top: 20px; margin-left: 130px;">
  Retour
</a>

<a hidden-print href="" id="print" onclick="javascript:window.print()" class="btn btn-primary d-print-none" style="display: inline-block; margin-top: 20px; margin-left: 820px;">
  Imprimer
</a>
          <th>Destinataire</th>
          <th>Matériel</th>
          <th>Description de la panne</th>
          <th>Date de la panne</th>

          
        </tr>
      </thead>
      <tbody>
          <?php while ($row = mysqli_fetch_array($resultsss)) { ?>
          <tr>
          <td><?php echo $row['user_nom'].' '.$row['user_prenom']; ?></td>
          <td><?php echo $row['libelle'].' '.$row['code']; ?></td>
          <td maxlength="5"><?php echo $row['observation']; ?></td>
          <td><?php echo $row['date_panne']; ?></td>
          
         
        </tr>
        
        <?php } ?>
        
        
      </tbody>
    </table>

     <?php for($i=1;$i<=$nbpage;$i++){
      echo "<span style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary d-print-none\" href=\"maintenance_pannes.php?p=$i\">$i </span>";
      } 
    
    ?>

    
<?php include 'footer.php'; ?>