<?php include 'header.php'; ?>

<?php include '../admin/server_comptes.php'; 


?>
<h1>Comptes du service</h1>
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Fonction</th>
          <th>Pseudo</th>
          <th>Service</th>
          <th>Type</th>
          
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_array($resultsD)) { ?>
          <tr>
          <td><?php echo $row['user_nom']; ?></td>
          <td><?php echo $row['user_prenom']; ?></td>
          <td><?php echo $row['user_fonction']; ?></td>
          <td><?php echo $row['user_pseudo']; ?></td>
          <td><?php echo $row['LibelleService']; ?></td>
          <td><?php echo $row['user_type']; ?></td>
       
        </tr>
        

        <?php } ?>
        
      </tbody>
    </table>

    <?php for($i=1;$i<=$nbpage;$i++){
      echo "<a style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary  d-print-none\" href=\"comptes_directeur.php?p=$i\">$i </a>";
      } 
    
    ?>

<?php include 'footer.php'; ?>