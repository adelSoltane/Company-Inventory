<?php include 'header.php'; ?>

<?php include 'server_commandes.php'; ?>

<h1>Commandes</h1>
    <table>
      <thead>
        <tr>
        <a class="btn btn-primary d-print-none" href="commandes_admin.php" style="margin-top: 20px; margin-left: 130px;">
  Retour
</a>

<a hidden-print href="" id="print" onclick="javascript:window.print()" class="btn btn-primary d-print-none" style="display: inline-block; margin-top: 20px; margin-left: 820px;">
  Imprimer
</a>
          <th>Commanditaire</th>
          <th>Désignation de la Commande</th>
          <th>Quantité</th>
          <th>Date de la Commande</th>
          </tr>
      </thead>

      <tbody>

          <?php while ($row = mysqli_fetch_array($recorddd)) { ?>
          <tr>
          <td><?php echo $row['user_nom'].' '.$row['user_prenom']; ?></td>
          <td><?php echo $row['designation_commande']; ?></td>
          <td><?php echo $row['quantite_commande']; ?></td>
          <td><?php echo $row['date_commande']; ?></td>
           
         

        </tr>
        

        <?php } ?>
        
      </tbody>
    </table>

    <?php for($i=1;$i<=$nbpage;$i++){
      echo "<a style=\"position: relative;
    left: 550px;\" class=\"btn btn-secondary d-print-none\" href=\"materiel_admin.php?p=$i\">$i </a>";
      } 
    
    ?>

    
<?php include 'footer.php'; ?>