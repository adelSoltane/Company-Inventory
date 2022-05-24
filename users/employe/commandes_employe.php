<?php include 'header.php' ?>

<?php include '../admin/server_commandes.php'; ?>

<h1>Commandes</h1>

<form method="POST" action="commandes_employe.php">

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
      
      <div class="input-group">
      	<button type="submit" name="save" class="btn">Envoyer</button>
      </div>
      
    </form>

<?php include 'footer.php' ?>