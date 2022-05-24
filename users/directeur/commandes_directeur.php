<?php include 'header.php'; ?>

<?php include '../admin/server_commandes.php'; ?>

<h1>Commandes</h1>
    <table>
      <thead>
        <tr>
        <?php echo $success; echo $empty; echo $error; ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="margin-top: 20px; margin-left: 130px;">
  Emettre une commande
</button>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Commande</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="commandes_directeur.php">

<?php echo $success; echo $empty; echo $error; ?>
    
    <input type="hidden" name="id">
      <div class="input-group">
        <label>Désignation</label>
        <input type="text" name="designation" style="text-transform:uppercase">
      </div>
      <div class="input-group">
        <label>Quantité</label>
        <input type="number" name="quantite">
      </div>
      <br>
      <div class="input-group">
        <button type="submit" name="save2" class="btn btn-primary">Envoyer</button>
      </div>

    </form>
      </div>
      
        
       
      
    </div>
  </div>
</div>
      
          <th>Commanditaire</th>
          <th>Désignation de la Commande</th>
          <th>Quantité</th>

          <th colspan="1" style="left: 170px;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
          <tr>
          <td><?php echo $row['user_nom'].' '.$row['user_prenom']; ?></td>
          <td><?php echo $row['designation_commande']; ?></td>
          <td><?php echo $row['quantite_commande']; ?></td>
          
           
           <td align="right";> 
          <a class="btn btn-success" href="commandes_directeur.php?ok=<?php echo $row['id_commandes']; ?>">Accepter</a>
          
            <a class="btn btn-danger" href="commandes_directeur.php?del=<?php echo $row['id_commandes']; ?>">Rejeter</a>
          </td>
        </tr>
        

        <?php } ?>
        
      </tbody>
    </table>


<?php include 'footer.php'; ?>